@extends('layouts.app')

@section('content')
    <div class="container">

<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="d-block">Edit your answer to: <span class="fw-bold">{{ $question->title }}</span></h3>
                </div>
                <hr>
                <form action="{{ route('answers.update', [$question->id, $answer->id]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="" cols="30" rows="7">
                            {{old('body', $answer->body)}}
                        </textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback small">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group mt-3 text-end">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Update Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
