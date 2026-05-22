<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class EmailsendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function emailsend(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'custom_field_602961'   => 'required',
        ]);
        Mail::send([], [], function ($message) use ($validated) {
            $message->to([
                'contact@empowering.legal',
                'qasimmizbah@gmail.com'
            ])
            ->subject('New Contact Form Submission')
            ->html("
                <h2>New Contact Submission</h2>
                <p><strong>Name:</strong> {$validated['first_name']} {$validated['last_name']}</p>
                <p><strong>Email:</strong> {$validated['email']}</p>
                <p><strong>Phone:</strong> {$validated['phone']}</p>
                <p><strong>Message:</strong> {$validated['custom_field_602961']}</p>
            ");
        });

        return response()->json([
            'success' => true,
            'message' => 'Submitted successfully'
        ]);

    }

}
