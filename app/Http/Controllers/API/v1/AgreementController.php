<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AgreementRepositoryInterface;

class AgreementController extends Controller
{
    private $agreementRepository;

    public function __construct(AgreementRepositoryInterface $agreementRepository)
    {
        $this->agreementRepository = $agreementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @return JsonResponse
     */
    public function index()
    {
        return response([
            'convenios' => $this->agreementRepository->all()
        ], 200);
    }
}
