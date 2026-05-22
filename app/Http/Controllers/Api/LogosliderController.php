<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LogoSlider;

class LogosliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $posts = LogoSlider::select('id', 'name', 'slug', 'logos')
                ->get();
     return response()->json($posts);


    }
    public function logosliderbyslug($slug)
    {
        $post = DB::table('logo_sliders')
            ->where('slug', $slug)
            ->first();

        if (!$post) {
            return response()->json([
                'message' => 'Logo slider not found'
            ], 404);
        }

        // Convert JSON string to array
        $post->logos = json_decode($post->logos, true);

        

        return response()->json($post);
    }
    
}