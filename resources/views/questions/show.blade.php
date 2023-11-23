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
                               <div class="d-flex flex-column w-auto align-items-center vote-controls">
                               <a href="" title="This question is useful" class="vote-up">
                                   <i class="fas fa-caret-up fa-3x text-black"></i>
                               </a>
                               <span class="votes-count">1230</span>
                               <a href="" title="This question is not useful" class="vote-down off">
                                   <i class="fas fa-caret-down fa-3x"></i>
                               </a>
                               <a href="" title="Click to mark as favorite question (Click again to undo)" class="favorite text-decoration-none mt-3 position-relative {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '' )}}"
                                  onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                               >

                                   <i class="fas fa-star fa-2x position-relative"></i>
                                   <span class="favorites-count position-absolute start-50 top-50 translate-middle fw-bold text-center text-white">{{ $question->favorites_count }}</span>
                               </a>

                                   <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display: none">
                                       @csrf
                                       @if($question->is_favorited)
                                           @method('DELETE')
                                       @endif
                                   </form>

                               </div>
                           </div>

                           <div class="media-body text-wrap col-md mt-2">
                               {{ $question->body }}
                           </div>
                               <div class="text-end">
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
                </div>
            </div>
        </div>

        @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
])
            @include('answers._create')
        </div>
@endsection
