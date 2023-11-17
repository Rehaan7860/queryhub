<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Question $question)
    {


        $questions = Question::with('user')->latest()->paginate(10);

        return view('questions/index', compact('questions'));


    }
}
