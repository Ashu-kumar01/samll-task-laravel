<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AgeCalculaterController extends Controller
{
    public function index()
    {
        return view('ageCalculater');
    }

    public function store(Request $req)
    {
        $dob = Carbon::parse($req->dob)->age;
        // dd($dob);
        return redirect()->route('ageCalculater')
            ->with([
                'age' => $dob,
                'dob' => $req->age
            ]);
    }
}
