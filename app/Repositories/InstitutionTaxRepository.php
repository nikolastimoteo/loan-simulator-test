<?php

namespace App\Repositories;

class InstitutionTaxRepository implements InstitutionTaxRepositoryInterface
{
    protected $institutionTaxes;

    public function __construct()
    {
        $institutionTaxesJsonString = file_get_contents(base_path('resources/json/taxas_instituicoes.json'));
        $this->institutionTaxes = json_decode($institutionTaxesJsonString);
    }

    /**
     * Gets all the institution taxes from the database.
     * 
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @return array
     */
    public function all() : array
    {
        return $this->institutionTaxes;
    }
}
