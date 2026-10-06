<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameRecord;

class GameController
{
    public function home()
    {
        return view('home');
    }

    public function setup()
    {
        return view('game.setup');
    }

    public function start(Request $request)
    {
        $request->validate([
            'player_name' => 'required|string|max:20'
        ]);

        session()->forget(['current_event', 'choice_event']);

        session([
            'game' => [
                'player_name' => $request->player_name,
                'day' => 1,
                'health' => 100,
                'food' => 20,
                'water' => 20,
                'ammo' => 10,
                'survivors' => 2,
                'score' => 0,
                'status' => 'playing',
                'inventory' => [
                    'Bandage' => 2,
                    'Water Bottle' => 4,
                    'Canned Food' => 4
                ],
                'history' => [
                    'Day 1: Your survival journey has begun.'
                ]
            ]
        ]);

        return redirect()->route('game.dashboard');
    }

    public function dashboard()
    {
        $game = session('game');

        if (!$game) {
            return redirect()->route('home');
        }

        if ($game['status'] !== 'playing') {
            return redirect()->route('game.result');
        }

        return view('game.dashboard', compact('game'));
    }

    public function explore()
    {
        $game = session('game');

        if (!$game) {
            return redirect()->route('home');
        }

        return view('game.explore', compact('game'));
    }

  public function action(Request $request)
{
    $game = session('game');

    if (!$game || $game['status'] !== 'playing') {
        return redirect()->route('home');
    }

    $action = $request->action;

    $events = [
        'food' => [
            [
                'title' => 'Small Farm',
                'message' => 'You discovered a small abandoned farm with some food left behind.',
                'food' => 10,
                'water' => 2,
                'health' => 5,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 50,
                'item' => 'Canned Food'
            ],
            [
                'title' => 'Friendly Survivor',
                'message' => 'A friendly survivor gave you some food before leaving.',
                'food' => 8,
                'water' => 2,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 40,
                'item' => null
            ],
            [
                'title' => 'Abandoned Kitchen',
                'message' => 'You found an untouched kitchen with plenty of food.',
                'food' => 12,
                'water' => 3,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 60,
                'item' => 'Canned Food'
            ],
            [
                'title' => 'Abandoned Grocery Store',
                'message' => 'You found an abandoned grocery store filled with canned food.',
                'food' => 7,
                'water' => 0,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 50,
                'item' => 'Canned Food'
            ],
            [
                'title' => 'Zombie Attack',
                'message' => 'You found food, but zombies attacked while you were searching.',
                'food' => 5,
                'water' => 0,
                'health' => -15,
                'ammo' => -1,
                'survivors' => 0,
                'score' => 40,
                'item' => 'Canned Food'
            ],
            [
                'title' => 'Bandit Ambush',
                'message' => 'A group of armed survivors ambushed you while you were collecting food.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight Back',
                        'message' => 'You fought the bandits and forced them to retreat.',
                        'food' => 2,
                        'water' => 0,
                        'health' => -20,
                        'ammo' => -3,
                        'survivors' => 0,
                        'score' => 80,
                        'item' => 'Canned Food'
                    ],
                    'run' => [
                        'text' => 'Run Away',
                        'message' => 'You escaped, but dropped some of your food while running.',
                        'food' => -3,
                        'water' => -1,
                        'health' => -5,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 30,
                        'item' => null
                    ],
                    'hide' => [
                        'text' => 'Hide',
                        'message' => 'You hid inside a nearby building until the bandits left.',
                        'food' => 0,
                        'water' => 0,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 50,
                        'item' => null
                    ]
                    
                    
                ]
            ]
        ],

