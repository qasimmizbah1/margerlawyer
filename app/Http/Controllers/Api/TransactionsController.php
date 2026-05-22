<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $posts = Transaction::select('id', 'title', 'slug', 'category', 'amount','transaction_type', 'short_description', 'button_text', 'button_url', 'featured_image')
                ->where('is_active', true)
                ->get();
     return response()->json($posts);


    }
    public function transactionbyslug($slug)
    {
        $post = DB::table('transactions')       
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$post) {   
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        // Convert JSON string to array
        $post->gallery = json_decode($post->gallery, true);

        // SEO keywords
        $post->keywords = json_decode($post->keywords, true);

        return response()->json($post);
    }
    
}