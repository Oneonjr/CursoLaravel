<x-layout title="Temporadas de {!! $series->nome !!}">
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
