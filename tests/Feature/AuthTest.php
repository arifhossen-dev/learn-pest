<?php

use App\Models\User;
use function Pest\Laravel\get;

test('unauthenticated user cannot access product', function () {
    get('/products')
        ->assertStatus(302)
        ->assertRedirect('/login');
});

// test('login redirects to products', function () {
//     User::create([
//         'name' => 'User',
//         'email' => 'user@user.com',
//         'password' => bcrypt('password123')
//     ]);
 
//     $this->withoutMiddleware()
//         ->post('/login', [
//             'email' => 'user@user.com',
//             'password' => 'password123',
//             '_token' => csrf_token(),
//         ])
//         ->assertStatus(302)
//         ->assertRedirect('products');
// });
