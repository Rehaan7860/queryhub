<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


      $questions = Question::with('user')->latest()->paginate(5);

     return view('questions/index', compact('questions'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', "Your question has been submitted successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $question->increment('views');

        $question = $question->load('user');

        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }

        $question->update($request->only('title', 'body'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your question has been successfully updated.',
                'body' => $question->body,
            ]);
        }

        return redirect('/questions')->with('success', 'Your question has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        if (Gate::denies('delete-question', $question)) {
            abort(403, "Access denied");
        }

        $question->delete();

        if(request()->expectsJson()) {
            return response()->json([
                'message' =>  "Your question has been deleted."
            ]);
        }

        return redirect('/questions')->with('success', "Your question has been deleted.");
    }
}
