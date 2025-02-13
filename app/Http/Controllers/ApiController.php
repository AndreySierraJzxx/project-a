<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function participantsCount()
    {
        // Obtiene todos los eventos con el conteo de participantes
        $events = Event::withCount('participants')->get();

        $data = $events->map(function ($event) {
            return [
                'event_id'          => $event->id,
                'event_name'        => $event->name,
                'participant_count' => $event->participants_count,
            ];
        });
        return response()->json($data);
    }
}
