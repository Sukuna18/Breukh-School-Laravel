@component('mail::message')
# Notification d'événement

Bonjour {{ $notifiable->name }},

{!! $content !!}

Détails de l'événement :
@foreach($events as $event)
    - Libellé : {{ $event->libelle }}
    - Date de début : {{ $event->date_debut }}
    - Date de fin : {{ $event->date_fin }}
    - Organisateur : {{ $user->where('id', $event->user_id)->first()->name }}
    - [Voir l'événement]({{ url('http://127.0.0.1:8000/breukh-api/evenements/'.$event->id.'/participations') }})
@endforeach

Merci de votre participation.

Cordialement,
Breukh'School'
@endcomponent
