<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Add an answer to this question</h3>
                </div>
                <hr>
                <form action="{{ route('answers.store', $question->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="" cols="30" rows="7"></textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback small">
                                <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group mt-3 text-end">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Submit Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
