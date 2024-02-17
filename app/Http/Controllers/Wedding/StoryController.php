<?php

namespace App\Http\Controllers\Wedding;

use App\Models\Story;
use App\Helpers\Method;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class StoryController extends Controller
{
    private $TYPE_ADD = 'add';
    private $TYPE_VIEW = 'view';
    private $TYPE_EDIT = 'edit';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = new Method();
        $section_header = "Love Story";
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $stories = Story::where('template_category_id', $template_category->id)->where('user_id', Auth::User()->id)->orderBy('date','asc')->get();
        $countStory = count($stories);
        $maxStory = 0;
        $warning = null;

        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (empty($invoice)) {
            // Jika tidak punya paket aktif
            $warning = 'Kamu tidak memiliki paket yang aktif';
        } else {
            // Jika punya paket aktif
            // Get Max Story
            $maxStory = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_STORY, $invoice->invoice_type_id);
            $maxStory = $maxStory ?? 0;

            if ($countStory > $maxStory) {
                $warning = 'Jumlah cerita Kamu melebihi batas, yang akan tampil di undangan hanya '.$maxStory.' cerita awal.';
            }
        }
        // $limitStory = $maxStory - $countStory <= 0 ? 0 : $maxStory - $countStory;

        return view('wedding.story.index', compact('section_header','stories','warning'));
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
        Cookie::queue('type-global', $this->TYPE_ADD, 1);
        Cookie::queue('story-id', 0, 1);
        $this->_validation($request);

        $method = new Method();
        $maxStory = 0;
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $countStory = count(Story::where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->get());
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (!empty($invoice)) {
            // Jika punya paket aktif
            // Get Max Story
            $maxStory = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_STORY, $invoice->invoice_type_id);
            $maxStory = $maxStory ?? 0;
        }
        if ($countStory < $maxStory) {
            Story::create([
                'template_category_id' => $template_category->id,
                'user_id' => Auth::User()->id,
                'title' => $request->title,
                'date' => $request->date,
                'desc' => $request->desc,
            ]);

            return redirect()->back()->with('success','Berhasil menambahkan cerita.');
        } else {
            return redirect()->back()->with('error','Gagal menambahkan cerita! Maksimal cerita adalah '.$maxStory.'.');
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
        Cookie::queue('type-global', $this->TYPE_EDIT, 1);
        Cookie::queue('story-id', $id, 1);
        $this->_validation($request);

        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();

        $story = Story::where('user_id',Auth::User()->id)->where('id',$id)->where('template_category_id',$template_category->id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'desc' => $request->desc,
        ]);

        if ($story > 0) {
            return redirect()->back()->with('success','Berhasil update cerita "'.$request->title.'"');
        } else {
            return redirect()->back()->with('error','Sorry, nothing has changed. Something went wrong!!');
        }
    }

    function updateImg($id, $reqImage) {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $story = Story::where('user_id',Auth::User()->id)->where('id',$id)->where('template_category_id',$template_category->id)->firstOrFail();
        $folderPath = public_path('assets/img/wedding/photo/story/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $image_parts = explode(";base64,", $reqImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $nama_file = Auth::User()->id . "_" . $id . "_" . time() . '.png';
        $file = $folderPath . $nama_file;

        //tidak pake count($story) == 1 karena get story pake firstOrFail(), artinya bukan array.
        // if (count($story) == 1 && !empty($story->photo) && file_exists($folderPath.$story->photo)) {}
        if (!empty($story) && !empty($story->photo) && file_exists($folderPath.$story->photo)) {
            unlink($folderPath.$story->photo);
            // File::delete($folderPath.$story->photo); //Harus Import: use Illuminate\Support\Facades\File;
        }
        
        file_put_contents($file, $image_base64);

        Story::where('user_id',Auth::User()->id)->where('id',$id)->where('template_category_id',$template_category->id)->update([
            'photo' => $nama_file,
        ]);
    }

    public function updatestoryimg(Request $request, $id)
    {
        if ($request->photo == null) {
            return response()->json(['error'=>"Nothing updated."]);
        }
        else {
            $this->updateImg($id, $request->photo);
            return response()->json(['success'=>"Berhasil update photo cerita '" . $request->title . "'."]);
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
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();

        $story = Story::where('id',$id)->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->firstOrFail();
        $title = $story->title;
        if (!empty($story->photo)) {
            $path = public_path('assets/img/wedding/photo/story/'.$story->photo);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $story->delete();

        return redirect()->back()->with('success',"Berhasil menghapus cerita '" . $title . "'.");
    }

    public function destroystories(Request $request, $id)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        if ($id == Auth::User()->id) {
            $ids = explode(",", $request->ids); // Array $ids dari string $request->ids
            $stories = Story::whereIn('id',$ids)->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->get();
            if (count($stories) > 0) {
                foreach ($stories as $story) {
                    if (!empty($story->photo)) {
                        $path = public_path('assets/img/wedding/photo/story/'.$story->photo);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                }

                Story::destroy($stories); //Untuk delete multiple dalam bentuk object array

                return response()->json(['success'=>"The selected item is deleted."]);
            } else {
                return response()->json(['error'=>"Error! can't delete selected item(s)."]);
            }
        } else {
            return response()->json(['error'=>"Maaf, Gagal hapus Cerita yang dipilih!"]);
        }
    }

    private function _validation(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'date' => ['required','date'],
            'desc' => ['required','string'],
        ],
        [
            'title.required' => 'Harus diisi!',
            'title.string' => 'Harus berisi text!',
            'title.max' => 'Maksimal 255 karakter!',
            'date.required' => 'Harus diisi!',
            'date.date' => 'Harus berisi tanggal!',
            'desc.required' => 'Harus diisi!',
            'desc.string' => 'Harus berisi text!',
        ]);
    }
}
