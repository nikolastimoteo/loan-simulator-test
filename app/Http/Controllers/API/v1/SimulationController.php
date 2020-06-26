<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\v1\SimulationSimulateFormRequest;
use App\Services\SimulationService;

class SimulationController extends Controller
{
    private $simulationService;

    public function __construct(SimulationService $simulationService)
    {
        $this->simulationService = $simulationService;
    }

    /**
     * Receives a loan simulation for the requested value.
     *
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @param  SimulationSimulateFormRequest  $request
     * @return JsonResponse
     */
    public function __invoke(SimulationSimulateFormRequest $request)
    {
        $choosenAgreements   = $request->convenios ? $request->convenios : [];
        $choosenInstitutions = $request->instituicoes ? $request->instituicoes : [];
        $instalment          = $request->parcela ? $request->parcela : 0;
        $loanValue           = $request->valor_emprestimo;

        $simulations = $this->simulationService->simulate(
            $choosenAgreements,
            $choosenInstitutions,
            $instalment,
            $loanValue
        );

        return response([ 
            'simulacoes' => $simulations
        ], 200);
    }
}
