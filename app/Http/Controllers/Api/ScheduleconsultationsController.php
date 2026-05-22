<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleconsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sh_setting = DB::table('schedule_consultations')
         ->get(); // Fetch all records

        return response()->json($sh_setting);
    }

}
