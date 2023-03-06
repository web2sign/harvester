<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

use Illuminate\Support\Facades\Http;


use PDF;
use Carbon\Carbon;


class InvoiceController extends Controller
{
    
    public function index(Request $request)
    {

        $data = Setting::first();

        return view('index', $data);
    }    


    public function update(Request $request)
    {
        
        $data = $request->only([
            'harvest_token',
            'account_id',
            'rate',
            'payment_method',
            'account_details',
            'address',            
            'invoice_number',            
            'invoice_prefix',            
        ]);

        $setting = Setting::first();
        if( $setting ) {
            Setting::find($setting->id)->update($data);
        } else {
            Setting::create($data);
        }
        return redirect()->back();
    }

    public function generate(Request $request)
    {
        $endpoint = 'https://api.harvestapp.com/v2/time_entries';
        //$rate = $request->get('rate', 16.5);

        $setting = Setting::first();

        if(!$setting) {
            return response([
                'error' => true,
                'message' => 'Please update settings.'
            ],400);
        }


        $token = $setting->harvest_token;


        $year = $request->input('year');
        $month = $request->input('month');

        $date = Carbon::parse($request->get('date', $request->input('month','2023-01-01')));
        $from = $request->get('from', Carbon::parse( $date )->firstOfMonth()->format('Y-m-d'));
        $to = $request->get('to', Carbon::parse( $date )->lastOfMonth()->format('Y-m-d'));


        $response = Http::acceptJson()->withHeaders([
            'Harvest-Account-Id'=> $setting->account_id
        ])
        ->withToken( $token )
        ->get( $endpoint, [
            'from' => $from,
            'to' => $to,
        ])
        ->json();

        dd($response);

        $error = $response['error'] ?? false;

        if($error) {
            return response([
                'error' => true,
                'message' => 'Please provided a valid harvest credential.'
            ],400);            
        }


        $total_hours = array_sum(array_column($response['time_entries'], 'hours'));
        $rate = $setting->rate;
        $total_amount = $total_hours * $rate;
        $payment_method = $setting->payment_method;
        $account_details = $setting->account_details;
        $address = $setting->address;
        $invoice_prefix = $setting->invoice_prefix;
        $invoice_number = $setting->invoice_number ?? str_pad(Carbon::parse($date)->format('m'), 4, 0, STR_PAD_LEFT);
        $invoice = $invoice_prefix . $invoice_number;
        



        $pdf = PDF::loadView('invoice',[
            'data' => array_reverse($response['time_entries']),
            'total_hours' => $total_hours,
            'rate' => $rate,
            'total_amount' => $total_amount,
            'invoice' => $invoice,
            'date' => $date,
            'payment_method' => $payment_method,
            'account_details' => nl2br($account_details),
            'address' => nl2br($address),
        ])->setPaper([
            0,0,720,$request->input('h',2300)
        ],'portrait');

        
        return $pdf->download($invoice . '-invoice.pdf');
        

    }
}
