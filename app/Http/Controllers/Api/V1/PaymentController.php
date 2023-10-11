<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Otp;

class PaymentController extends Controller
{
    // Generate ID
    public function getId($length = 10)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    // Generate OTP
    public function otp($length = 6)
    {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    }

    // Index
    public function index()
    {
        return PaymentResource::collection(Payment::all());
    }

    public function initialize(Request $io)
    {
        $io->validate([
            'amount' => 'required|integer',
            'reference' => 'required|string',
            'email' => 'required|email'
        ]);

        // if($io->fails()){
        //     return response()->json([
        //         'status' => 'fail',
        //         'message' => $io->messages()
        //     ], 400);
        // }

        $header = $io->header('Authorization');
        $auth = Client::where('public_key', $header)
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->where('users.email', $io->email)
            ->first();

        if(is_null($auth)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }else{
            $check_ref = Payment::where('reference', $io->reference)->get()->count();
            if($check_ref > 0){
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Reference already exists'
                ], 400);
            }
            $trans = $this->getId(10);
            $fee = ($io->amount / 100) * 0.03;
            Payment::create([
                'trans_id' => $trans,
                'domain' => 'live',
                'status' => 'pending',
                'reference' => $io->reference,
                'amount' => $io->amount / 100,
                'message' => null,
                'gateway_response' => 'Initialized',
                'paid_at' => null,
                'created_at' => now(),
                'channel' => 'mobile_money',
                'currency' => 'GHS',
                'ip_address' => null,
                'fees' => $fee,
                'prev_url' => url()->current()
            ]);
            return redirect('http://localhost:4200/'.$trans);
        }
    }

    public function checkout(Request $io)
    {
        $io->validate([
            'myNumber' => 'required|string|max:10',
            'myProvider' => 'required|string',
        ]);

        $start = substr($io->myNumber, 0, 3);
        // return response()->json(['message' => $start], 200);
        if($io->myProvider == 'mtn'){
            if($start != '024' && $start != '025' && $start != '054' && $start != '055'){
                return response()->json(['errors' => ['wrongProvider' => ['Wrong network provider']]], 422);
            }
        }
        if($io->myProvider == 'vodafone'){
            if($start != '020' && $start != '050'){
                return response()->json(['errors' => ['wrongProvider' => ['Wrong network provider']]], 422);
            }
        }
        if($io->myProvider == 'airteltigo'){
            if($start != '027' && $start != '057' && $start != '026' && $start != '056'){
                return response()->json(['errors' => ['wrongProvider' => ['Wrong network provider']]], 422);
            }
        }

        // Send OTP to user
        $otp = $this->otp();
        $trans = $this->getId();

        // Save OTP details
        Otp::create([
            'trans_id' => $trans,
            'mobile' => $io->myNumber,
            'otp' => $otp
        ]);

        return response()->json([
            'status' => 'success',
            'trans_id' => $trans,
            'mobile' => $io->myNumber,
            'message' => 'Validated'
        ], 200);
    }
}
