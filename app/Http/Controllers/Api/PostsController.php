<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $posts = DB::table('posts')
        //  ->where("is_published", true)
        // ->get(); // Fetch all records

        // return response()->json($posts);

     $posts = Post::with(['author', 'categories'])
                 ->where('is_published', true)
                 ->get();
     return response()->json($posts);


    }
    public function postbyslug($slug)
    {
         $posts = DB::table('posts')
    ->join('users', 'posts.author_id', '=', 'users.id')
    ->where('posts.is_published', true)
    ->where('posts.slug', $slug)
    ->where('users.status', 'active') // Only include active authors
    ->select(
        'posts.*',
        'users.id as author_id',
        'users.name as author_name',
        'users.email as author_email'
        // Add other user fields you need
    )
    ->get();

        return response()->json($posts);
    }
    
}