<?php
namespace App\Helpers;
use App\Models\CommonParameter;
class Aihut

{
    public static function get(string | array $value)
    {
        return is_array($value) ? CommonParameter::select('value')->whereIn('key', $value)->get() : CommonParameter::select('value')->where('key', $value)->first()->value;
    }

    public static function getLabel(string | array $value)
    {
        return is_array($value) ? CommonParameter::select('label')->whereIn('key', $value)->get() : CommonParameter::select('label')->whereKey($value)->first()->label;
    }
}

