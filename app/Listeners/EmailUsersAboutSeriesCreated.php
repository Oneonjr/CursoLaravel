<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(EventsSeriesCreated $event) //este handle é executado quando um evento acontece
    {
        $userList = User::all(); //mandando para todos os usuarios
        // dd($userList);
        foreach ($userList as $index => $user){
    
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonQty,
                $event->SeriesEspsodesPerSeason,
            );

            $when = now()->addSeconds($index * 5); //Adicionando 5 segundo a cada index de usuario.
            Mail::to($user)->later($when, $email);
            // sleep(2);
        }
    }
}
