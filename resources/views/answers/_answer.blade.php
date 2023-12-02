<answer :answer="{{ $answer }}"
        :auth-edit="{{ Auth::check() && Auth::user()->can('update-answer', $answer) }}"
        :auth-delete="{{ Auth::check() && Auth::user()->can('delete-answer', $answer) }}">

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
