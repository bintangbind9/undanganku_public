<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guest;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Guest_presence;
use App\Models\Template_category;
use Illuminate\Support\Facades\Auth;

class GuestPresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $template_category_name)
    {
        $section_header = 'Add Guest Presence';
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->where('name',$request->guest_name)->firstOrFail();
        return view('master_data.guest_presence.create', compact('section_header','template_category','guest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $template_category_name)
    {
        $this->_validation($request);
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->where('name',$request->guest_name)->findOrFail($request->guest_id);
        $guest_presence_today = Guest_presence::where('guest_id',$guest->id)->where('date',Carbon::now()->toDateString())->get();

        if (count($guest_presence_today) > 0) {
            return redirect()->back()->with('error','Maaf! Tamu bernama "'.$request->guest_name.'" sudah hadir hari ini.');
        }

        $guest_presence = Guest_presence::create([
            'guest_id' => $guest->id,
            'presence' => $request->presence,
            'date' => Carbon::now()->toDateString(),
            'time' => Carbon::now()->toTimeString(),
        ]);

        if (!empty($guest_presence)) {
            return redirect()->back()->with('success','Kehadiran '.$guest_presence->guest->name.', '.$guest_presence->presence.' orang berhasil dikonfirmasi.');
        } else {
            return redirect()->back()->with('error','Kesalahan! Gagal konfirmasi kehadiran '.$request->guest_name.'.');
        }
    }

    public function not_shown_first($template_category_name) {
        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $gp_updated = 0;
        $gp_not_shown_first = Guest_presence::selectRaw('guest_presences.id, guests.user_id, guests.template_category_id, guests.name')
            ->join('guests','guest_presences.guest_id','=','guests.id')
            ->where('guest_presences.is_shown',Constant::FALSE_CONDITION)
            ->where('guests.user_id',Auth::user()->id)
            ->where('guests.template_category_id',$template_category->id)
            ->first();

        if (!empty($gp_not_shown_first)) {
            $gp_updated = Guest_presence::findOrFail($gp_not_shown_first->id)->update([
                'is_shown' => Constant::TRUE_CONDITION
            ]);
        }

        if ($gp_updated > 0) {
            return response()->json(['success' => $gp_not_shown_first->name]);
        } else {
            return response()->json(['info' => 'Tidak ada data']);
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

    private function _validation(Request $request)
    {
        $request->validate([
            'guest_id' => ['required','integer'],
            'guest_name' => ['required','string','max:255'],
            'presence' => ['required','integer','min:'.Constant::MIN_PRESENCE_OF_EACH_GUEST], // MAX dikecualikan ['max:'.Constant::MAX_PRESENCE_OF_EACH_GUEST]
        ],
        [
            'guest_id.required' => 'Guest ID Harus diisi!',
            'guest_id.integer' => 'Guest ID Harus berisi angka!',
            'guest_name.required' => 'Nama Tamu Harus diisi!',
            'guest_name.string' => 'Nama Tamu Harus berisi text!',
            'guest_name.max' => 'Nama Tamu Maksimal 255 karakter!',
            'presence.required' => 'Jumlah Kehadiran Harus diisi!',
            'presence.integer' => 'Jumlah Kehadiran Harus berisi angka!',
            'presence.min' => 'Jumlah Tamu Minimal Harus '.Constant::MIN_PRESENCE_OF_EACH_GUEST.'!',
            // 'presence.max' => 'Jumlah Tamu Maksimal Harus '.Constant::MAX_PRESENCE_OF_EACH_GUEST.'!'
        ]);
    }
}