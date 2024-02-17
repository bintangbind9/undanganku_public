<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Helpers\Method;
use App\Models\Visitor;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::User()->hasRole('Admin')) {
            return 'List Users';
        } else {
            return redirect()->route('dashboard');
        }
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
        $section_header = "Profile";
        $method = new Method();
        $template_category_id = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail()->id;
        $active_invoice = $method->getActiveInvoiceOnHighestLevelPackage($id, $template_category_id);
        $visitors = Visitor::where('user_id',$id)->where('template_category_id',$template_category_id)->get();
        $guests = Guest::where('user_id',$id)->where('template_category_id',$template_category_id)->get();
        if (Auth::User()->hasRole('Admin')) {
            $user = User::findOrFail($id);
            return view('user.show', compact(['user','section_header','active_invoice','visitors','guests']));
        } else {
            if ($id == Auth::User()->id) {
                $user = User::findOrFail($id);
                return view('user.show', compact(['user','section_header','active_invoice','visitors','guests']));
            } else {
                return redirect()->route('user.show', Auth::User()->id);
            }
        }
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
        $this->_validation($request);
        if (Auth::User()->hasRole('Admin')) {
            User::updateOrCreate(['id' => $id],['name'=>$request->name]);
            return redirect()->route('user.show', $id)->with('messageAbout','Updated successfully.');
        } else {
            if ($id == Auth::User()->id) {
                User::updateOrCreate(['id' => $id],['name'=>$request->name]);
                return redirect()->route('user.show', $id)->with('messageAbout','Updated successfully.');
            } else {
                return redirect()->route('user.show', Auth::User()->id)->with('warningAbout','Sorry, Access Denied.');
            }
        }
    }

    function updateImg($id, $reqImage) {
        $user = User::findOrFail($id);
        $folderPath = public_path('assets/img/avatar/');
        $image_parts = explode(";base64,", $reqImage);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $nama_file = $id . "_" . time() . '.png';
        $file = $folderPath . $nama_file;

        file_put_contents($file, $image_base64);
        File::delete($folderPath.$user->photo);
        User::updateOrCreate(['id' => $id], ['photo' => $nama_file]);
    }

    public function updateImage(Request $request, $id)
    {
        if ($request->image == null) {
            return redirect()->route('user.show', $id)->with('warningPhoto','Nothing to update.');
        }
        else {
            if (Auth::User()->hasRole('Admin')) {
                $this->updateImg($id, $request->image);
                return redirect()->route('user.show', $id)->with('messagePhoto','Photo updated successfully.');
            } else {
                if ($id == Auth::User()->id) {
                    $this->updateImg($id, $request->image);
                    return redirect()->route('user.show', $id)->with('messagePhoto','Photo updated successfully.');
                } else {
                    return redirect()->route('user.show', Auth::User()->id)->with('warningPhoto','Sorry, Access Denied.');
                }
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
        // $this->_validationPassword($request);
        $user = User::findOrFail($id);
        // if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {}
        if (Hash::check($request->currPassword, $user->password)) {
            if (strlen($request->password) >= 8) {
                if ($request->password == $request->password_confirmation) {
                    User::updateOrCreate(['id' => $id],['password' => Hash::make($request->password)]);
                    return redirect()->route('user.show', $id)->with('messagePassword','Password updated successfully.');
                } else {
                    return redirect()->route('user.show', $id)->with('warningPassword','Confirmation password does not match.');
                }
            } else {
                return redirect()->route('user.show', $id)->with('warningPassword','The new password must be at least 8 characters.');
            }
        } else {
            return redirect()->route('user.show', $id)->with('warningPassword','Current password does not match.');
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

    private function _validation(Request $request)
    {
        // 'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    private function _validationPassword(Request $request)
    {
        // 'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
        $request->validate([
            'currPassword' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}