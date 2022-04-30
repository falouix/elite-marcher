<?php
namespace App\Common;
use Request;
use App\Models\Income;
use App\Models\MCase;


class Utility {
    public static function stripXSS($request)
    {
        $sanitized = static::cleanArray($request->all());
        $request->merge($sanitized);
    }
    public static function cleanArray($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $result[$key] = static::cleanArray($value);
            } else {
                $result[$key] = trim(strip_tags($value)); // Remove trim() if you want to.
            }
       }
       return $result;
    }

    //  Get record revenue_from_table in Income Table
    public static function getRecordFromTableById($income_id){
        $income = Income::select('id','revenue_from_table','incomes_from_id')->where('id', $income_id)->first();
        if($income){
            switch ($income->revenue_from_table){
                case 'cases':
                    return Mcase::select('id','case_date', 'case_code', 'description','user_id')->with('user')->where('id', $income->incomes_from_id)->first();
                    break;

                default:
                    # code...
                    break;
            }
        }

    }
}
