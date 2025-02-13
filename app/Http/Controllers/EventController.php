<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Exception;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view('index', compact('events'));
    }


    public function showEvents()

    {
        $events = Event::all();
        return view('events.showEvents', compact('events'));
    }


    public function create()
    {
        return view('events.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        try {
            Event::create($request->all());
            return redirect()->route('events.showEvents')->with('success', 'Evento creado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('events.create')->with('error', 'Error al crear el evento:' . $e->getMessage());
        }
    }


    public function show(string $id)
    {
        $events = Event::all();
        return view('events.show', compact('events'));
    }


    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'capacity' => 'required|integer|min:1',
        ]);

        try {
            $event = Event::findOrFail($id);
            $event->update($request->all());
            return redirect()->route('events.showEvents')->with('success', 'Evento actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('events.edit')->with('error', 'Error al actualizar el evento:' . $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->route('events.showEvents')->with('success', 'Evento eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('events.showEvents')->with('error', 'Error al elminar el evento:' . $e->getMessage());
        }
    }
}
