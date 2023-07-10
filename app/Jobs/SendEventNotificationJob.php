<?php

use App\Models\Eleve;
use App\Models\Events;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEventNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content;
    protected $events;
    protected $user;
    protected $eleves;

    /**
     * Crée une nouvelle instance du travail.
     *
     * @param  string  $content
     * @param  Events  $events
     * @param  User $user
     * @param  Eleve  $eleves
     * @return void
     */
    public function __construct($content,Events $events,User $user,Eleve $eleves)
    {
        $this->content = $content;
        $this->events = $events;
        $this->user = $user;
        $this->eleves = $eleves;
    }

    /**
     * Exécute le travail.
     *
     * @return void
     */
    public function handle()
    {
        // foreach ($this->eleves as $eleve) {
        //     $eleve->notify(new EmailNotification($this->content, $this->events, $this->user));
        // }
    }
}
