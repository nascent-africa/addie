<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CityTest extends TestCase
{
    protected $route = '/api/v1/en/cities';

    protected function createCity($extraData = []): \App\City
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();

        return factory(\App\City::class, 1)->create($extraData)->first();
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
    public function can_return_cities()
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();

        $cities = factory(\App\City::class, 2)->create();

        $response = $this->getJson($this->route);

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
    public function can_return_a_city()
    {
        $city = $this->createCity();

        $response = $this->getJson($this->route."/{$city->name}");

        $response->assertJsonStructure([
            'success', 'city'
        ]);

        $data = $response->json('city');

        $this->assertEquals($data['name'], $city->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_country_belonging_to_city()
    {
        $country = factory(\App\Country::class, 5)->create()->random();

        $localGovernmentArea = $this->createCity(['country_id' => $country->id]);

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/countries");

        $response->assertJsonStructure([
            'success', 'country'
        ]);

        $data = $response->json('country');

        $this->assertEquals($data['name'], $localGovernmentArea->country->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_region_belonging_to_city()
    {
        factory(\App\Country::class, 1)->create();

        $region = factory(\App\Region::class, 5)->create()->random();

        $city = $this->createCity(['region_id' => $region->id]);

        $response = $this->getJson($this->route."/{$city->name}/regions");

        $response->assertJsonStructure([
            'success', 'region'
        ]);

        $data = $response->json('region');

        $this->assertEquals($data['name'], $city->region->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_province_belonging_to_city()
    {
        factory(\App\Country::class, 1)->create();

        factory(\App\Region::class, 1)->create();

        $province = factory(\App\Province::class, 5)->create()->random();

        $city = $this->createCity(['province_id' => $province->id]);

        $response = $this->getJson($this->route."/{$city->name}/provinces");

        $response->assertJsonStructure([
            'success', 'province'
        ]);

        $data = $response->json('province');

        $this->assertEquals($data['name'], $city->province->name);

        $response->assertOk();


        $response = $this->getJson($this->route."/{$city->name}/states");

        $response->assertJsonStructure([
            'success', 'state'
        ]);

        $data = $response->json('state');

        $this->assertEquals($data['name'], $city->province->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_lga_belonging_to_city()
    {
        factory(\App\Country::class, 1)->create();

        factory(\App\Region::class, 1)->create();

        factory(\App\Province::class, 1)->create();

        $localGovernmentArea = factory(\App\LocalGovernmentArea::class, 5)->create()->random();

        $city = $this->createCity(['local_government_area_id' => $localGovernmentArea->id]);

        $response = $this->getJson($this->route."/{$city->name}/local_government_areas");

        $response->assertJsonStructure([
            'success', 'local_government_area'
        ]);

        $data = $response->json('local_government_area');

        $this->assertEquals($data['name'], $city->localGovernmentArea->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_village_belonging_to_city()
    {
        $city = $this->createCity();

        factory(\App\City::class, 1)->create();

        $villages = $city->villages()
            ->saveMany(factory(\App\Village::class, 3)->make());

        $response = $this->getJson($this->route."/{$city->name}/villages");

        $response->assertJsonStructure([
            'success', 'villages'
        ]);

        $data = $response->json('villages');

        $this->assertEquals(collect($data)->count(), $villages->count());

        $response->assertOk();
    }
}
