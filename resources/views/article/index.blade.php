@extends('layout')

@section('content')
    <div class="container">
        <div id="app">
            <div class="row text-center">
                <search-component></search-component>
            </div>
        </div>

    @forelse($articles as $article)
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ $article->details->titre }}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10">
                        <p>Ministère: {{ $article->details->ministere }}</p>
                        <p>Type:{{$article->meta->type }}</p>
                        <p>Date de publication: {{ date(' d-m-Y', strtotime($article->details->publication)) }}</p>
                        <p>Date de signature: {{ date(' d-m-Y', strtotime($article->details->signature)) }}</p>
                    </div>
                    <div class="col-xs-12 col-sm-2 bg-ligthgrey">
                        <p class="text-center">Versions <span class="badge">{{ $article->versions->count() }}</span></p>
                    </div>
                </div>
                <a class="btn btn-primary pull-right" href="{{ route('article.show', $article->id) }}">en savoir plus</a>
            </div>
        </div>
    @empty
        <p>Aucun article</p>
    @endforelse

   <div class="text-center">{{ $articles->links() }}</div>

@endsection