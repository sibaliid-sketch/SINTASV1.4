<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Newsletter::create([
            'email' => $request->email,
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Terima kasih! Anda telah berhasil berlangganan newsletter kami.');
    }
}
