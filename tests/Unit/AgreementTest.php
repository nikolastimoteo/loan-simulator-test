<?php

namespace Tests\Unit;

use Tests\TestCase;

class AgreementTest extends TestCase
{
    /** @test */
    public function itCanListAgreements()
    {
        $response = $this->getJson('/api/v1/convenios');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'convenios'
            ]);
    }
}
