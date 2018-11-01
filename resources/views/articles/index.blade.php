@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <a href="{{ action('ArticleController@create') }}" class="btn btn-primary">New Article</a>

            <table class="table mt-5">
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
                            <td>{{ $article->created_at->diffForHumans() ?? '-' }}</td>
                            <td>{{ $article->updated_at->format('d/m/Y') ?? '-' }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ action('ArticleController@show', $article->id) }}">Details</a>
                                        <a class="dropdown-item" href="{{ action('ArticleController@edit', $article->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ action('ArticleController@destroy', $article->id) }}" data-toggle="modal" data-target="#delete-confirmation-modal">Delete</a>
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

@section('modals')
    @include('component.delete_confirmation')
@endsection

@section('scripts')
<script>
    $(function () {
        $('#delete-confirmation-modal').on('shown.bs.modal', function (e) {
            let buttonDOM   = $(e.relatedTarget);
            let url         = buttonDOM.attr('href');
            let modal       = $(this);
            modal.find('form').attr('action', url);
        });
    });
</script>
@endsection
