<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\InstitutionRepositoryInterface;

class InstitutionController extends Controller
{
    private $institutionRepository;

    public function __construct(InstitutionRepositoryInterface $institutionRepository)
    {
        $this->institutionRepository = $institutionRepository;
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
            'instituicoes' => $this->institutionRepository->all()
        ], 200);
    }
}
