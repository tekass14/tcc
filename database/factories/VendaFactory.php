<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\User; // Supondo que "responsavel_id" esteja relacionado ao modelo User
use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory
{
    /**
     * O nome do modelo correspondente à fábrica.
     *
     * @var string
     */
    protected $model = Venda::class;

    /**
     * Defina o estado padrão da fábrica.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => Cliente::inRandomOrder()->first()->id ?? Cliente::factory()->create()->id,
            'responsavel_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
