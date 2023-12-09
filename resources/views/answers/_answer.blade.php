<answer
    :answer="{{ json_encode($answer) }}"
    :auth-edit="{{ Auth::check() && Auth::user()->can('update-answer', $answer) }}"
    :auth-delete="{{ Auth::check() && Auth::user()->can('delete-answer', $answer) }}"
    @handle-answer-deleted="handleAnswerDeleted"
>

        <template #vote-controls>
            @include('shared._vote', [
             'model' => $answer
         ])

        </template>

    <template #author>
                <div>
                    @include('shared._author', [
                        'model' => $answer,
                        'label' => 'Answered'
    ])
                </div>
    </template>
</answer>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const answersContainer = document.getElementById('answers-container');

            answersContainer.addEventListener('answerDeleted', function (event) {
                // Handle the event here
                const deletedAnswerId = event.detail;
                // Emit a custom Vue event
                window.app.$emit('answerDeleted', deletedAnswerId);
            });
        });
    </script>
@endpush
