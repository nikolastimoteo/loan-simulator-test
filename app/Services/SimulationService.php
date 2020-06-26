<?php

namespace App\Services;

use App\Repositories\AgreementRepositoryInterface;
use App\Repositories\InstitutionRepositoryInterface;
use App\Repositories\InstitutionTaxRepositoryInterface;

class SimulationService
{
    private $agreementRepository;
    private $institutionRepository;
    private $institutionTaxRepository;

    public function __construct(
        AgreementRepositoryInterface $agreementRepository, 
        InstitutionRepositoryInterface $institutionRepository, 
        InstitutionTaxRepositoryInterface $institutionTaxRepository
    )
    {
        $this->agreementRepository = $agreementRepository;
        $this->institutionRepository = $institutionRepository;
        $this->institutionTaxRepository = $institutionTaxRepository;
    }

    /**
     * Makes a loan simulation.
     *
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @param  array  $choosenAgreements
     * @param  array  $choosenInstitutions
     * @param  int    $instalment
     * @param  float  $loanValue
     * @return array
     */
    public function simulate($choosenAgreements, $choosenInstitutions, $instalment, $loanValue)
    {
        $allInstitutions = $this->institutionRepository->all();
        $allInstitutionTaxes = $this->institutionTaxRepository->all();
        $simulations = array();

        foreach ($allInstitutions as $institution) {
            if (in_array($institution->chave, $choosenInstitutions) || empty($choosenInstitutions)) {
                // creates a key for the institution in the simulations array
                // if it was choosen or if the choosen institution options are empty
                $simulations[$institution->chave] = array();

                foreach ($allInstitutionTaxes as $institutionTax) {
                    if ($institutionTax->instituicao === $institution->chave 
                        && (in_array($institutionTax->convenio, $choosenAgreements)
                            || empty($choosenAgreements))) {
                        if ($institutionTax->parcelas === $instalment || empty($instalment)) {
                            // inserts a new simulation if the institution has a tax for the choosen
                            // agreement or if the choosen agreement options are empty
                            // and if the choosen instalment match with the tax or is empty
                            array_push($simulations[$institution->chave], [
                                'taxas'         => $institutionTax->taxaJuros,
                                'parcelas'      => $institutionTax->parcelas,
                                'valor_parcela' => round($loanValue * $institutionTax->coeficiente, 2),
                                'convenio'      => $institutionTax->convenio
                            ]);
                        }
                    }

                }
               
                // removes the key for the institution from the array if it's still empty
                // after the taxes foreach
                if (empty($simulations[$institution->chave])) {
                    array_pop($simulations);
                }
            }
        }

        return $simulations;
    }
}