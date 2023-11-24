@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="fw-bolder my-auto">All Questions</h4>
                            @if(Auth::check())
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask a Question</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Sign in to ask a Question</a>
                            @endif
                        </div>
                        </div>

                    <div class="card-body">
                        @include('layouts._messages')

                        @forelse($questions as $question)
                            @include('questions._excerpt')
                        @empty
                            <div class="alert alert-warning">
                                <strong>Sorry</strong> There are currently no questions available!
                            </div>
                        @endforelse
                    <div class="p-3 d-flex justify-content-center align-middle align-items-center mt-4">
                        {{ $questions->links('pagination::simple-bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
