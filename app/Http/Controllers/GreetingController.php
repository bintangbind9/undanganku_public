<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Greeting;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GreetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($template_category_name)
    {
        $section_header = ucwords($template_category_name) . ' Greetings';
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $greetings = Greeting::selectRaw('greetings.id, greetings.guest_id, guests.user_id, guests.template_category_id, guests.name, guests.phone, greetings.date, greetings.greeting, greetings.`status`')
            ->join('guests', 'greetings.guest_id', '=', 'guests.id')
            ->where('guests.user_id', Auth::user()->id)
            ->where('guests.template_category_id', $template_category->id)
            ->orderBy('greetings.date', 'desc')
            ->get();

        return view('master_data.greeting.index', compact('section_header','template_category_name','greetings'));
    }

    public function get_by_stat($template_category_name, $stat) {
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $greetings = Greeting::selectRaw('greetings.id, greetings.guest_id, guests.user_id, guests.template_category_id, guests.name, guests.phone, greetings.date, greetings.greeting, greetings.`status`')
            ->join('guests', 'greetings.guest_id', '=', 'guests.id')
            ->where('guests.user_id', Auth::user()->id)
            ->where('guests.template_category_id', $template_category->id)
            ->where('greetings.status', $stat)
            ->orderBy('greetings.date', 'desc')
            ->get();

        if (count($greetings) > 0) {
            return response()->json(['success' => $greetings]);
        } else {
            return response()->json(['info' => 'Tidak ada data']);
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
    public function show($template_category_name, $id)
    {
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $greeting = Greeting::findOrFail($id);
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($greeting->guest_id);

        if (!empty($greeting)) {
            return response()->json([
                'success' => $greeting->status,
                'message' => 'Get Greeting ID '.$greeting->id.' Successfully!'
            ]);
        } else {
            return response()->json([
                'error' => $id,
                'message' => 'Get Greeting ID '.$id.' Failed!'
            ]);
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
    public function update(Request $request, $template_category_name, $id)
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

        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $greeting = Greeting::findOrFail($id);
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($greeting->guest_id);
        $greeting->update([
            'status' => $request->status == Constant::TRUE_CONDITION ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION,
            'is_shown_on_dashboard' => Constant::FALSE_CONDITION,
        ]);

        if ($greeting) {
            // return response()->json(['success' => $greeting->id, 'result' => $request->status == Constant::TRUE_CONDITION ? true : false]);
            return response()->json(['success' => $greeting->id, 'result' => $greeting->status]);
        } else {
            // return response()->json(['error' => $id, 'result' => $request->status == Constant::TRUE_CONDITION ? false : true]);
            return response()->json(['error' => $id, 'result' => $greeting->status]);
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
}
