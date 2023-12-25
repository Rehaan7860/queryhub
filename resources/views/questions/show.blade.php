@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                   <div class="card-body">
                       <div class="card-title">
                           <div class="d-flex align-items-center justify-content-between">
                               <h2 class="fw-bolder my-auto"> {{ $question->title }}</h2>
                               <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to all questions</a>
                           </div>
                       </div>

                       <hr>

                       <div class="media">
                           <div class="row w-auto">
                           <div class="col-md-auto ms-0">
                              <vote :model="{{ $question }}" :name="'question'"></vote>
                           </div>

                           <div class="media-body text-wrap col-md mt-2">
                               {{ $question->body }}
                           </div>
                               <div class="text-end">
                                   <div class="d-none">
                                   @include('shared._author', [
                                        'model' => $question,
                                        'label' => 'Asked'
                                ])
                                   </div>
                                   <user-info :model="{{ $question }}" label="Asked"></user-info>
                               </div>
                           </div>

                       </div>
                   </div>
                </div>
            </div>
        </div>
            <answers :question="{{ $question }}"></answers>
        </div>
@endsection
