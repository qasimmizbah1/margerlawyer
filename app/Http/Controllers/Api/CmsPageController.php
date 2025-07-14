<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $pages = CmsPage::where('is_active', true)->get();
    return response()->json($pages);
    }

    public function showBySlug(string $slug)
    {
    $page = CmsPage::where('slug', $slug)->where('is_active', true)->firstOrFail();
    return response()->json($page);
    }
}