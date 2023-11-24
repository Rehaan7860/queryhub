<span class="text-muted">
    {{ $label }} {{ $model->created_date }}
</span>
<div class="media d-flex justify-content-end mt-3 align-items-center">
    <a href="{{ $model->user->url }}" class="pe-2">
        <img src="{{ $model->user->avatar }}" alt="">
    </a>
    <div class="media-body">

        <a href="{{ $model->user->url }}"> {{ $model->user->name }}</a>
    </div>
</div>
