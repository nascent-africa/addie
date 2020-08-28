<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class LocalGovernmentAreaTest extends TestCase
{
    protected $route = '/api/v1/en/local_government_areas';

    protected function createLocalGovernmentArea($extraData = []): \App\LocalGovernmentArea
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();

        return factory(\App\LocalGovernmentArea::class, 1)->create($extraData)->first();
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
    public function can_return_lgas()
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();

        $localGovernmentArea = factory(\App\LocalGovernmentArea::class, 2)->create();

        $response = $this->getJson($this->route);

        $response->assertJsonStructure([
            'success', 'local_government_areas'
        ]);

        $data = $response->json('local_government_areas');

        $this->assertEquals(collect($data)->count(), $localGovernmentArea->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_a_lga()
    {
        $localGovernmentArea = $this->createLocalGovernmentArea();

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}");

        $response->assertJsonStructure([
            'success', 'local_government_area'
        ]);

        $data = $response->json('local_government_area');

        $this->assertEquals($data['name'], $localGovernmentArea->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_country_belonging_to_lga()
    {
        $country = factory(\App\Country::class, 5)->create()->random();

        $localGovernmentArea = $this->createLocalGovernmentArea(['country_id' => $country->id]);

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
    public function can_return_region_belonging_to_lga()
    {
        factory(\App\Country::class, 1)->create();

        $region = factory(\App\Region::class, 5)->create()->random();

        $localGovernmentArea = $this->createLocalGovernmentArea(['region_id' => $region->id]);

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/regions");

        $response->assertJsonStructure([
            'success', 'region'
        ]);

        $data = $response->json('region');

        $this->assertEquals($data['name'], $localGovernmentArea->region->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_province_to_lga()
    {
        factory(\App\Country::class, 1)->create();

        factory(\App\Region::class, 1)->create();

        $province = factory(\App\Province::class, 5)->create()->random();

        $localGovernmentArea = $this->createLocalGovernmentArea(['province_id' => $province->id]);

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/provinces");

        $response->assertJsonStructure([
            'success', 'province'
        ]);

        $data = $response->json('province');

        $this->assertEquals($data['name'], $localGovernmentArea->province->name);

        $response->assertOk();


        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/states");

        $response->assertJsonStructure([
            'success', 'state'
        ]);

        $stateData = $response->json('state');

        $this->assertEquals($stateData['name'], $localGovernmentArea->province->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_cities_belonging_to_lga()
    {
        $localGovernmentArea = $this->createLocalGovernmentArea();

        $cities = $localGovernmentArea->cities()
            ->saveMany(factory(\App\City::class, 3)->make());

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/cities");

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
    public function can_return_village_belonging_to_lga()
    {
        $localGovernmentArea = $this->createLocalGovernmentArea();

        factory(\App\City::class, 1)->create();

        $villages = $localGovernmentArea->villages()
            ->saveMany(factory(\App\Village::class, 3)->make());

        $response = $this->getJson($this->route."/{$localGovernmentArea->name}/villages");

        $response->assertJsonStructure([
            'success', 'villages'
        ]);

        $data = $response->json('villages');

        $this->assertEquals(collect($data)->count(), $villages->count());

        $response->assertOk();
    }
}
