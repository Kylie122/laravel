<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'home'])->name('home');

Route::get('/setup', [GameController::class, 'setup'])->name('game.setup');
Route::post('/start', [GameController::class, 'start'])->name('game.start');

Route::get('/game', [GameController::class, 'dashboard'])->name('game.dashboard');

Route::get('/game/explore', [GameController::class, 'explore'])->name('game.explore');
Route::post('/game/action', [GameController::class, 'action'])->name('game.action');

Route::get('/game/event', [GameController::class, 'event'])->name('game.event');
Route::post('/game/choice', [GameController::class, 'choice'])->name('game.choice');

Route::get('/game/inventory', [GameController::class, 'inventory'])->name('game.inventory');
Route::get('/game/history', [GameController::class, 'history'])->name('game.history');

Route::get('/game/result', [GameController::class, 'result'])->name('game.result');

Route::post('/restart', [GameController::class, 'restart'])->name('game.restart');

Route::get('/best-score', [GameController::class, 'bestScore']) ->name('best-score');