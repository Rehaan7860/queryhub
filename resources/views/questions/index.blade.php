@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header fw-bolder">All Questions</div>

                    <div class="card-body">
                        @foreach($questions as $question)
                            <div class="media">
                                <div class="media-body">
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
                    <div class="p-5 d-flex justify-content-center">
                        {{ $questions->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
