<?php

namespace Tests\Feature\Api\V1;

use App\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CountryTest extends TestCase
{
    protected $route = '/api/v1/en/countries';

    protected function createCountry(): Country
    {
        $countries = factory(Country::class, 1)->create();

        return $countries->first();
    }

    /**
     * @test
     */
    public function can_return_countries()
    {
        $countries = factory(Country::class, 2)->create();

        $response = $this->getJson($this->route);

        $response->assertJsonStructure([
            'success', 'countries'
        ]);

        $data = $response->json('countries');

        $this->assertEquals($countries->count(), collect($data)->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_a_country()
    {
        $country = $this->createCountry();

        $response = $this->getJson($this->route."/{$country->name}");

        $response->assertJsonStructure([
            'success', 'country'
        ]);

        $responseCountry = $response->json('country');

        $this->assertEquals($country->name, $responseCountry['name']);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_regions_belonging_to_country()
    {
        $country = $this->createCountry();

        $regions = $country->regions()->saveMany(factory(\App\Region::class, 3)->make());

        $response = $this->getJson($this->route."/{$country->name}/regions");

        $response->assertJsonStructure([
            'success', 'regions'
        ]);

        $responseRegions = $response->json('regions');

        $this->assertEquals($regions->count(), collect($responseRegions)->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_provinces_belonging_to_country()
    {
        $country = $this->createCountry();

        // Region is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Region::class, 1)->create();

        $provinces = $country->provinces()->saveMany(factory(\App\Province::class, 3)->make());

        $response = $this->getJson($this->route."/{$country->name}/provinces");

        $response->assertJsonStructure([
            'success', 'provinces'
        ]);

        $responseProvinces = $response->json('provinces');

        $this->assertEquals($provinces->count(), collect($responseProvinces)->count());

        $response->assertOk();

        // We will repeat the same process for states but skipping steps 1, 2 and 3
        // since they are basically the same so all we need is to test route,
        // data json structure and the data returned.
        $response = $this->getJson($this->route."/{$country->name}/states");

        $response->assertJsonStructure([
            'success', 'states'
        ]);

        $responseStates = $response->json('states');

        $this->assertEquals($provinces->count(), collect($responseStates)->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_local_government_areas_belonging_to_country()
    {
        $country = $this->createCountry();

        // Region is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Region::class, 1)->create();

        // Province is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Province::class, 1)->create();

        $localGovernmentAreas = $country->localGovernmentAreas()
              ->saveMany(factory(\App\LocalGovernmentArea::class, 3)->make());

        $response = $this->getJson($this->route."/{$country->name}/local_government_areas");

        $response->assertJsonStructure([
            'success', 'local_government_areas'
        ]);

        $responselocalGovernmentAreas = $response->json('local_government_areas');

        $this->assertEquals($localGovernmentAreas->count(), collect($responselocalGovernmentAreas)->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_cities_belonging_to_country()
    {
        $country = $this->createCountry();

        // Region is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Region::class, 1)->create();

        // Province is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Province::class, 1)->create();

        $cities = $country->cities()
              ->saveMany(factory(\App\City::class, 3)->make());

        $response = $this->getJson($this->route."/{$country->name}/cities");

        $response->assertJsonStructure([
            'success', 'cities'
        ]);

        $responseCities = $response->json('cities');

        $this->assertEquals($cities->count(), collect($responseCities)->count());

        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_return_villages_belonging_to_country()
    {
        $country = $this->createCountry();

        // Region is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Region::class, 1)->create();

        // Province is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\Province::class, 1)->create();

        // Province is going to be needed in the factory
        // files so we need to have at least one present.
        factory(\App\City::class, 1)->create();

        $villages = $country->villages()
              ->saveMany(factory(\App\Village::class, 3)->make());

        $response = $this->getJson($this->route."/{$country->name}/villages");

        $response->assertJsonStructure([
            'success', 'villages'
        ]);

        $responseVillages = $response->json('villages');

        $this->assertEquals($villages->count(), collect($responseVillages)->count());

        $response->assertOk();
    }
}
