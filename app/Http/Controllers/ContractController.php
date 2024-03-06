<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Mail\TestMain;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Validator;

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

    public function show($id)
    {
        $contracts = Contract::find($id);
        return view('contracts.view')->with('contracts', $contracts);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:contracts',
            'startd' => 'required',
            'endd' => 'required',
            'document' => 'required|file|mimes:jepg,jpg,png,gif,pdf|max:2048'
        ]);
        $filename = time() . '.' . $request->document->extension();
        $request->document->move(public_path('uploads'), $filename);
        $contract = new Contract();
        $contract->name = $request->name;
        $contract->startd = $request->startd;
        $contract->endd = $request->endd;
        $start = Carbon::parse($request->startd);
        $end = Carbon::parse($request->endd);
        $contract->duration = $start->diffInMonths($end);
        $contract->document = $request->document;
        $contract->save();
        return redirect()->route('contract')->with('success', 'Detail  successfully saved', $filename);

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
    public function send(Request $request,string $id)
    {
        $contract = Contract::find($id);
        $start = Carbon::parse($request->startd);
        $end = Carbon::parse($request->endd);
        $currentTime = Carbon::now();
        if($contract->duration<=12){
            if($currentTime->diffInMinutes($end)==2){
                $request->validate([
                    'email' => 'required|email',
                    'name' => 'required',
                    'subject' => 'required',
                    'sms' => 'required',

                ]);
                if ($this->isOline()) {
                    $email_data = [
                        'recepient' => 'Mlasamlasa2024@gmail.com',
                        'fromEmail' => $request->email,
                        'fromName' => $request->name,
                        'subject' => $request->subject,
                        'body' => $request->sms
                    ];
                    \Mail::send('email', $email_data, function ($message) use ($email_data) {
                        $message->to($email_data['recepient'])
                            ->from($email_data['fromEmail'], $email_data['fromName'])
                            ->subject($email_data['subject']);
                    });
                    return redirect()->back()->with('success', 'Email sent');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Check your Connection');
                }
            }
        }else{
            if($currentTime->diffInMonths($end)==6){
                $request->validate([
                    'email' => 'required|email',
                    'name' => 'required',
                    'subject' => 'required',
                    'sms' => 'required',

                ]);
                if ($this->isOline()) {
                    $email_data = [
                        'recepient' => 'Mlasamlasa2024@gmail.com',
                        'fromEmail' => $request->email,
                        'fromName' => $request->name,
                        'subject' => $request->subject,
                        'body' => $request->sms
                    ];
                    \Mail::send('email', $email_data, function ($message) use ($email_data) {
                        $message->to($email_data['recepient'])
                            ->from($email_data['fromEmail'], $email_data['fromName'])
                            ->subject($email_data['subject']);
                    });
                    return redirect()->back()->with('success', 'Email sent');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Check your Connection');
                }
            }
        }

    }

    public function sendmessage(Request $request)
    {
        $contanct = Contract::create([
            'name' => $request->name,
            'duration' => $request->duration,
        ]);
        $users = User::all();
        Notification::route('mail', $users)->notify(new Contract($contanct));
        return response()->json($contanct);
    }
}
