<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Otp;

class OtpController extends Controller
{
    // Generate OTP Code
    public function genOpt($length = 6)
    {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }

    // Generate OTP
    public function otp(Request $io)
    {
        $code = $this->genOpt(6);

        // Save and send OTP
        // Send SMS

        // Save OTP details
        Otp::create([
            'reference' => $io->reference,
            'otp' => $code,
        ]);

        return response()->json(['message' => 'success'], 400);
    }

    public function verify_otp(Request $io)
    {
        $state = Otp::where('mobile', $io->otpNumber)
            ->where('trans_id', $io->myTransId)
            ->where('otp', $io->myOtp)
            ->get();
            // return response()->json(['message' => $state], 200);
        if(count($state) > 0){
            return response()->json(['message' => 'success'], 200);
        }else{
            return response()->json(['errors' => ['invalidOpt' => ['Invalid Otp']]], 422);
        }
    }
}
