<?php

namespace App\Http\Controllers\Wedding;

use App\Models\Bride;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrideController extends Controller
{
    function createAllBride(int $user_id)
    {
        $genders = array(Constant::CODE_MALE, Constant::CODE_FEMALE);
        foreach ($genders as $g) {
            $bride = Bride::where('gender',$g)->where('user_id', $user_id)->get();
            if (count($bride) <= 0) {
                Bride::create([
                    'user_id' => $user_id,
                    'gender' => $g,
                    'name' => '',
                    'nickname' => '',
                    'father' => '',
                    'mother' => '',
                ]);
            }
        }
    }

    function translateGender(string $gender)
    {
        return $gender == 'L' ? 'Pria' : 'Wanita';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Pengantin";

        $this->createAllBride(Auth::User()->id);

        $brides = Bride::where('user_id',Auth::User()->id)->orderBy('gender','ASC')->get();
        return view('wedding.bride.index', compact('section_header','brides'));
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
    public function update(Request $request, $gender)
    {
        $this->_validationUpdateBride($request, $gender);

        $bride = Bride::where('user_id',Auth::User()->id)->where('gender',$gender)->update([
            'name' => $request->input('name'.$gender),
            'nickname' => $request->input('nickname'.$gender),
            'father' => $request->input('father'.$gender),
            'mother' => $request->input('mother'.$gender),
            'about' => $request->input('about'.$gender),
        ]);

        if ($bride > 0) {
            return redirect()->back()->with('message','Berhasil Update Data Pengantin '.$this->translateGender($gender).'.');
        } else {
            return redirect()->back()->with('fail','Sorry, nothing has changed. Something went wrong!!');
        }
    }

    function updateImg($gender, $reqImage) {
        $bride = Bride::where('user_id',Auth::User()->id)->where('gender',$gender)->get();
        $folderPath = public_path('assets/img/wedding/photo/bride/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        $image_parts = explode(";base64,", $reqImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $nama_file = Auth::User()->id . "_" . $gender . "_" . time() . '.png';
        $file = $folderPath . $nama_file;

        if (count($bride) == 1 && !empty($bride[0]->photo) && file_exists($folderPath.$bride[0]->photo)) {
            unlink($folderPath.$bride[0]->photo);
            // File::delete($folderPath.$bride->photo); //Harus Import: use Illuminate\Support\Facades\File;
        }
        
        file_put_contents($file, $image_base64);

        Bride::where('user_id',Auth::User()->id)->where('gender',$gender)->update([
            'photo' => $nama_file,
        ]);
    }

    public function updatephotobride(Request $request, $gender)
    {
        if ($request->photo == null) {
            // return redirect()->route('bride.index')->with('fail','Nothing to update.');
            return response()->json(['fail' => 'Nothing to update.']);
        }
        else {
            $this->updateImg($gender, $request->photo);
            // return redirect()->route('bride.index')->with('message','Photo Pengantin ' . $this->translateGender($gender) . ' berhasil diupdate.');
            return response()->json(['message' => 'Photo Pengantin ' . $this->translateGender($gender) . ' berhasil diupdate.']);
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

    private function _validationUpdateBride(Request $request, $gender)
    {
        $genderName = $this->translateGender($gender);

        $request->validate([
            'name'.$gender => ['required','string','max:255'],
            'nickname'.$gender => ['required','string','max:255'],
            'father'.$gender => ['max:255'],
            'mother'.$gender => ['max:255'],
            'about'.$gender => [],
        ],
        [
            'name'.$gender.'.required' => 'Nama Pengantin '.$genderName.' harus diisi!',
            'name'.$gender.'.string' => 'Nama Pengantin '.$genderName.' harus berisi text!',
            'name'.$gender.'.max' => 'Nama Pengantin '.$genderName.' maksimal berisi 255 karakter!',
            'nickname'.$gender.'.required' => 'Nama Panggilan Pengantin '.$genderName.' harus diisi!',
            'nickname'.$gender.'.string' => 'Nama Panggilan Pengantin '.$genderName.' harus berisi text!',
            'nickname'.$gender.'.max' => 'Nama Panggilan Pengantin '.$genderName.' maksimal berisi 255 karakter!',
            'father'.$gender.'.max' => 'Nama Ayah Pengantin '.$genderName.' maksimal berisi 255 karakter!',
            'mother'.$gender.'.max' => 'Nama Ibu Pengantin '.$genderName.' maksimal berisi 255 karakter!',
        ]);
    }
}