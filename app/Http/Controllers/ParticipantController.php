<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Exception;


class ParticipantController extends Controller
{

    public function index()
    {
        //
    }

    public function showParticipants()
    {
        $participants = Participant::all();
        return view('participants.showParticipants', compact('participants'));
    }

    public function create()
    {
        $events = Event::all(); // obtiene todos los eventos
        return view('participants.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,NULL,id,event_id,' . $request->event_id,
            'phone' => 'required|string|max:20',
        ]);

        try {
            $event = Event::findOrFail($request->event_id);

            if ($event->participants()->count() >= $event->capacity) {
                return redirect()->back()->with('error', 'Este evento ha alcanzado su máxima capacidad.');
            }

            $participant = Participant::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'event_id' => $request->event_id,
            ]);
            Mail::to($participant->email)->send(new RegistrationConfirmation($participant, $event));

            return redirect()->route('participants.showParticipants', $event->id)->with('success', 'Inscripción exitosa.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar la inscripción: ' . $e->getMessage());
        }
    }

    public function edit($eventId, $participantId)
    {

        $event = Event::findOrFail($eventId);

        $participant = Participant::where('event_id', $eventId)->findOrFail($participantId);

        // obtiene la lista de todos los eventos para poder seleccionar otro
        $events = Event::all();


        return view('participants.edit', compact('event', 'participant', 'events'));
    }



    public function update(Request $request, $eventId, $participantId)
    {
        // valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);

        try {

            $newEvent = Event::findOrFail($request->event_id);

            // verifica si el nuevo evento tiene capacidad disponible
            if ($newEvent->participants()->count() >= $newEvent->capacity) {
                return redirect()->back()->with('error', 'El nuevo evento ha alcanzado su máxima capacidad.');
            }

            $participant = Participant::where('event_id', $eventId)->findOrFail($participantId);

            $participant->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'event_id' => $request->event_id,
            ]);

            return redirect()->route('participants.showParticipants', ['event' => $request->event_id])
                ->with('success', 'Participante actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('participants.edit', ['event' => $eventId, 'participant' => $participantId])
                ->with('error', 'Error al actualizar los datos del participante: ' . $e->getMessage());
        }
    }

    public function destroy($eventId, $participantId)
    {
        try {
            $participant = Participant::where('event_id', $eventId)->findOrFail($participantId);
            $participant->delete();
            return redirect()->route('participants.showParticipants')->with('success', 'La inscripción se eliminó correctamente.');
        } catch (Exception $e) {
            return redirect()->route('participants.showParticipants')->with('error', 'Error al eliminar la inscripción: ' . $e->getMessage());
        }
    }
}
