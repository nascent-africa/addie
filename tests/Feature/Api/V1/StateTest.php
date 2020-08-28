<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class StateTest extends TestCase
{
    protected $route = '/api/v1/en/states';

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_return_states()
    {
        $response = $this->json('get', $this->route);

        $response->assertJsonStructure([
            'success', 'states'
        ]);

        $response->assertStatus(200);
    }
}
