<?php

namespace App\Repositories;

class InstitutionRepository implements InstitutionRepositoryInterface
{
    protected $institutions;

    public function __construct()
    {
        $institutionsJsonString = file_get_contents(base_path('resources/json/instituicoes.json'));
        $this->institutions = json_decode($institutionsJsonString);
    }

    /**
     * Gets all the institutions from the database.
     * 
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @return array
     */
    public function all() : array
    {
        return $this->institutions;
    }
}