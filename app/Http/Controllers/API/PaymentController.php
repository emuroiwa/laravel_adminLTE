<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $payments = DB::table('payments')
        //              ->select(DB::raw('*'))
        //              ->where('id', '=',Auth::user()->id)
        //              ->get();
        $payments = Payment::where('id', '<>',3)
                     ->get();             
        return $payments;
        //return Payment::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'amount' => 'required|string|max:191',
            'currency' => 'required|string|max:20',
            'description' => 'required|string|max:255'
        ]);

        return Payment::create([
            'amount'=>$request['amount'],
            'currency'=>$request['currency'],
            'description'=>$request['description'],
            'file_number'=>'',
            'capturer'=>'',
            'payment_type'=>'',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
