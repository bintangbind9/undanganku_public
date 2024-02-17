<?php

namespace App\Http\Controllers\Wedding;

use Carbon\Carbon;
use App\Helpers\Method;
use App\Models\Invoice;
use App\Models\Invoice_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    function genCode()
    {
        $method = new Method();
        $kode = 'INV'.Carbon::now()->format('ym').'-';
        $maxKode = Invoice::where('code','LIKE',$kode.'%')->max('code');
        if (is_null($maxKode)) {
            return $kode.'0001';
        } else {
            return $kode.$method->right('0000'.strval($method->right($maxKode, 4) + 1), 4);
        }
    }

    function isFree($inv_type_id)
    {
        return Invoice_type::findOrFail($inv_type_id)->amount == 0 ? true : false;
    }

    function getExpiredDatetimeByDay($day)
    {
        return Carbon::now()->addDays($day)->toDateTimeString();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
