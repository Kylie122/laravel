<?php

namespace Tests\Feature;

use Tests\TestCase;

class GameEventTest extends TestCase
{
    public function test_resolved_events_show_their_result(): void
    {
        $response = $this->withSession([
            'game' => $this->game(),
            'current_event' => [
                'title' => 'Abandoned Grocery Store',
                'message' => 'You found supplies.',
                'health' => 0,
                'food' => 7,
                'water' => 0,
                'ammo' => 0,
                'survivors' => 0,
                'score' => 50,
                'item' => 'Canned Food',
            ],
        ])->get('/game/event');

        $response->assertOk()
            ->assertSee('Event Result')
            ->assertSee('Abandoned Grocery Store')
            ->assertSee('+7')
            ->assertSee('Continue');
    }

    public function test_choice_events_show_choices_then_the_result(): void
    {
        $response = $this->withSession([
            'game' => $this->game(),
            'choice_event' => [
                'title' => 'Bandit Ambush',
                'message' => 'Bandits confront you.',
                'choice' => true,
                'choices' => [
                    'fight' => [
                        'text' => 'Fight Back',
                        'message' => 'You drove them away.',
                        'health' => -5,
                        'food' => 1,
                        'water' => 0,
                        'ammo' => -1,
                        'survivors' => 0,
                        'score' => 20,
                        'item' => null,
                    ],
                ],
            ],
        ])->get('/game/event');

        $response->assertOk()
            ->assertSee('Bandit Ambush')
            ->assertSee('Fight Back');

        $this->post('/game/choice', ['choice' => 'fight'])
            ->assertRedirect('/game/event');

        $this->get('/game/event')
            ->assertOk()
            ->assertSee('You drove them away.')
            ->assertSee('-5')
            ->assertSee('Continue');
    }

    private function game(): array
    {
        return [
            'player_name' => 'Tester',
            'day' => 1,
            'health' => 100,
            'food' => 20,
            'water' => 20,
            'ammo' => 10,
            'survivors' => 2,
            'score' => 0,
            'status' => 'playing',
            'inventory' => [],
            'history' => [],
        ];
    }
}
