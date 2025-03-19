<?php

use App\Models\Product;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses()->group('products');
 
test('api returns products list', function () {
    $product = Product::factory()->create();
 
    $res = getJson('/api/products')
        ->assertJson([$product->toArray()]);
 
    expect($res->content())
        ->json()
        ->toHaveCount(1);
});
 
test('api product store successful', function () {
    $product = [
        'name' => 'Product 1',
        'price' => 123
    ];
 
    postJson('/api/products', $product)
        ->assertStatus(201)
        ->assertJson($product);
});
 
test('api product invalid store returns error', function () {
    $product = [
        'name' => '',
        'price' => 123
    ];
 
    postJson('/api/products', $product)
        ->assertStatus(422);
});