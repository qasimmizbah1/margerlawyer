<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Webinar;

use function Laravel\Prompts\select;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $posts = Webinar::where('is_active', true)
                ->select('id', 'title', 'subtitle', 'slug', 'short_description','speaker_name','event_date','event_time','event_timezone', 'featured_image', 'button_text', 'button_url')
                ->get();
     return response()->json($posts);


    }
    public function webinarbyslug($slug)
    {
        $post = DB::table('webinars')
            ->where('is_active', true)
            ->where('slug', $slug)
            ->first();

        if (!$post) {
            return response()->json([
                'message' => 'Webinar not found'
            ], 404);
        }

        // Convert JSON string to array
        $post->gallery = json_decode($post->gallery, true);

        // SEO keywords
        $post->keywords = json_decode($post->keywords, true);

        return response()->json($post);
    }
    
}