@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">

            <h1 class="display-4">{{ $article->title ?? '-' }}</h1>

            <article>
                {!! $article->body !!}
            </article>

        </div>
    </div>
</div>
@endsection
