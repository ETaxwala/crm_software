<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetData extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $response = $this->postJson('/add-num', [
            'number1' => 5,
            'number2' => 10,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'result' => 15
            ]);
    }

}
