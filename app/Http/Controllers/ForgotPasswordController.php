<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\Validations\ForgotPasswordValidation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    protected $table = 'users';


    public function encrypturl($userId)
    {
        $token = $userId . '-' . time();
        $enctoken = Crypt::encryptString($token);
        return $enctoken;
    }

    public function index()
    {
        try {
            $data['title'] = 'Forgot-Password';
            return view('forgotpassword.index', $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkUser(Request $request)
    {
        try {
            $objUserValidation = new ForgotPasswordValidation();
            $validationResult = $objUserValidation->validate($request->all());

            if ($validationResult !== null) {
                return redirect()->back()->withErrors($validationResult)->withInput();
            }

            $user = User::where('email', $request->contact_email)->first();
            if (!$user) {
                return redirect()->back()->withErrors(['email' => 'The provided email does not exist.'])->withInput();
            }

            $url = $this->encrypturl($user->id);
            $url = url()->current() . '/' . $url;
            Mail::to($user->email)->send(new ForgotPasswordMail($url));

            return redirect('/login');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function generatepassword(Request $request, $token)
    {
        try {
            $data['title'] = "Change Password";
            $data['token'] = $token;
            return view("forgotpassword.generatepassword", $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function passwordUpdate(Request $request, $token)
    {
        try {
            $decryptedToken = base64_decodeString($token);
            [$userId, $timestamp] = explode('-', $decryptedToken);

            if (strtotime("-24 hours") > $timestamp) {
                return redirect()->back()->with('error', 'The password reset link has expired. Please request a new one.');
            }

            $user = User::find($userId);

            if (!$user) {
                return redirect()->back()->with('error', 'Invalid password reset link.');
            }

            $request->validate([
                'new_password' => 'required|min:8',
                'new_confirm_password' => 'required|same:new_password',
                'current_password' => 'required',
            ]);

            $pathInfo = request()->getPathInfo();
            $hasChangePasswordPathInfo = strpos($pathInfo, 'change-password') !== false;

            if ($hasChangePasswordPathInfo) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'The current password is incorrect.');
                } else {
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return redirect()->route('login')->with('success', 'Your password has been successfully updated. You can now log in with your new password.');

                }
            }
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('login')->with('success', 'Your password has been successfully updated. You can now log in with your new password.');
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'Invalid password reset link.');
        }
    }



}