<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Music;
use App\Models\Invoice;
use App\Models\Wedding;
use App\Models\Template;
use App\Helpers\Constant;
use App\Models\Bank_account;
use App\Models\Invoice_type;
use Illuminate\Http\Request;
use App\Models\Invoice_level;
use App\Models\Template_user;
use App\Models\Template_category;
use App\Models\Bank_func_category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Wedding\InvoiceController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $user_url = $request->user_url;
        $templateCategory = Template_category::all();
        return view('otentikasi.register', compact('templateCategory','user_url'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'user_url' => ['required', 'string', 'max:255', 'unique:template_users', 'alpha_dash'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'template_category_id' => ['required', 'numeric'],
        ],[
            'name.required' => 'Nama diperlukan!',
            'name.string' => 'Nama harus text!',
            'name.max' => 'Maksimal nama harus 255 karakter!',
            'user_url.required' => 'User URL diperlukan!',
            'user_url.string' => 'User URL harus text!',
            'user_url.max' => 'Maksimal User URL harus 255 karakter!',
            'user_url.unique' => 'User URL sudah ada!',
            'user_url.alpha_dash' => 'User URL harus berupa karakter alfabet, numerik, karakter "-" atau "_"',
            'email.required' => 'Email diperlukan!',
            'email.string' => 'Email harus text!',
            'email.email' => 'Email tidak valid!',
            'email.max' => 'Maksimal email harus 255 karakter!',
            'email.unique' => 'Email sudah ada!',
            'password.required' => 'Password diperlukan!',
            'password.min' => 'Minimal password adalah 8 karakter!',
            'password.confirmed' => 'Konfirmasi password salah!',
            'template_category_id.required' => 'Category diperlukan!',
            'template_category_id.numeric' => 'ID Category harus angka!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $inv_ctrl = new InvoiceController();
        $templateCategory = Template_category::findOrFail($data['template_category_id']);
        $music = Music::where('template_category_id', '=', $templateCategory->id)->firstOrFail();

        // $current = date('Y-m-d H:i:s');
        // return $current;
        $min_level = Invoice_level::orderBy('level')->firstOrFail()->level;
        $invoice_type = Invoice_type::where('template_category_id', $templateCategory->id)->whereRaw('(amount = 0 OR invoice_levels.level = ' . $min_level . ')')->join('invoice_levels', 'invoice_types.invoice_level_id', '=', 'invoice_levels.id')->select('invoice_types.*')->firstOrFail();
        $template = Template::where('template_category_id', '=', $templateCategory->id)->where('invoice_type_id',$invoice_type->id)->firstOrFail();
        $bank_func_category = Bank_func_category::where('name',Constant::CODE_BANK_FUNC_CATEGORY_PAYMENT)->firstOrFail();
        $bank_account = Bank_account::where('bank_func_category_id',$bank_func_category->id)->where('status',Constant::TRUE_CONDITION)->firstOrFail();
        $expired = $inv_ctrl->getExpiredDatetimeByDay($invoice_type->expired_day);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status'=> Constant::TRUE_CONDITION,
        ]);

        $user->assignRole(Constant::ROLE_USER);

        Template_user::create([
            'user_id' => $user->id,
            'template_category_id' => $templateCategory->id,
            'user_url' => $data['user_url'],
            'status' => Constant::TRUE_CONDITION,
        ]);

        Wedding::create([
            'user_id' => $user->id,
            'template_id' => $template->id,
            'music_id' => $music->id,
        ]);

        Invoice::create([
            'user_id' => $user->id,
            'template_category_id' => $templateCategory->id,
            'invoice_type_id' => $invoice_type->id,
            'bank_account_id' => $bank_account->id,
            'code' => $inv_ctrl->genCode(),
            'expired' => $expired,
            'amount'=> 0,
            'status'=> $inv_ctrl->isFree($invoice_type->id) ? Constant::TRUE_CONDITION : Constant::FALSE_CONDITION,
        ]);

        return $user;
    }
}
