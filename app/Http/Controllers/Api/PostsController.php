<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $posts = DB::table('posts')
         ->where("is_published", true)
          ->where("type", 'post')
        ->get(); // Fetch all records

        return response()->json($posts);
    }
    public function postbyslug($slug)
    {
         $posts = DB::table('posts')
         ->where("is_published", true)
          ->where("type", 'post')
          ->where("slug", $slug)
        ->get(); // Fetch all records

        return response()->json($posts);
    }
}