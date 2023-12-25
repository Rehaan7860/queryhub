<answer
    :answer="{{ json_encode($answer) }}"
    :auth-edit="{{ Auth::check() && Auth::user()->can('update-answer', $answer) }}"
    :auth-delete="{{ Auth::check() && Auth::user()->can('delete-answer', $answer) }}"
>

{{--        <template #vote-controls>--}}
{{--         <vote :model="{{ $answer }}" :name="'answer'"></vote>--}}
{{--        </template>--}}

{{--    <template #author>--}}
{{--                <div>--}}
{{--                    @include('shared._author', [--}}
{{--                        'model' => $answer,--}}
{{--                        'label' => 'Answered'--}}
{{--    ])--}}
{{--                </div>--}}
{{--    </template>--}}
</answer>
