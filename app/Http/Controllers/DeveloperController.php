<?php

namespace App\Http\Controllers;

use App\Mail\SendDevOTP;
use App\Models\OtpAccess;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class DeveloperController extends Controller
{
    public function otp(){
        $otp = rand(100000, 999999);
        $user = Auth::user();
        OtpAccess::create([
            'user_id' => $user->id,
            'otp' => bcrypt($otp),
            'is_active' => 1,
            'expired_at' => now()->addMinutes(5),
        ]);

        $message = 'Halo, user '. $user->nama . ' baru saja meminta access ke Developer Menu!';
        $data = [
            'status' => 'Request Access Developer Menu!',
            'link' => '',
            'otp' => $otp,
            'penerima' => $user->nama,
            'body' => $message
        ];
        Mail::to('ferdyyrahmat@gmail.com')->send(new SendDevOTP($data));

        return response()->json(['success' => 'OTP has been sended'], 200);
    }
    public function authOTP(Request $request) {
        $otp = $request->otp;

        $user = Auth::user();

        $otpAccess = OtpAccess::where('user_id', $user->id)
            ->where('is_active', true)
            ->latest()
            ->first();

        // dd(\Hash::check($otp, $otpAccess->otp));

        if ($otpAccess && \Hash::check($otp, $otpAccess->otp)) {
            // OTP is correct
            $otpAccess->is_active = false;
            $otpAccess->save();
            $json = [
                'success' => 'OTP is correct',
                'isPass' => true,
                'url' => 'dev',
            ];

            OtpAccess::query()
                ->where('id', '!=', $otpAccess->id)
                ->delete();
            OtpAccess::query()
                        ->where('user_id', $user->id)
                        ->where('is_active', false)
                        ->where('id', $otpAccess->id)
                        ->update(['expired_at' => now()->addMinutes(30)]);
                        
            return response()->json($json);
        } else {
            // OTP is incorrect or expired
            return response()->json(['error' => 'OTP is incorrect or expired'], 400);
        }
    }
    public function checkOtp()
    {
        $otp = OtpAccess::query()
            ->where('user_id', auth()->user()->id)
            ->where('is_active', false)
            ->latest()
            ->first();

        // Check if OTP exists
        if (!$otp) {
            return response()->json(['error' => 'Access Needed!.'], 401);
        }

        // Reminder logic for next_pengukuran
        $currentDate = Carbon::now();
        if ($otp->expired_at <= $currentDate) {
            return response()->json(['error' => 'OTP has expired.'], 401);
        } else {
            return response()->json([
                'success' => 'Access Valid',
                'isPass' => true,
                'route' => ''],
                  200);
        }
    }
    public function index(Request $request)
    {
        $this->checkOtp();
        return view('dev.index');
    }
}
