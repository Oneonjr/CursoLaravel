<x-layout title="Temporadas de {!! $series->nome !!}">
    <div class="d-flex justify-center">
        <img src="{{ asset('storage/' . $serie->cover) }}" 
        style="height: 200px;"
        alt="Capa da serie"
        class="img-fluid">
    </div>
    <ul class="list-group">
        @csrf
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center"> 
            <a href="{{ route('episodes.index', $season->id) }}">
                Temporada {{ $season->numero }}
            </a>
            
            <span class="badge bg-secondary">
            {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>

</x-layout>
