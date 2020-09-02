## Welcome to GitHub Pages

Google already provides an Autocomplete for Address that helps you improve your user's experience when filling out an 
address form, but sometimes it could be overwhelming and still not give you exactly what you need in terms of control 
and options on a field by field level. Addie was formally part of a project that required a less opinionated version of 
Google's Autocomplete but still give your users options to choose from if they decide to input their address as they see 
fit. 

This documentation is going to help you implement Addie API into your project in a few easy steps.

## Acquiring API Key

Addie is a free and open-source project but requires authorization to make  API calls which you
can get in two easy steps:

1. visit [Addie](#) to create an account.
2. Navigate to `My Tokes` by clicking on the link on the navigation bar, when the page loads, view the top right corner where the `Create token` button is located, click on it to reveal a modal with an input field that requests for the name of your application you wish to use the API key. Submit the form and if all goes well then your API key will be generated.

When you get your API key, your interaction with the Addie web interface is done, next is making calls from your web 
application.

## Making Calls to Addie API

> I am going to be using [Axios](https://github.com/axios/axios) for making API requests throughout this documentation
> but please feel free to use any library of your choosing.

Making an API call to Addie is so simple painless to a point the best way to describe it is by a simple demonstration:

```javascript
// Import axios...
import axios from 'axios'

axios.get('$URL/api/v1/en/countries', {
    headers: { Authorization: `Bearer PASTE_YOUR_TOKE_HERE` }
}).then(response => {
    if (response.data.success) {
        let countries = response.data.countries
        console.log(countries)
    }
})
```

It's as simple as that!

## Retrieving Resources

Retrieving a resource from Addie is easy but first, let's look at an example to know exactly what to expect, 
Let's assume we would like to retrieve all countries available on Addie or a single country, the following is how to do it and what to expect:

To retrieve all countries available on Addie, simply make an API call to `$URL/api/v1/en/countries` to get a response 
with a response structure that looks like the following:

Response:
```javascript
{
    success: true // boolean,
    countries: [ // List of countries available on Addie
         {
            "name": "Burkina Faso",
            "longitude": -1.533333,
            "latitude": 12.467634,
            "iso_code": "BF",
            "calling_code": "+226"
        },
         {
            "name": "Nigeria",
            "longitude": -1.653333,
            "latitude": 8.467634,
            "iso_code": "BF",
            "calling_code": "+226"
        }
        // ...
    ]
}
```

#### Retrieving a single country

To retrieve the data of a single country, simply make an API call to `$URL/api/v1/en/countries/[COUNTRY NAME]` to get a 
response with a response structure that looks like the following:

```json
{
    "success": true,
    "country": {
        "name": "Burkina Faso",
        "longitude": -1.533333,
        "latitude": 12.467634,
        "iso_code": "BF",
        "calling_code": "+226",
        "regions": [], 
        "provinces": [],
        "states": [],
        "local_government_areas": [],
        "cities": [],
        "villages": []
    }
}
```

> Notice the structure of json response that returns `country` and not `countries`, when a name of 
> a resource is specified then we expect a singular verb and not plural.

## Available APIs

`$URL/api/v1/en/countries`

`$URL/api/v1/en/countries/[COUNTRY NAME]`

`$URL/api/v1/en/regions`

`$URL/api/v1/en/regions/[REGION NAME]`

`$URL/api/v1/en/provinces`

`$URL/api/v1/en/provinces/[PROVINCE NAME]`

`$URL/api/v1/en/states`

`$URL/api/v1/en/states/[STATE NAME]`

`$URL/api/v1/en/local_government_areas`

`$URL/api/v1/en/local_government_areas/[LOCAL GOVERNMENT AREA NAME]`

`$URL/api/v1/en/cities`

`$URL/api/v1/en/cities/[CITY NAME]`

`$URL/api/v1/en/villages`

`$URL/api/v1/en/villages/[VILLAGE NAME]`

## Locale

Addie supports the two languages, English and French, and resources could be retrieved for both locales respectively.
to specify a locale when making an API call, simply specify it in the url, so to retrieve all countries in English,
 then the url will look like so:`$URL/api/v1/en/villages`, and for French `$URL/api/v1/fr/villages`.



