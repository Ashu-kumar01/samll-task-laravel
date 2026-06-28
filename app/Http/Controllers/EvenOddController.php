<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvenOddController extends Controller
{
    public function index()
    {
        return view('find_even_odd');
    }

    public function store(Request $req)
    {
        $number = $req->input('number');
        if ($number % 2 == 0) {
            $result = "Number will be Even";
        } else {
            $result = "Number will be Odd";
        }

        return redirect()->route('find_even_odd')->with([
            'number' => $number,
            'result' => $result
        ]);
    }
}
