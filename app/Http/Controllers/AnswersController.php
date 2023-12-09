<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AnswersController extends Controller
{

    public function index() {
        $answers = Answer::all();

        return response()->json($answers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $question->answers()->create(['body' => $request->body, 'user_id' => Auth::id()]);

        return back()->with('success', 'Your answer has been submitted successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question, Answer $answer)
    {
        if (Gate::denies('update-answer', $answer)) {
            abort(403, "Access denied");
        }

        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question, Answer $answer)
    {

        if (Gate::denies('update-answer', $answer)) {
            abort(403, "Access denied");
        }

        $answer->update($request->validate([
            'body' => 'required'
        ]));

       if($request->expectsJson()) {
           return response()->json([
               'message' => 'Your answer has been updated',
               'body' => $answer->body
           ]);
       };

        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        if (Gate::denies('delete-answer', $answer)) {
            abort(403, "Access denied");
        }

        $answer->delete();

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been successfully removed.'
            ]);
        }

        return back()->with('success', 'Your answer has been successfully removed.');
    }
}
