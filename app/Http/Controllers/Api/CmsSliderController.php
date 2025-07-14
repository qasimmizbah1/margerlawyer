<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class CmsSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $pages = Slider::where('is_active', true)->get();
    return response()->json($pages);
    }
}