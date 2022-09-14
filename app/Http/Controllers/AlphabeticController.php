<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function App\Helpers\alphabetic;

class AlphabeticController extends Controller
{
    public function index(Request $request)
    {
        return $this->encode($request->input_string);
    }

    public static function encode($string)
    {
        $alphabet = alphabetic();;

        if (strlen($string) == 1) {
            return $alphabet[$string];
        }
        return  26 * self::encode(substr($string,0,strlen($string)-1))  + $alphabet[substr($string,strlen($string)-1)];

    }

    public function zero()
    {
        $array = [1,2,3,4,5,6,7,8,9,10];
        $output = array();
        foreach ($array as $key => $value) {
            $steps = 0;
            while ($value > 0)
            {
                $steps++;
                if ($value % 2 == 0) {
                    $value = $value / 2;
                } else {
                    $value = $value - 1;
                }
            }
            array_push($output, $steps);
        }
        return $output;
    }
}
