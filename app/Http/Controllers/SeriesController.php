<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //return $request->url();//RequestEX

        //$series = DB::select('SELECT nome FROM series;');// DB facede
        //dd($series);//dá um var_dump e die ao mesmo tempo.

        // $series = series::query()->orderBy('nome')->get(); //Eloquent

        // return view('series.index',compact('series')); //PrimeiraView 
        $series = Series::all();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso'); //enviando a mensagem para view
        $request->session()->forget('mensagem.sucesso'); // esquecendo a mensagem da view

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso); // Mandando pra view.
    }

    public function create( )
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {


        // $request->validate([
        //     'nome' => ['required','min:3']
        // ]); //Substituido pela SerieFormRequest

        // dd($request->all());
        // $nomeSerie = $request->input('nome');

        // //DB::insert('INSERT INTO series (nome) VALUES (?)',[$nomeSerie]); //Db Facede

        // $series = new series(); //ELOQUENT
        // $series->nome = $nomeSerie;//ELOQUENT
        // $series->save();//ELOQUENT
        $serie = DB::transaction(function () use ($request, &$serie){ //TudoOuNada no banco de dados.
            
            
            $serie = Series::create($request->all());
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
        // $request->session()->put('mensagem.sucesso', 'Série Adicionada com sucesso');

        // return redirect('/series');
        
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' Adicionada com sucesso");
    }

    public function destroy (Series $series )
    {
        // dd($request->serie);

       $series->delete();

        // $request->session()->put('mensagem.sucesso', 'Série removida com sucesso'); // Mesma coisa que o with abaixo.

        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}'removida com sucesso");
    }

    public function edit(Series $series)
    {   
        /*
        $series->Temporadas é diferente de $series->Temporadas() Basicamente acessando o metodo você consegue alterar a query Por exemplo:
            $series->Temporadas()->get();
        */ 
        // dd($series->Temporadas); 
        return view('series.edit')->with('series',$series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        // $series->nome = $request->nome;//Igual ao de baixo
        $series->fill($request->all());

        $series->save();

        return to_route('series.index')->with('mensagem.sucesso',"Série '($series->nome)' atualizada com sucesso");
    }
}
