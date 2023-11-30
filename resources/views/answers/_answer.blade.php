<answer :answer="{{ $answer }}">
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
