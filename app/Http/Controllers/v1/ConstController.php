<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConstController extends Controller
{

    public function index($min, $max, $level, $x)
    {
    	$nilaiTengah = (($max - $min) / 2) + $min;
        if ($level == 'first') {
            if($x <= $min){
                return 1;
            }else if ($min <= $x && $x <= $max) {
                return (($max - $x) / ($max - $min));
            }else if ($x >= $max) {
                return 0;
            }
        }else if ($level == 'mid') {
            if ($x <= $min || $x >= $max) {
                return 0;
            }else if ($min < $x && $x <= $nilaiTengah) {
                return (($x - $min) / ($nilaiTengah - $min));
            }else if ($nilaiTengah <= $x  && $x <= $max) {
                return (($max - $x) / ($max - $nilaiTengah));
            }
        }else if ($level == 'last') {
            if ($x <= $min) {
                return 0;
            }else if ($min <= $x && $x <= $max ) {
                return (($x - $min) / ($max - $min));
            }else if ($x > $max) {
                return 1;
            }
        }
    }
    
}
