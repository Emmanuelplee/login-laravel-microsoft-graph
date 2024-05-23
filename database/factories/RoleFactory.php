<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{

    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique(true, 20000)->sentence(2, true),
            'guard_name' => 'web', // Puedes cambiar esto si necesitas otros valores
            'status' => $this->faker->boolean,
            'id_role_tipo' => rand(1,8),
        ];
    }
}
