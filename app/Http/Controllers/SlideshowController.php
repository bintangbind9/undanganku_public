<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_user;
use App\Models\Template_category;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($template_category_name, $user_url)
    {
        $invitationController = new InvitationController();
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $template_user = Template_user::where('template_category_id',$template_category->id)->where('user_url',$user_url)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        $gallery = Gallery::where('template_category_id',$template_category->id)->where('user_id',$template_user->user_id)->get();
        if (count($gallery) > 0) {
            return view('slideshow.index', compact('gallery','template_category_name'));
        } else {
            return $invitationController->error_page('fas fa-times','bg-danger','Oops! Tidak ada Photo','Gallery tidak dapat ditampilkan, photo tidak ditemukan.');
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
