<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MilsCompanion;

use function Laravel\Prompts\select;

class MilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $posts = MilsCompanion::where('is_published', true)
                ->select('id', 'title','slug', 'short_description','hero_image')
                ->get();
     return response()->json($posts);


    }
    public function milsbyslug($slug)
    {
        $post = DB::table('mils_companions')
            ->where('is_published', true)
            ->where('slug', $slug)
            ->first();

        if (!$post) {
            return response()->json([
                'message' => 'Mils Companion not found'
            ], 404);
        }

        // Convert JSON string to array
        $post->gallery = json_decode($post->gallery, true);

        // SEO keywords
        $post->keywords = json_decode($post->keywords, true);

        return response()->json($post);
    }
    
}