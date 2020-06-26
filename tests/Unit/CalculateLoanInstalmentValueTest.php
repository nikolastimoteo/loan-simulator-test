<?php

namespace Tests\Unit;

use Tests\TestCase;

class CalculateLoanInstalmentValueTest extends TestCase
{
    /** @test */
    public function itCanCalculateWhenValidValue()
    {
        $loanInstalmentValue = calculate_loan_instalment_value(3500, 0.03529);
        $this->assertTrue($loanInstalmentValue === 123.52);
    }
}
