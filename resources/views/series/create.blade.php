<x-layout title="Nova Serie">
    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input  type="text"
                        autofocus 
                        id="nome" 
                        name="nome" 
                        class="form-control" 
                        value="{{ old('nome') }}">
            </div>

            <div class="col-2">
                <label for="seasonQty" class="form-label">N� Temporadas:</label>
                <input  type="text" 
                id="seasonQty" 
                name="seasonQty" 
                class="form-control" 
                value="{{ old('seasonQty') }}">
            </div>

            <div class="col-2">
                <label for="espsodesPerSeason" class="form-label">Eps / Temporadas:</label>
                <input  type="text" 
                id="espsodesPerSeason" 
                name="espsodesPerSeason" 
                class="form-control" 
                value="{{ old('espsodesPerSeason') }}">
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>