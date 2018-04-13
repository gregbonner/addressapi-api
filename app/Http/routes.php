<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get(
    '/', function () use ($app) {
        return $app->version();
    }
);

//Ready for testing
$app->get(
    'address-attributes-id/V1/{addressId}',
    'AddressController@getAddressAttributesByAddressApiId'
);
$app->get(
    'address-attributes-city-id/V1/{cityId}',
    'AddressController@getAddressAttributesByCityAddressId'
);
$app->get(
    'address-attributes-county-id/V1/{countyId}',
    'AddressController@getAddressAttributesByCountyAddressId'
);
$app->get(
    'address-attributes/V1/{address}',
    'AddressController@getAddressAttributesByAddress'
);
$app->get(
    'address-by-metro-area/V1/{metroAreaName}',
    'AddressController@getAddressByMetroArea'
);
$app->get(
    'address-by-neighborhood/V1/{neighborhoodName}',
    'AddressController@getAddressByNeighborhood'
);

//To Do
$app->get('address', 'AddressController@index');
$app->get('address-typeahead/V0/{address}', '');
$app->get('all/V0', '');
$app->get('by-address/V0/{address}', '');
$app->get('jd_wp/{:id}', '');
$app->get('kcmo_tifs/V0', '');
$app->get('metro-areas/V0', '');
$app->get('neighborhood_census/V0', '');
$app->get('neighborhoods-geo/V0/{id}', '');
$app->get('neighborhoods/V0/{id}', '');
$app->get('neighborhood-typeahead/V0/{neighborhood}', '');
$app->get('neighborhood-attributes/V0/{neighborhood}', '');
$app->get('police_divisions/V0', '');