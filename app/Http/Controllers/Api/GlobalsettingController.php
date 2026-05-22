<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $globalsetting = DB::table('global_settings')
         ->get(); // Fetch all records

        return response()->json($globalsetting);
    }

}
