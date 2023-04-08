<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Public\PhoneRequest;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use SendSMS;

class PhoneController extends Controller
{

// GenerateCode Mobile Sms

    public function generateCode($mobile)
    {

        $rand = rand(1111, 9999);
        $messageContent = 'Code: 12345 متن جهت تست می‌باشد.';
        $item = new SendSMS();
        $item->Send($rand, $mobile, $messageContent);
        return $rand;
    }

    //

    public function verified(PhoneRequest $request)
    {
        $user = User::find($request->id);

        if ($request->mobile != $user->mobile) {

            $user->update([
                'mobile' => $request->mobile,
            ]);
        }

        $user->phone()->create([
            'verification_code' => '2131213123' //$this->generateCode($user->mobile),
        ]);

    }

    public function verifiedCode(Request $request)
    {

        $code = $request['code'];

        $user = User::find($request->id);

        $verification_code = $user->phone->verification_code;

        if ($verification_code == $code) {
            $user->phone()->update(['verified' => '1']);
            $token = $user->createToken('token_base_name')->plainTextToken;
            return response()->json(['user' => $user , 'token' => $token], 200);

        }
        else{
            return response()->json(['errors' => 'کد یک بار مصرف را درست وارد کنید'],422);
        }



    }

}
