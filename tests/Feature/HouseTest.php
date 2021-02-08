<?php

namespace Tests\Feature;

use App\Models\House;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseTest extends TestCase
{
    use RefreshDatabase, WithFaker;
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

    /**
     * @test
     */
    public function bedrooms_filter_returns_houses_with_exact_match()
    {
        $rooms = 2;
        House::factory()->count(3)->create(['bedrooms' => 2]);
        House::factory()->count(5)->create(['bedrooms' => 4]);
        $response = $this->get("/houses?bedrooms=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function bathrooms_filter_returns_houses_with_exact_match()
    {
        $rooms = 2;
        House::factory()->count(3)->create(['bathrooms' => 2]);
        House::factory()->count(5)->create(['bathrooms' => 4]);
        $response = $this->get("/houses?bathrooms=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function garages_filter_returns_houses_with_exact_match()
    {
        $rooms = 2;
        House::factory()->count(3)->create(['garages' => 2]);
        House::factory()->count(5)->create(['garages' => 4]);
        $response = $this->get("/houses?garages=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function storeys_filter_returns_houses_with_exact_match()
    {
        $rooms = 2;
        House::factory()->count(3)->create(['storeys' => 2]);
        House::factory()->count(5)->create(['storeys' => 4]);
        $response = $this->get("/houses?storeys=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function price_filter_returns_houses_within_selected_price_range()
    {
        $lowPrice = 300000;
        $highPrice = 600000;
        House::factory()->count(3)->create(['price' => $this->faker->numberBetween($lowPrice, $highPrice)]);
        House::factory()->count(5)->create(['price' => $this->faker->numberBetween($highPrice, 10000000)]);
        House::factory()->count(1)->create(['price' => $this->faker->numberBetween(100000, $lowPrice)]);

        $response = $this->get("/houses?low=$lowPrice");
        $response->assertStatus(200)->assertJsonCount(8);

        $response = $this->get("/houses?high=$highPrice");
        $response->assertStatus(200)->assertJsonCount(4);

        $response = $this->get("/houses?low=$lowPrice&high=$highPrice");
        $response->assertStatus(200)->assertJsonCount(3);
    }
}
