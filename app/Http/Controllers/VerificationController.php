<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function showVerifyForm()
    {
        return view('backend.dashboard.layouts.verify-form');
    }

    public function verifyNumber(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|integer',
        ]);

        $user = Auth::user();
        $inputCode = $request->input('otp_code');

        if ($inputCode == $user->verify_code) {

            $user->verify_code = $inputCode; // Store the actual OTP code
            $user->number_verified_at = now();
            $user->save();


            return redirect()->route('verify.form')->with('success', 'Number verified successfully.');
        }

        return redirect()->route('verify.form')->with('error', 'Verification code is incorrect.');
    }
}
