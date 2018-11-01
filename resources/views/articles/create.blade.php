@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ action('ArticleController@store') }}" method="post">
                @csrf

                <div class="form-group">
                    <input class="form-control form-control-lg {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" value="{{ old('title') }}" placeholder="Title" autofocus>
                    @if ($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <textarea id="body" name="body">{{ old('body') }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Publish</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>
<script>
    $(function () {
        $('#body').summernote({
            airMode: false,
            height: 400
        });
    });
</script>
@endsection
