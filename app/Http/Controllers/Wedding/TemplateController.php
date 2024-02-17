<?php

namespace App\Http\Controllers\Wedding;

use App\Helpers\Method;
use App\Models\Wedding;
use App\Models\Template;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_user;
use App\Models\Template_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Pilih Template Wedding";
        $template_category = Template_category::where('name','=','Wedding')->get();
        $template = Template::where('template_category_id','=',$template_category[0]->id)->get();
        $wedding_info = Wedding::where('user_id','=',Auth::User()->id)->get();
        $template_user = Template_user::where('template_category_id',$template_category[0]->id)->where('user_id',Auth::User()->id)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        return view('wedding.template.index', compact('section_header','template','wedding_info','template_user'));
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
        $method = new Method();
        $template_category_id = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail()->id;
        $template = Template::findOrFail($id);
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category_id);
        //Jika tidak punya paket aktif
        if (empty($invoice)) {
            return redirect('/dashboard/wedding/template')->with('error','Kamu tidak memiliki paket yang aktif');
        }
        //Jika Template yang akan dipilih tidak sesuai
        if ($template->invoice_type->invoice_level->level > $invoice->invoice_type->invoice_level->level) {
            //Jika Current Template tidak sesuai, maka turunin template yang sesuai
            $curr_template_level = Wedding::where('user_id',Auth::user()->id)->firstOrFail()
                ->template->invoice_type->invoice_level->level;
            if ($curr_template_level > $invoice->invoice_type->invoice_level->level) {
                //Flow Down Template by System
                $template_by_system = Template::selectRaw('templates.id, templates.name, invoice_levels.`level`')
                    ->join('invoice_types', 'templates.invoice_type_id', '=', 'invoice_types.id')
                    ->join('invoice_levels', 'invoice_types.invoice_level_id', '=', 'invoice_levels.id')
                    ->where('templates.template_category_id', $template_category_id)
                    ->where('invoice_types.template_category_id', $template_category_id)
                    ->where('invoice_levels.level', '<=', $invoice->invoice_type->invoice_level->level)
                    ->orderBy('invoice_levels.level', 'desc')
                    ->orderBy('templates.id', 'desc')
                    ->first();
                if (!empty($template_by_system)) {
                    //Update by system
                    Wedding::updateOrCreate(['user_id' => Auth::user()->id],['template_id'=>$template_by_system->id]);
                }
            }
            return redirect('/dashboard/wedding/template')
                ->with('error','Upgrade paket Kamu agar bisa memilih template '.$template->name)
                ->with('buypackage',$template);
        }
        Wedding::updateOrCreate(['user_id' => Auth::user()->id],['template_id'=>$id]);
        return redirect('/dashboard/wedding/template')->with('success','Kamu memilih template '.$template->name);
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
