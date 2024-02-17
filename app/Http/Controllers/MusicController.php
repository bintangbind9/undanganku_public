<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Template_category;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    //

    public function index()
    {
        $section_header = "Master Data Musik";
        $music = Music::all();
  

        return view('master_data.musik.musik_data',compact(['section_header','music']));
    }

    public function store(Request $request)
    {
        if($request->hasFile('path_musik'))
        {
            $this->_validation($request);
            $template_category = Template_category::where('name','=','Wedding')->get();
            $role_id_users = User::where('id','=',Auth::User()->id)->with('roles')->get();
            $filename = round(microtime(true) * 1000).'-Musik-'.str_replace(' ','-',$request->file('path_musik')->getClientOriginalName());
            $request->file('path_musik')->move(public_path('assets/file/musik'), $filename);
            $music = Music::create([
                'template_category_id' => $template_category[0]->id,
                'role_id' => $role_id_users[0]->roles[0]->id,
                'user_id' => Auth::User()->id,
                'name' => $request->nama_musik,
                'path' => $filename,
            ]);

            return redirect()->back()->with('message','Data berhasil di simpan');
        } else {
            return redirect()->back()->with('fail','Gagal simpan. Mohon lampirkan file musik!');
        }
        // return response()->json('success','data berhasil di simpan');
    }

    public function update(Request $request)
    {
        if($request->hasFile('path_musik'))
        {
        $this->_validation($request);
        $filename = round(microtime(true) * 1000).'-Musik-'.str_replace(' ','-',$request->file('path_musik')->getClientOriginalName());
        $request->file('path_musik')->move(public_path('assets/file/musik'), $filename);
        unlink(public_path('assets/file/musik/'.$request->path_old));
            $music = Music::where('id',$request->id_musik)->update([
                'user_id' => Auth::User()->id,
                'name' =>$request->nama_musik,
                'path' =>$filename,
            ]);
        }
        else
        {
            $this->_validation($request);
            $music = Music::where('id',$request->id_musik)->update([
                'user_id' => Auth::User()->id,
                'name' =>$request->nama_musik,
                'path' =>$request->path_old,
            ]);
        }

        return redirect()->route('music.index')->with('message','Data berhasil di edit');      
    }

    public function destroy($id)
    {
        $music = Music::findOrFail($id);
        unlink(public_path('assets/file/musik/'.$music->path));    
        $music->delete();
   
        return redirect()->route('music.index')->with('message','Data berhasil di hapus');
    }
 
    private function _validation(Request $request)
    {
        $request->validate([
            'nama_musik' => ['required'],
            'path_musik' => ['mimes:mp3','required']
        ],
        [
            'path_musik.mimes' => 'Harus *.mp3',
            'path_musik.required'=> 'Wajib di isi',
            'nama_musik.required'=> 'Wajib di isi',
        ]);
    }

}