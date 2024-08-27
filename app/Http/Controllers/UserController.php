<?php

namespace App\Http\Controllers;

use App\Events\ErsalPayam;
use App\Events\Login;
use App\Events\Message;
use App\Events\MessageSent;
use App\Events\Send;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserController extends Controller
{

    public function karbaran()
    {

        $user = Auth::id();

        $users = DB::table('users')
        ->select(['*'])
        ->where('id', '!=', $user)
        ->get();

        $users = json_decode($users, true);

        return view('karbaran', compact('users'));

    }

    public function dashboard()
    {

        return Auth::user();

    }

    public function payamresan($id_to)
    {

        $author = Auth::id();

        $messages = DB::table('chas')
        ->where(function ($query) use ($author, $id_to) {
            $query->where('id_from', $author)
                ->where('id_to', $id_to);
        })
        ->orWhere(function ($query) use ($author, $id_to) {
            $query->where('id_from', $id_to)
                ->where('id_to', $author);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        $messages = json_decode($messages, true);

        // $messages1 = DB::table('chas')
        // ->select()
        // ->where('id_from', $author)
        // ->where('id_to', $id_to)
        // ->get();

        // $messages1 = json_decode($messages1, true);

        // $messages1 = array_values($messages1);

        // $messages2 = DB::table('chas')
        // ->select()
        // ->where('id_from', $id_to)
        // ->where('id_to', $author)
        // ->get();

        // $messages2 = json_decode($messages2, true);

        // $messages2 = array_values($messages2);

        // $messages = [...$messages1, ...$messages2];

        // dd($messages);

        return view('payamresan', compact('author', 'messages'));

    }

    public function ersalPayam(Request $request)
    {

        $user = Auth::user();

        $id_from = $user->id;
        $name_from = $user->full_name;

        $id_to = $request->id;
        
        $userTo = User::findOrFail($id_to);

        $name_to = $userTo->full_name;

        $message = $request->message;

        $name_to = $user->full_name;

        ErsalPayam::dispatch($id_from, $name_from, $id_to, $name_to, $message);

        return response()->json(['success' => true, 'message' => 'payam ba moafaghiyat ersal shod']);

    }

    public function chats()
    {

        $user = Auth::id();

        $chats = DB::table('chas')
        ->where('id_from', $user)
        ->orWhere('id_to', $user)
        ->get()
        ->unique('chatroom');

        $chats = json_decode($chats, true);

        return view('chats', compact('chats'));

    }

    public function verify(Request $request)
    {

        $mobile_number = $request->mobile_number;

        $checkingUser = User::where('mobile_number', $mobile_number)
            ->first();
    
        if ($checkingUser == null) {
    
            $checkMobileInVerifyTable = VerifyCode::where('mobile_number', $mobile_number)
            ->first();
    
            if($checkMobileInVerifyTable != null) {
    
                $id = VerifyCode::findOrFail($checkMobileInVerifyTable->id);
    
                $expireTime = $id->expire_time;
    
                if($expireTime > time()) {
    
                    $msg = [
                        'status' => false,
                        'message' => 'کد امنیتی هنوز منقضی نشده است'
                    ];
    
                    return response()->json($msg);
                    
                }
    
                $now = time();
    
                $expireTime = $now + 120;
    
                $code = rand(1000, 9999);
    
                // $this->sms($mobile_number, $code);
    
                $id->mobile_number = $mobile_number;
    
                $id->creating_time = $now;
    
                $id->expire_time = $expireTime;
    
                $id->code = $code;
    
                $id->save();
    
                $msg = [
                    'status' => true,
                    'message' => 'کد جدید ارسال شد'
                ];
    
                return response()->json($msg);
    
            }
    
            $now = time();
    
            $expireTime = $now + 120;
    
            $code = rand(1000, 9999);
    
            $register = VerifyCode::create([
                'mobile_number' => $mobile_number,
                'creating_time' => $now,
                'expire_time' => $expireTime,
                'code' => $code
            ]);
    
            if ($register) {
    
                // $this->sms($mobile_number, $code);
    
                $msg = [
                    'status' => true,
                    'message' => 'کد ارسال شد',
                    'code' => $code
                ];
    
                return response()->json($msg);
            }
    
        } else {
    
            $checkMobileInVerifyTable = VerifyCode::where('mobile_number', $mobile_number)
            ->first();
    
            if($checkMobileInVerifyTable != null) {
    
                $id = VerifyCode::findOrFail($checkMobileInVerifyTable->id);
    
                $expireTime = $id->expire_time;
    
                if($expireTime > time()) {
    
                    $msg = [
                        'status' => false,
                        'message' => 'کد امنیتی هنوز منقضی نشده است'
                    ];
    
                    return response()->json($msg);
                    
                }
    
                $now = time();
    
                $expireTime = $now + 120;
    
                $code = rand(1000, 9999);
    
                // $this->sms($mobile_number, $code);
    
                $id->mobile_number = $mobile_number;
    
                $id->creating_time = $now;
    
                $id->expire_time = $expireTime;
    
                $id->code = $code;
    
                $id->save();
    
                $msg = [
                    'status' => true,
                    'message' => 'کد جدید جهت ورود ارسال شد',
                    'code' => $code
                ];
    
                return response()->json($msg);
    
            }
    
            $now = time();
    
            $expireTime = $now + 120;
    
            $code = rand(1000, 9999);
    
            $register = VerifyCode::create([
                'mobile_number' => $mobile_number,
                'creating_time' => $now,
                'expire_time' => $expireTime,
                'code' => $code
            ]);
    
            if ($register) {

    
                $msg = [
                    'status' => true,
                    'message' => 'کد جهت ورود ارسال شد',
                    'code' => $code
                ];
    
                return response()->json($msg);
    
            }
    
        }
    }
    
    public function verifyCode(Request $request)
    {

        $code = $request->code;

        $mobile_number = $request->mobile_number;

        $checkUser = User::where('mobile_number', $mobile_number)
        ->first();

        if($checkUser != null) {

            $verifyMobile = VerifyCode::where('code', $code)
            ->where('mobile_number', $mobile_number)
            ->where('expire_time', '>', time())
            ->first();

            if($verifyMobile != null) {

                DB::table('personal_access_tokens')
                ->where('tokenable_id', '=', $checkUser->id)
                ->where('name', '=', 'login')
                ->delete();

                $token = $checkUser->createToken('login')->plainTextToken;

                MessageSent::dispatch($mobile_number);

                $check = json_decode($checkUser, true);

                $msg = [
                    'status' => true,
                    'message' => 'شما با موفقیت ورود کردید',
                    'token' => $token,
                    'information' => $check
                ];

                return response()->json($msg);

                }else {

                    $msg = [
                        'status' => false,
                        'message' => 'کد امنیتی منقضی شده و یا صحیح نمیباشد، لطفا مجددا اقدام کنید'
                    ];
        
                    return response()->json($msg);

                }
            }
        

        $verifyMobile = VerifyCode::where('code', $code)
            ->where('mobile_number', $mobile_number)
            ->where('expire_time', '>', time())
            ->first();

        if ($verifyMobile != null) {

            $idAcceptMobileNumber = VerifyCode::findOrFail($verifyMobile->id);

            $token = $idAcceptMobileNumber->createToken('verify')->plainTextToken;

            MessageSent::dispatch($mobile_number);

            $acceptMobileNumber = User::create(
                [
                    'full_name' => '',
                    'father_name' => '',
                    'birthday' => '',
                    'mobile_number' => $verifyMobile->mobile_number,
                    'type' => '',
                    'password' => '',
                    'code_melli' => '',
                    'history' => '0',
                    'status_profile' => 'not_complete' 
                ]
            );

            if ($acceptMobileNumber) {

                $msg = [
                    'status' => true,
                    'message' => 'شماره موبایل کاربر معتبر سنجی شد',
                    'token' => $token
                ];

                return response()->json($msg);
            }
        } else {
 
            $msg = [
                'status' => false,
                'message' => 'کد امنیتی منقضی شده و یا صحیح نمیباشد، لطفا مجددا اقدام کنید'
            ];

            return response()->json($msg);

        }

    }

    public function registerApplicant(Request $request)
    {

        $user = request()->user();

        $checkRegister = User::where('mobile_number', $user->mobile_number)
        ->where('status_register', 'complete')
        ->first();

        if($checkRegister != null) {

            $msg = [
                'status' => false,
                'message' => 'کاربر گرامی شما قبلا ثبت نام کرده اید'
            ];

            return response()->json($msg);
            
        }

        $first_name = $request->first_name;

        $last_name = $request->last_name;

        $full_name = "$first_name  $last_name";

        $check = User::where('mobile_number', $user->mobile_number)
        ->first();

            if ($check != null) {

                $createID = User::findOrFail($check->id);

                $createID->full_name = $full_name;

                $createID->code_melli = $request->code_melli;

                $createID->type = 'applicant';

                $createID->status_register = 'complete';

                $createID->save();

                $msg = [
                    'status' => true,
                    'message' => 'ثبت نام با موفقیت اتجام شد متقاصی محترم،در صفحه پنل خود اقدام به تکمیل اطلاعات حساب خود کنید',
                ];

                return response()->json($msg);

            }
    }

    public function sendMessage(Request $request)
    {

        $user = request()->user();

        $to = $user->mobile_number;

        $from = $request->from;

        $message = $request->message;

        Message::dispatch($to, $from, $message);
        
    }

    public function send(Request $request)
    {

        $mobile = $request->mobile;

        $message = $request->message;

        Send::dispatch($mobile, $message);

        return response()->json(['success' => true, 'message' => 'payam ersal shod']);

    }
}
