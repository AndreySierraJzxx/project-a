<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index'])->name('home');

Route::get('/events/showEvents', [EventController::class, 'showEvents'])->name('events.showEvents');
Route::get('/participants/showParticipants', [ParticipantController::class, 'showParticipants'])->name('participants.showParticipants');

Route::resource("events", EventController::class);
Route::get('events/create', [EventController::class, 'create'])->name('events.create');

Route::get('participants/create', [ParticipantController::class, 'create'])->name('participants.create');
Route::get('events/{event}/participants/{participant}/edit', [ParticipantController::class, 'edit'])->name('participants.edit');
Route::put('events/{event}/participants/{participant}', [ParticipantController::class, 'update'])->name('participants.update');
Route::delete('events/{event}/participants/{participant}', [ParticipantController::class, 'destroy'])->name('participants.destroy');
Route::post('participants', [ParticipantController::class, 'store'])->name('participants.store');
