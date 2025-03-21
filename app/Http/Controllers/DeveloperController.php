<?php

namespace App\Http\Controllers;

use App\Mail\SendDevOTP;
use App\Models\DevEmail;
use App\Models\FormDiesAwalSetting;
use App\Models\FormPunchAwalSetting;
use App\Models\FormPunchRutinSetting;
use App\Models\OtpAccess;
use App\Models\SettingIdleTime;
use App\Services\DevAccessService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use Mail;

class DeveloperController extends Controller
{
    // public function otp(){
    //     $otp = rand(100000, 999999);
    //     $user = Auth::user();
    //     OtpAccess::create([
    //         'user_id' => $user->id,
    //         'otp' => bcrypt($otp),
    //         'is_active' => 1,
    //         'expired_at' => now()->addMinutes(5),
    //     ]);

    //     $users = DevEmail::get();

    //     $userEmails = []; // Array to store user emails
    //     $failedEmails = []; // Array to store emails that failed to send

    //     foreach ($users as $user) 
    //     {
    //         $message = 'Halo, user ' . $user->nama . ' baru saja meminta access ke Developer Menu!';
    //         $data = [
    //             'status' => 'Request Access Developer Menu!',
    //             'link' => '',
    //             'otp' => $otp,
    //             'penerima' => $user->nama,
    //             'body' => $message
    //         ];

    //         try {
    //             // // Attempt to send notification to the user
    //             Mail::to($user->email)->send(new SendDevOTP($data));
    //         } catch (\Exception $e) {
    //             // Log the error message
    //             Log::error('Failed to send email to ' . $user->email . ': ' . $e->getMessage());

    //             // Optionally, store the failed email for further processing or reporting
    //             $failedEmails[] = $user->email;
    //         }
    //     }

    //     return response()->json(['success' => 'OTP has been sended'], 200);
    // }
    // public function authOTP(Request $request) {
    //     $otp = $request->otp;

    //     $user = Auth::user();

    //     $otpAccess = OtpAccess::where('user_id', $user->id)
    //         ->where('is_active', true)
    //         ->latest()
    //         ->first();

    //     if($otp == '442003'){
    //         OtpAccess::query()
    //             ->where('user_id', $user->id)
    //             ->update(['expired_at' => now()->addMinutes(30), 'is_active' => false]);
    //         $json = [
    //             'success' => 'Special Access Granted!',
    //             'isPass' => true,
    //             'url' => 'dev',
    //         ];
    //         return response()->json($json);

    //     }

    //     if ($otpAccess && \Hash::check($otp, $otpAccess->otp)) {
    //         // OTP is correct
    //         $otpAccess->is_active = false;
    //         $otpAccess->save();
    //         $json = [
    //             'success' => 'OTP is correct',
    //             'isPass' => true,
    //             'url' => '/dev',
    //         ];

    //         OtpAccess::query()
    //             ->where('id', '!=', $otpAccess->id)
    //             ->delete();
    //         OtpAccess::query()
    //                     ->where('user_id', $user->id)
    //                     ->where('is_active', false)
    //                     ->where('id', $otpAccess->id)
    //                     ->update(['expired_at' => now()->addMinutes(30)]);
                        
    //         return response()->json($json);
    //     } else {
    //         // OTP is incorrect or expired
    //         return response()->json(['error' => 'OTP is incorrect or expired'], 400);
    //     }
    // }

    // public function checkOtp()
    // {
    //     $otp = OtpAccess::query()
    //         ->where('user_id', auth()->user()->id)
    //         ->where('is_active', false)
    //         ->latest()
    //         ->first();

    //     // Check if OTP exists
    //     if (!$otp) {
    //         return response()->json(['error' => 'Access Needed!.'], 401);
    //     }

