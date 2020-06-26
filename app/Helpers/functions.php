<?php

if (! function_exists('calculate_loan_instalment_value')) {
    /**
     * Calculates the loan instalment value.
     * 
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @param  float $loan_value
     * @param  float $institution_coefficient
     * @return float
     */
    function calculate_loan_instalment_value(float $loan_value, float $institution_coefficient) {
        return round($loan_value * $institution_coefficient, 2);
    }
}