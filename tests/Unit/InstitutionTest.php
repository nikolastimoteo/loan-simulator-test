<?php

namespace Tests\Unit;

use Tests\TestCase;

class InstitutionTest extends TestCase
{
    /** @test */
    public function itCanListInstitutions()
    {
        $response = $this->getJson('/api/v1/instituicoes');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'instituicoes'
            ]);
    }
}
