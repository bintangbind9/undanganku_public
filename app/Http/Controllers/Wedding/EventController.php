<?php

namespace App\Http\Controllers\Wedding;

use App\Models\Event;
use App\Helpers\Method;
use App\Helpers\Constant;
use App\Models\Event_type;
use Illuminate\Http\Request;
use App\Models\Template_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    function createAllEvent(int $template_category_id, int $user_id)
    {
        $event_types = Event_type::where('template_category_id', $template_category_id)->get();
        foreach ($event_types as $et) {
            $event = Event::where('event_type_id',$et->id)->where('user_id', $user_id)->get();
            if (count($event) <= 0) {
                Event::create([
                    'template_category_id' => $template_category_id,
                    'event_type_id' => $et->id,
                    'user_id' => $user_id,
                    'name' => '',
                    'place' => '',
                    'address'=> '',
                ]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = new Method();
        $section_header = "Wedding Event";
        $linkHowToMap = "https://www.youtube.com/embed/4mgBLVta0jA";

        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $this->createAllEvent($template_category->id, Auth::User()->id);

        $events = Event::where('template_category_id', $template_category->id)->where('user_id',Auth::User()->id)->orderBy('event_type_id','ASC')->get();
        $result = view('wedding.event.index', compact('section_header','events','linkHowToMap'));

        $invoice = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $template_category->id);
        if (empty($invoice)) {
            // Jika tidak punya paket aktif
            $result = $result->with('warning','Kamu tidak memiliki paket yang aktif');
        } else {
            // Jika punya paket aktif
            $is_gmaps = $method->getValueOfRule($template_category->id, Constant::CODE_GMAPS, $invoice->invoice_type_id);
            if (!$is_gmaps) {
                // Jika Paket tidak include GMAPS
                $result = $result->with('warning','Fitur Google Maps tidak termasuk di dalam Paket Kamu. Kamu bisa menambahkan Google Maps di sini, tetapi tidak akan tampil di Undangan Kamu.');
            }
        }
        return $result;
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
        $my_event = Event_type::findOrFail($id);
        $event_name = empty($request->input('name'.$id)) ? $my_event->name : $request->input('name'.$id);

        $this->_validationUpdateEvent($request, $id, $event_name);

        $template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();

        $event = Event::where('user_id',Auth::User()->id)->where('event_type_id',$id)->where('template_category_id',$template_category->id)->update([
            'template_category_id' => $template_category->id,
            'event_type_id' => $id,
            'user_id' => Auth::User()->id,
            'name' => $request->input('name'.$id),
            'startdate' => $request->input('startdate'.$id),
            'enddate' => $request->input('enddate'.$id),
            'place' => $request->input('place'.$id),
            'address' => $request->input('address'.$id),
            'map' => $request->input('map'.$id),
        ]);

        if ($event > 0) {
            return redirect()->back()->with('success','Berhasil Update Acara "'.$event_name.'" Anda.');
        } else {
            return redirect()->back()->with('error','Sorry, nothing has changed. Something went wrong!!');
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

    private function _validationUpdateEvent(Request $request, $id, $event_name)
    {
        $request->validate([
            // 'required|date|after:tomorrow'
            // 'required|date|after:start_date'
            // 'before:date'
            // 'before_or_equal:date'
            // 'between:min,max'
            // 'date_equals:date'
            // 'date_format:format'
            'name'.$id => ['max:255'],
            'startdate'.$id => ['required','date','after_or_equal:today'],
            'enddate'.$id => ['required','date','after_or_equal:startdate'.$id],
            'place'.$id => ['required','string','max:255'],
            'address'.$id => ['required'],
            'map'.$id => [],
        ],
        [
            'name'.$id.'.max' => 'Nama '.$event_name.' maksimal berisi 255 karakter!',
            'startdate'.$id.'.required' => 'Atur tanggal dan waktu mulai '.$event_name.'!',
            'startdate'.$id.'.date' => 'Tanggal dan waktu mulai '.$event_name.' invalid!',
            'startdate'.$id.'.after_or_equal' => 'Tanggal dan waktu mulai '.$event_name.' harus diisi hari ini kedepan!',
            'enddate'.$id.'.required'=> 'Atur tanggal dan waktu selesai '.$event_name.'!',
            'enddate'.$id.'.date' => 'Tanggal dan waktu selesai '.$event_name.' invalid!',
            'enddate'.$id.'.after_or_equal' => 'Tanggal dan waktu selesai '.$event_name.' harus diisi setelah atau sama dengan dari tanggal dan waktu mulai '.$event_name.'!',
            'place'.$id.'.required' => 'Tempat '.$event_name.' harus diisi!',
            'place'.$id.'.string' => 'Tempat '.$event_name.' harus berisi text!',
            'place'.$id.'.max' => 'Tempat '.$event_name.' maksimal berisi 255 karakter!',
            'address'.$id.'.required' => 'Alamat '.$event_name.' harus diisi!',
        ]);
    }
}