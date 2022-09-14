<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CountController extends Controller
{
    public function count(Request $request)
    {
        //valid
        $validator = Validator::make($request->all(), [
            'start_number'  => 'required|lt:end_number',
            'end_number'    => 'required|gt:start_number',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $range = range($request->start_number, $request->end_number);

        $data = array_filter($range, function ($item) {
            return !preg_match('/5/', $item);
        });

        return Response::json($data, \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }
}
