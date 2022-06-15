<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DB;
use App\Models\Setting;

use Illuminate\Support\Facades\Schema;

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

        // Register Paragraphe Repository
        $this->app->bind(
            'App\Repositories\Interfaces\IParagrapheRepository',
            'App\Repositories\Services\ParagrapheRepository'
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

        view()->composer('*', function ($view) {
            $locale = LaravelLocalization::getCurrentLocale();
          //  $settings = Setting::first();
            $view->with('locale', $locale);
                // ->with('service', $service);
        });



    }
}
