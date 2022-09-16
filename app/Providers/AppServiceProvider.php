<?php

namespace App\Providers;

use App\Models\BesoinsParam;
use App\Models\Etablissement;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        // Register User Repository
        $this->app->bind(
            'App\Repositories\IUserRepository',
            'App\Repositories\UserRepository'
        );
        // Register Besoin Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IBesoinRepository',
            'App\Repositories\Services\BesoinRepository'
        );
        // Register NatureDemande Repository
        $this->app->bind(
            'App\Repositories\Interfaces\INatureDemandeRepository',
            'App\Repositories\Services\NatureDemandeRepository'
        );
        // Register Pai Generator Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IPaiRepository',
            'App\Repositories\Services\PaiRepository'
        );

        // Register Paragraphe Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IParagrapheRepository',
            'App\Repositories\Services\ParagrapheRepository'
        );
        // Register Paragraphe Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IProjetRepository',
            'App\Repositories\Services\ProjetRepository'
        );
        // Register Sparagraphe Repository
        $this->app->bind(
            'App\Repositories\Interfaces\ISparagrapheRepository',
            'App\Repositories\Services\SparagrapheRepository'
        );
        // Register Titre Repository
        $this->app->bind(
            'App\Repositories\Interfaces\ITitreRepository',
            'App\Repositories\Services\TitreRepository'
        );
        // Register Chapitre Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IChapitreRepository',
            'App\Repositories\Services\ChapitreRepository'
        );
        // Register Service Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IServiceRepository',
            'App\Repositories\Services\ServiceRepository'
        );
        // Register Service Repository
        $this->app->bind(
            'App\Repositories\Interfaces\ISoumissionnaireRepository',
            'App\Repositories\Services\SoumissionnaireRepository'
        );
        // Register Service Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IEtablissementRepository',
            'App\Repositories\Services\EtablissementRepository'
        );
        // Register Consultation Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IConsultationRepository',
            'App\Repositories\Services\ConsultationRepository'
        );
        // Register DossierAchat Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IDossierARepository',
            'App\Repositories\Services\DossierARepository'
        );
        // Article Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IArticleRepository',
            'App\Repositories\Services\ArticleRepository'
        );
        // FileUpload Repository
        $this->app->bind(
            'App\Repositories\IFileUploadRepository',
            'App\Repositories\FileUploadRepository'
        );

        // Event Repository
        /* $this->app->bind(
        'App\Repositories\ICalendarRepository',
        'App\Repositories\CalendarRepository'
        );*/

        Schema::defaultStringLength(191);

        //dd($besoins_actif);
        view()->composer('*', function ($view) {
            $locale = LaravelLocalization::getCurrentLocale();
            $besoins_actif = false;
            $paramBesoin = BesoinsParam::select('*')->where('annee_gestion', strftime("%Y"))->first();
            if ($paramBesoin) {
                $besoins_actif = Carbon::now()->between($paramBesoin->date_debut, $paramBesoin->date_fin);
            }
            $settings = Etablissement::first();
            if(!$settings){
                $settings = Etablissement::create();
            }

            $view->with('locale', $locale)
                ->with('besoins_actif', $besoins_actif)
                ->with('paramBesoin', $paramBesoin)
                ->with('settings', $settings);
        });

    }
}
