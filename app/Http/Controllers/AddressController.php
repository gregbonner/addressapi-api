<?php

namespace App\Http\Controllers;

use App\Address;
use App\AddressKeys;
use App\CityAddressAttributes;
use App\CountyAddressAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AddressController extends Controller
{

    /**
     * Display a listing of all rows in the address table
     *
     * @return Response
     */
    public function index()
    {
        $addressAll = AddressKeys::all();
        return response()->json($addressAll);
    }

    public function getAddressIdFromCityId($cityAddressId)
    {

        $addressId = DB::table('address_keys')
        ->select('id')
        ->where('city_address_id', '=', $cityAddressId)
        ->get();

    }

    /**
     * Display a single address record
     *
     * @return Response
     */    
    public function getAddressAttributesByApiId($apiId)
    {
        $allAttributes = $this -> getAddressAttributes('address_keys.address_id', $apiId);
        $addressRecord = $this -> getAddressRecord($apiId);
        return $allAttributes;

    }

    /**
     * Display a single address record
     *
     * @return Response
     */
    public function getAddressRecord($addressId)
    {
        $address = DB::table('address')
        ->where('id', '=', $addressId)
        ->get();
    }

    /**
     * Display a set of attributes about an address
     *
     * @return Response
     */
    public function getAddressAttributesByCountyId($countyId)
    {
        $address = addressAttributes('id', $countyId)
                 ->get();
        return response()->json($address);
    }

    /**
     * Display a set of attributes about an address
     *
     * @return Response
     */     
    public function getAddressAttributes($filterColumn, $filterValue)
    {

        return DB::table('city_address_attributes')
        ->leftJoin('address_keys', 'city_address_attributes.id', '=', 'address_keys.id')
        ->leftJoin('address', 'address_keys.address_id', '=', 'address.id')
        ->leftJoin('census_attributes', 'address_keys.city_address_id', '=', 'census_attributes.city_address_id')
        ->leftJoin('county_address_attributes', 'address_keys.county_address_id', '=', 'county_address_attributes.id')
        ->leftJoin('county_address_data', 'address_keys.county_address_id', '=', 'county_address_data.id')
        ->select(
            'address.id AS address_id',
            'address.street_address',
            'address.single_line_address',
            'address.city',
            'address.state',
            'address.zip',
            'address.longitude',
            'address.latitude',
            'address_keys.city_address_id AS city_id',
            'city_address_attributes.land_use_code AS city_land_use_code',
            'city_address_attributes.land_use AS city_land_use',
            'city_address_attributes.classification AS city_classification',
            'city_address_attributes.sub_class AS city_sub_class',
            'city_address_attributes.neighborhood AS city_neighborhood',
            'city_address_attributes.nhood AS city_nhood',
            'city_address_attributes.council_district AS city_council_district',
            'city_address_attributes.land_bank_property AS city_land_bank_property',
            'city_address_attributes.tif AS city_tif',
            'city_address_attributes.police_division AS city_police_division',
            'city_address_attributes.neighborhood_census AS city_neighborhood_census',
            'city_address_attributes.vacant_parcel AS city_vacant_parcel',
            'address_keys.county_address_id AS county_id',
            'census_attributes.block_2010_name AS census_block_2010_name',
            'census_attributes.block_2010_id AS census_block_2010_id',
            'census_attributes.tract_name AS census_track_name',
            'census_attributes.tract_id AS census_track_id',
            'census_attributes.zip AS census_zip',
            'census_attributes.county_id AS census_county_id',
            'census_attributes.state_id AS census_county_state_id',
            'census_attributes.longitude AS census_longitude',
            'census_attributes.latitude AS census_latitude',
            'census_attributes.tiger_line_id AS census_tiger_line_id',
            'census_attributes.metro_areas AS census_metro_area',
            'county_address_attributes.parcel_number AS county_parcel_number',
            'county_address_attributes.name AS county_name',
            'county_address_attributes.tif_district AS county_tif_district',
            'county_address_attributes.tif_project AS county_tif_project',
            'county_address_attributes.neighborhood_code AS county_neighborhood_code',
            'county_address_attributes.pca_code AS county_pca_code',
            'county_address_attributes.land_use_code AS county_land_use_code',
            'county_address_attributes.tca_code AS county_tca_code',
            'county_address_attributes.document_number AS county_document_number',
            'county_address_attributes.book_number AS county_book_number',
            'county_address_attributes.conveyance_area AS county_conveyance_area',
            'county_address_attributes.conveyance_designator AS county_conveyance_designator',
            'county_address_attributes.legal_description AS county_legal_description',
            'county_address_attributes.object_id AS county_object_id',
            'county_address_attributes.page_number AS county_page_number',
            'county_address_attributes.delinquent_tax_2010 AS county_delinquent_tax_2010',
            'county_address_attributes.delinquent_tax_2011 AS county_delinquent_tax_2011',
            'county_address_attributes.delinquent_tax_2012 AS county_delinquent_tax_2012',
            'county_address_attributes.delinquent_tax_2013 AS county_delinquent_tax_2013',
            'county_address_attributes.delinquent_tax_2014 AS county_delinquent_tax_2014',
            'county_address_attributes.delinquent_tax_2015 AS county_delinquent_tax_2015',
            'county_address_data.situs_address AS county_situs_address',
            'county_address_data.situs_city AS county_situs_city',
            'county_address_data.situs_state AS county_situs_state',
            'county_address_data.situs_zip AS county_situs_zip',
            'county_address_data.owner AS county_owner',
            'county_address_data.owner_address AS county_owner_address',
            'county_address_data.owner_city AS county_owner_city',
            'county_address_data.owner_state AS county_owner_state',
            'county_address_data.owner_zip AS county_owner_zip',
            'county_address_data.stated_area AS county_stated_area',
            'county_address_data.tot_sqf_l_area AS county_tot_sqf_l_area',
            'county_address_data.year_built AS county_year_built',
            'county_address_data.property_area AS county_property_area',
            'county_address_data.property_picture AS county_property_picture',
            'county_address_data.property_report AS county_property_report',
            'county_address_data.market_value AS county_market_value',
            'county_address_data.assessed_value AS county_assessed_value',
            'county_address_data.assessed_improvement AS county_assessed_improvement',
            'county_address_data.assessed_land AS county_assessed_land',
            'county_address_data.taxable_value AS county_taxable_value',
            'county_address_data.mtg_co AS county_mtg_co',
            'county_address_data.mtg_co_address AS county_mtg_co_address',
            'county_address_data.mtg_co_city AS county_mtg_co_city',
            'county_address_data.mtg_co_state AS county_mtg_co_state',
            'county_address_data.mtg_co_zip AS county_mtg_co_zip',
            'county_address_data.common_area AS county_common_area',
            'county_address_data.floor_designator AS county_floor_designator',
            'county_address_data.floor_name_designator AS county_floor_name_designator',
            'county_address_data.exempt AS county_exempt',
            'county_address_data.complex_name AS county_complex_name',
            'county_address_data.cid AS county_cid',
            'county_address_data.eff_from_date AS county_eff_from_date',
            'county_address_data.eff_to_date AS county_eff_to_date',
            'county_address_data.extract_date AS county_extract_date',
            'county_address_data.shape_st_area AS county_shape_st_area',
            'county_address_data.shape_st_lenght AS county_shape_st_lenght',
            'county_address_data.shape_st_area_1 AS county_shape_st_area_1',
            'county_address_data.shape_st_length_1 AS county_shape_st_length_1',
            'county_address_data.shape_st_legnth_2 AS county_shape_st_legnth_2',
            'county_address_data.shape_st_area_2 AS county_shape_st_area_2',
            'county_address_data.sim_con_div_type AS county_sim_con_div_type',
            'county_address_data.tax_year AS county_tax_year',
            'county_address_data.type AS county_type',
            'county_address_data.z_designator AS county_z_designator'
        )
        ->where($filterColumn, '=', $filterValue)
        ->get();

    }
      
    /**
    * Display a set of attributes about an address
    *
    * @return Response
    */
    public function getAddressAttributesByCityId($cityId)
    {
     
        //TODO:  Convert cityId to AddressId
        $addressId = $this -> getAddressIdFromCityId($cityId);

        $allAttributes = $this -> getAddressAttributes('address_keys.city_address_id', $cityId);
        $addressRecord = $this -> getAddressRecord($addressId);
        return $allAttributes;
    }

}
