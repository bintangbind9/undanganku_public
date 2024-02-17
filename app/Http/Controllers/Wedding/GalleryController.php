<?php

namespace App\Http\Controllers\Wedding;

use App\Helpers\Method;
use App\Models\Gallery;
use App\Models\Wedding;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_category;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = new Method();
        $section_header = "Gallery";
        $wedding_info = Wedding::where('user_id', Auth::User()->id)->get()[0];
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $gallery = Gallery::where('user_id', Auth::User()->id)->where('template_category_id',$template_category->id)->get();
        $countGallery = count($gallery);
        $maxGallery = 0;
        $warning = null;

        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (empty($invoice)) {
            // Jika tidak punya paket aktif
            $warning = 'Kamu tidak memiliki paket yang aktif';
        } else {
            // Jika punya paket aktif
            // Get Max Gallery
            $maxGallery = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GALLERY, $invoice->invoice_type_id);
            $maxGallery = $maxGallery ?? 0;

            if ($countGallery > $maxGallery) {
                $warning = 'Jumlah foto Kamu melebihi batas, yang akan tampil di undangan hanya '.$maxGallery.' foto pertama.';
            }
        }
        $limitGallery = $maxGallery - $countGallery <= 0 ? 0 : $maxGallery - $countGallery;

        return view('wedding.gallery.index', compact('section_header','wedding_info','gallery','countGallery','limitGallery','warning'));
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
        $method = new Method();
        $maxGallery = 0;
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $countGallery = count(Gallery::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->get());
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (!empty($invoice)) {
            // Jika punya paket aktif
            // Get Max Gallery
            $maxGallery = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GALLERY, $invoice->invoice_type_id);
            $maxGallery = $maxGallery ?? 0;
        }
        if ($countGallery < $maxGallery) {
            $image = $request->file('file');
            // $imageName = Auth::User()->id."_gallery_".round(microtime(true) * 1000).".".$image->extension();
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/img/wedding/photo/gallery'),$imageName);
            Gallery::create([
                'template_category_id' => $template_category->id,
                'user_id' => Auth::User()->id,
                'name' => '',
                'photo' => $imageName,
            ]);

            // return redirect()->back()->with('success','Berhasil tambah Photo Gallery.');
            // return Log::info('Success upload image .'.$imageName);
            return response()->json(['success'=>"Success upload image '".$imageName."'"]);
        } else {
            return response()->json(['error'=>"Maksimal photo gallery adalah ".$maxGallery]);
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
        $this->_validationUpdateGallery($request);

        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();

        if ($id == Auth::User()->id) {
            $gallery = Gallery::where('user_id',$id)->where('id',$request->id_gallery)->where('template_category_id',$template_category->id)->where('photo',$request->photo_gallery)->update([
                'name' => $request->name_gallery,
            ]);

            if ($gallery > 0) {
                return redirect()->back()->with('success','Berhasil update Nama Photo "'.$request->name_gallery.'"');
            } else {
                return redirect()->back()->with('error','Sorry, nothing has changed. Something went wrong!!');
            }
        } else {
            return redirect()->back()->with('error','Whoops Something went wrong!!');
        }
    }

    public function updatesampul(Request $request, $id)
    {
        $this->_validationSampul($request);
        if($request->hasFile('photo_sampul'))
        {
            $filename = $id."_".round(microtime(true) * 1000).'-photo_sampul-'.str_replace(' ','-',$request->file('photo_sampul')->getClientOriginalName());
            $request->file('photo_sampul')->move(public_path('assets/img/wedding/photo/sampul'), $filename);
            if (!empty($request->photo_sampul_old)) {
                unlink(public_path('assets/img/wedding/photo/sampul/'.$request->photo_sampul_old));
            }
            Wedding::where('user_id',$id)->update([
                'photo_sampul' => $filename,
            ]);
            return redirect()->back()->with('success','Berhasil ganti photo sampul.');
        }
        else
        {
            return redirect()->back()->with('error','Gagal ganti photo sampul, tidak ada photo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    // Ini untuk hapus 1 photo gallery di dropzone
    // public function destroy($id)
    public function destroy($filename)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        
        Gallery::where('photo',$filename)->where('template_category_id',$template_category->id)->delete();
        $path = public_path('assets/img/wedding/photo/gallery/'.$filename);
        if (file_exists($path)) {
            unlink($path);
        }

        // return $filename;
        return response()->json(['success'=>"Image '".$filename."' successfully deleted!"]);
    }

    public function destroysampul(Request $request, $id)
    {
        $this->_validationDestroySampul($request);
        if(!empty($request->photo_sampul_old))
        {
            unlink(public_path('assets/img/wedding/photo/sampul/'.$request->photo_sampul_old));
            Wedding::where('user_id',$id)->update([
                'photo_sampul' => null,
            ]);
            return redirect()->back()->with('success','Photo Sampul Kamu berhasil dihapus.');
        }
        else
        {
            return redirect()->back()->with('error','Gagal hapus photo sampul, tidak ada Photo Sampul lama yang terpasang!');
        }
    }

    public function destroygalleries(Request $request, $id)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();

        if ($id == Auth::User()->id) {
            $filenames = explode(",", $request->filenames); // Array $filenames dari string $request->filenames
            if (Gallery::where('user_id', $id)->where('template_category_id',$template_category->id)->whereIn('photo', $filenames)->delete())
            {
                foreach ($filenames as $value) {
                    $path = public_path('assets/img/wedding/photo/gallery/'.$value);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                return response()->json(['success'=>"The selected data is deleted."]);
            }
            else
            {
                return response()->json(['error'=>"Error! can't delete selected photo(s)."]);
            }
        } else {
            return redirect()->back()->with('error','Maaf, gagal hapus Gallery yang dipilih!');
        }
    }

    private function _validationUpdateGallery(Request $request)
    {
        $request->validate([
            'id_gallery' => ['required'],
            'name_gallery' => ['string','max:255'],
            'photo_gallery' => ['required'],
        ],
        [
            'id_gallery.required' => '*ID Gallery tidak boleh kosong!',
            'name_gallery.string' => '*Nama Photo harus string (text)!',
            'name_gallery.max'=> '*Nama Photo maksimal 255 karakter!',
            'photo_gallery.required' => '*Photo Gallery tidak boleh kosong!',
        ]);
    }

    private function _validationSampul(Request $request)
    {
        $request->validate([
            'photo_sampul' => ['mimes:jpg,jpeg,png','required']
        ],
        [
            'photo_sampul.mimes' => 'File Harus *.jpg, *.jpeg, *.png',
            'photo_sampul.required'=> 'Tidak ada Photo',
        ]);
    }

    private function _validationDestroySampul(Request $request)
    {
        $request->validate([
            'photo_sampul_old' => ['required']
        ],
        [
            'photo_sampul_old.required'=> 'Tidak ada Photo Sampul lama yang terpasang.',
        ]);
    }
}
