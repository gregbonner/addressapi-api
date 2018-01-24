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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get(
    'foo', function () {
        return 'Hello World';
    }
);

//Ready for testing
$app->get('address-attributes-id/V0/{addressId}', 'AddressController@getAddressAttributesByApiId');
$app->get('address-attributes-city-id/V0/{cityId}', 'AddressController@getAddressAttributesByCityAddressId');
$app->get('address-attributes-county-id/V0/{countyId}', 'AddressController@getAddressAttributesByCountyAddressId');
$app->get('address-attributes/V0/{address}', 'AddressController@getAddressAttributesByAddress');

//To Do
$app->get('address-by-metro-area/V0/{metro_area}', 'AddressController@addressByMetroArea');
$app->get('address-by-neighborhood/V0/{neighborhood}', 'AddressController@addressByNeighborhood');
$app->get('address', 'AddressController@index');

$app->get('police_divisions/V0', '');
$app->get('kcmo_tifs/V0', '');
$app->get('neighborhood_census/V0', '');
$app->get('metro-areas/V0', '');
$app->get('neighborhoods-geo/V0/{id}', '');
$app->get('neighborhoods/V0/{id}', '');
$app->get('address-typeahead/V0/{address}', '');
$app->get('by-address/V0/{address}', '');
$app->get('neighborhood-typeahead/V0/{neighborhood}', '');
$app->get('neighborhood-attributes/V0/{neighborhood}', '');
$app->get('all/V0', '');
$app->get('jd_wp/{:id}', '');