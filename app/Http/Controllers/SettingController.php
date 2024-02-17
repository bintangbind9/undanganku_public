<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_user;
use App\Models\Template_category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = 'Pengaturan';
        $template_users = Template_user::where('user_id', Auth::user()->id)
            ->where('status', Constant::TRUE_CONDITION)
            ->get();
        return view('setting.index', compact('section_header', 'template_users'));
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
        $template_user = Template_user::where('user_id', Auth::user()->id)->where('status', Constant::TRUE_CONDITION)->findOrFail($id);
        $template_category = Template_category::findOrFail($template_user->template_category_id);
        $this->_validation($request, $id, strtolower($template_category->name));

        $updated_template_user = $template_user->update([
            'user_url'=> $request[strtolower($template_category->name).'_user_url'],
            'is_greeting_auto_approved'=> $request->has(strtolower($template_category->name).'_is_greeting_auto_apv') ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION
        ]);

        if ($updated_template_user > 0) {
            return redirect()->route('setting.index')->with('success','Pengaturan '.$template_category->name.' berhasil disimpan.')->with('tab',strtolower($template_category->name));
        } else {
            return redirect()->route('setting.index')->with('error','Kesalahan! Pengaturan '.$template_category->name.' gagal disimpan.')->with('tab',strtolower($template_category->name));
        }
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

    private function _validation(Request $request, $id, $template_category_name)
    {
        $user_url_unique_rule = Rule::unique('template_users', 'user_url')->ignore($id);
        $request->validateWithBag($template_category_name, [
            $template_category_name . '_user_url' => ['required', 'string', 'max:255', $user_url_unique_rule, 'alpha_dash']
        ],[
            $template_category_name . '_user_url.required' => 'User URL diperlukan!',
            $template_category_name . '_user_url.string' => 'User URL harus text!',
            $template_category_name . '_user_url.max' => 'Maksimal User URL harus 255 karakter!',
            $template_category_name . '_user_url.unique' => 'User URL sudah ada!',
            $template_category_name . '_user_url.alpha_dash' => 'User URL harus berupa karakter alfabet, numerik, karakter "-" atau "_"'
        ]);
    }
}
