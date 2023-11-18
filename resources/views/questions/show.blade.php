@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="fw-bolder my-auto"> {{ $question->title }}</h4>
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $question->body }}
                        <div class="text-end mt-3">
                                    <span class="text-muted">
                                        Question asked {{ $question->created_date }}
                                    </span>
                            <div class="media d-flex justify-content-end mt-3 align-items-center">
                                <a href="{{ $question->user->url }}" class="pe-2">
                                    <img src="{{ $question->user->avatar }}" alt="">
                                </a>
                                <div class="media-body">
                                    By
                                    <a href="{{ $question->user->url }}"> {{ $question->user->name }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2> {{ $question->answers_count }} {{ Str::title(Str::plural('Answer', $question->answers_count)) }} </h2>
                    </div>
                    <hr>
                    @foreach($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">
                                {{ $answer->body }}
                                <div class="text-end mt-3">
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }}
                                    </span>
                                        <div class="media d-flex justify-content-end mt-3 align-items-center">
                                            <a href="{{ $answer->user->url }}" class="pe-2">
                                                <img src="{{ $answer->user->avatar }}" alt="">
                                            </a>
                                                <div class="media-body">
                                                    <a href="{{ $answer->user->url }}"> {{ $answer->user->name }}</a>
                                                </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
