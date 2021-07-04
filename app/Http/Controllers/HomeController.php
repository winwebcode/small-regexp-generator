<?php

namespace App\Http\Controllers;

use App\Models\Regexp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var Regexp
     */
    private $regex;

    public function __construct(Regexp $regex)
    {
        $this->regex = $regex;
    }

    public function index()
    {
        return view('regexp.index');
    }
    public function storeRegex(Request $request)
    {
        $result = $this->regex->getRegexp($request);
       // return $result; //for ajax
        return view('regexp.regex', compact('result'));
    }
}
