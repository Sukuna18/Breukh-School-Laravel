<?php

namespace App\Console\Commands;

use App\Models\Eleve;
use App\Models\Events;
use App\Models\EventsClasse;
use App\Models\Inscriptions;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class EmailNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $content = "notification d'événements.";
        $participations = EventsClasse::all();
        $eventsIds = $participations->pluck('events_id')->toArray();
        $classesIds = $participations->pluck('classes_id')->toArray();

        $inscrit = Inscriptions::whereIn('classes_id', $classesIds)->get();
        $eleves = Eleve::whereIn('id', $inscrit->pluck('eleve_id'))->get();

        $events = Events::whereIn('id', $eventsIds)->get();
        $userIds = $events->pluck('user_id')->toArray();
        $users = User::whereIn('id', $userIds)->get();

        Notification::send($eleves, new EmailNotification($content, $events, $users));

        $this->info('Notifications envoyées avec succès !');
    }
}
