<?php

use App\Models\Product;
use App\Models\User;

use function Pest\Laravel\actingAs;

use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->user = User::factory()->create();
});
 
test('homepage contains empty table', function () {
    actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertSee(__('No products found'));
});
 
test('homepage contains non empty table', function () { 
    $product = Product::create([
        'name'  => 'Product 1',
        'price' => 123,
    ]);
 

    actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertDontSee(__('No products found'))
        ->assertViewHas('products',function(LengthAwarePaginator $collection)use ($product){
            return $collection->contains($product);
        });
});

test('paginate products tble doesnt contain 11th record',function(){
    $products = Product::factory(11)->create(); 
    $lastProduct = $products->last();


    actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertViewHas('products', function (LengthAwarePaginator $collection) use ($lastProduct) {
            return $collection->doesntContain($lastProduct);
        });
});


test('admin can see product create button',function(){
    asAdmin()
        ->get('/products')
        ->assertStatus(200)
        ->assertSee(__('Add new product'));
});

test('non admin cant see product create button',function(){
    actingAs($this->user)
        ->get('/products')
        ->assertStatus(200)
        ->assertDontSee(__('Add new product'));
});

test('admin can access product create page',function(){
    asAdmin()
        ->get('/products/create')
        ->assertStatus(200);
});

test('non admin cant access product create page',function(){
    actingAs($this->user)
        ->get('/products/create')
        ->assertStatus(403);
});

test('admin can create product',function(){
    $product = [
        'name' => 'Product 1',
        'price' => 123,
    ];

    asAdmin()
        ->post('/products',$product)
        ->assertStatus(302)
        ->assertRedirect('/products');

    $this->assertDatabaseHas('products',$product);

    $lastProduct = Product::latest()->first();

    expect($lastProduct->name)
        ->toBe($product['name'])
        ->and($lastProduct->price)
        ->toBe($product['price']);
});
