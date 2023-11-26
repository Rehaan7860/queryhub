<div class="media post">
    <div class="row w-auto">
        <div class="col-md-auto ms-0">
            @include('shared._vote', [
             'model' => $answer
         ])

        </div>
        <div class="media-body col-md mt-2">
            {{ $answer->body }}
        </div>


        <div class="d-flex justify-content-between align-items-center gap-2">

            <div class="d-flex align-items-center gap-2 mt-5">
                @can('update', $answer)
                    <a href="{{ route('answers.edit', [$question->id, $answer->id]) }}" class="border-0 bg-transparent">
                        <i class="fas fa-pencil-alt fa-lg text-primary"></i>
                    </a>
                @endcan

                @can('delete', $answer)
                    <form action="{{ route('answers.destroy', [$question->id, $answer->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="border-0 bg-transparent" onclick="return confirm('Are you sure you want to delete this answer?')">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>

                    </form>
                @endcan
            </div>

            <div class="mt-3">
                <div class="d-none">
                @include('shared._author', [
                    'model' => $answer,
                    'label' => 'Answered'
])
                </div>
                <user-info :model="{{ $answer }}" label="Answered"></user-info>
            </div>
        </div>
    </div>
</div>
