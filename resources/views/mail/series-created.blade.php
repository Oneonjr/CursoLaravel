<x-mail::message>
    # {{ $nomeSerie }} Criada

    A serie {{ $nomeSerie }} com {{ $qtdTemporada }} Temporadas e {{ $episodiosPorTemporada }} espisodios foi Criada com sucesso.

    Acesse aqui:
    <x-mail::button :url="route('seasons.index', $idSerie)">
        Ver Serie
    </x-mail::button>

</x-mail::message>