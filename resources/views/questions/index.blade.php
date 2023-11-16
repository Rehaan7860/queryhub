@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="fw-bolder my-auto">All Questions</h4>
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask a Question</a>
                        </div>
                        </div>

                    <div class="card-body">
                        @include('layouts._messages')

                        @foreach($questions as $question)
                            <div class="media row">
                                <div class="col-1 counters">
                                    <div class="vote text-center mb-2">
                                       <strong class="fw-bold"> {{ $question->votes }}</strong> {{ Str::title(Str::plural('vote', $question->votes)) }}
                                    </div>

                                    <div class="status {{ $question->status }} text-center mb-2">
                                        <strong class="fw-bold">{{ $question->answers }} </strong> {{ Str::title(Str::plural('answer', $question->answers)) }}
                                    </div>
                                    <div class="view text-center">
                                        {{ $question->views }} {{ Str::title(Str::plural('view', $question->views)) }}
                                    </div>
                                </div>
                                <div class="media-body col">
                                    <h3 class="mt-0">
                                        <a href="{{$question->url}}" class="text-decoration-none">
                                        {{ $question->title }}
                                        </a>
                                    </h3>
                                    <p class="lead">
                                        Asked by
                                        <a href="{{ $question->user->url }}" class="text-decoration-none">{{ $question->user->name }}</a>
                                        <small class="text-muted ms-2">{{ $question->created_date }}</small>
                                    </p>
                                    {{ $question->body }}

                                </div>
                            </div>
                            <hr>
                        @endforeach
                    <div class="p-3 d-flex justify-content-center align-middle align-items-center h-100">
                        {{ $questions->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
