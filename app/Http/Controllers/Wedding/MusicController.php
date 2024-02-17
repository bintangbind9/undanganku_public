<?php

namespace App\Http\Controllers\Wedding;

use App\Models\User;
use App\Models\Music;
use App\Helpers\Method;
use App\Models\Wedding;
use App\Helpers\Constant;
use App\Models\Invoice_type;
use Illuminate\Http\Request;
use App\Models\Template_category;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = new Method();
        $section_header = "Pilih Musik";
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $music = Music::where('role_id','=',1)->where('template_category_id','=',$template_category->id)->get();
        $music_user = Music::where('user_id','=',Auth::User()->id)->where('role_id','!=',1)->where('template_category_id','=',$template_category->id)->get();
        $wedding_info = Wedding::where('user_id','=',Auth::User()->id)->get();
        $result = view('wedding.music.index', compact('section_header','music','music_user','wedding_info'));
        $current_music = $wedding_info[0]->music;
        if ($current_music->role->name != Constant::ROLE_ADMIN) {
            // Validasi Jika musik sekarang adalah Musik dengan role BUKAN Admin
            $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
            if (empty($invoice)) {
                // Jika tidak punya paket aktif
                $result = $result->with('warning','Kamu tidak memiliki paket yang aktif');
            } else {
                // Jika punya paket aktif
                $is_music_customable = $method->getValueOfRule($template_category->id, Constant::CODE_CUSTOM_MUSIC, $invoice->invoice_type_id);
                if ($is_music_customable) {
                    // Jika music bisa custom berdasar paket
                    if ($current_music->user_id != Auth::user()->id) {
                        // Jika music sekarang bukan punya si user
                        $result = $result->with('warning','Musik yang dipilih bukan punya Kamu');
                    }
                } else {
                    // Jika music tidak bisa custom berdasar paket
                    $result = $result->with('warning','Paket Kamu tidak bisa Custom Music, Silahkan pilih musik lain yang telah disediakan oleh '.config('app.name'));
                }
            }
        }
        return $result;
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
        if($request->hasFile('path'))
        {
            $this->_validation($request);
            $method = new Method();
            $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
            $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
            // Get Recommendation Package
            $invoice_types_recommendation = Invoice_type::selectRaw('invoice_types.*')
                ->join('invoice_levels','invoice_types.invoice_level_id','=','invoice_levels.id')
                ->join('rule_values','rule_values.invoice_type_id','=','invoice_types.id')
                ->join('rules','rule_values.rule_id','=','rules.id')
                ->where('invoice_types.template_category_id',$template_category->id)
                ->where('rule_values.template_category_id',$template_category->id)
                ->where('rules.template_category_id',$template_category->id)
                ->where('rules.code',Constant::CODE_CUSTOM_MUSIC)
                ->where('rules.status',Constant::TRUE_CONDITION)
                ->where('rule_values.value',Constant::TRUE_CONDITION_NUMB)
                ->orderBy('invoice_levels.level','asc')
                ->firstOrFail();
            // Jika tidak punya paket aktif
            if (empty($invoice)) {
                return redirect()->back()
                    ->with('error','Kamu tidak memiliki paket yang aktif')
                    ->with('buypackage',$invoice_types_recommendation);
            }
            $is_music_customable = $method->getValueOfRule($template_category->id, Constant::CODE_CUSTOM_MUSIC, $invoice->invoice_type_id);
            // Jika music tidak bisa custom berdasar paket
            if (!$is_music_customable) {
                return redirect()->back()
                    ->with('error','Paket Kamu tidak termasuk Custom Music')
                    ->with('buypackage',$invoice_types_recommendation);
            }
            $role_id_users = User::where('id','=',Auth::User()->id)->with('roles')->get();
            $filename = round(microtime(true) * 1000).'-Musik-'.str_replace(' ','-',$request->file('path')->getClientOriginalName());
            $request->file('path')->move(public_path('assets/file/musik'), $filename);
            $music = Music::create([
                'template_category_id' => $template_category->id,
                'role_id' => $role_id_users[0]->roles[0]->id,
                'user_id' => Auth::User()->id,
                'name' => $request->name,
                'path' => $filename,
            ]);

            Wedding::updateOrCreate(['user_id' => Auth::user()->id],['music_id'=>$music->id]);

            return redirect()->back()->with('success','Musik Kamu berhasil diupload.');
        } else {
            return redirect()->back()->with('error','Gagal simpan. Kamu tidak melampirkan file musik.');
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
        $method = new Method();
        $music = Music::findOrFail($id);
        // Validasi Jika musik yang dipilih adalah Musik dengan role BUKAN Admin
        if ($music->role->name != Constant::ROLE_ADMIN) {
            $template_category_id = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail()->id;
            $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category_id);
            // Get Recommendation Package
            $invoice_types_recommendation = Invoice_type::selectRaw('invoice_types.*')
                ->join('invoice_levels','invoice_types.invoice_level_id','=','invoice_levels.id')
                ->join('rule_values','rule_values.invoice_type_id','=','invoice_types.id')
                ->join('rules','rule_values.rule_id','=','rules.id')
                ->where('invoice_types.template_category_id',$template_category_id)
                ->where('rule_values.template_category_id',$template_category_id)
                ->where('rules.template_category_id',$template_category_id)
                ->where('rules.code',Constant::CODE_CUSTOM_MUSIC)
                ->where('rules.status',Constant::TRUE_CONDITION)
                ->where('rule_values.value',Constant::TRUE_CONDITION_NUMB)
                ->orderBy('invoice_levels.level','asc')
                ->firstOrFail();
            // Jika tidak punya paket aktif
            if (empty($invoice)) {
                return redirect('/dashboard/wedding/music')
                    ->with('error','Kamu tidak memiliki paket yang aktif')
                    ->with('buypackage',$invoice_types_recommendation);
            }
            $is_music_customable = $method->getValueOfRule($template_category_id, Constant::CODE_CUSTOM_MUSIC, $invoice->invoice_type_id);
            // Jika music tidak bisa custom berdasar paket
            if (!$is_music_customable) {
                return redirect('/dashboard/wedding/music')
                    ->with('error','Paket Kamu tidak termasuk Custom Music')
                    ->with('buypackage',$invoice_types_recommendation);
            }
            // Jika music yang dipilih bukan punya si user
            if ($music->user_id != Auth::user()->id) {
                return redirect('/dashboard/wedding/music')->with('error','Musik yang dipilih bukan punya Kamu');
            }
            Wedding::updateOrCreate(['user_id' => Auth::user()->id],['music_id'=>$id]);
            return redirect('/dashboard/wedding/music')->with('success','Kamu memilih musik '.$music->name);
        }
        Wedding::updateOrCreate(['user_id' => Auth::user()->id],['music_id'=>$id]);
        return redirect('/dashboard/wedding/music')->with('success','Kamu memilih musik '.$music->name);
    }

    public function updatemusic(Request $request, $id)
    {
        $this->_validationUpdate($request);
        // if($request->path_update != null)
        if($request->hasFile('path_update'))
        {
            $filename = round(microtime(true) * 1000).'-Musik-'.str_replace(' ','-',$request->file('path_update')->getClientOriginalName());
            $request->file('path_update')->move(public_path('assets/file/musik'), $filename);
            unlink(public_path('assets/file/musik/'.$request->path_old));
            $music = Music::where('id',$request->id_update)->update([
                'user_id' => Auth::User()->id,
                'name' =>$request->name_update,
                'path' =>$filename,
            ]);
        }
        else
        {
            $music = Music::where('id',$request->id_update)->update([
                'user_id' => Auth::User()->id,
                'name' =>$request->name_update,
                'path' =>$request->path_old,
            ]);
        }

        return redirect()->back()->with('success','Musik Kamu berhasil di-edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music_user = Wedding::where('user_id','=',Auth::user()->id)->get()[0];
        if ($music_user->music_id == $id) {
            $role_admin = Role::where('name','=','Admin')->get();
            $template_category = Template_category::where('name','=','Wedding')->get();
            $music_random = Music::where('role_id','=',$role_admin[0]->id)->where('template_category_id','=',$template_category[0]->id)->get();
            Wedding::updateOrCreate(['user_id' => Auth::user()->id],['music_id'=>$music_random[0]->id]);
        }

        $music = Music::findOrFail($id);
        unlink(public_path('assets/file/musik/'.$music->path));
        $music->delete();
   
        return redirect()->back()->with('success','Musik Kamu sudah di hapus.');
    }

    private function _validation(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'path' => ['mimes:mp3','required']
        ],
        [
            'path.mimes' => 'Harus *.mp3',
            'path.required'=> 'Wajib di isi',
            'name.required'=> 'Wajib di isi',
        ]);
    }

    private function _validationUpdate(Request $request)
    {
        $request->validate([
            'name_update' => ['required'],
            'path_update' => ['mimes:mp3','required']
        ],
        [
            'path_update.mimes' => 'Harus *.mp3',
            'path_update.required'=> 'Wajib di isi',
            'name_update.required'=> 'Wajib di isi',
        ]);
    }
}
