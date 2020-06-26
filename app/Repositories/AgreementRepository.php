<?php

namespace App\Repositories;

class AgreementRepository implements AgreementRepositoryInterface
{
    protected $agreements;

    public function __construct()
    {
        $agreementsJsonString = file_get_contents(base_path('resources/json/convenios.json'));
        $this->agreements = json_decode($agreementsJsonString);
    }

    /**
     * Gets all the agreements from the database.
     * 
     * @author Níkolas Timóteo <nikolastps@hotmail.com>
     * @return array
     */
    public function all() : array
    {
        return $this->agreements;
    }
}
