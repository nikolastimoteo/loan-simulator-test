<?php

namespace Tests\Unit;

use Tests\TestCase;

class SimulationTest extends TestCase
{
    /** @test */
    public function itCanSimulateWhenValidValueForValorEmprestimo()
    {
        $response = $this->postJson('/api/v1/simular', [
            'valor_emprestimo' => 3500
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'simulacoes'
            ]);
    }
}
