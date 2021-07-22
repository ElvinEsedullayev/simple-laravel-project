<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;//yazdigimiz modeli elave edirik
use Illuminate\Support\Facades\Auth;//auth istifade etmek ucun kitabxanani elave edirik
use Illuminate\Support\Facades\Hash;//kod ucun yazilir
//use Illuminate\Validation\ValidationException;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
class Giris extends Controller
{
    public function giris()
    {
        return view('auth.login');
    }

    public function girisPost(Request $request)
    {
        $request->validate([
            'email'=>'required | email',
            'password'=>'required | min:5'
        ]);
        $pas=$request->password;
            $yeni= md5($pas);
        //$email=$request->email; 
        //$password = \Hash::make($request['password']);
        //echo $password; die;
        
        //$log=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
       // dd(Hash::make($request->input('password')));
        if(Auth::attempt(['email' => $request->post('email'),'password' =>$request->post('password')]))
        {
            toastr()->success('Panel giris etdiniz,xos gelmisiniz! '.Auth::user()->name);//toastr ile msj gosterilir
            return redirect()->route('admin.panel');
        }else{
            return redirect()->route('admin.login')->withErrors('Email ve ya sifre sehvdir');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
//$2y$10$uxeWeYKhbeF0AP6VA7vvqefwECP2AU3DmkImrpwCGEcqkK4d8A8oq
//$2y$10$PD4swyG6NOshNtys7pA7buYxiJpjPYwuEoJ3Vp9OEffkWFPPidpbu
//$2y$10$LyShLVnmIGJDFyO/HGU9oee6io0ND/E/zAua2S5oNnC.QbAY7uwPy
//Auth::attempt(['email' => $request->email, 'password' => $request->password]) don't work    12345kodu