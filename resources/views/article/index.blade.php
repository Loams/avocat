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
                <ul class="nav navbar-right panel_toolbox">
                    <li>date signature {{ date(' d-m-Y', strtotime($article->details->signature)) }}<br>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="meta">
                    {{$article->meta->meta_id }}<br>
                    {{$article->meta->joid }}<br>
                    {{$article->meta->url }}<br>
                    {{$article->meta->origine }}<br>
                    {{$article->meta->nature }}<br>
                    {{$article->meta->type }}<br>
                    {{date(' d-m-Y', strtotime($article->meta->debut)) }}<br>
                    {{date(' d-m-Y', strtotime($article->meta->fin)) }}<br>
                </div>
                <hr></hr>
                <div class="details">
                    {{ $article->details->ministere }}<br>
                    {{ $article->details->nature }}<br>
                    {{ date(' d-m-Y', strtotime($article->details->publication)) }}<br>
                    {{ date(' d-m-Y', strtotime($article->details->signature)) }}<br>
                    {{ $article->details->titre }}<br>
                    @if($article->details->contenu != '')
                        {{ str_limit($article->details->contenu, 150 ,'...') }}<br>
                    @else
                        <p>Pas de description</p>
                    @endif
                </div>
                <hr></hr>
                <div class="versions">

                    @forelse($article->versions as $version)
                        nombre de versions : {{ $loop->count }}<br>
                        {{$version->id_version}}<br>
                        {{$version->origine}}<br>
                        {{$version->etat}}<br>
                        {{date(' d-m-Y', strtotime($version->debut)) }}<br>
                        {{date(' d-m-Y', strtotime($version->fin)) }}<br>
                        <hr></hr>
                    @empty
                        <p>aucune version</p>
                    @endforelse
                </div>
                <a class="btn btn-primary pull-right" href="{{ route('article.show', $article->id) }}">en savoir plus</a>
            </div>
        </div>
    @empty
        <p>Aucun article</p>
    @endforelse

    {{ $articles->links() }}
    </div>
@endsection