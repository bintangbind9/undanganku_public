<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Feedback;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_header = "Feedbacks";

        $feedback = Feedback::with('user')->get();

        // dd($feedback);

        return view('master_data.feedback.feedback_data',compact(['section_header','feedback']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section_header = "Add Feedback";
        return view('master_data.feedback.feedback_create',compact('section_header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validation($request);
        $feedback = Feedback::create([
            'user_id'=> Auth::user()->id,
            'ulasan' => $request->ulasan,
            'is_shown_on_dashboard' => Constant::TRUE_CONDITION,
            'status' => Constant::FALSE_CONDITION,
        ]);

        return redirect()->back()->with('message','Feedback berhasil dikirim. Terimakasih atas ulasan Anda.');
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
        $section_header = "Edit Feedback";
        $feedback = Feedback::findOrFail($id);

        return view('master_data.feedback.feedback_edit',compact(['section_header','feedback']));
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
        $this->_validationUpdate($request);
        $feedback = Feedback::findOrFail($id)->update([
            // 'user_id'=> Auth::user()->id, //Update Feedback tidak usah update user_id
            // 'ulasan' => $request->ulasan, //Update Feedback tidak usah update ulasan
            'is_shown_on_dashboard' => Constant::FALSE_CONDITION,
            'status' => $request->status,
        ]);
        return redirect()->route('feedback.index')->with('message','Berhasil edit feedback.');
    }

    public function update_status(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required','string','in:' . Constant::TRUE_CONDITION . ',' . Constant::FALSE_CONDITION],
        ], [
            'status.required' => 'Status diperlukan!',
            'status.string' => 'Status harus string!',
            'status.in' => 'Status harus "'.Constant::TRUE_CONDITION.'" atau "'.Constant::FALSE_CONDITION.'"!',
        ]);

        if ($validator->fails()) {
            return response()->json(['error_validation' => $validator->errors()->first()]);
        }

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'is_shown_on_dashboard' => Constant::FALSE_CONDITION,
            'status' => $request->status,
        ]);

        if ($feedback) {
            return response()->json(['success' => $feedback->id, 'result' => $feedback->status]);
        } else {
            return response()->json(['error' => $id, 'result' => $feedback->status]);
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
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback.index')->with('message','Feedback berhasil dihapus.');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Feedback::whereIn('id',explode(",",$ids))->delete();

        return response()->json(['success'=>"Feedback deleted successfully."]);
    }

    private function _validation(Request $request)
    {
        $request->validate([
            'ulasan' => ['required','string','min:5']
        ],
        [
            'ulasan.required' => 'Wajib di isi',
            'ulasan.string' => 'Ulasan harus berbentuk text!',
            'ulasan.min' => 'Ulasan minimal 5 karakter!',
        ]);
    }

    private function _validationUpdate(Request $request)
    {
        $request->validate([
            'ulasan' => ['required','string','min:5'],
            'status' => ['required','string','in:' . Constant::TRUE_CONDITION . ',' . Constant::FALSE_CONDITION]
        ],
        [
            'ulasan.required' => 'Wajib di isi',
            'ulasan.string' => 'Ulasan harus berbentuk text!',
            'ulasan.min' => 'Ulasan minimal 5 karakter!',
            'status.required' => 'Status diperlukan!',
            'status.string' => 'Status harus text!',
            'status.in' => 'Status harus "'.Constant::TRUE_CONDITION.'" atau "'.Constant::FALSE_CONDITION.'"!',
        ]);
    }
}