<?php

namespace Tests\Feature;

use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function index_without_filter_returns_all_houses()
    {
        House::factory()->count(10)->create();
        $response = $this->get('/houses');

        $response->assertStatus(200)->assertJsonCount(10);
    }
}
