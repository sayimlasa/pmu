<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pmu;
use Illuminate\Support\Facades\Hash;

class PmuController extends Controller
{
    public function index(){
     return view('Pmu/index');
    }
 public function change()
 {
    return view('pmu.passwordchange');
 }
 public function storePassword(Request $request)
 {
     $request->validate([
         'oldpass'=>'required',
         'newpass'=>'required',
         'confirmpass'=>'required|same:newpass'
     ]);
     $pmu=auth()->user();
     if(!Hash::check($request->oldpass,$pmu->password))
         return back()->with('error','The old password is incorrect');
     $pmu->password=Hash::make($request->newpass);
     $pmu->save();
     return redirect()->route('login')->with('success','Successfully to Change password');
 }
}
