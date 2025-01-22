<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Defina o estado padrão da fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word, 
        ];
    }
}
