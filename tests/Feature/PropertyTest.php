<?php

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_without_filter_returns_all_properties()
    {
        Property::factory()->count(10)->create();
        $response = $this->get('/properties');

        $response->assertStatus(200)->assertJsonCount(10);
    }

    /**
     * @test
     */
    public function bedrooms_filter_returns_properties_with_exact_match()
    {
        $rooms = 2;
        Property::factory()->count(3)->create(['bedrooms' => 2]);
        Property::factory()->count(5)->create(['bedrooms' => 4]);

        $response = $this->get("/properties?bedrooms=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function bathrooms_filter_returns_properties_with_exact_match()
    {
        $rooms = 2;
        Property::factory()->count(3)->create(['bathrooms' => 2]);
        Property::factory()->count(5)->create(['bathrooms' => 4]);

        $response = $this->get("/properties?bathrooms=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function garages_filter_returns_properties_with_exact_match()
    {
        $rooms = 2;
        Property::factory()->count(3)->create(['garages' => 2]);
        Property::factory()->count(5)->create(['garages' => 4]);

        $response = $this->get("/properties?garages=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function storeys_filter_returns_properties_with_exact_match()
    {
        $rooms = 2;
        Property::factory()->count(3)->create(['storeys' => 2]);
        Property::factory()->count(5)->create(['storeys' => 4]);

        $response = $this->get("/properties?storeys=$rooms");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /**
     * @test
     */
    public function price_filter_returns_properties_within_selected_price_range()
    {
        $lowPrice = 300000;
        $highPrice = 600000;
        Property::factory()->count(3)->create(['price' => $this->faker->numberBetween($lowPrice, $highPrice)]);
        Property::factory()->count(5)->create(['price' => $this->faker->numberBetween($highPrice, 10000000)]);
        Property::factory()->count(1)->create(['price' => $this->faker->numberBetween(100000, $lowPrice)]);

        // User enters only lowest price
        $response = $this->get("/properties?low=$lowPrice");
        $response->assertStatus(200)->assertJsonCount(8);

        // User enters only highest price
        $response = $this->get("/properties?high=$highPrice");
        $response->assertStatus(200)->assertJsonCount(4);

        // User enters both the lowest and the highest prices
        $response = $this->get("/properties?low=$lowPrice&high=$highPrice");
        $response->assertStatus(200)->assertJsonCount(3);
    }

    /** @test  */
    public function name_filter_returns_properties_with_similar_names()
    {
        Property::factory()->create(['name' => "The Victoria"]);

        $response = $this->get("/properties?name=vic");
        $response->assertStatus(200)->assertJsonCount(1);

        $response = $this->get("/properties?name=vyc");
        $response->assertStatus(200)->assertJsonCount(0);
    }

    /** @test  */
    public function using_multiple_filters_simultaneously_returns_relevant_results()
    {
        Property::factory()->create([
            'name' => "The Victoria",
            'price' => 300000,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'garages' => 1,
            'storeys' => 1
        ]);
        Property::factory()->create([
            'name' => "The Victoria",
            'price' => 300000,
            'bedrooms' => 2,
            'bathrooms' => 2,
            'garages' => 1,
            'storeys' => 1
        ]);
        Property::factory()->create([
            'name' => "The Victoria",
            'price' => 700000,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'garages' => 1,
            'storeys' => 1
        ]);

        $response = $this->get("/properties?name=vic&bedrooms=2&bathrooms=1&garages=1&storeys=1&low=300000&high=500000");
        $response->assertStatus(200)->assertJsonCount(1);
    }
}
