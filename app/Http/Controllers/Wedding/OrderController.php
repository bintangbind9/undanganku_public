<?php

namespace App\Http\Controllers\Wedding;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Invoice_payment;
use App\Models\Template_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function redirect_page($tab)
    {
        return redirect()->route('order.index')->with('tab',$tab);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Pesanan";
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $notyetpaids = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('expired', '>=', Carbon::now())->where('invoices.amount',0)->where('status',Constant::FALSE_CONDITION)->leftJoin('invoice_payments', 'invoices.id', '=', 'invoice_payments.invoice_id')->groupBy('invoices.id')->orderBy('expired')->selectRaw('invoices.*, COUNT(invoice_payments.invoice_id) AS `count_inv_payments`')->get();
        foreach($notyetpaids as $nyp_no => $nyp) {
            if($nyp->count_inv_payments > 0){
               unset($notyetpaids[$nyp_no]);
            }
        }
        $lesspaids = Invoice::where('user_id',Auth::User()->id)->where('invoices.template_category_id',$template_category->id)->where('expired', '>=', Carbon::now())->whereRaw('invoices.amount < invoice_types.amount')->where('status','N')->join('invoice_types', 'invoices.invoice_type_id', '=', 'invoice_types.id')->selectRaw("CASE WHEN (SELECT COUNT(*) FROM invoice_payments WHERE invoice_id = invoices.id) > 0 THEN CASE WHEN (SELECT COUNT(*) FROM invoice_payments WHERE invoice_id = invoices.id AND invoice_payments.is_confirmed = 'N') > 0 THEN 'N' ELSE 'Y' END ELSE 'N' END AS `is_confirmed`, invoices.*")->orderBy('expired')->get();
        foreach($lesspaids as $lp_no => $lp) {
            if($lp->is_confirmed == 'N'){
               unset($lesspaids[$lp_no]);
            }
        }
        $waiting_to_be_confirmeds = Invoice_payment::where('invoices.user_id',Auth::User()->id)->where('invoices.template_category_id',$template_category->id)->where('invoice_payments.is_confirmed','N')->join('invoices', 'invoice_payments.invoice_id', '=', 'invoices.id')->orderBy('invoice_payments.date')->select('invoice_payments.*')->get();
        $activateds = Invoice::where('user_id',Auth::User()->id)->where('invoices.template_category_id',$template_category->id)->where('expired', '>=', Carbon::now())->where('status','Y')->join('invoice_types', 'invoice_types.id', '=', 'invoices.invoice_type_id')->join('invoice_levels', 'invoice_levels.id', '=', 'invoice_types.invoice_level_id')->orderBy('invoice_levels.level','desc')->orderBy('expired')->select('invoices.*')->get();
        $expireds = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('expired', '<', Carbon::now())->where('status',Constant::TRUE_CONDITION)->orderBy('expired','desc')->get();
        $canceleds = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('expired', '<', Carbon::now())->where('status',Constant::FALSE_CONDITION)
            ->whereRaw("(SELECT COUNT(1) FROM invoice_payments WHERE invoice_payments.invoice_id = invoices.id AND is_confirmed = '" . Constant::FALSE_CONDITION . "') = 0")
            ->orderBy('expired','desc')->get();
        return view('wedding.order.index', compact('section_header','notyetpaids','lesspaids','waiting_to_be_confirmeds','activateds','expireds','canceleds'));
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

    public function show_invoice_data($id) {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $invoice_show_item = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->findOrFail($id);
        $invoice_payments = Invoice_payment::where('invoice_id',$invoice_show_item->id)->orderBy('date')->get();
        $amount_confirmed = 0;
        foreach ($invoice_payments as $inv_pay) {
            if ($inv_pay->is_confirmed == Constant::TRUE_CONDITION) {
                $amount_confirmed += $inv_pay->amount;
            }
        }
        $amount_must_be_paid = $invoice_show_item->invoice_type->amount - $amount_confirmed;
        if ($amount_must_be_paid < 0) {
            $amount_must_be_paid = 0;
        }
        return $result_data = array('invoice_show_item' => $invoice_show_item,'invoice_payments' => $invoice_payments,'amount_confirmed' => $amount_confirmed,'amount_must_be_paid' => $amount_must_be_paid);
    }

    public function print_invoice($id)
    {
        $invoice_data = $this->show_invoice_data($id);
        $invoice_show_item = $invoice_data['invoice_show_item'];
        $invoice_payments = $invoice_data['invoice_payments'];
        $amount_confirmed = $invoice_data['amount_confirmed'];
        $amount_must_be_paid = $invoice_data['amount_must_be_paid'];
        $section_header = 'Print Invoice';
        return view('wedding.order.invoice_print', compact('section_header','invoice_show_item','invoice_payments','amount_confirmed','amount_must_be_paid'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice_data = $this->show_invoice_data($id);
        $invoice_show_item = $invoice_data['invoice_show_item'];
        $invoice_payments = $invoice_data['invoice_payments'];
        $amount_confirmed = $invoice_data['amount_confirmed'];
        $amount_must_be_paid = $invoice_data['amount_must_be_paid'];
        return view('wedding.order.invoice_show', compact('invoice_show_item','invoice_payments','amount_confirmed','amount_must_be_paid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section_header = "Invoice";
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $invoice_edit_item = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('expired', '>=', Carbon::now())->where('status',Constant::FALSE_CONDITION)->findOrFail($id);
        $invoice_payments = Invoice_payment::where('invoice_id',$invoice_edit_item->id)->orderBy('date')->get();
        $amount_confirmed = 0;
        foreach ($invoice_payments as $inv_pay) {
            if ($inv_pay->is_confirmed == Constant::TRUE_CONDITION) {
                $amount_confirmed += $inv_pay->amount;
            }
        }
        $amount_must_be_paid = $invoice_edit_item->invoice_type->amount - $amount_confirmed;
        if ($amount_must_be_paid < 0) {
            $amount_must_be_paid = 0;
        }

        if ($invoice_edit_item->amount < $invoice_edit_item->invoice_type->amount)
        {
            return view('wedding.order.invoice', compact('section_header','invoice_edit_item','invoice_payments','amount_confirmed','amount_must_be_paid'));
        } else {
            return redirect()->route('order.index')->with('tab','notyetpaid')->with('warning',"Pesanan '".$invoice_edit_item->code."' sudah dibayar.");
        }
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
