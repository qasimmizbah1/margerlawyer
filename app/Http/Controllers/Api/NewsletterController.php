<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate([
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscribed successfully',
            'data' => $subscriber
        ]);
    }
}
