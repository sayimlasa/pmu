<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Mail;
use App\Mail\TestMain;
use Illuminate\Notifications\Notification;

class ContractController extends Controller
{
    public function index()
    {
        $currentTime = Carbon::now();
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts', 'currentTime'));
    }

    public function create()
    {
        return view('contracts.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:contracts',
            'startd' => 'required',
            'endd' => 'required',
            'document' => 'required|max:2048'
        ]);
       //$filename=time().'.'.$request->document->extension();
        //$filename=$request->document->move(public_path('uploads'));
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->startd = $request->startd;
        $contract->endd = $request->endd;
        $start = Carbon::parse($request->startd);
        $end = Carbon::parse($request->endd);
        $contract->duration = $start->diffInMonths($end);
        $contract->document=$request->document;
        $contract->save();
        return redirect()->route('contract')->with('success','Detail  successfully saved');

    }

    public function edit(string $id)
    {
        $contract = Contract::find($id);
        if (!$contract) return back()->with('error', 'Contract does exist');
        return view('contracts.edit', compact('contract'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'startd' => 'required',
            'endd' => 'required',
        ]);
        $contract = Contract::find($id);
        $contract->name = $request->name;
        $contract->startd = $request->startd;
        $contract->endd = $request->endd;
        $start = Carbon::parse($request->startd);
        $end = Carbon::parse($request->endd);
        $contract->duration = $start->diffInMonths($end);
        $contract->update();
        return redirect()->route('contract')->with('success', 'Contract Detail updated');
    }
//send message to pmu
public function send(){
$subject="Test Mail";
$body="Test Body";
\Illuminate\Support\Facades\Mail::to("sayimlasa2021@gmail.com","SAYI MAKOYE")->send(new TestMain($subject,$body));
}

public function sendmessage(Request $request)
{
    $contanct=Contract::create([
        'name'=>$request->name,
         'duration'=>$request->duration,
    ]);
    $users=User::all();
    Notification::route('mail',$users)->notify(new Contract($contanct));
    return response()->json($contanct);
}
}
