<?php

namespace Database\Factories;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'user_id' => User::factory(),
            'subject' => fake()->sentence(),
            'status' => fake()->randomElement(TicketStatus::cases())->value,
            'priority' => fake()->randomElement(TicketPriority::cases())->value,
            'category' => fake()->randomElement(['general', 'technical', 'billing', 'server', 'other']),
            'assigned_to' => null,
            'closed_at' => null,
            'closed_by' => null,
        ];
    }

    public function open(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TicketStatus::OPEN->value,
        ]);
    }

    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => TicketStatus::CLOSED->value,
            'closed_at' => now(),
            'closed_by' => User::factory(),
        ]);
    }

    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => TicketPriority::URGENT->value,
        ]);
    }
}
