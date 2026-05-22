<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = DB::table('services')
         ->get(); // Fetch all records

        return response()->json($services);
    }

    public function servicebyslug($slug)
    {
         $services = DB::table('services')
        ->where("slug", $slug)
        ->get(); // Fetch all records

        return response()->json($services);
    }
}
