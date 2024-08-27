<?php

namespace App\Http\Controllers;

use App\Events\ErsalPayam;
use App\Events\Login;
use App\Events\MessageSent;
use App\Events\Record;
use App\Events\Send;
use App\Events\Update;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function ersalPayam(Request $request)
    {

        $message = $request->message;

        ErsalPayam::dispatch($message);

        return response()->json(['success' => true, 'message' => 'payam ba moafaghiyat ersal shod']);

    }

    public function chatLogin()
    {

        return view('chat-login');

    }

    public function login(Request $request)
    {

        $check = User::where('mobile_number', $request->mobile_number)
        ->first();

        if($check != null) {


            Auth::login($check);

            return response()->json([
                'status' => true,
                'message' => 'karbar login kard'
            ]);

            //asli ine

            // Login::dispatch($request->mobile_number);

            // $mobile = DB::table('users')
            // ->select(['*'])
            // ->where('mobile_number', $request->mobile_number)
            // ->get();

            // $mobile = json_decode($mobile, true);

            // $result = [];

            // for($i = 0; $i < count($mobile); $i++) {

            //     $result[] = $mobile[$i]['mobile_number'];

            // }

            // Update::dispatch($result);

            // cookie()->queue('mobile_number', $request->mobile_number, 120);

            // return redirect()->route('users');

        }
    }

    public function send(Request $request)
    {
        
        $mobile = $request->mobile;

        $message = $request->message;

        Send::dispatch($mobile, $message);

        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
        
    }

    public function store(Request $request)
    {

        $message = $request->message; 

        MessageSent::dispatch($message);

        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
        
    }
}
