<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Rule;
use App\Models\User;
use App\Models\Invoice;
use App\Helpers\Constant;
use App\Models\Rule_value;
use App\Models\Invoice_type;
use Spatie\Permission\Models\Role;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Method {
    // common
    function left($str, $length)
    {
        return substr($str, 0, $length);
    }

    function right($str, $length)
    {
        return substr($str, -$length);
    }

    function generateQrCode($val) {
        //Generate Qr Code with Icon, tapi belum berhasil!
        // return QrCode::style('round')
        //     ->format('png')
        //     ->size(100)
        //     ->margin(1)
        //     ->merge(asset('assets/img/favicon.png'), .3, true)
        //     ->errorCorrection('H')
        //     ->generate($val);

        // Reguler Qr Code
        return QrCode::style('round')
            // ->color(Constant::COLOR_RED, Constant::COLOR_GREEN, Constant::COLOR_BLUE)
            ->eyeColor(0, Constant::COLOR_RED, Constant::COLOR_GREEN, Constant::COLOR_BLUE, 0, 0, 0)
            ->eyeColor(1, Constant::COLOR_RED, Constant::COLOR_GREEN, Constant::COLOR_BLUE, 0, 0, 0)
            ->eyeColor(2, Constant::COLOR_RED, Constant::COLOR_GREEN, Constant::COLOR_BLUE, 0, 0, 0)
            // ->backgroundColor(Constant::COLOR_RED, Constant::COLOR_GREEN, Constant::COLOR_BLUE, 8)
            ->size(100)
            ->margin(1)
            ->generate($val);
    }

    function generatePhone($str_phone) {
        $phone = trim($str_phone);
        if (empty($phone)) { return null; }
        if (strpos(Constant::MASK_PHONE, "-") >= 0) {
            $phone = str_replace("-","",$phone); // Karena pake Jquery Mask
        }
        if ($this->left($phone, 1) == '0') {
            $phone = $this->right($phone, strlen($phone) - 1);
        }
        return $phone;
    }
    // end common

    // app
    function getRoleByRoleId($role_id) {
        return Role::find($role_id);
    }

    function getRoleByUserId($user_id) {
        return User::with('roles')->findOrFail($user_id)->roles->first();
    }

    function getActiveInvoiceOnHighestLevelPackage($user_id, $template_category_id) {
        // invoices->amount juga divalidasi tidak? untuk kondisi sekarang tidak divalidasi!
        return Invoice::where('user_id',$user_id)->where('invoices.template_category_id',$template_category_id)->where('expired', '>=', Carbon::now())->where('status',Constant::TRUE_CONDITION)->join('invoice_types', 'invoice_types.id', '=', 'invoices.invoice_type_id')->join('invoice_levels', 'invoice_levels.id', '=', 'invoice_types.invoice_level_id')->orderBy('invoice_levels.level','desc')->select('invoices.*')->first();
    }

    function getValueOfRule($template_category_id, $code_rule, $invoice_type_id) {
        $rule = Rule::where('template_category_id',$template_category_id)->where('code',$code_rule)->where('status',Constant::TRUE_CONDITION)->first();
        if ($rule != null) {
            $rule_value = Rule_value::where('template_category_id',$template_category_id)->where('rule_id',$rule->id)->where('invoice_type_id',$invoice_type_id)->first()->value;
            if ($rule_value != null) {
                if ($rule->countable == Constant::TRUE_CONDITION) {
                    return $rule_value;
                } else {
                    if ($rule_value == Constant::TRUE_CONDITION_NUMB) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    // end app
}