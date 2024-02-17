<?php

namespace App\Http\Controllers\Wedding;

use Carbon\Carbon;
use App\Models\Bride;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Guest_presence;
use App\Helpers\Method;
use App\Models\Visitor;
use App\Helpers\Constant;
use App\Models\Country_code;
use Illuminate\Http\Request;
use App\Models\Template_user;
use Illuminate\Validation\Rule;
use App\Models\Template_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = new Method();
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $section_header = 'Tamu';
        $guest = Guest::selectRaw('guests.id, guests.user_id, guests.template_category_id, guests.country_code_id, guests.name, guests.phone, guests.presence, guests.status, case when max(visitors.date) is null then "'.Constant::FALSE_CONDITION.'" else "'.Constant::TRUE_CONDITION.'" end is_visited, max(visitors.date) visitors_date')
            ->leftJoin('visitors','guests.id','=','visitors.guest_id')
            ->where('guests.user_id', Auth::User()->id)
            ->where('guests.template_category_id',$template_category->id)
            ->groupBy('guests.id')
            ->get();
        $guest_presences = Guest_presence::with('guest')
            ->whereHas('guest', function($query) use ($template_category) {
                $query->where('user_id', Auth::user()->id)->where('template_category_id', $template_category->id);
            })
            ->get();
        $template_user = Template_user::where('template_category_id', $template_category->id)
            ->where('user_id', Auth::user()->id)
            ->where('status', Constant::TRUE_CONDITION)
            ->firstOrFail();

        $countGuest = count($guest);
        $maxGuest = 0;
        $warning = null;
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (empty($invoice)) {
            // Jika tidak punya paket aktif
            $warning = 'Kamu tidak memiliki paket yang aktif';
        } else {
            // Jika punya paket aktif
            // Get Max Guest
            $maxGuest = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GUESTS, $invoice->invoice_type_id);
            $maxGuest = $maxGuest ?? 0;

            // Sudah support CODE_UNLIMITED ('~')
            // Misal: jika 10 > '~', maka false.
            if ($countGuest > $maxGuest) {
                $warning = 'Jumlah Tamu melebihi batas, Tamu yang aktif hanya '.$maxGuest.' Tamu dengan urutan dari yang pertama kali ditambahkan.';
            }
        }
        return view('master_data.guest.guest_data', compact('section_header','guest','guest_presences','template_user','template_category','maxGuest','warning'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $method = new Method();
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $countGuest = Guest::select('id')->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->count();
        $maxGuest = 0;
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (!empty($invoice)) {
            // Masuk kondisi jika punya paket aktif, jika tidak punya paket aktif, maka $maxGuest sudah default = 0
            // Get Max Guest
            $maxGuest = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GUESTS, $invoice->invoice_type_id);
            $maxGuest = $maxGuest ?? 0;
        }
        if ($countGuest < $maxGuest) {
            $section_header = 'Tambah Tamu';
            $country_codes = Country_code::select('id','name','phone_code','2_digit_iso_code as iso_code')->get();
            return view('master_data.guest.guest_create', compact('section_header','country_codes'));
        } else {
            return redirect()->route('guest.index')->with('error','Tidak dapat menambah Tamu! Data Tamu sudah mencapai batas maksimal '.$maxGuest.' Tamu.');
        }
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
        $request->phone = $method->generatePhone($request->phone);
        $request->nama_tamu = trim($request->nama_tamu);
        $request->merge(['nama_tamu' => $request->nama_tamu, 'phone' => $request->phone]);
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $this->_validation($request, $template_category->id);
        $country_code = Country_code::findOrFail($request->country_code_id);

        $maxGuest = 0;
        $countGuest = Guest::select('id')->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->count();
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (!empty($invoice)) {
            // Jika punya paket aktif
            // Get Max Guest
            $maxGuest = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GUESTS, $invoice->invoice_type_id);
            $maxGuest = $maxGuest ?? 0;
        }
        if ($countGuest < $maxGuest) {
            $created_guest = Guest::create([
                'user_id' => Auth::id(),
                'template_category_id' => $template_category->id,
                'country_code_id' => $country_code->id,
                'name' => $request->nama_tamu,
                'phone' => $request->phone,
                'presence' => 0,
                'status' => Constant::FALSE_CONDITION
            ]);

            if (!empty($created_guest)) {
                return redirect()->route('guest.create')->with('success','Tamu "'.$request->nama_tamu.'" berhasil ditambah.');
            } else {
                return redirect()->back()->with('error','Kesalahan! Gagal menambahkan Tamu "'.$request->nama_tamu.'".');
            }
        } else {
            return redirect()->back()->with('error','Gagal menambahkan Tamu! Maksimal Tamu adalah '.$maxGuest.'.');
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
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($id);
        $section_header = 'Edit Tamu';
        $country_codes = Country_code::select('id','name','phone_code','2_digit_iso_code as iso_code')->get();

        return view('master_data.guest.guest_edit', compact(['section_header','guest','country_codes']));
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
        $request->phone = $method->generatePhone($request->phone);
        $request->nama_tamu = trim($request->nama_tamu);
        $request->merge(['nama_tamu' => $request->nama_tamu, 'phone' => $request->phone]);
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $this->_validation($request, $template_category->id, $id);
        $country_code = Country_code::findOrFail($request->country_code_id);
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($id)->update([
            'user_id'=> Auth::user()->id,
            'template_category_id' => $template_category->id,
            'country_code_id' => $request->country_code_id,
            'name' => $request->nama_tamu,
            'phone' => $request->phone,
            // 'status' => $request->status // Maksud dari Status adalah Flag untuk menandakan bahwa Tamu tsb. akan hadir atau tidak.
        ]);

        if ($guest > 0) {
            return redirect()->route('guest.index')->with('success','Berhasil update Tamu "'.$request->nama_tamu.'".');
        } else {
            return redirect()->back()->with('error','Kesalahan! Gagal update Tamu "'.$request->nama_tamu.'".');
        }
    }

    public function message()
    {
        $section_header = 'Pesan untuk Tamu';
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $template_user = Template_user::where('template_category_id', $template_category->id)
            ->where('user_id', Auth::user()->id)
            ->where('status', Constant::TRUE_CONDITION)
            ->firstOrFail();
        return view('master_data.guest.guest_message', compact('template_category','section_header','template_user'));
    }

    public function message_update(Request $request)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $pesan = Template_user::where('template_category_id', $template_category->id)
            ->where('user_id', Auth::User()->id)
            // ->where('status', Constant::TRUE_CONDITION) // Tanpa Status, karena cuma mengupdate.
            ->update([
                'message_guest' => $request->message_guest
            ]);

        if ($pesan > 0) {
            return redirect()->route('guest.index')->with('success','Berhasil update Pesan untuk Tamu.');
        } else {
            return redirect()->back()->with('error','Kesalahan! Gagal update Pesan untuk Tamu.');
        }
    }

    public function message_send(Request $request)
    {
        $method = new Method();
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($request->guest_id);
        if (empty($guest->phone)) {
            return redirect()->route('guest.index')->with('error','Gagal kirim pesan ke Tamu, Nomor Ponsel Tamu "'.$guest->name.'" kosong!');
        }
        // Validate Guest
        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (empty($invoice)) {
            // Masuk kondisi jika tidak punya paket aktif
            return redirect()->route('guest.index')->with('error','Gagal kirim pesan ke Tamu, Kamu tidak punya Paket yang aktif!');
        }
        // Masuk kondisi jika punya paket aktif, Get Limit Guest
        $is_guest_valid = false;
        $max_guest_limit = $method->getValueOfRule($template_category->id, Constant::CODE_MAX_GUESTS, $invoice->invoice_type_id);
        $max_guest_limit = $max_guest_limit ?? 0;
        if ($max_guest_limit == Constant::CODE_UNLIMITED) {
            $is_guest_valid = true;
        } else {
            $valid_guest_collection = Guest::select('id')->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->limit($max_guest_limit)->get();
            foreach ($valid_guest_collection as $valid_guest) {
                if ($guest->id == $valid_guest->id) {
                    $is_guest_valid = true;
                    break;
                }
            }
        }
        if (!$is_guest_valid) {
            return redirect()->route('guest.index')->with('error','Gagal kirim pesan ke Tamu, Tamu tidak aktif!');
        }
        // End Validate Guest
        $groom = Bride::where('user_id',Auth::user()->id)->where('gender',Constant::CODE_MALE)->first();
        $bride = Bride::where('user_id',Auth::user()->id)->where('gender',Constant::CODE_FEMALE)->first();
        $event = Event::where('template_category_id',$template_category->id)->where('user_id',Auth::user()->id)->whereRaw('startdate IS NOT NULL')->orderBy('startdate')->first();
        $template_user = Template_user::where('template_category_id', $template_category->id)
            ->where('user_id', Auth::user()->id)
            ->where('status', Constant::TRUE_CONDITION)
            ->firstOrFail();
        $message = $template_user->message_guest ?? Constant::DEFAULT_GUEST_MESSAGE;
        $message = str_replace(array(
                "<b>",
                "<bold>",
                "</b>",
                "</bold>",
                "&nbsp;",
                "<i>",
                "</i>",
                "<strike>",
                "</strike>",
                "</p>",
                "&amp;",
                Constant::TEXT_CODE_GUEST,
                Constant::TEXT_CODE_GROOM,
                Constant::TEXT_CODE_BRIDE,
                Constant::TEXT_CODE_START_DAY,
                Constant::TEXT_CODE_END_DAY,
                Constant::TEXT_CODE_START_DATE,
                Constant::TEXT_CODE_END_DATE,
                Constant::TEXT_CODE_START_TIME,
                Constant::TEXT_CODE_END_TIME,
                Constant::TEXT_CODE_LOCATION,
                Constant::TEXT_CODE_LINK
            ),
            array(
                "*",
                "*",
                "*",
                "*",
                " ",
                "_",
                "_",
                "~",
                "~",
                "%0A%0A",
                "%26",
                $guest->name,
                (empty($groom) ? "..." : (empty($groom->name) ? "..." : $groom->name)),
                (empty($bride) ? "..." : (empty($bride->name) ? "..." : $bride->name)),
                (empty($event) ? "..." : Carbon::parse($event->startdate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('dddd')),
                (empty($event) ? "..." : Carbon::parse($event->enddate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('dddd')),
                (empty($event) ? "..." : Carbon::parse($event->startdate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('D MMMM YYYY')),
                (empty($event) ? "..." : Carbon::parse($event->enddate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('D MMMM YYYY')),
                (empty($event) ? "..." : Carbon::parse($event->startdate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('HH:mm')),
                (empty($event) ? "..." : Carbon::parse($event->enddate)->locale(Constant::DEFAULT_COUNTRY_CODE)->isoFormat('HH:mm')),
                (empty($event) ? "..." : $event->place . ". " . $event->address),
                urlencode(route('invitation.index', [strtolower($template_category->name), $template_user->user_url, Constant::GUEST_VAR_FROM_URL_REQ => $guest->name])) // Bisa pakai urlencode() atau rawurlencode()
            ), $message);
        $message = strip_tags($message);
        return redirect()->away('https://wa.me/'.$guest->country_code->phone_code.$guest->phone.'?text='.$message);
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
        $guest = Guest::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->findOrFail($id);

        if ($guest->delete()) {
            Visitor::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->where('guest_id',$guest->id)->delete();
            return redirect()->route('guest.index')->with('success','Berhasil menghapus Tamu '.$guest->name.'.');
        } else {
            return redirect()->route('guest.index')->with('error','Kesalahan! Gagal menghapus Tamu '.$guest->name.'.');
        }
    }

    public function destroyguests(Request $request)
    {
        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $ids = explode(",", $request->ids); // Array $ids dari string $request->ids
        $guests = Guest::whereIn('id',$ids)->where('user_id',Auth::User()->id)->where('template_category_id',$template_category->id)->get();
        $destroyed_guests = Guest::destroy($guests);
        if ($destroyed_guests > 0) { //Untuk delete multiple dalam bentuk object array
            Visitor::where('user_id',Auth::user()->id)->where('template_category_id',$template_category->id)->whereIn('guest_id',$ids)->delete();
            return response()->json([
                'success' => $destroyed_guests,
                'route_name' => 'guest.index',
                'msg' => 'success',
                'msg_content' => 'Berhasil menghapus '.$destroyed_guests.' Tamu yang dipilih.'
            ]);
        } else {
            return response()->json([
                'error' => $destroyed_guests,
                'route_name' => 'guest.index',
                'msg' => 'error',
                'msg_content' => 'Kesalahan! Gagal menghapus Tamu yang dipilih.'
            ]);
        }
    }

    public function routehelper($route_name, $msg, $msg_content)
    {
        return redirect()->route($route_name)->with($msg, $msg_content);
    }

    private function _validation(Request $request, $template_category_id, $id = null)
    {
        $nama_tamu_unique_rule = Rule::unique('guests', 'name')->where(function ($query) use ($request, $template_category_id) {
            return $query->where('user_id', Auth::user()->id)->where('template_category_id', $template_category_id);
        });
        $phone_unique_rule = Rule::unique('guests', 'phone')->where(function ($query) use ($request, $template_category_id) {
            return $query->where('user_id', Auth::user()->id)->where('template_category_id', $template_category_id)->where('country_code_id', $request->country_code_id)->whereNotNull('phone');
        });
        if (!empty($id)) {
            $nama_tamu_unique_rule = $nama_tamu_unique_rule->ignore($id);
            $phone_unique_rule = $phone_unique_rule->ignore($id);
        }
        $arr_msg = [
            'country_code_id.required' => 'Kode Nomor Ponsel tidak boleh kosong!',
            'country_code_id.integer' => 'ID Kode Nomor Ponsel harus integer!',
            'nama_tamu.required' => 'Tidak boleh kosong!',
            'nama_tamu.string' => 'Harus text!',
            'nama_tamu.max' => 'Maksimal 255 karakter!',
            'nama_tamu.unique' => 'Sudah ada!',
            'phone.max' => 'Maksimal Nomor Ponsel adalah 25 karakter!',
            'phone.unique' => 'Nomor Ponsel sudah ada!',
        ];
        $request->validate([
            'country_code_id' => ['required','integer'],
            'nama_tamu' => ['required','string','max:255',$nama_tamu_unique_rule],
            'phone' => ['max:25',$phone_unique_rule],
        ],$arr_msg);
    }
}
