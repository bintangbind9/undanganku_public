<?php

namespace App\Http\Controllers\Wedding;

use Carbon\Carbon;
use App\Models\Rule;
use App\Models\Invoice;
use App\Helpers\Constant;
use App\Models\Bank_account;
use App\Models\Invoice_type;
use Illuminate\Http\Request;
use App\Models\Template_category;
use App\Models\Bank_func_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Wedding\InvoiceController;

class SubscribeController extends Controller
{
    function is_activated($inv_type_id)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $activateds = Invoice::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->where('invoice_type_id',$inv_type_id)->where('expired', '>=', Carbon::now())->where('amount',0)->where('status',Constant::TRUE_CONDITION)->get();
        return count($activateds) > 0 ? true : false;
    }

    public function redirect_order_page($package_name, $tab)
    {
        if ($tab == 'active')
        {
            return redirect()->route('order.index')->with('message','Paket ' . $package_name . ' telah diaktifkan.')->with('tab',$tab);
        }
        else
        {
            return redirect()->route('order.index')->with('message','Kamu pesan Paket ' . $package_name . '. Mohon lakukan pembayaran sebelum tanggal kedaluwarsa.')->with('tab',$tab);
        }
    }

    public function redirect_index_page_with_session_package($package_id) {
        return redirect()->route('subscribe.index')->with('package_id', $package_id);
    }

    function create_invoice($user_id, $template_category_id, $invoice_type_id, $bank_account_id, $code, $expired, $amount, $status)
    {
        $invoice = Invoice::create([
            'user_id' => $user_id,
            'template_category_id' => $template_category_id,
            'invoice_type_id' => $invoice_type_id,
            'bank_account_id' => $bank_account_id,
            'code' => $code,
            'expired' => $expired,
            'amount' => $amount,
            'status' => $status,
        ]);
        return $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Subscribe";
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $invoice_types = Invoice_type::where('template_category_id', $template_category->id)->join('invoice_levels', 'invoice_levels.id', '=', 'invoice_types.invoice_level_id')->orderBy('invoice_levels.level','asc')->select('invoice_types.*')->get();
        $rules = Rule::where('template_category_id', $template_category->id)->where('status',Constant::TRUE_CONDITION)->get();
        $bank_accounts = Bank_account::select('bank_accounts.*')->join('bank_func_categories','bank_accounts.bank_func_category_id','=','bank_func_categories.id')->where('bank_func_categories.name',Constant::CODE_BANK_FUNC_CATEGORY_PAYMENT)->where('bank_accounts.status',Constant::TRUE_CONDITION)->orderBy('bank_accounts.name')->get();
        return view('wedding.subscribe.index', compact('section_header','invoice_types','rules','bank_accounts'));
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
        $validator = Validator::make($request->all(), [
            'invoice_type_id' => ['required','integer'],
            'bank_account_id' => ['required','integer'],
        ],
        [
            'invoice_type_id.required' => 'Tidak ada paket yang dipilih!',
            'invoice_type_id.integer' => 'ID Paket harus integer!',
            'bank_account_id.required' => 'Mohon pilih Bank Account untuk melakukan pembayaran!',
            'bank_account_id.integer' => 'ID Bank Account harus integer!',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return response()->json(['warning' => $validator->errors()->first()]);
        }

        $inv_ctrl = new InvoiceController();
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $inv_type = Invoice_type::where('template_category_id',$template_category->id)->findOrFail($request->invoice_type_id);
        $bank_func_category = Bank_func_category::where('name',Constant::CODE_BANK_FUNC_CATEGORY_PAYMENT)->firstOrFail();
        $bank_account = Bank_account::where('bank_func_category_id',$bank_func_category->id)->where('status',Constant::TRUE_CONDITION)->findOrFail($request->bank_account_id);

        $status = $inv_ctrl->isFree($inv_type->id) ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION;
        $expired = $status == Constant::TRUE_CONDITION ? $inv_ctrl->getExpiredDatetimeByDay($inv_type->expired_day) : $inv_ctrl->getExpiredDatetimeByDay(Constant::EXPIRED_DAY_OF_INVOICE_FIRST_MADE);

        if ($inv_type->amount == 0)
        {
            if ($this->is_activated($request->invoice_type_id))
            { return response()->json(['warning'=>"Paket sudah aktif!"]); }
            else
            {
                $this->create_invoice(Auth::User()->id, $template_category->id, $inv_type->id, $bank_account->id, $inv_ctrl->genCode(), $expired, 0, $status);
                return response()->json(['redirect'=>route('subscribe.redirect_order',[$inv_type->name,'active'])]);
            }
        }
        else
        {
            if ($request->btn_modal_save_id == 'btn-modal-order') {
                $this->create_invoice(Auth::User()->id, $template_category->id, $inv_type->id, $bank_account->id, $inv_ctrl->genCode(), $expired, 0, $status);
                return response()->json(['redirect'=>route('subscribe.redirect_order',[$inv_type->name,'notyetpaid'])]);
            } elseif ($request->btn_modal_save_id == 'btn-modal-pay') {
                $inv = $this->create_invoice(Auth::User()->id, $template_category->id, $inv_type->id, $bank_account->id, $inv_ctrl->genCode(), $expired, 0, $status);
                return response()->json(['redirect'=>route('order.edit',$inv->id)]);
            } else {
                return response()->json(['error' => 'Maaf, terjadi kesalahan!']);
            }
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
        //
    }
}
