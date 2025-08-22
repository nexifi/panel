<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketResponseFactory extends Factory
{
    protected $model = TicketResponse::class;

    public function definition(): array
    {
        return [
            'ticket_id' => Ticket::factory(),
            'user_id' => User::factory(),
            'content' => fake()->paragraphs(2, true),
            'is_internal' => false,
            'is_staff_response' => false,
        ];
    }

    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_internal' => true,
        ]);
    }

    public function staff(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_staff_response' => true,
        ]);
    }

    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_internal' => false,
            'is_staff_response' => false,
        ]);
    }
}