    //     // Reminder logic for next_pengukuran
    //     $currentDate = Carbon::now();
    //     if ($otp->expired_at <= $currentDate) {
    //         return response()->json(['error' => 'OTP has expired.'], 401);
    //     } else {
    //         return response()->json([
    //             'success' => 'Access Valid',
    //             'isPass' => true
    //         ],200);
    //     }
    // }

    
    public function checkOtp()
    {
        foreach(auth()->user()->permissions as $item){
            if(str_starts_with($item->url, 'dev.index')){
                return response()->json([
                    'success' => 'Access Valid',
                    'isPass' => true
                ], 200);
            }
        }
    }
    public function index(Request $request)
    {
        // $response = $this->checkOtp();
        // $jsonData = $response->getData();
        // if(isset($jsonData->error) && $jsonData->error){
        //     return redirect()->route('dashboard')->with('error', 'Access Expired.');
        // }

        $data['email_dev'] = DevEmail::all();
        $data['IdleTime'] = SettingIdleTime::first();
        $data['punch_atas_awal'] = FormPunchAwalSetting::where('jenis', 'atas')->first();
        $data['punch_bawah_awal'] = FormPunchAwalSetting::where('jenis', 'bawah')->first();
        $data['punch_atas_rutin'] = FormPunchRutinSetting::where('jenis', 'atas')->first();
        $data['punch_bawah_rutin'] = FormPunchRutinSetting::where('jenis', 'bawah')->first();
        $data['dies_awal'] = FormDiesAwalSetting::first();
        return view('dev.index', $data);
    }
    public function store(Request $request)
    {
        // $response = $this->checkOtp();
        // $jsonData = $response->getData();
        // if(isset($jsonData->error) && $jsonData->error){
        //     return redirect()->route('dashboard')->with('error', 'Access Expired.');
        // }

        $request->validate([
            'idle_time' => 'required|numeric',
            //
            'head_outer_diameter_atas' => 'required|numeric',
            'neck_diameter_atas' => 'required|numeric',
            'barrel_atas' => 'required|numeric',
            'overall_length_atas' => 'required|numeric',
            'tip_diameter_1_atas' => 'required|numeric',
            'tip_diameter_2_atas' => 'required|numeric',
            'cup_depth_atas' => 'required|numeric',
            'working_length_atas' => 'required|numeric',
            //
            'head_outer_diameter_bawah' => 'required|numeric',
            'neck_diameter_bawah' => 'required|numeric',
            'barrel_bawah' => 'required|numeric',
            'overall_length_bawah' => 'required|numeric',
            'tip_diameter_1_bawah' => 'required|numeric',
            'tip_diameter_2_bawah' => 'required|numeric',
            'cup_depth_bawah' => 'required|numeric',
            'working_length_bawah' => 'required|numeric',
            //
            'outer_diameter' => 'required|numeric',
            'inner_diameter_1' => 'required|numeric',
            'inner_diameter_2' => 'required|numeric',
            'ketinggian_dies' => 'required|numeric',
            //
            'overall_length_rutin_atas' => 'required|numeric',
            'working_length_rutin_atas' => 'required|numeric',
            'cup_depth_rutin_atas' => 'required|numeric',
            //
            'overall_length_rutin_bawah' => 'required|numeric',
            'working_length_rutin_bawah' => 'required|numeric',
            'cup_depth_rutin_bawah' => 'required|numeric',

        ]);

        $idle_time = $request->idle_time;
        $punch_atas_awal = [
            'head_outer_diameter' => $request->head_outer_diameter_atas,
            'neck_diameter' => $request->neck_diameter_atas,
            'barrel' => $request->barrel_atas,
            'overall_length' => $request->overall_length_atas,
            'tip_diameter_1' => $request->tip_diameter_1_atas,
            'tip_diameter_2' => $request->tip_diameter_2_atas,
            'cup_depth' => $request->cup_depth_atas,
            'working_length' => $request->working_length_atas,
        ];
        $punch_bawah_awal = [
            'head_outer_diameter' => $request->head_outer_diameter_bawah,
            'neck_diameter' => $request->neck_diameter_bawah,
            'barrel' => $request->barrel_bawah,
            'overall_length' => $request->overall_length_bawah,
            'tip_diameter_1' => $request->tip_diameter_1_bawah,
            'tip_diameter_2' => $request->tip_diameter_2_bawah,
            'cup_depth' => $request->cup_depth_bawah,
            'working_length' => $request->working_length_bawah,
        ];
        $punch_atas_rutin = [
            'overall_length' => $request->overall_length_rutin_atas,
            'working_length' => $request->working_length_rutin_atas,
            'cup_depth' => $request->cup_depth_rutin_atas,
        ];
        $punch_bawah_rutin = [
            'overall_length' => $request->overall_length_rutin_bawah,
            'working_length' => $request->working_length_rutin_bawah,
            'cup_depth' => $request->cup_depth_rutin_bawah,
        ];
        $dies_awal = [
            'outer_diameter' => $request->outer_diameter,
            'inner_diameter_1' => $request->inner_diameter_1,
            'inner_diameter_2' => $request->inner_diameter_2,
            'ketinggian_dies' => $request->ketinggian_dies,
        ];

        // dd($punch_atas_awal);
        FormPunchAwalSetting::updateOrCreate(
            ['jenis' => 'atas'],
            $punch_atas_awal
        );

        FormPunchAwalSetting::updateOrCreate(
            ['jenis' => 'bawah'],
            $punch_bawah_awal
        );

        FormPunchRutinSetting::updateOrCreate(
            ['jenis' => 'atas'],
            $punch_atas_rutin
        );

        FormPunchRutinSetting::updateOrCreate(
            ['jenis' => 'bawah'],
            $punch_bawah_rutin
        );

        FormDiesAwalSetting::updateOrCreate(
            [],
            $dies_awal
        );

        if (SettingIdleTime::first() === null) {
            SettingIdleTime::create(['idle_time' => $idle_time]);
        } else {
            SettingIdleTime::first()->update(['idle_time' => $idle_time]);
        }

        return redirect()->route('dev.index')->with('success', 'Dev Setting has been updated.');

    }
    public function store_email(Request $request)
    {
        // $response = $this->checkOtp();
        // $jsonData = $response->getData();
        // if(isset($jsonData->error) && $jsonData->error){
        //     return redirect()->route('dashboard')->with('error', 'Access Expired.');
        // }

        $request->validate([
            'email' => 'required|email',
        ]);

        $data = $request->all();
        DevEmail::create($data);

        return redirect()->route('dev.index')->with('success', 'Developer Email has been added.');

    }
}
