<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Mail\InvPayment;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Invoice_payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Wedding\InvoiceController;

class InvoicePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Pembayaran Masuk";
        $invoice_payments = Invoice_payment::where('is_confirmed',Constant::FALSE_CONDITION)->get();
        return view('master_data.invoice_payment.index',compact(['section_header','invoice_payments']));
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
        $this->_validationUpdateInvoicePayment($request);
        $inv_ctrl = new InvoiceController();
        $invoice = Invoice::where('user_id',$request->user_id)->where('template_category_id',$request->template_category_id)->where('invoice_type_id',$request->invoice_type_id)->where('bank_account_id',$request->bank_account_id)->where('code',$request->invoice_code)->findOrFail($request->invoice_id);
        $invoice_payment = Invoice_payment::where('invoice_id',$invoice->id)->findOrFail($id);
        $user = User::findOrFail($request->user_id);

        DB::beginTransaction();
        try {
            $invoice_payment_update = Invoice_payment::findOrFail($invoice_payment->id)->update([
                'amount'=> $request->amount,
                'is_confirmed' => Constant::TRUE_CONDITION,
            ]);
    
            $invoice_amount_result = $invoice->amount + $request->amount;
            $invoice_status_result = $invoice_amount_result >= $invoice->invoice_type->amount ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION;
            $invoice_expired_result = $invoice_status_result == Constant::TRUE_CONDITION ?
                $inv_ctrl->getExpiredDatetimeByDay($invoice->invoice_type->expired_day) :
                ($invoice->expired > Carbon::now()->addDays(Constant::EXPIRED_DAY_OF_PAYMENT_AFTER_CONFIRMED) ?
                    $invoice->expired :
                    Carbon::now()->addDays(Constant::EXPIRED_DAY_OF_PAYMENT_AFTER_CONFIRMED));
            $invoice_update = Invoice::findOrFail($invoice->id)->update([
                'expired' => $invoice_expired_result,
                'amount' => $invoice_amount_result,
                'status' => $invoice_status_result,
            ]);

            if ($invoice_payment_update > 0 && $invoice_update > 0) {
                DB::commit();
                $this->send_payment_mail($user->email, $invoice, $invoice_payment, $invoice_status_result);
                return redirect()->back()->with('message','Berhasil konfirmasi pembayaran ' . $invoice->code);
            } else {
                DB::rollBack();
                return redirect()->back()->with('fail','Sorry, nothing has changed. Something went wrong!!');
            }
        }
        catch(Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('fail',$e->getMessage());
        }
    }

    public function send_payment_mail($to, $invoice, $invoice_payment, $status)
    {
        $invoice_payments = Invoice_payment::where('invoice_id', $invoice->id)->where('is_confirmed', Constant::TRUE_CONDITION)->get();
        $url = $status == Constant::TRUE_CONDITION ? route('order.redirect', 'active') : route('order.redirect', 'lesspaid');
        $details = [
            'title' => 'Invoice Pembayaran ' . config('app.name'),
            'invoice' => $invoice,
            'invoice_payment' => $invoice_payment,
            'invoice_payments' => $invoice_payments,
            'status' => $status,
            'url' => $url
        ];

        Mail::to($to)->send(new InvPayment($details));
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

    private function _validationUpdateInvoicePayment(Request $request)
    {
        $request->validate([
            'user_id' => ['required','integer'],
            'invoice_id' => ['required','integer'],
            'template_category_id' => ['required','integer'],
            'invoice_type_id' => ['required','integer'],
            'bank_account_id' => ['required','integer'],
            'invoice_code' => ['required'],
            'amount' => ['required','numeric'],
        ],
        [
            'user_id.required' => 'ID User diperlukan!',
            'user_id.integer' => 'ID User harus integer!',
            'invoice_id.required' => 'ID Invoice diperlukan!',
            'invoice_id.integer' => 'ID Invoice harus integer!',
            'template_category_id.required' => 'ID Template Category diperlukan!',
            'template_category_id.integer' => 'ID Template Category harus integer!',
            'invoice_type_id.required' => 'ID Invoice Type diperlukan!',
            'invoice_type_id.integer' => 'ID Invoice Type harus integer!',
            'bank_account_id.required' => 'ID Bank Account diperlukan!',
            'bank_account_id.integer' => 'ID Bank Account harus integer!',
            'invoice_code.required' => 'Code Invoice diperlukan!',
            'amount.required' => 'Mohon isi jumlah pembayaran!',
            'amount.numeric' => 'Jumlah pembayaran harus berbentuk angka!',
        ]);
    }
}