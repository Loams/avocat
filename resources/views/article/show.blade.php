@extends('layout')

@section('content')

            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ $article->details->titre }}</h2>
                    <h2><small>{{ $article->id_article }}</small></h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9">
                            <div class="block">
                                <h3>Détails</h3>
                                <p><span class="bold">Ministère:</span> {{ $article->details->ministere }}</p>
                                <p><span class="bold">Nature:</span> {{ $article->details->nature }}</p>
                                <p><span class="bold">Date de Publication:</span> {{ date(' d-m-Y', strtotime($article->details->publication)) }}</p>
                                <p><span class="bold">Date de signature:</span> {{ date(' d-m-Y', strtotime($article->details->signature)) }}</p>
                                <p><span class="bold">Contenu:</span> {{ $article->details->contenu }}</p>
                            </div>
                            <hr></hr>
                            <h3>Méta</h3>
                            <div class="block">
                                <p><span class="bold">Id:</span> {{$article->meta->meta_id }}</p>
                                <p><span class="bold">Joid:</span> {{$article->meta->joid }}</p>
                                <p><span class="bold">Url:</span> {{$article->meta->url }}</p>
                                <p><span class="bold">Origine:</span> {{$article->meta->origine }}</p>
                                <p><span class="bold">Nature:</span> {{$article->meta->nature }}</p>
                                <p><span class="bold">Type:</span> {{$article->meta->type }}</p>
                                <p><span class="bold">Début:</span> {{date(' d-m-Y', strtotime($article->meta->debut)) }}</p>
                                <p><span class="bold">Fin:</span> {{date(' d-m-Y', strtotime($article->meta->fin)) }}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 bg-ligthgrey">
                            <div class="block">
                            <h3>Versions <span class="badge">{{ $article->versions->count() }}</span></h3>

                            </div>
                            <hr>
                                @forelse($article->versions as $version)
                                <div class="block">
                                    <p><span class="bold">id:</span> {{$version->id_version}}</p>
                                    <p><span class="bold">Origine:</span> {{$version->origine}}</p>
                                    <p><span class="bold">Etat:</span> {{$version->etat}}</p>
                                    <p><span class="bold">Début:</span> {{date(' d-m-Y', strtotime($version->debut)) }}</p>
                                    <p><span class="bold">Fin:</span> {{date(' d-m-Y', strtotime($version->fin)) }}</p>
                                </div>
                                @if(!$loop->last)
                                    <hr></hr>
                                @endif
                                @empty
                                    <p>aucune version</p>
                                @endforelse


                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection