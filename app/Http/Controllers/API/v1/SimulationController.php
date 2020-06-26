<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\v1\SimulationSimulateFormRequest;
use App\Repositories\AgreementRepositoryInterface;
use App\Repositories\InstitutionRepositoryInterface;
use App\Repositories\InstitutionTaxRepositoryInterface;

class SimulationController extends Controller
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
     * Makes a loan simulation for the requested value.
     *
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @param  SimulationSimulateFormRequest  $request
     * @return JsonResponse
     */
    public function __invoke(SimulationSimulateFormRequest $request)
    {
        $choosenAgreements   = $request->convenios ? $request->convenios : [];
        $choosenInstitutions = $request->instituicoes ? $request->instituicoes : [];
        $parcela             = $request->parcela ? $request->parcela : 0;
        $valorEmprestimo     = $request->valor_emprestimo;
        
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
                        if ($institutionTax->parcelas === $parcela || empty($parcela)) {
                            // inserts a new simulation if the institution has a tax for the choosen
                            // agreement or if the choosen agreement options are empty
                            // and if the choosen instalment match with the tax or is empty
                            array_push($simulations[$institution->chave], [
                                'taxas'         => $institutionTax->taxaJuros,
                                'parcelas'      => $institutionTax->parcelas,
                                'valor_parcela' => round($valorEmprestimo * $institutionTax->coeficiente, 2),
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

        return response([ 
            'simulacoes' => $simulations
        ], 200);
    }
}
