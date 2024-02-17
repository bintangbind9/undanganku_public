<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Feedback;
use App\Models\Template;
use App\Models\Template_category;
use App\Helpers\Constant;
use App\Models\Invoice_type;
use App\Models\Bank_account;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Masih hanya support untuk wedding
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $template = Template::where('template_category_id',$template_category->id)->get();
        $feedbacks = Feedback::where('status',Constant::TRUE_CONDITION)->orderBy('created_at','desc')->limit(Constant::MAX_FEEDBACK_DISPLAYED_ON_LANDING_PAGE)->get();
        $invoice_types = Invoice_type::where('template_category_id',$template_category->id)->get();
        $banks = Bank_account::with('bank_func_category')
            ->whereHas('bank_func_category', function ($query) {
                $query->where('name',Constant::CODE_BANK_FUNC_CATEGORY_PAYMENT);
            })
            ->where('status',Constant::TRUE_CONDITION)
            ->get();
        $rules = Rule::with('template_category')
            ->whereHas('template_category', function ($query) {
                $query->where('name',Constant::CODE_WEDDING);
            })
            ->where('status',Constant::TRUE_CONDITION)
            ->get();
        return view('welcome',compact('template','feedbacks','invoice_types','banks','rules'));
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
