<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\InstitutionRepository;
use App\Repositories\InstitutionRepositoryInterface;
use App\Repositories\AgreementRepository;
use App\Repositories\AgreementRepositoryInterface;
use App\Repositories\InstitutionTaxRepository;
use App\Repositories\InstitutionTaxRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(InstitutionRepositoryInterface::class, InstitutionRepository::class);
        $this->app->bind(AgreementRepositoryInterface::class, AgreementRepository::class);
        $this->app->bind(InstitutionTaxRepositoryInterface::class, InstitutionTaxRepository::class);
    }
}
