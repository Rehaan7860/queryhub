<div class="media row post">
    <div class="col-1 counters">
        <div class="vote text-center mb-2">
            <strong class="fw-bold"> {{ $question->votes_count }}</strong> {{ Str::title(Str::plural('vote', $question->votes_count)) }}
        </div>

        <div class="status {{ $question->status }} text-center mb-2">
            <strong class="fw-bold">{{ $question->answers_count }} </strong> {{ Str::title(Str::plural('answer', $question->answers_count)) }}
        </div>
        <div class="view text-center">
            {{ $question->views }} {{ Str::title(Str::plural('view', $question->views)) }}
        </div>
    </div>
    <div class="media-body col">
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="mt-0">
                <a href="{{ $question->url }}" class="text-decoration-none">
                    {{ $question->title }}
                </a>
            </h3>
            <div class="ml-auto d-flex align-items-center gap-2">

                @if( Auth::check() && Auth::user()->can('update-question', $question))
                    <a href="{{ route('questions.edit', $question->id) }}" class="border-0 bg-transparent">
                        <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                    </a>
                @endif

                @if( Auth::check() && Auth::user()->can('delete-question', $question))
                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="border-0 bg-transparent" onclick="return confirm('Are you sure you want to delete this question?')">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>

                    </form>
                @endif
            </div>
        </div>

        <p class="lead">
            Asked by
            <a href="{{ $question->user->url }}" class="text-decoration-none">{{ $question->user->name }}</a>
            <small class="text-muted ms-2">{{ $question->created_date }}</small>
        </p>
        {{ $question->body }}

    </div>
</div>
