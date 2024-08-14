<?php 

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Series;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
                /**
         * Basicamente esta função abaixo ela faz um begin no banco e um commit apenas quando tudo estiver Ok para evitar erros na inserção de dados no BD, caso queira utilizar o 
         * Try catch e tratar os dados pode se utilizr o DB::beginTransaction() para iniciar a transação no Try e no final o DB::Commit e caso queria voltar no CATH utilziar o RollBack
         */


         return DB::transaction(function () use ($request, &$serie){ //TudoOuNada no banco de dados.
            
            
            $serie = Series::create([
                'nome' => $request->nome,
                'cover' => $request->coverPath,
            ]);
            $seasons = [];
            for ($i=1; $i <= $request->seasonQty; $i++) { 
                $seasons[] = [
                    'series_id' => $serie->id,
                    'numero' => $i
                ];
            }
            Season::insert($seasons);
                
            $Episodes = [];
                foreach ($serie->seasons as $season) {
                    for ($j=1; $j <= $request->espsodesPerSeason; $j++) { 
                        
                        $Episodes[] = [
                            'season_id' => $season->id,
                            'numero' => $j
                        ];
                    }
                }
            Episode::insert($Episodes);

            return $serie;
        });
    }
}