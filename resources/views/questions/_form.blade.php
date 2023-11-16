@csrf
<div class="form-group">
    <label for="question-title" class="form-label">Question Title</label>
    <input type="text" name="title" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{old('title', $question->title)}}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong class="small">{{ $errors->first('title') }}</strong>
        </div>
    @endif

</div>

<div class="form-group mt-3">
    <label for="question-body" class="form-label">Your Question</label>
    <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">
                                    {{ old('body', $question->body) }}
                                </textarea>

    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong class="small">{{ $errors->first('body') }}</strong>
        </div>
    @endif

</div>

<div class="form-group mt-4 text-end">
    <button type="submit" class="btn btn-outline-primary btn-lg">
       {{ $buttonText }}
    </button>
</div>