        'water' => [
                [
                'title' => 'Clean Well',
                'message' => 'You discovered a clean well with plenty of fresh water.',
                'food' => 0,
                'water' => 12,
                'health' => 5,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 50,
                'item' => 'Water Bottle'
            ],
            [
                'title' => 'Water Supply',
                'message' => 'You found several bottles of clean drinking water.',
                'food' => 2,
                'water' => 10,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 45,
                'item' => 'Water Bottle'
            ],
            [
                'title' => 'Rainwater',
                'message' => 'You collected clean rainwater while traveling.',
                'food' => 0,
                'water' => 8,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 35,
                'item' => null
            ],
        [
                'title' => 'Water Station',
                'message' => 'You discovered a clean water supply.',
                'food' => 0,
                'water' => 8,
                'health' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 40,
                'item' => 'Water Bottle'
            ],
            [
                'title' => 'Broken Water Tank',
                'message' => 'Most of the water was contaminated, but you managed to collect some.',
                'food' => 0,
                'water' => 4,
                'health' => -5,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 25,
                'item' => null
            ],
            [
                'title' => 'Water Robbery',
                'message' => 'Another survivor group found you collecting water.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight',
                        'message' => 'You fought them off, but the battle cost you some health and ammunition.',
                        'food' => 0,
                        'water' => 3,
                        'health' => -20,
                        'ammo' => -3,
                        'survivors' => 0,
                        'score' => 70,
                        'item' => 'Water Bottle'
                    ],
                    'give' => [
                        'text' => 'Give Them Water',
                        'message' => 'You gave them some water and avoided a fight.',
                        'food' => 0,
                        'water' => -3,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 40,
                        'item' => null
                    ],
                    'run' => [
                        'text' => 'Escape',
                        'message' => 'You escaped but dropped some of your water.',
                        'food' => 0,
                        'water' => -2,
                        'health' => -5,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 30,
                        'item' => null
                    ]
                ]
            ]
        ],

        'weapon' => [
                        [
                'title' => 'Abandoned Armory',
                'message' => 'You discovered a small supply of ammunition.',
                'food' => 0,
                'water' => 0,
                'health' => 0,
                'ammo' => 15,
                'survivors' => 0,
                'score' => 80,
                'item' => 'Ammunition'
            ],
            [
                'title' => 'Empty Police Car',
                'message' => 'You found ammunition inside an abandoned police vehicle.',
                'food' => 0,
                'water' => 0,
                'health' => 0,
                'ammo' => 8,
                'survivors' => 0,
                'score' => 45,
                'item' => 'Ammunition'
            ],
            [
                'title' => 'Quiet Road',
                'message' => 'You searched the area without encountering any zombies.',
                'food' => 2,
                'water' => 2,
                'health' => 5,
                'ammo' => 5,
                'survivors' => 0,
                'score' => 40,
                'item' => null
            ],
            [
                'title' => 'Police Station',
                'message' => 'You found ammunition inside an abandoned police station.',
                'food' => 0,
                'water' => 0,
                'health' => 0,
                'ammo' => 10,
                'survivors' => 0,
                'score' => 70,
                'item' => 'Ammunition'
            ],
            [
                'title' => 'Armed Zombie',
                'message' => 'A zombie attacked you while you searched for weapons.',
                'food' => 0,
                'water' => 0,
                'health' => -20,
                'ammo' => 5,
                'survivors' => 0,
                'score' => 50,
                'item' => 'Ammunition'
            ],
            [
                'title' => 'Zombie Horde',
                'message' => 'A massive zombie horde suddenly surrounded the building.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight the Horde',
                        'message' => 'You fought through the horde using a large amount of ammunition.',
                        'food' => 0,
                        'water' => -1,
                        'health' => -25,
                        'ammo' => -6,
                        'survivors' => 0,
                        'score' => 120,
                        'item' => 'Ammunition'
                    ],
                    'escape' => [
                        'text' => 'Escape',
                        'message' => 'You escaped through a back entrance but left some ammunition behind.',
                        'food' => -1,
                        'water' => -1,
                        'health' => -15,
                        'ammo' => -2,
                        'survivors' => 0,
                        'score' => 60,
                        'item' => null
                    ],
                    'hide' => [
                        'text' => 'Hide',
                        'message' => 'You hid quietly until the zombies moved away.',
                        'food' => -1,
                        'water' => -1,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 40,
                        'item' => null
                    ]
                ]
            ]
        ],

        'medicine' => [
                    [
            'title' => 'First Aid Kit',
            'message' => 'You found a first aid kit inside an abandoned house.',
            'food' => 0,
            'water' => 0,
            'health' => 25,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 60,
            'item' => 'Medicine'
        ],
        [
            'title' => 'Medical Supplies',
            'message' => 'You discovered useful medical supplies in a clinic.',
            'food' => 0,
            'water' => 2,
            'health' => 20,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 55,
            'item' => 'Medicine'
        ],
        [
            'title' => 'Safe Clinic',
            'message' => 'You found a quiet clinic and treated your injuries.',
            'food' => 0,
            'water' => 0,
            'health' => 30,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 70,
            'item' => 'Med Kit'
        ],
            [
                'title' => 'Abandoned Hospital',
                'message' => 'You found medical supplies inside an abandoned hospital.',
                'food' => 0,
                'water' => 0,
                'health' => 20,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 60,
                'item' => 'Medicine'
            ],
            [
                'title' => 'Dangerous Hospital',
                'message' => 'You found medicine but a zombie bit you.',
                'food' => 0,
                'water' => 0,
                'health' => -10,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 45,
                'item' => 'Medicine'
            ],
            [
                'title' => 'Hospital Ambush',
                'message' => 'You found a large amount of medicine, but zombies are closing in.',
                'choice' => true,
                'choices' => [
                    'take' => [
                        'text' => 'Take Everything',
                        'message' => 'You grabbed as much medicine as possible before escaping.',
                        'food' => 0,
                        'water' => -2,
                        'health' => -20,
                        'ammo' => -2,
                        'survivors' => 0,
                        'score' => 100,
                        'item' => 'Medicine'
                    ],
                    'leave' => [
                        'text' => 'Leave Immediately',
                        'message' => 'You escaped safely but left the medicine behind.',
                        'food' => 0,
                        'water' => -1,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 30,
                        'item' => null
                    ],
                    'fight' => [
                        'text' => 'Fight Through',
                        'message' => 'You fought through the zombies and collected the medicine.',
                        'food' => 0,
                        'water' => -2,
                        'health' => -30,
                        'ammo' => -5,
                        'survivors' => 0,
                        'score' => 130,
                        'item' => 'Medicine'
                    ]
                ]
            ]
        ],

        'explore' => [
                    [
            'title' => 'Abandoned House',
            'message' => 'You found an empty house with useful supplies.',
            'food' => 5,
            'water' => 5,
            'health' => 10,
            'ammo' => 3,
            'survivors' => 0,
            'score' => 70,
            'item' => 'Med Kit'
        ],
        [
            'title' => 'Friendly Survivors',
            'message' => 'A friendly group shared some supplies with you.',
            'food' => 6,
            'water' => 6,
            'health' => 5,
            'ammo' => 5,
            'survivors' => 1,
            'score' => 100,
            'item' => null
        ],
        [
            'title' => 'Quiet Neighborhood',
            'message' => 'You explored a quiet neighborhood and found useful supplies.',
            'food' => 4,
            'water' => 4,
            'health' => 5,
            'ammo' => 2,
            'survivors' => 0,
            'score' => 60,
            'item' => null
        ],
            [
                'title' => 'Survivor Found',
                'message' => 'You discovered another survivor hiding inside a house.',
                'choice' => true,
                'choices' => [
                    'invite' => [
                        'text' => 'Invite Them',
                        'message' => 'The survivor joined your group.',
                        'food' => -2,
                        'water' => -2,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 1,
                        'score' => 100,
                        'item' => null
                    ],
                    'leave' => [
                        'text' => 'Leave Them',
                        'message' => 'You decided you could not support another survivor.',
                        'food' => 0,
                        'water' => 0,
                        'health' => 0,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 20,
                        'item' => null
                    ]
                ]
            ],
            [
                'title' => 'Zombie Horde',
                'message' => 'A massive zombie horde surrounded your group.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight',
                        'message' => 'Your group fought through the zombies.',
                        'food' => -1,
                        'water' => -1,
                        'health' => -30,
                        'ammo' => -5,
                        'survivors' => 0,
                        'score' => 120,
                        'item' => null
                    ],
                    'run' => [
                        'text' => 'Run',
                        'message' => 'You escaped, but dropped several supplies.',
                        'food' => -3,
                        'water' => -3,
                        'health' => -15,
                        'ammo' => -1,
                        'survivors' => 0,
                        'score' => 50,
                        'item' => null
                    ],
                    'hide' => [
                        'text' => 'Hide',
                        'message' => 'You hid inside a building and waited for the horde to pass.',
                        'food' => -1,
                        'water' => -1,
                        'health' => -5,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 40,
                        'item' => null
                    ]
                ]
            ],
            [
                'title' => 'Hostile Survivors',
                'message' => 'Another survivor group blocked your path and demanded your supplies.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight',
                        'message' => 'You fought the hostile survivors and forced them to retreat.',
                        'food' => -2,
                        'water' => -1,
                        'health' => -25,
                        'ammo' => -4,
                        'survivors' => 0,
                        'score' => 100,
                        'item' => null
                    ],
                    'give' => [
                        'text' => 'Give Supplies',
                        'message' => 'You gave them some supplies to avoid a fight.',
                        'food' => -4,
                        'water' => -3,
                        'health' => 0,
                        'ammo' => -1,
                        'survivors' => 0,
                        'score' => 40,
                        'item' => null
                    ],
                    'escape' => [
                        'text' => 'Escape',
                        'message' => 'You escaped through a narrow alley but lost some supplies.',
                        'food' => -2,
                        'water' => -2,
                        'health' => -10,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 60,
                        'item' => null
                    ]
                ]
            ],
            [
                'title' => 'Safe House',
                'message' => 'You found a safe house with supplies.',
                'food' => 3,
                'water' => 3,
                'health' => 10,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 80,
                'item' => 'Med Kit'
            ]
        ],

        'rest' => [
                    [
            'title' => 'Peaceful Shelter',
            'message' => 'You found a secure shelter and had a peaceful night.',
            'food' => -1,
            'water' => -1,
            'health' => 20,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 20,
            'item' => null
        ],
        [
            'title' => 'Good Night Sleep',
            'message' => 'Your group rested well and recovered from the journey.',
            'food' => -1,
            'water' => -1,
            'health' => 25,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 25,
            'item' => null
        ],
        [
            'title' => 'Safe Camp',
            'message' => 'You found a safe place to rest without any trouble.',
            'food' => -1,
            'water' => -1,
            'health' => 15,
            'ammo' => 0,
            'survivors' => 0,
            'score' => 15,
            'item' => null
        ],
            [
                'title' => 'Quiet Night',
                'message' => 'You stayed inside a secure building and recovered some health.',
                'food' => -1,
                'water' => -1,
                'health' => 10,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 10,
                'item' => null
            ],
            [
                'title' => 'Zombie Break-In',
                'message' => 'Zombies broke into your shelter during the night.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight',
                        'message' => 'You fought the zombies inside your shelter.',
                        'food' => -2,
                        'water' => -1,
                        'health' => -20,
                        'ammo' => -3,
                        'survivors' => 0,
                        'score' => 70,
                        'item' => null
                    ],
                    'escape' => [
                        'text' => 'Escape',
                        'message' => 'You escaped from the shelter but lost some supplies.',
                        'food' => -3,
                        'water' => -3,
                        'health' => -10,
                        'ammo' => 0,
                        'survivors' => 0,
                        'score' => 40,
                        'item' => null
                    ]
                ]
            ]
        ]
    ];

    if (!isset($events[$action])) {
        return redirect()->route('game.explore');
    }

    $event = $events[$action][array_rand($events[$action])];

    if (isset($event['choice']) && $event['choice'] === true) {
        session()->forget('current_event');

        session([
            'game' => $game,
            'choice_event' => $event
        ]);

        return redirect()->route('game.event');
    }

    $game = $this->applyEvent($game, $event);

    session([
        'game' => $game,
        'current_event' => $event
    ]);

    return redirect()->route('game.event');
}

