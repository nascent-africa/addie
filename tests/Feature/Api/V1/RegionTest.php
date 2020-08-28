<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RegionTest extends TestCase
{
    protected $route = '/api/v1/en/regions';

    protected function createRegion($extraData = []): \App\Region
    {
        factory(\App\Country::class, 1)->create();

        return factory(\App\Region::class, 1)->create($extraData)->first();
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_return_regions()
    {
        factory(\App\Country::class, 1)->create();

        $regions = factory(\App\Region::class, 2)->create();

        $response = $this->getJson($this->route);

        $response->assertJsonStructure([
          'success', 'regions'
        ]);

        $data = $response->json('regions');

        $this->assertEquals(collect($data)->count(), $regions->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_a_region()
    {
        $region = $this->createRegion();

        $response = $this->getJson($this->route."/{$region->name}");

        $response->assertJsonStructure([
            'success', 'region'
        ]);

        $data = $response->json('region');

        $this->assertEquals($data['name'], $region->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_country_belonging_to_region()
    {
        $country = factory(\App\Country::class, 5)->create()->random();

        $region = $this->createRegion(['country_id' => $country->id]);

        $response = $this->getJson($this->route."/{$region->name}/countries");

        $response->assertJsonStructure([
            'success', 'country'
        ]);

        $data = $response->json('country');

        $this->assertEquals($data['name'], $region->country->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_provinces_belonging_to_region()
    {
        $region = $this->createRegion();

        $provinces = $region->provinces()->saveMany(factory(\App\Province::class, 3)->make());

        $response = $this->getJson($this->route."/{$region->name}/provinces");

        $response->assertJsonStructure([
            'success', 'provinces'
        ]);

        $data = $response->json('provinces');

        $this->assertEquals(collect($data)->count(), $provinces->count());

        $response->assertOk();

        // We will repeat the same process for states but skipping steps 1, 2 and 3
        // since they are basically the same so all we need is to test route,
        // data json structure and the data returned.
        $response = $this->getJson($this->route."/{$region->name}/states");

        $response->assertJsonStructure([
            'success', 'states'
        ]);

        $stateData = $response->json('states');

        $this->assertEquals(collect($stateData)->count(), $provinces->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_local_government_areas_belonging_to_region()
    {
        $region = $this->createRegion();

        factory(\App\Province::class, 1)->create();

        $localGovernmentAreas = $region->localGovernmentAreas()
                                    ->saveMany(factory(\App\LocalGovernmentArea::class, 3)->make());

        $response = $this->getJson($this->route."/{$region->name}/local_government_areas");

        $response->assertJsonStructure([
            'success', 'local_government_areas'
        ]);

        $data = $response->json('local_government_areas');

        $this->assertEquals(collect($data)->count(), $localGovernmentAreas->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_cities_belonging_to_region()
    {
        $region = $this->createRegion();

        factory(\App\Province::class, 1)->create();

        $cities = $region->cities()
            ->saveMany(factory(\App\City::class, 3)->make());

        $response = $this->getJson($this->route."/{$region->name}/cities");

        $response->assertJsonStructure([
            'success', 'cities'
        ]);

        $data = $response->json('cities');

        $this->assertEquals(collect($data)->count(), $cities->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_village_belonging_to_region()
    {
        $region = $this->createRegion();

        factory(\App\Province::class, 1)->create();

        factory(\App\City::class, 1)->create();

        $villages = $region->villages()
            ->saveMany(factory(\App\Village::class, 3)->make());

        $response = $this->getJson($this->route."/{$region->name}/villages");

        $response->assertJsonStructure([
            'success', 'villages'
        ]);

        $data = $response->json('villages');

        $this->assertEquals(collect($data)->count(), $villages->count());

        $response->assertOk();
    }
}
