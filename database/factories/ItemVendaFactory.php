<?php

namespace Database\Factories;

use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemVendaFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = ItemVenda::class;

    /**
     * Defina o estado padrão da fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'produto_id' => Produto::inRandomOrder()->first()->id ?? Produto::factory()->create()->id,
            'venda_id' => Venda::inRandomOrder()->first()->id ?? Venda::factory()->create()->id,
            'quantidade' => $this->faker->numberBetween(1, 100), // Gera uma quantidade aleatória entre 1 e 100
        ];
    }
}
