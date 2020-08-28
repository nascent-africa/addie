<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class VillageTest extends TestCase
{
    protected $route = '/api/v1/en/villages';

    protected function createVillage($extraData = []): \App\Village
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();
        factory(\App\City::class, 1)->create();

        return factory(\App\Village::class, 1)->create($extraData)->first();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_return_villages()
    {
        factory(\App\Country::class, 1)->create();
        factory(\App\Region::class, 1)->create();
        factory(\App\Province::class, 1)->create();
        factory(\App\City::class, 1)->create();

        $village = factory(\App\Village::class, 2)->create();

        $response = $this->getJson($this->route);

        $response->assertJsonStructure([
            'success', 'villages'
        ]);

        $data = $response->json('villages');

        $this->assertEquals(collect($data)->count(), $village->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_a_village()
    {
        $village = $this->createVillage();

        $response = $this->getJson($this->route."/{$village->name}");

        $response->assertJsonStructure([
            'success', 'village'
        ]);

        $data = $response->json('village');

        $this->assertEquals($data['name'], $village->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_country_belonging_to_village()
    {
        $country = factory(\App\Country::class, 5)->create()->random();

        $village = $this->createVillage(['country_id' => $country->id]);

        $response = $this->getJson($this->route."/{$village->name}/countries");

        $response->assertJsonStructure([
            'success', 'country'
        ]);

        $data = $response->json('country');

        $this->assertEquals($data['name'], $village->country->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_region_belonging_to_village()
    {
        factory(\App\Country::class, 1)->create();

        $region = factory(\App\Region::class, 5)->create()->random();

        $village = $this->createVillage(['region_id' => $region->id]);

        $response = $this->getJson($this->route."/{$village->name}/regions");

        $response->assertJsonStructure([
            'success', 'region'
        ]);

        $data = $response->json('region');

        $this->assertEquals($data['name'], $village->region->name);

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

        $village = $this->createVillage(['province_id' => $province->id]);

        $response = $this->getJson($this->route."/{$village->name}/provinces");

        $response->assertJsonStructure([
            'success', 'province'
        ]);

        $data = $response->json('province');

        $this->assertEquals($data['name'], $village->province->name);

        $response->assertOk();


        $response = $this->getJson($this->route."/{$village->name}/states");

        $response->assertJsonStructure([
            'success', 'state'
        ]);

        $stateData = $response->json('state');

        $this->assertEquals($stateData['name'], $village->province->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_lga_belonging_to_village()
    {
        factory(\App\Country::class, 1)->create();

        factory(\App\Region::class, 1)->create();

        factory(\App\Province::class, 1)->create();

        $localGovernmentArea = factory(\App\LocalGovernmentArea::class, 5)->create()->random();

        $village = $this->createVillage(['local_government_area_id' => $localGovernmentArea->id]);

        $response = $this->getJson($this->route."/{$village->name}/local_government_areas");

        $response->assertJsonStructure([
            'success', 'local_government_area'
        ]);

        $data = $response->json('local_government_area');

        $this->assertEquals($data['name'], $village->localGovernmentArea->name);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_city_belonging_to_village()
    {
        factory(\App\Country::class, 1)->create();

        factory(\App\Region::class, 1)->create();

        factory(\App\Province::class, 1)->create();

        $city = factory(\App\City::class, 5)->create()->random();

        $village = $this->createVillage(['city_id' => $city->id]);

        $response = $this->getJson($this->route."/{$village->name}/cities");

        $response->assertJsonStructure([
            'success', 'city'
        ]);

        $data = $response->json('city');

        $this->assertEquals($data['name'], $village->city->name);

        $response->assertOk();
    }
}
