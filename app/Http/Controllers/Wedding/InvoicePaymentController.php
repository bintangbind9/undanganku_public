<?php

namespace App\Http\Controllers\Wedding;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Invoice_payment;
use App\Models\Template_category;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvoicePaymentController extends Controller
{
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
        $this->_validationStoreInvoicePayment($request);
        $inv_ctrl = new InvoiceController();
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $inv_req = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('expired', '>=', Carbon::now())->where('status',Constant::FALSE_CONDITION)->findOrFail($request->invoice_id);
        $count_of_payment = count(Invoice_payment::where('invoice_id',$inv_req->id)->get());
        $count_of_unconfirmed_payment = count(Invoice_payment::where('invoice_id',$inv_req->id)->where('is_confirmed',Constant::FALSE_CONDITION)->get());

        if ($count_of_unconfirmed_payment >= Constant::MAX_UNCONFIRMED_PAYMENT_EACH_INVOICE) {
            return redirect()->back()->with('fail','Pembayaran gagal dikirim, mohon untuk menunggu proses konfirmasi.');
        }

        if ($inv_req->amount < $inv_req->invoice_type->amount)
        {
            if($request->hasFile('attachment'))
            {
                $filename = $inv_req->code."_".round(microtime(true) * 1000).'-attachment.'.pathinfo($request->file('attachment')->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->file('attachment')->move(public_path('assets/img/wedding/attachment'), $filename);

                Invoice_payment::create([
                    'invoice_id' => $inv_req->id,
                    'date' => Carbon::now(),
                    'amount' => 0,
                    'attachment' => $filename,
                    'is_confirmed' => Constant::FALSE_CONDITION,
                ]);

                if ($count_of_payment == 0) {
                    Invoice::where('id',$inv_req->id)->update([
                        'expired' => $inv_ctrl->getExpiredDatetimeByDay(Constant::EXPIRED_DAY_OF_PAYMENT_FIRST_MADE),
                    ]);
                }

                return redirect()->back()->with('message','Pembayaran berhasil dikirim, mohon untuk menunggu proses konfirmasi.');
            }
            else
            {
                return redirect()->back()->with('fail','Pembayaran gagal dikirim, tidak ada Bukti transfer!');
            }
        } else {
            return redirect()->back()->with('fail',"Invoice '".$inv_req->code."' sudah dibayar.");
        }
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
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $invoice_payment = Invoice_payment::where('is_confirmed','N')->findOrFail($id);
        if ($invoice_payment->invoice->user_id == Auth::User()->id && $invoice_payment->invoice->template_category_id == $template_category->id) {
            $path = public_path('assets/img/wedding/attachment/'.$invoice_payment->attachment);
            if (file_exists($path)) {
                unlink($path);
            }
            $invoice_payment->delete();

            if (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'order.index') {
                return redirect()->route('order.index')->with('tab','confirmation')->with('message','Berhasil menghapus pembayaran Kamu.');
            } elseif (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'order.edit') {
                return redirect()->back()->with('message','Berhasil menghapus pembayaran Kamu.');
            } else {
                return redirect()->back()->with('message','Berhasil menghapus pembayaran Kamu.');
            }
        } else {
            return redirect()->back()->with('fail','Gagal menghapus pembayaran Kamu. Data Invalid!');
        }
    }

    private function _validationStoreInvoicePayment(Request $request)
    {
        $request->validate([
            'invoice_id' => ['required','integer'],
            'attachment' => ['required','mimes:jpg,jpeg,png,pdf'],
        ],
        [
            'invoice_id.required' => 'ID Invoice diperlukan!',
            'invoice_id.integer' => 'ID Invoice harus integer!',
            'attachment.required' => 'Bukti transfer diperlukan!',
            'attachment.mimes' => 'Format file Bukti transfer harus *.jpg, *.jpeg, *.png, *.pdf',
        ]);
    }
}
