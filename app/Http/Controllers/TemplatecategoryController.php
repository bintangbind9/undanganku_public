<?php

namespace App\Http\Controllers;

use App\Models\Template_category;
use Illuminate\Http\Request;

class TemplatecategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $section_header = "Template Category Data";
        $template_category = Template_category::all();
        return view('master_data.template_category.template_category_data',compact(['section_header','template_category']));
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

     $check = Template_category::where('name','=',$request->nama_category_template)->get();
   
     if($check->count() > 0 )
     {
        return redirect()->route('template_category.index')->with('fail','data gagal di simpan, data sudah ada');
     }
     else
     {
        $data = Template_category::create([
            'name'  =>$request->nama_category_template
        ]);
     }
       
        return redirect()->route('template_category.index')->with('message','data berhasil di simpan');
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
    public function update(Request $request,$id)
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
        $data = Template_category::findOrFail($id);
        $data->delete();
        return redirect()->route('template_category.index')->with('message','data berhasil di hapus');
    }
    public function UpdatePost(Request $request)
    {
 
        $check = Template_category::where('name','=',$request->nama_category_template)->get();
   
        if($check->count() > 0 )
        {
           return redirect()->route('template_category.index')->with('fail','data gagal di simpan, data sudah ada');
        }
        else
        {
            $data = Template_category::where('id',$request->temp_id)->update([
                'name'  =>$request->nama_category_template
            ]);

        }
        return redirect()->route('template_category.index')->with('message','data berhasil di edit');
    }
    public function destroyMany(Request $request)
    {
   
        $ids = $request->ids;
        Template_category::whereIn('id',explode(",",$ids))->delete();
      
        return response()->json(['success'=>"Data Deleted successfully."]);
    }
    
   
}
