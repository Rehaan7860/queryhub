@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="fw-bold my-auto">Edit Question</h4>
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('questions.update', $question->id) }}" method="POST">
                            @method('PUT')
                            @include('questions._form', ['buttonText' => 'Update Question'])
                        </form>
                    </div>
                </div>
            </div>
@endsection
