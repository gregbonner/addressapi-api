<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AreaController extends Controller
{
  /**
   * Display a listing of the resource
   *
   * @return Response
   */
    public function index()
    {
        $areaAll = DB::select('SELECT attribute_value FROM address_attributes WHERE attribute_type_id = 1');
        return response()->json($areaAll);
    }

    public function getById($areaId)
    {
        $area = DB::select('SELECT attribute_value FROM address_attributes WHERE attribute_type_id = 1 AND id = ?', [$areaId]);
        return response()->json($area);
    }
}
