<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ClienteFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Defina o estado padrão da fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,  
            'cpf' => $this->faker->numberBetween($min = 0, $max = 99999999999),    
            'endereco' => $this->faker->address,  
        ];
    }
}
