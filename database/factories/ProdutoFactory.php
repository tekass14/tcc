<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Defina o estado padrão da fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->word,                 // Nome do produto
            'marca' => $this->faker->company,             // Marca fictícia
            'modelo' => $this->faker->bothify('Modelo ##'), // Modelo fictício (e.g., Modelo 12)
            'preco' => $this->faker->randomFloat(2, 10, 1000), // Preço aleatório entre 10 e 1000
            'descricao' => $this->faker->sentence,        // Descrição curta
            'categoria_id' => Categoria::inRandomOrder()->first()->id,      // Gera uma categoria associada
        ];
    }
}
