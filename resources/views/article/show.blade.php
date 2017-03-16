@extends('layout')

@section('content')
    <div class="container">

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $article->details->titre }}</h2>
                    <h2><small>{{ $article->id_article }}</small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="details">
                        {{ $article->details->ministere }}<br>
                        {{ $article->details->nature }}<br>
                        {{ date(' d-m-Y', strtotime($article->details->publication)) }}<br>
                        {{ date(' d-m-Y', strtotime($article->details->signature)) }}<br>
                        {{ $article->details->titre }}<br>
                        {{ $article->details->contenu }}<br>
                    </div>
                    <hr></hr>
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





                </div>
            </div>
    </div>
@endsection