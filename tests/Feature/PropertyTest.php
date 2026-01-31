<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    public function test_endpoint(): void
    {
        $this->get(route('api.properties.index'))
            ->assertStatus(200);
    }

    public function test_empty_query(): void
    {
        Property::factory(5)->create();

        $response = $this->get(route('api.properties.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'price',
                    'bedrooms',
                    'bathrooms',
                    'storeys',
                    'garages',
                    'created_at',
                ],
            ])
            ->assertJsonCount(5);
    }

    public function test_filters_by_name(): void
    {
        Property::factory()->create(['name' => 'Luxury Villa']);
        Property::factory()->create(['name' => 'Modern Apartment']);
        Property::factory()->create(['name' => 'Cozy House']);

        $response = $this->get(route('api.properties.index', [
            'name' => 'Luxury',
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Luxury Villa']);
    }

    public function test_filters_by_price_range(): void
    {
        Property::factory()->create(['price' => 100000]);
        Property::factory()->create(['price' => 200000]);
        Property::factory()->create(['price' => 300000]);

        $response = $this->get(route('api.properties.index', [
            'price' => [150000, 250000],
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['price' => 200000]);
    }

    public function test_filters_by_bedrooms(): void
    {
        Property::factory()->create(['bedrooms' => 2]);
        Property::factory()->create(['bedrooms' => 3]);
        Property::factory()->create(['bedrooms' => 4]);

        $response = $this->get(route('api.properties.index', [
            'bedrooms' => 3,
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['bedrooms' => 3]);
    }

    public function test_filters_by_bathrooms(): void
    {
        Property::factory()->create(['bathrooms' => 1]);
        Property::factory()->create(['bathrooms' => 2]);

        $response = $this->get(route('api.properties.index', [
            'bathrooms' => 2,
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_filters_by_storeys(): void
    {
        Property::factory()->create(['storeys' => 1]);
        Property::factory()->create(['storeys' => 2]);

        $response = $this->get(route('api.properties.index', [
            'storeys' => 1,
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_filters_by_garages(): void
    {
        Property::factory()->create(['garages' => 1]);
        Property::factory()->create(['garages' => 2]);

        $response = $this->get(route('api.properties.index', [
            'garages' => 2,
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_filters_by_multiple_criteria(): void
    {
        Property::factory()->create([
            'name' => 'Villa',
            'price' => 200000,
            'bedrooms' => 3,
            'bathrooms' => 2,
        ]);

        Property::factory()->create([
            'name' => 'Apartment',
            'price' => 150000,
            'bedrooms' => 2,
            'bathrooms' => 1,
        ]);

        $response = $this->get(route('api.properties.index', [
            'price' => ['180000', '250000'],
            'bedrooms' => 3,
        ]));

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['name' => 'Villa']);
    }
}
