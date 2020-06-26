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
                'simulacoes' => [
                    '*' => [
                        [
                            'taxas',
                            'parcelas',
                            'valor_parcela',
                            'convenio'
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function itCanNotSimulateWhenNoValueForValor()
    {
        $response = $this->postJson('/api/v1/simular', [
            'convenios'    => ['Federal'],
            'instituicoes' => ['Ole'],
            'parcela'      => 1
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'valor_emprestimo'
            ]);
    }

    /** @test */
    public function itCanNotSimulateWhenInvalidValueForValor()
    {
        $response = $this->postJson('/api/v1/simular', [
            'valor_emprestimo' => 'abc'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'valor_emprestimo'
            ]);
    }

    /** @test */
    public function itCanNotSimulateWhenInvalidValueForAnyField()
    {
        $response = $this->postJson('/api/v1/simular', [
            'convenios'        => 'a',
            'instituicoes'     => 'b',
            'parcela'          => -1,
            'valor_emprestimo' => 2400.5
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'convenios',
                'instituicoes',
                'parcela'
            ]);
    }
}
