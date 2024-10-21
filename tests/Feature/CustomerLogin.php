<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerLogin extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/customer-login', [
            'user_name' => 'user2@gmail.com',
            'user_pass' => 'Cust@2024',
        ]);
        $response->assertStatus(302); // Check for a redirect
        $response->assertRedirect('/customer-dashboard'); // Adjust this based on your actual redirect route

        // $this->assertAuthenticatedAs($customer, 'customer'); // Assumes 'customer' is the guard name used in your CustomerMiddleware
        $this->assertEquals('this is santosh asole personal token', Session::get('token'));
    }
}
