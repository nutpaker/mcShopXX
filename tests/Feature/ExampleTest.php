<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('https://api.mojang.com/users/profiles/minecraft/numnoi?at=1579364447');


        $response->assertStatus(200);
    }
}
