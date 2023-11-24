<a href="" title="Click to mark as favorite question (Click again to undo)" class="favorite text-decoration-none mt-3 position-relative {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '' )}}"
   onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
>

    <i class="fas fa-star fa-2x position-relative"></i>
    <span class="favorites-count position-absolute start-50 top-50 translate-middle fw-bold text-center text-white">{{ $model->favorites_count }}</span>
</a>

<form id="favorite-question-{{ $model->id }}" action="/questions/{{ $model->id }}/favorites" method="POST" style="display: none">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
