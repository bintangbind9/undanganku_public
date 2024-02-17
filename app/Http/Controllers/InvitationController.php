<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bride;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Music;
use App\Models\Story;
use App\Helpers\Method;
use App\Models\Gallery;
use App\Models\Visitor;
use App\Models\Wedding;
use App\Models\Greeting;
use App\Models\Template;
use App\Models\Bank_account;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use App\Models\Template_user;
use App\Models\Guest_presence;
use Spatie\CalendarLinks\Link;
use App\Models\Template_category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    const STAT = 'status';
    const MSG = 'message';
    const ERROR_STAT = 'error';
    const SUCCESS_STAT = 'success';
    private $method, $template_category, $template_user, $guest, $active_invoice, $groom, $bride,
            $event, $event_count, $hours_spent, $gallery, $story, $guest_estimate, $guest_act_presence,
            $guest_qr_code, $greeting, $wedding, $template, $music, $save_date_link, $bank_acc_donations;

    function get_data_invitation($template_category_name, $user_url, $guest_name = null) {
        $this->method = new Method();
        $this->template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $this->template_user = Template_user::where('template_category_id',$this->template_category->id)->where('user_url',$user_url)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        $this->guest = Guest::where('user_id',$this->template_user->user_id)->where('template_category_id',$this->template_category->id)->where('name',$guest_name)->first();
        $this->active_invoice = $this->method->getActiveInvoiceOnHighestLevelPackage($this->template_user->user_id, $this->template_category->id);
        $this->groom = Bride::where('user_id',$this->template_user->user_id)->where('gender',Constant::CODE_MALE)->first();
        if (empty($this->groom)) {
            return array(InvitationController::STAT => InvitationController::ERROR_STAT, InvitationController::MSG => 'Tidak ada data Pengantin Pria.');
        }
        $this->bride = Bride::where('user_id',$this->template_user->user_id)->where('gender',Constant::CODE_FEMALE)->first();
        if (empty($this->bride)) {
            return array(InvitationController::STAT => InvitationController::ERROR_STAT, InvitationController::MSG => 'Tidak ada data Pengantin Wanita.');
        }
        $this->event = Event::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->whereRaw('startdate IS NOT NULL')->orderBy('startdate')->get();
        $this->event_count = count($this->event);
        if ($this->event_count > 0) {
            $groom_nickname = empty($this->groom->nickname) ? 'The Groom' : $this->groom->nickname;
            $bride_nickname = empty($this->bride->nickname) ? 'The Bride' : $this->bride->nickname;
            $groom_name = empty($this->groom->name) ? 'The Groom' : $this->groom->name;
            $bride_name = empty($this->bride->name) ? 'The Bride' : $this->bride->name;
            // https://github.com/spatie/calendar-links
            $this->save_date_link = Link::create(
                $this->template_category->name . ' ' . $groom_nickname . ' & ' . $bride_nickname . ' (' . (empty($this->event[0]->name) ? $this->event[0]->event_type->name : $this->event[0]->name) . ')',
                Carbon::createFromFormat('Y-m-d H:i:s', $this->event[0]->startdate),
                Carbon::createFromFormat('Y-m-d H:i:s', $this->event[0]->enddate)
            )->description("'" . (empty($this->event[0]->name) ? $this->event[0]->event_type->name : $this->event[0]->name) . "' event from " . $this->template_category->name . " of " . $groom_name . " and " . $bride_name . ".")
            ->address($this->event[0]->place . '. ' . $this->event[0]->address)->google();
        }
        $this->hours_spent = 0;
        foreach ($this->event as $val) {
            $this->hours_spent += date_diff(date_create($val->startdate),date_create($val->enddate))->format('%R%h');
        }
        $this->gallery = Gallery::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->get();
        $this->story = Story::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->orderBy('date','asc')->get();
        $this->guest_estimate = Guest::where('user_id',$this->template_user->user_id)->where('template_category_id',$this->template_category->id)->where('status',Constant::TRUE_CONDITION)->selectRaw('SUM(presence) AS `total`')->firstOrFail()->total;
        $this->guest_estimate = empty($this->guest_estimate) ? 0 : $this->guest_estimate;
        $this->guest_act_presence = Guest_presence::selectRaw('SUM(guest_presences.presence) AS `total`')->join('guests', 'guest_presences.guest_id', '=', 'guests.id')->where('guests.user_id',$this->template_user->user_id)->where('guests.template_category_id',$this->template_category->id)->firstOrFail()->total;
        $this->guest_act_presence = empty($this->guest_act_presence) ? 0 : $this->guest_act_presence;
        $this->guest_qr_code = empty($this->guest) ? null : $this->method->generateQrCode(route('guest_presence.create', [$template_category_name, 'guest_name' => $this->guest->name]));
        $this->greeting = Greeting::selectRaw('greetings.*')->join('guests', 'greetings.guest_id', '=', 'guests.id')->where('greetings.status',Constant::TRUE_CONDITION)->where('guests.user_id',$this->template_user->user_id)->where('guests.template_category_id',$this->template_category->id)->orderBy('greetings.date','desc')->limit(Constant::MAX_GREETING_DISPLAYED)->get();
        $this->wedding = Wedding::where('user_id',$this->template_user->user_id)->firstOrFail();
        $this->template = Template::where('template_category_id',$this->template_category->id)->findOrFail($this->wedding->template_id);
        $this->music = Music::where('template_category_id',$this->template_category->id)->findOrFail($this->wedding->music_id);
        $this->bank_acc_donations = Bank_account::with('bank_func_category')
            ->where('user_id', $this->template_user->user_id)
            ->where('status', Constant::TRUE_CONDITION)
            ->whereHas('bank_func_category', function ($query) {
                $query->where('name', Constant::CODE_BANK_FUNC_CATEGORY_DONATION);
            })
            ->get();

        return array(InvitationController::STAT => InvitationController::SUCCESS_STAT, InvitationController::MSG => InvitationController::SUCCESS_STAT);
    }

    public function invitation_preview($template_category_name, $user_url, $template_id) {
        $is_preview = true;
        $is_has_guest = false;
        $gmaps_rule_value = Constant::GMAPS_SAMPLE;
        $get_data_result = $this->get_data_invitation($template_category_name, $user_url);
        if ($get_data_result[InvitationController::STAT] == InvitationController::ERROR_STAT) {
            return $this->error_page('fas fa-times','bg-danger','Tidak dapat ditampilkan',$get_data_result[InvitationController::MSG]);
        }
        $this->template = Template::where('template_category_id',$this->template_category->id)->findOrFail($template_id);
        $max_gallery_limit = Constant::MAX_SAMPLE_GALLERY;
        $this->gallery = Gallery::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->limit($max_gallery_limit)->get();
        $max_story_limit = Constant::MAX_SAMPLE_STORY;
        $this->story = Story::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->limit($max_story_limit)->orderBy('date','asc')->get();
        // Validate Music
        $is_music_customable = Constant::MUSIC_CUSTOMABLE_SAMPLE;
        if ($this->method->getRoleByRoleId($this->music->role_id)->name != Constant::ROLE_ADMIN) {
            if ($is_music_customable) {
                if ($this->music->user_id != $this->template_user->user_id) {
                    return $this->error_page('fas fa-times','bg-danger','Musik Tidak Valid',Auth::check() ? 'Musik yang dipilih adalah bukan musik Anda!' : 'Yang punya hajat sedang memperbaiki Data.');
                }
            } else {
                return $this->error_page('fas fa-times','bg-danger','Musik Tidak Valid',Auth::check() ? 'Musik yang dipilih tidak sesuai dengan Paket Anda! Paket Anda tidak mendukung custom musik.' : 'Yang punya hajat sedang memperbaiki Data.');
            }
        }
        // End Validate Music
        // return view(Constant::PATH_INVITATION_VIEW.'.'.$this->template->view, compact('is_preview','is_has_guest','template_category','template_user','template','wedding','music','groom','bride','event','story','gallery','greeting','guest_estimate','guest_act_presence','event_count','hours_spent','gmaps_rule_value'));
        return view(Constant::PATH_INVITATION_VIEW.'.'.$this->template->view, [
            'is_preview' => $is_preview,
            'is_has_guest'=> $is_has_guest,
            'template_category' => $this->template_category,
            'template_user' => $this->template_user,
            'template' => $this->template,
            'wedding' => $this->wedding,
            'music' => $this->music,
            'groom' => $this->groom,
            'bride' => $this->bride,
            'event' => $this->event,
            'story' => $this->story,
            'gallery' => $this->gallery,
            'greeting' => $this->greeting,
            'guest_estimate' => $this->guest_estimate,
            'guest_act_presence' => $this->guest_act_presence,
            'event_count' => $this->event_count,
            'hours_spent' => $this->hours_spent,
            'gmaps_rule_value' => $gmaps_rule_value,
            'save_date_link' => $this->save_date_link,
            'bank_acc_donations' => $this->bank_acc_donations
        ]);
    }

    public function invitation(Request $request, $template_category_name, $user_url) {
        $guest_var_from_url_req = Constant::GUEST_VAR_FROM_URL_REQ;
        $guest_name = trim($request->$guest_var_from_url_req);
        $get_data_result = $this->get_data_invitation($template_category_name, $user_url, $guest_name);
        if ($get_data_result[InvitationController::STAT] == InvitationController::ERROR_STAT) {
            return $this->error_page('fas fa-times','bg-danger','Tidak dapat ditampilkan',$get_data_result[InvitationController::MSG]);
        }
        $is_preview = false;
        $is_has_guest = empty($this->guest) ? false : true;
        $gmaps_rule_value = true;
        if ($this->active_invoice != null) {
            $max_gallery_limit = $this->method->getValueOfRule($this->template_category->id, Constant::CODE_MAX_GALLERY, $this->active_invoice->invoice_type_id);
            $this->gallery = Gallery::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->limit($max_gallery_limit)->get();
            $max_story_limit = $this->method->getValueOfRule($this->template_category->id, Constant::CODE_MAX_STORY, $this->active_invoice->invoice_type_id);
            $this->story = Story::where('template_category_id',$this->template_category->id)->where('user_id',$this->template_user->user_id)->limit($max_story_limit)->orderBy('date','asc')->get();
            $gmaps_rule_value = $this->method->getValueOfRule($this->template_category->id, Constant::CODE_GMAPS, $this->active_invoice->invoice_type_id);
            if ($is_has_guest) {
                // Validate Guest
                $is_guest_valid = false;
                $max_guest_limit = $this->method->getValueOfRule($this->template_category->id, Constant::CODE_MAX_GUESTS, $this->active_invoice->invoice_type_id);
                if ($max_guest_limit == Constant::CODE_UNLIMITED) {
                    $is_guest_valid = true;
                } else {
                    $valid_guest_collection = Guest::select('id')->where('user_id',$this->template_user->user_id)->where('template_category_id',$this->template_category->id)->limit($max_guest_limit)->get();
                    foreach ($valid_guest_collection as $valid_guest) {
                        if ($this->guest->id == $valid_guest->id) {
                            $is_guest_valid = true;
                            break;
                        }
                    }
                }
                if (!$is_guest_valid) {
                    return $this->error_page('fas fa-times','bg-danger','Tamu Tidak Valid',Auth::check() ? 'Tamu '.$this->guest->name.' tidak valid dalam Paket Anda!' : 'Invalid Data Tamu! Yang punya hajat sedang memperbaiki Data.');
                }
                // End Validate Guest
            }
            // Validate Music
            $is_music_customable = $this->method->getValueOfRule($this->template_category->id, Constant::CODE_CUSTOM_MUSIC, $this->active_invoice->invoice_type_id);
            if ($this->method->getRoleByRoleId($this->music->role_id)->name != Constant::ROLE_ADMIN) {
                if ($is_music_customable) {
                    if ($this->music->user_id != $this->template_user->user_id) {
                        return $this->error_page('fas fa-times','bg-danger','Musik Tidak Valid',Auth::check() ? 'Musik yang dipilih adalah bukan musik Anda!' : 'Yang punya hajat sedang memperbaiki Data.');
                    }
                } else {
                    return $this->error_page('fas fa-times','bg-danger','Musik Tidak Valid',Auth::check() ? 'Musik yang dipilih tidak sesuai dengan Paket Anda! Paket Anda tidak mendukung custom musik.' : 'Yang punya hajat sedang memperbaiki Data.');
                }
            }
            // End Validate Music
            if ($this->active_invoice->invoice_type->invoice_level->level >= $this->template->invoice_type->invoice_level->level) {
                $this->update_visitor($this->template_user->user_id, $this->template_category->id, $is_has_guest ? $this->guest->id : null);
                // return view(Constant::PATH_INVITATION_VIEW.'.'.$this->template->view, compact('is_preview','is_has_guest','template_category','template_user','template','wedding','music','groom','bride','event','story','gallery','greeting','guest','guest_estimate','guest_act_presence','event_count','hours_spent','guest_name','gmaps_rule_value'));
                return view(Constant::PATH_INVITATION_VIEW.'.'.$this->template->view, [
                    'is_preview' => $is_preview,
                    'is_has_guest' => $is_has_guest,
                    'template_category' => $this->template_category,
                    'template_user' => $this->template_user,
                    'template' => $this->template,
                    'wedding' => $this->wedding,
                    'music' => $this->music,
                    'groom' => $this->groom,
                    'bride' => $this->bride,
                    'event' => $this->event,
                    'story' => $this->story,
                    'gallery' => $this->gallery,
                    'greeting' => $this->greeting,
                    'guest' => $this->guest,
                    'guest_estimate' => $this->guest_estimate,
                    'guest_act_presence' => $this->guest_act_presence,
                    'guest_qr_code' => $this->guest_qr_code,
                    'event_count' => $this->event_count,
                    'hours_spent' => $this->hours_spent,
                    'guest_name' => $guest_name,
                    'gmaps_rule_value' => $gmaps_rule_value,
                    'save_date_link' => $this->save_date_link,
                    'bank_acc_donations' => $this->bank_acc_donations
                ]);
            } else {
                return $this->error_page('fas fa-times','bg-danger','Template Tidak Valid',Auth::check() ? 'Template yang dipilih tidak sesuai dengan Paket Anda!' : 'Kesalahan, Yang punya hajat sedang memperbaiki Data.');
            }
        } else {
            return $this->error_page('fas fa-times','bg-danger','Undangan Tidak Valid',Auth::check() ? 'Anda tidak mempunyai paket aktif!' : 'Undangan sudah tidak tersedia!');
        }
    }

    public function get_greeting($template_category_id, $user_id, $paginate) {
        $greeting = Greeting::selectRaw('greetings.*, guests.name AS guest_name')->join('guests', 'greetings.guest_id', '=', 'guests.id')->where('greetings.status',Constant::TRUE_CONDITION)->where('guests.user_id',$user_id)->where('guests.template_category_id',$template_category_id)->orderBy('greetings.date','desc')->paginate($paginate);
        // Untuk Support Datetime di Safari
        foreach ($greeting as $grt) {
            $grt->date = Carbon::parse($grt->date)->toIso8601String();
        }
        // END Untuk Support Datetime di Safari
        return response()->json(['greeting' => $greeting->toJson()]);
    }

    public function error_page($icon_name, $icon_bg, $error_title, $error_msg)
    {
        $btn_link = Auth::check() ? route('dashboard') : '/';
        $btn_txt = Auth::check() ? 'Dashboard' : 'Pergi ke ' . config('app.name');
        return view(Constant::PATH_INVITATION_ERROR_VIEW, compact('icon_name','icon_bg','error_title','error_msg','btn_txt','btn_link'));
    }

    function update_visitor($user_id, $template_category_id, $guest_id = null)
    {
        $guest = Guest::where('user_id',$user_id)->where('template_category_id',$template_category_id)->find($guest_id);
        Visitor::create([
            'user_id' => $user_id,
            'template_category_id' => $template_category_id,
            'guest_id' => $guest_id,
            'name' => $guest->name ?? 'unknown',
            'fullname' => $guest->name ?? '-',
            'date' => Carbon::now()
        ]);
    }

    public function update_presence(Request $request, $template_category_name, $user_url) {
        $validatorType = Validator::make($request->all(), [
            'type' => ['required','string','max:6','in:CANCEL,UPDATE'],
        ], [
            'type.required' => 'Type Button diperlukan!',
            'type.string' => 'Type Button harus text!',
            'type.max' => 'Type Button maksimal 6 karakter!',
            'type.in' => 'Type Button harus "CANCEL" atau "UPDATE"!',
        ]);

        if ($validatorType->fails()) {
            // return response()->json($validatorType->messages(), Response::HTTP_BAD_REQUEST);
            return response()->json(['error' => $validatorType->errors()->first()]);
        }

        if ($request->type == 'CANCEL') {
            // CANCEL
            $validator = Validator::make($request->all(), [
                'name' => ['required','string','max:255'],
            ], [
                'name.required' => 'Nama Tamu Harus diisi!',
                'name.string' => 'Nama Tamu Harus Text!',
                'name.max' => 'Nama Tamu Maksimal 255 karakter!',
            ]);
        } else {
            // UPDATE
            $validator = Validator::make($request->all(), [
                'name' => ['required','string','max:255'],
                'presence' => ['required','integer','min:'.Constant::MIN_PRESENCE_OF_EACH_GUEST,'max:'.Constant::MAX_PRESENCE_OF_EACH_GUEST],
            ], [
                'name.required' => 'Nama Tamu Harus diisi!',
                'name.string' => 'Nama Tamu Harus Text!',
                'name.max' => 'Nama Tamu Maksimal 255 karakter!',
                'presence.required' => 'Jumlah Tamu Harus diisi!',
                'presence.integer' => 'Jumlah Tamu Harus Bilangan Bulat!',
                'presence.min' => 'Jumlah Tamu Minimal Harus '.Constant::MIN_PRESENCE_OF_EACH_GUEST.'!',
                'presence.max' => 'Jumlah Tamu Maksimal Harus '.Constant::MAX_PRESENCE_OF_EACH_GUEST.'!',
            ]);
        }

        if ($validator->fails()) {
            // return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $template_user = Template_user::where('template_category_id',$template_category->id)->where('user_url',$user_url)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        $guest = Guest::where('user_id',$template_user->user_id)->where('template_category_id',$template_category->id)->where('name',$request->name)->firstOrFail();
        $guest->update([
            'presence' => $request->type == 'CANCEL' ? 0 : $request->presence,
            'status' => $request->type == 'CANCEL' ? Constant::FALSE_CONDITION : Constant::TRUE_CONDITION
        ]);

        if ($guest) {
            // return redirect()->back()->with('message','Berhasil update kehadiran Anda.');
            return response()->json([
                $request->type == 'CANCEL' ? 'warning' : 'success' => $request->type == 'CANCEL' ? 'Sayang sekali Anda tidak bisa hadir, mohon doa & restu Anda ya ' . $request->name . ' :)' : 'Saya akan datang dengan jumlah ' . $request->presence . ' orang.',
                'info-batal-atau-abaikan' => $request->type == 'CANCEL' ? 'Abaikan ini' : "Klik 'Batalkan'",
                'info-status-hadir' => $request->type == 'CANCEL' ? 'Tidak Hadir' : 'Hadir',
                'info-jumlah-hadir' => $request->type == 'CANCEL' ? 0 : $request->presence,
            ]);
        } else {
            // return redirect()->back()->with('fail','Maaf, Gagal update kehadiran Anda.');
            return response()->json(['error' => $request->type == 'CANCEL' ? 'Maaf, Gagal membatalkan kehadiran Anda.' : 'Maaf, Gagal update kehadiran Anda.']);
        }
    }

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

    public function store_greeting(Request $request, $template_category_name, $user_url)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255'],
            'greeting' => ['required','string','min:5'],
        ], [
            'name.required' => 'Nama Tamu Harus diisi!',
            'name.string' => 'Nama Tamu Harus berisi Text!',
            'name.max' => 'Nama Tamu Maksimal 255 karakter!',
            'greeting.required' => 'Mohon tulis ucapan Anda!',
            'greeting.string' => 'Ucapan harus berisi Text!',
            'greeting.min' => 'Ucapan minimal harus berisi 5 karakter!',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            return response()->json(['warning' => $validator->errors()->first()]);
        }

        $template_category = Template_category::where('name',$template_category_name)->firstOrFail();
        $template_user = Template_user::where('template_category_id',$template_category->id)->where('user_url',$user_url)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        $guest = Guest::where('user_id',$template_user->user_id)->where('template_category_id',$template_category->id)->where('name',$request->name)->firstOrFail();
        $greeting = Greeting::create([
            'guest_id' => $guest->id,
            'date' => Carbon::now(),
            'greeting' => $request->greeting,
            'is_shown_on_dashboard' => $template_user->is_greeting_auto_approved == Constant::TRUE_CONDITION ? Constant::FALSE_CONDITION : Constant::TRUE_CONDITION,
            'status' => $template_user->is_greeting_auto_approved == Constant::TRUE_CONDITION ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION
        ]);

        if ($greeting) {
            return response()->json([
                'success' => $template_user->is_greeting_auto_approved == Constant::TRUE_CONDITION ?
                'Ucapan berhasil dikirim.' :
                'Ucapan berhasil dikirim. Ucapan Anda perlu dikonfirmasi oleh Kedua Mempelai agar dapat tampil di sini.'
            ]);
        } else {
            return response()->json(['error' => 'Maaf, Gagal kirim ucapan.']);
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
}
