<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $pages = LandingPage::where('is_active', true)->get();
    return response()->json($pages);
    }

    public function showByDomain(string $domain)
    {
    $page = LandingPage::where('domain_name', $domain)->where('is_active', true)->firstOrFail();
    return response()->json($page);
    }
}