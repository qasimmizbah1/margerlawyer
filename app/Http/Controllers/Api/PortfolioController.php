<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolio = DB::table('portfolios')
         ->get(); // Fetch all records

        return response()->json($portfolio);
    }

    public function portfoliobyslug($slug)
    {
         $portfolios = DB::table('portfolios')
        ->where("slug", $slug)
        ->get(); // Fetch all records

        return response()->json($portfolios);
    }
    
}
