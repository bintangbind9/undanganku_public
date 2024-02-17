<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Story;
use App\Helpers\Method;
use App\Models\Gallery;
use App\Models\Visitor;
use App\Models\Wedding;
use App\Models\Feedback;
use App\Models\Greeting;
use App\Helpers\Constant;
use App\Models\Bank_account;
use Illuminate\Http\Request;
use App\Models\Template_user;
use App\Models\Guest_presence;
use App\Models\Invoice_payment;
use App\Models\Template_category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $wedding_template_category, $wedding_greetings, $wedding_guest_plan_present, $wedding_guest_plan_not_present,
        $wedding_guest_act_present, $wedding_guest_plan_present_with_family, $wedding_visitor_datas,
        $wedding_template_user, $invoice_payments, $bank_accounts, $feedbacks, $wedding_templates;

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    function getValueGlobalVariable () {
        $this->wedding_template_category = Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail();
        $this->wedding_greetings = Greeting::with('guest')
                    ->where('is_shown_on_dashboard', Constant::TRUE_CONDITION)
                    ->where('status', Constant::FALSE_CONDITION)
                    ->whereHas('guest', function ($query) {
                        $query->where('user_id', Auth::user()->id)->where('template_category_id', $this->wedding_template_category->id);
                    })->get();
        $this->wedding_guest_plan_present = Guest::where('user_id',Auth::user()->id)
            ->where('template_category_id',$this->wedding_template_category->id)
            ->where('status',Constant::TRUE_CONDITION)
            ->get()->count();
        $this->wedding_guest_plan_not_present = Guest::where('user_id',Auth::user()->id)
            ->where('template_category_id',$this->wedding_template_category->id)
            ->where('status',Constant::FALSE_CONDITION)
            ->get()->count();
        $this->wedding_guest_act_present = Guest_presence::with('guest')
            ->whereHas('guest', function ($query) {
                $query->where('user_id', Auth::user()->id)->where('template_category_id', $this->wedding_template_category->id);
            })
            ->sum('guest_presences.presence');
        $this->wedding_guest_plan_present_with_family = Guest::where('user_id',Auth::user()->id)
            ->where('template_category_id',$this->wedding_template_category->id)
            ->where('status',Constant::TRUE_CONDITION)
            ->sum('presence');
        if (Constant::VISITOR_GRAPH_DISTANCE_UNIT == 'D') {
            //D = Day (INTERVAL -6 DAY = 7 Hari terakhir dari hari sekarang)
            $this->wedding_visitor_datas = Visitor::selectRaw("user_id, template_category_id, DAYNAME(`date`) label, DATE_FORMAT(`date`, '%Y-%m-%d') date, COUNT(1) count")
                ->where('user_id', Auth::user()->id)
                ->where('template_category_id',$this->wedding_template_category->id)
                ->whereRaw("(`date` BETWEEN DATE_FORMAT(DATE_ADD(NOW(), INTERVAL " . (Constant::VISITOR_DATA_IN_LAST_UNIT * -1) + 1 . " DAY), '%Y-%m-%d') AND NOW())")
                ->groupByRaw("DATE_FORMAT(`date`, '%Y-%m-%d')")
                ->get();
        } else {
            //M = Month (INTERVAL -5 MONTH = 6 Bulan terakhir dari bulan sekarang)
            $this->wedding_visitor_datas = Visitor::selectRaw("user_id, template_category_id, CONCAT(MONTHNAME(`date`), ' ', YEAR(`date`)) label, DATE_FORMAT(`date`, '%Y-%m-01') date, COUNT(1) count")
                ->where('user_id', Auth::user()->id)
                ->where('template_category_id',$this->wedding_template_category->id)
                ->whereRaw("(`date` BETWEEN CONCAT(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL " . (Constant::VISITOR_DATA_IN_LAST_UNIT * -1) + 1 . " MONTH), '%Y-%m-'),'01') AND NOW())")
                ->groupByRaw("DATE_FORMAT(`date`, '%Y-%m')")
                ->get();
        }
        $this->wedding_template_user = Template_user::where('user_id', Auth::user()->id)
            ->where('template_category_id',$this->wedding_template_category->id)
            ->where('status',Constant::TRUE_CONDITION)
            ->firstOrFail();
        $this->invoice_payments = Invoice_payment::where('is_confirmed',Constant::FALSE_CONDITION)->get();
        $this->bank_accounts = Bank_account::with('bank_func_category')
            ->whereHas('bank_func_category', function($query) {
                $query->where('name',Constant::CODE_BANK_FUNC_CATEGORY_PAYMENT);
            })
            ->where('status',Constant::TRUE_CONDITION)->get();
        $this->feedbacks = Feedback::where('is_shown_on_dashboard',Constant::TRUE_CONDITION)->where('status',Constant::FALSE_CONDITION)->get();
        $this->wedding_templates = Wedding::selectRaw('weddings.template_id, COUNT(weddings.template_id) `count`')
            ->join('users','weddings.user_id','=','users.id')
            ->join('templates','weddings.template_id','=','templates.id')
            ->join('invoice_types','templates.invoice_type_id','=','invoice_types.id')
            ->where('users.status',Constant::TRUE_CONDITION)
            ->where('templates.template_category_id',$this->wedding_template_category->id)
            ->where('invoice_types.amount','>',0)
            ->groupBy('weddings.template_id')
            ->orderBy('count','desc')
            ->limit(Constant::MAX_POP_TEMPLATE_DISPLAYED_ON_DASHBOARD)
            ->get();
    }

    public function index()
    {
        $section_header = "Dashboard";
        $method = new Method();
        $this->getValueGlobalVariable();
        $active_invoice_wedding = $method->getActiveInvoiceOnHighestLevelPackage(Auth::user()->id, $this->wedding_template_category->id);
        $wedding = Wedding::where('user_id', Auth::user()->id)->firstOrFail();
        $gallery = Gallery::where('user_id', Auth::user()->id)->where('template_category_id', $this->wedding_template_category->id)->get();
        $story = Story::where('user_id', Auth::user()->id)->where('template_category_id', $this->wedding_template_category->id)->get();
        $guest = Guest::where('user_id', Auth::user()->id)->where('template_category_id', $this->wedding_template_category->id)->get();
        $greetings = $this->wedding_greetings;
        $wedding_guest_plan_present = $this->wedding_guest_plan_present;
        $wedding_guest_plan_not_present = $this->wedding_guest_plan_not_present;
        $wedding_guest_act_present = $this->wedding_guest_act_present;
        $wedding_guest_plan_present_with_family = $this->wedding_guest_plan_present_with_family;
        $wedding_visitor_datas = $this->wedding_visitor_datas;
        $wedding_template_user = $this->wedding_template_user;
        $invoice_payments = $this->invoice_payments;
        $bank_accounts = $this->bank_accounts;
        $feedbacks = $this->feedbacks;
        $wedding_templates = $this->wedding_templates;
        $sum_wedding_templates = $wedding_templates->sum('count');
        return view('dashboard', compact(
            'section_header',
            'active_invoice_wedding',
            'wedding',
            'gallery',
            'story',
            'guest',
            'greetings',
            'wedding_guest_plan_present',
            'wedding_guest_plan_not_present',
            'wedding_guest_act_present',
            'wedding_guest_plan_present_with_family',
            'wedding_visitor_datas',
            'wedding_template_user',
            'invoice_payments',
            'bank_accounts',
            'feedbacks',
            'wedding_templates',
            'sum_wedding_templates'
        ));
    }

    public function greeting() {
        $this->getValueGlobalVariable();
        $greetings = $this->wedding_greetings;
        return view('partials.dashboard.greeting', compact('greetings'));
    }

    public function feedback() {
        $this->getValueGlobalVariable();
        $feedbacks = $this->feedbacks;
        return view('partials.dashboard.feedback', compact('feedbacks'));
    }
}