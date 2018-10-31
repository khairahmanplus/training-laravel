@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ action('ArticleController@create') }}" class="btn btn-primary">New Article</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>{{ str_limit($article->title, 60) ?? '-' }}</td>
                            <td>{{ $article->status ?? '-' }}</td>
                            <td>{{ $article->created_at ?? '-' }}</td>
                            <td>{{ $article->updated_at ?? '-' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ action('ArticleController@show', $article->id) }}">Details</a>
                                        <a class="dropdown-item" href="{{ action('ArticleController@edit', $article->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ action('ArticleController@destroy', $article->id) }}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">There is no data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