public function choice(Request $request)
{
    $game = session('game');
    $event = session('choice_event');

    if (!$game || !$event || $game['status'] !== 'playing') {
        return redirect()->route('home');
    }

    $choice = $request->choice;

    if (!isset($event['choices'][$choice])) {
        return redirect()->route('game.event');
    }

    $result = $event['choices'][$choice];

    $resultEvent = [
        'title' => $event['title'],
        'message' => $result['message'],
        'health' => $result['health'],
        'food' => $result['food'],
        'water' => $result['water'],
        'ammo' => $result['ammo'],
        'survivors' => $result['survivors'],
        'score' => $result['score'],
        'item' => $result['item']
    ];

    $game = $this->applyEvent($game, $resultEvent);

    session([
        'game' => $game,
        'current_event' => $resultEvent
    ]);

    session()->forget('choice_event');

    return redirect()->route('game.event');
}

private function applyEvent($game, $event)
{
    $game['health'] += $event['health'];
    $game['food'] += $event['food'];
    $game['water'] += $event['water'];
    $game['ammo'] += $event['ammo'];
    $game['survivors'] += $event['survivors'];
    $game['score'] += $event['score'];

    $game['health'] = min(100, max(0, $game['health']));
    $game['food'] = max(0, $game['food']);
    $game['water'] = max(0, $game['water']);
    $game['ammo'] = max(0, $game['ammo']);
    $game['survivors'] = max(1, $game['survivors']);

    if ($event['item']) {
        if (!isset($game['inventory'][$event['item']])) {
            $game['inventory'][$event['item']] = 0;
        }

        $game['inventory'][$event['item']]++;
    }

    $game['history'][] = 'Day ' . $game['day'] . ': ' . $event['title'] . ' - ' . $event['message'];

    $game['day']++;

    if ($game['health'] <= 0) {
        $game['status'] = 'dead';
        $game['history'][] = 'You died from your injuries.';
    }

    if ($game['food'] <= 0 || $game['water'] <= 0) {
        $game['status'] = 'dead';
        $game['history'][] = 'Your group ran out of essential supplies.';
    }

   if ($game['day'] >= 30 && $game['status'] === 'playing') {
    $game['status'] = 'won';
    $game['score'] += 500;
    $game['history'][] = 'Day 30: You survived the zombie apocalypse!';

    GameRecord::create([
        'name' => $game['player_name'],
        'score' => $game['score'],
    ]);
        }
    return $game;
}

    public function event()
    {
        $game = session('game');
        $event = session('current_event');
        $choiceEvent = session('choice_event');

        if (!$game) {
            return redirect()->route('home');
        }

        if ($choiceEvent && $game['status'] === 'playing') {
            return view('game.event', compact('game', 'choiceEvent'));
        }

        if (!$event) {
            return redirect()->route('game.dashboard');
        }

        return view('game.event', compact('game', 'event'));
    }

    public function inventory()
    {
        $game = session('game');

        if (!$game) {
            return redirect()->route('home');
        }

        return view('game.inventory', compact('game'));
    }

    public function history()
    {
        $game = session('game');

        if (!$game) {
            return redirect()->route('home');
        }

        return view('game.history', compact('game'));
    }

    public function result()
    {
        $game = session('game');

        if (!$game) {
            return redirect()->route('home');
        }

        return view('game.result', compact('game'));
    }

   public function bestScore()
{
    $scores = \DB::table('game_records')
        ->orderByDesc('score')
        ->limit(10)
        ->get();

    return view('best-score', compact('scores'));
}
    public function restart()
    {
        session()->forget([
            'game',
            'current_event',
            'choice_event'
        ]);

        return redirect()->route('game.setup');
    }
}