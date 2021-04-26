<?php

namespace App\Http\Controllers;

use App\Models\Regexp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('regexp.index');
    }
    public function storeRegex(Request $request)
    {
        $regex = new Regexp();
        $result = $regex->getRegexp($request);

        return view('regexp.regex', compact('result'));
    }
}
