<?php
$number = 101010010200;
$dic = [
    0 => "không",
    1 => "một",
    2 => "hai",
    3 => "ba",
    4 => "bốn",
    5 => "năm",
    6 => "sáu",
    7 => "bảy",
    8 => "tám",
    9 => "chín"
];
function cutLast($num) {
    $array = array_map('intval', str_split($num)); //Chuyển number thành array
    $newNum = null;
    for($i = 0; $i < 3; $i++){
        $newNum .= array_pop($array);
    }
    return strrev($newNum);
}
function read3($num, $dic) {
    global $number;
    $num = strval($num);
    $num = str_pad($num, 3, 0, STR_PAD_LEFT);

    $digit_0    = substr($num, 2, 1);
    $digit_00   = substr($num, 1, 1);
    $digit_000  = substr($num, 0 ,1);

    $str_000 = $dic[$digit_000] . " trăm ";

    //0: linh; 1: mười; 2-9: 2-9 + mươi;
    $str_00 = $dic[$digit_00] . " mươi ";
    if ($digit_00 == 0) $str_00 = " linh ";
    if ($digit_00 == 1) $str_00 = " mười ";

    //1: mốt ? $digit_00 > 1; 5: lăm ? $digit_00 > 0
    $str_0 = $dic[$digit_0];
    if ($digit_00 > 1 && $digit_0 == 1) $str_0 = " mốt";
    if ($digit_00 > 0 && $digit_0 == 5) $str_0 = " lăm";

    if ($digit_00 == 0 && $digit_0 == 0 && $digit_000 == 0) {
        $str_0 = "";
        $str_00 = "";
        $str_000 = "";
    }
    if ($digit_00 == 0 && $digit_0 == 0) {
        $str_0 = "";
        $str_00 = "";
    }
    if ($digit_0 == 0){
        $str_0 = "";
    }
    if( $number >= 100){
        return $str_000 . $str_00 . $str_0;
    } elseif ($number >= 10 && $number<= 99){
        return $str_00 . $str_0;
    } elseif ($number <= 9) {
        return $str_0;
    }
}
function read3f($num, $dic) {
    $num = strval($num);
    $num = str_pad($num, 3, 0, STR_PAD_LEFT);

    $digit_0    = substr($num, 2, 1);    //(int)($number % 100);
    $digit_00   = substr($num, 1, 1);   // (int)($number % 100 / 10);
    $digit_000  = substr($num, 0 ,1);  // (int)($number / 100);

    $str_000 = $dic[$digit_000] . " trăm ";
    //0: linh; 1: mười; 2-9: 2-9 + mươi;
    $str_00 = $dic[$digit_00] . " mươi ";
    if ($digit_00 == 0) $str_00 = " linh ";
    if ($digit_00 == 1) $str_00 = " mười ";

    //1: mốt ? $digit_00 > 1; 5: lăm ? $digit_00 > 0
    $str_0 = $dic[$digit_0];
    if ($digit_00 > 1 && $digit_0 == 1) $str_0 = " mốt";
    if ($digit_00 > 0 && $digit_0 == 5) $str_0 = " lăm";

    if ($digit_00 == 0 && $digit_0 == 0) {
        $str_0 = "";
        $str_00 = "";
    }
    if ($digit_0 == 0){
        $str_0 = "";
    }
    if($num >= 100 && $num<= 999) {
        return $str_000 . $str_00 . $str_0;
    } elseif ($num >= 10 && $num<= 99){
        return $str_00 . $str_0;
    } else {
        return $str_0;
    }
}
function read6($num, $dic){
    global $number;
    $num = strval($num);
    $num = str_pad($num, 6, 0, STR_PAD_LEFT);
    if( $number >= 1000 && $number <= 999999) {
        return read3f(substr($num, 0, 3), $dic) . " nghìn " . read3(substr($num, 3, strlen($num) - 3), $dic);
    } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0){
        return read3(substr($num, 0, 3), $dic) . read3(substr($num, 3, strlen($num) - 3), $dic);
    } else {
        return read3(substr($num, 0, 3), $dic). " nghìn " . read3(substr($num, 3, strlen($num) - 3), $dic);
    }
}
function read9($num, $dic){
    global $number;
    $num = strval($num);
    $num = str_pad($num, 9, 0, STR_PAD_LEFT);
    if ($number >= 1000000 && $number <= 999999999) {
        return read3f(substr($num, 0, 3), $dic) . " triệu " . read6(substr($num, 3, strlen($num) - 3), $dic);
    } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0) {
        return read3(substr($num, 0, 3), $dic) . read6(substr($num, 3, strlen($num) - 3), $dic);
    }else {
        return read3(substr($num, 0, 3), $dic) . " triệu " . read6(substr($num, 3, strlen($num) - 3), $dic);
    }
}
function read12($num, $dic){
    global $number;
    $num = strval($num);
    $num = str_pad($num, 12, 0, STR_PAD_LEFT);
    if ($number >= 1000000000 && $number <= 999999999999) {
        return read3f(substr($num, 0, 3), $dic) . " tỷ " . read9(substr($num, 3, strlen($num) - 3), $dic);
    } elseif(substr($num, 0 , 1) == 0 && substr($num, 1 , 1) == 0 && substr($num, 2 , 1) == 0) {
        return read3(substr($num, 0, 3), $dic) . read9(substr($num, 3, strlen($num) - 3), $dic);
    }else {
        return read3(substr($num, 0, 3), $dic) . " tỷ " . read9(substr($num, 3, strlen($num) - 3), $dic);
    }
}
function readNumber($num, $dic) {
    if ($num >= 1000000000 && $num <= 999999999999){
        return read12($num, $dic);
    }
    if ($num >= 1000000 && $num <= 999999999) {
        return read9($num, $dic);
    }
    if( $num >= 1000 && $num<= 999999){
        return read6($num, $dic);
    }
    if( $num >= 0 && $num <= 999){
        return read3f($num, $dic);
    }
}
//echo readNumber($number, $dic) . "<br />";
