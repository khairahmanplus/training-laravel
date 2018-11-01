@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            @forelse ($articles as $article)
                <a href="#"><h1 class="display-4">{{ $article->title }}</h1></a>
                <article>
                    {!! str_limit($article->body, 400, '...') !!}
                </article>
            @empty
                There is no articles.
            @endforelse
        </div>
    </div>
</div>
@endsection
