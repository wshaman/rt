<?php
/**
 * Created by PhpStorm.
 * User: wshaman
 * Date: 9/11/17
 * Time: 2:26 PM
 */

namespace app\components;


class F
{

    const AUTO      = 1;
    const RU_EN     = 2;
    const EN_RU     = 3;

    public static function simplify_string($str, $make_slug=false)
    {
        if($make_slug){
            $r = str_replace(array(' ', '(', ')','/',',', '.', '&', '+'), array('-','-','','-','-','.','_', 'plus'), $str );
            $r = preg_replace('/[-]{2,}/s', '-', $r);
        }else{
            $r = str_replace(' ', '', $str);
        }
        $code = strtolower(self::transRu2Lat($r));
        return ($make_slug) ? urlencode($code) : $code;
    }

    /**
     * gets item from array or returns $def value
     * @param array $a Array to search in
     * @param mixed $k Key to search for in array
     * @param mixed $def Value returned if $key if not present
     * @return bool
     */
    public static function array_get(&$a, $k, $def=null){
        if(!$a) return $def;
        if(is_array($k)){
            $ar = &$a;
            foreach ($k as $item) {
                try{
                    if(!isset($ar[$item])){
                        return $def;
                    } else {
                        $ar = &$ar[$item];
                    }
                } catch( \ErrorException $e){
                    var_dump($e);
                }
            }
            return $ar;
        }else{
            return (array_key_exists($k, $a)) ? $a[$k] : $def;
        }
    }

    public static function transRu2Lat($s) {
        $cyr = array(
            'ж',  'ч',  'щ',   'ш',  'ю', 'я', 'ё', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ы', 'ь', 'э',
            'Ж',  'Ч',  'Щ',   'Ш',  'Ю', 'Я', 'Ё', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ы', 'Ь', 'Э');
        $lat = array(
            'zh', 'ch', 'sht', 'sh', 'yu', 'ya', 'yo', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', '', 'y', '', 'e',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'YA', 'Yo', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', '', 'Y', '', 'E');
        return str_replace($cyr, $lat, $s);
    }

    public static function correctString ($string, $dir=NULL){
        if(!$dir) $dir = self::AUTO;
        $ru = array(
            "й","ц","у","к","е","н","г","ш","щ","з","х","ъ",
            "ф","ы","в","а","п","р","о","л","д","ж","э",
            "я","ч","с","м","и","т","ь","б","ю"
        );
        $en = array(
            "q","w","e","r","t","y","u","i","o","p","[","]",
            "a","s","d","f","g","h","j","k","l",";","'",
            "z","x","c","v","b","n","m",",","."
        );
        if(self::AUTO == $dir){
            $dir = (in_array(mb_substr($string, 0,1, 'utf-8'), $ru)) ? self::RU_EN : self::EN_RU;
        }
        return (self::RU_EN == $dir) ? str_replace($ru, $en, $string) : str_replace($en, $ru, $string);
    }

    public static function date_format($ts=null, $with_time=false){
//        $lc = locale_get_default();
//        setlocale(LC_TIME, "ru_RU.UTF-8");
        if(!$ts) $ts = time();
        $format = "%a %d %B %Y". ($with_time ? " %H:%M" : '');
        $r = strftime($format, $ts);
//        setlocale(LC_TIME, $lc);
        return $r;
        //return date(DATE_RSS, $ts);
    }

}