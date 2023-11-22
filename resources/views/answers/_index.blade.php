<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2> {{ $answersCount }} {{ Str::title(Str::plural('Answer', $answersCount)) }} </h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                    <div class="media">
                        <div class="row w-auto">
                            <div class="col-md-auto ms-0">
                                <div class="d-flex flex-column w-auto align-items-center vote-controls">
                                    <a href="" title="This answer is useful" class="vote-up">
                                        <i class="fas fa-caret-up fa-3x text-black"></i>
                                    </a>
                                    <span class="votes-count">1230</span>
                                    <a href="" title="This answer is not useful" class="vote-down off">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    <a href="" title="Mark this answer as best answer" class="vote-accepted text-decoration-none mt-3">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="media-body col-md mt-2">
                                {{ $answer->body }}
                            </div>
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
