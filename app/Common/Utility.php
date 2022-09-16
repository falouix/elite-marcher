<?php
namespace App\Common;
use Request;



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


    public static function getSituationDossierLabel($situation){
          switch ($situation){
                case 1:
                    return '<label class="badge btn-primary-gradient btn-sm" style="color: white;">بصدد الإعداد</label>';
                case 2:
                    return '<label class="badge btn-success-gradient btn-sm" style="color: white;"> في انتظار العروض </label>';
                case 3:
                    return '<label class="badge btn-secondary-gradient btn-sm" style="color: white;"> في الفرز </label>';
                case 4:
                    return '<label class="badge btn-danger-gradient btn-sm" style="color: white;"> بصدد الإنجاز </label>';
                case 5:
                    return '<label class="badge btn-warning-gradient btn-sm" style="color: white;"> القبول الوقتي</label>';
                case 6:
                    return '<label class="badge badge-primary" style="color: white;">القبول النهائي</label>';
                case 7:
                    return '<label class="badge badge-secondary" style="color: white;">ملف منتهي </label>';
                case 8:
                    return '<label class="badge btn-dark-gradient btn-sm" style="color: white;">ملغى</label>';
            }
        }
}
