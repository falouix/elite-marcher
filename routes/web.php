<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,ArticleController,BesoinController,
    BesoinValidationController,ChapitreController,
    EtablissementController,FileUploadController,
    NatureDemandeController,PaiController,ParagrapheController,
    ProjetController,RoleController,ServiceController,
    SettingController,SoumissionnaireController,
    SparagrapheController,TitreController,UserController,
    DossierAchatController,ConsultationController,AOSController,
    AONController,GREGREController,NotifController,PPMController,
    ParamBesoinsController,CustomerController
};
use App\Http\Controllers\Auth\ClientLoginController;
/************************************************************************* */
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::post('logout', function () {
    $user = auth()->user();
    auth()->logout();

    Session()->flush();
  //if(!$user) {return Redirect::to('/customer/login');}
   return Redirect::to('/login');

})->name('logout');

Route::group(
    [
        'middleware' => ['XSS'],
    ],

    function () {

        Route::get('/', function () {
            return redirect('/login');
        });
        Route::get('/customer', function () {
            return redirect('/customer/login');
        });
        Auth::routes(['logout' => false]);
    });

//, 'localize', 'localizationRedirect', 'localeSessionRedirect', 'localeCookieRedirect', 'localeViewPath'
Route::group(
    [
        //'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['XSS', 'auth'],
    ],
    function () {

        Route::resource('roles', RoleController::class);
        Route::resource('settings', SettingController::class);
        // Route::resource('titres', TitreController::class);
        /*****************users routes******************/
        Route::resource('users', UserController::class);

        Route::post('users_datatables', [UserController::class, 'getAllUserDataTable'])->name('users_datatable.data');
        Route::delete('/users-multi-delete', [UserController::class, '/users-multi-delete'])->name('users_datatable.multidestroy');
        Route::post('/users/Select2', [UserController::class, 'getAllLawyerToSelect'])->name('users.LawyerListToSelect');
        Route::post('/users-type/Select2', [UserController::class, 'getAllUserByTypeToSelect'])->name('users.AllByTypeListToSelect');
        Route::get('/userbyid/Select2/{users_id}', [UserController::class, 'getUserById'])->name('users.userByIdToSelect');

        /// Routes SANA
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::resource('paragraphes', ParagrapheController::class);
        Route::post('paragraphes/datatable', [ParagrapheController::class, 'getAllParagraphesDatatable'])->name('paragraphes.datatable');

        Route::resource('Sparagraphes', SparagrapheController::class);
        Route::post('Sparagraphes/datatable', [SparagrapheController::class, 'getAllSparagraphesDatatable'])->name('Sparagraphes.datatable');

        Route::resource('titres', TitreController::class);
        Route::post('titres/datatable', [TitreController::class, 'getAllTitresDatatable'])->name('titres.datatable');

        Route::resource('chapitres', ChapitreController::class);
        Route::post('chapitres/datatable', [ChapitreController::class, 'getAllChapitresDatatable'])->name('chapitres.datatable');

        Route::resource('services', ServiceController::class);
        Route::post('services/datatable', [ServiceController::class, 'getAllServicesDatatable'])->name('services.datatable');

        Route::resource('soumissionnaires', SoumissionnaireController::class);
        Route::post('soumissionnaires/datatable', [SoumissionnaireController::class, 'getAllSoumissionnairesDatatable'])->name('soumissionnaires.datatable');

        Route::post('clients-account', [SoumissionnaireController::class, 'createAccount'])->name('clients.createAccount');
        Route::post('clients-suspend', [SoumissionnaireController::class, 'suspendAccount'])->name('clients.suspendAccount');

        Route::resource('etablissements', EtablissementController::class);

        //route besoin
        Route::resource('besoins', BesoinController::class);
        Route::post('besoin/datatable', [BesoinController::class, 'getAllBesoinDatatable'])->name('besoin.datatable');
        // Route::post('besoin/edit', [BesoinController::class, 'edit'])->name('besoinDataTable.edit');
        // Route::post('besoin/destroy', [BesoinController::class, 'destroy'])->name('besoinDataTable.destroy');
        Route::post('/besoins-multi-delete', [BesoinController::class, '/users-multi-delete'])->name('besoins_datatable.multidestroy');
        //route ligneBesoin
        Route::post('lignes-besoin/datatable', [BesoinController::class, 'getLigneBesoinsByBesoin'])->name('ligne_besoin.datatable');
        Route::post('lignes-besoin', [BesoinController::class, 'storeLigneBesoin'])->name('lignes_besoin.store');
        Route::post('lignes-besoin-exception', [BesoinController::class, 'storeLigneBesoinException'])->name('lignes_besoin.storeExeption');
        Route::put('lignes-besoin', [BesoinController::class, 'updateLigneBesoin'])->name('lignes_besoin.update');
        Route::get('lignes-besoin', [BesoinController::class, 'editLigneBesoin'])->name('ligne_besoins.edit');
        Route::delete('lignes-besoin-delete', [BesoinController::class, 'destroyLigneBesoin'])->name('ligne_besoins_datatable.destroy');
        // Validation Besoins
        Route::resource('besoins-validation', BesoinValidationController::class);
        Route::put('besoin-validation/valider', [BesoinValidationController::class, 'validerBesoin'])->name('besoins-validation.valider');
        Route::put('lignes-besoin-validation', [BesoinValidationController::class, 'updateLigneBesoin'])->name('lignes_besoin_v.update');
        Route::get('lignes-besoin-validation', [BesoinValidationController::class, 'editLigneBesoin'])->name('ligne_besoins_v.edit');

        //route besoin
        Route::resource('natures-demande', NatureDemandeController::class);
        Route::post('natures-demande/datatable', [NatureDemandeController::class, 'getAllNatureDemandeDataTable'])->name('natures-demande.data');
        Route::post('natures-demande/select', [NatureDemandeController::class, 'getAllNatureDemandeToSelect'])->name('natures-demande.select');
        Route::post('/natures_demande/Select2', [NatureDemandeController::class, 'getNatureDemandeById'])
            ->name('natures-demande.NatureDemandeByIdToSelect');
        Route::delete('natures-demande/multidestroy', [NatureDemandeController::class, 'multidestroy'])->name('natures-demandes-datatable.multidestroy');

        //route Pai : Générateur du plan d'investissement annulle des achats
       // Route::get('pais', PaiController::class);
        Route::get('pais', [PaiController::class, 'indexPais'])->name('pais.index');
        Route::get('pais/projet', [PaiController::class, 'indexPais'])->name('pais.indexPais');
        Route::post('pais/datatable', [PaiController::class, 'getAllPaiDatatable'])->name('pais.datatable');
        Route::post('pais-projet/datatable', [PaiController::class, 'getAllPaiProjetDatatable'])->name('pais-projet.datatable');

        // route projets d'approvisionnement
        Route::resource('projets', ProjetController::class);
        Route::post('projets/datatable', [ProjetController::class, 'getAllProjetsDatatable'])->name('projets.data');
        Route::post('lignes-projets/datatable', [ProjetController::class, 'getLigneProjetsByProjet'])->name('lignes-projets.data');
        Route::post('projets/transferer', [ProjetController::class, 'transfererProjet'])->name('projets.transfertDA');
        Route::post('lignes-projets/addLProjet', [ProjetController::class, 'addLProjet'])->name('lignes-projets.addLProjet');
        Route::delete('projets/multidestroy', [ProjetController::class, 'multidestroy'])->name('projets.multidestroy');
        Route::delete('lignes-projets', [ProjetController::class, 'destroyLigneProjet'])->name('lignes-projets.destroy');
        // Route PPM
        Route::resource('ppm', PPMController::class);
        Route::post('ppm/datatable',[PPMController::class, 'getAllProjetsDatatable'])->name('ppm.data');
        Route::post('ppm/print',[PPMController::class, 'printPPM'])->name('ppm.print');


        //route Articles
        Route::resource('articles', ArticleController::class);
        Route::post('articles/datatable', [ArticleController::class, 'getAllArticlesDatatable'])->name('articles.data');
        Route::post('articles/store', [ArticleController::class, 'storeFromBesoin'])->name('articles.storeFromBesoin');
        Route::post('articles/select', [ArticleController::class, 'getAllArticlesToSelect'])->name('articles.select');
        Route::put('article/validate', [ArticleController::class, 'valider'])->name('articles.validate');

         //route ParamBesoins
         Route::resource('parambesoins', ParamBesoinsController::class);
         Route::post('param-besoins/datatable', [ParamBesoinsController::class, 'getAllParamBesoinsDatatable'])->name('parambesoins.data');

        //route DossierAchats
        Route::post('dossiers/datatable', [DossierAchatController::class, 'getAllDossiersDatatable'])->name('dossiers.data');
        Route::post('lignesdossier/datatable', [DossierAchatController::class, 'getLigneDossierADataTable'])->name('lignes-dossier.data');
        Route::post('dossiers/datatable/offres', [DossierAchatController::class, 'getOffresDataTable'])->name('dossiers.offres.data');
        Route::post('dossiers/datatable/ccdocs', [DossierAchatController::class, 'getCCDocsDatatable'])->name('dossiers.cc-docs.data');
        Route::get('dossiers/{id}', [DossierAchatController::class, 'show'])->name('dossiers.show');
        Route::get('settings/{id}/edit ', [DossierAchatController::class, 'edit'])->name('dossiers.edit');

         // route Consultations
         Route::resource('consultations', ConsultationController::class);
         Route::post('consultations/cc', [ConsultationController::class, 'cahierCharges'])->name('consultation.cc');
         Route::get('consultations/cc', [ConsultationController::class, 'getCahierCharges'])->name('consultation.cc');
         Route::post('consultations/avisPub', [ConsultationController::class, 'avisPub'])->name('consultation.avisPub');
         // route Appel Offre Normal
         Route::resource('aon', AONController::class);
         // route Appel Offre Simplifié
         Route::resource('aos', AOSController::class);
         // route Marché de Gré à Gré
         Route::resource('aogregre', GREGREController::class);

         //route Notifications
        Route::resource('notifs', NotifController::class);
        Route::post('notifs/datatable', [NotifController::class, 'getAllNotifDatatable'])->name('notifs.data');
         // Route Notifs Axios
         Route::get('/getNotifs',[NotifController::class, 'getNotifs']);
         Route::post('/notifAction',[NotifController::class, 'postNotifAction']);


        Route::get('file-upload/show/{id}/{param}', [FileUploadController::class, 'fileUploadGet'])->name('file.upload.get');
        Route::post('file-upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');
        Route::post('file-data', [FileUploadController::class, 'getAllFilesByType'])->name('files.datatable');
        Route::delete('file-delete', [FileUploadController::class, 'fileUploadDelete'])->name('files.delete');



    }
);
Route::get('/customer/login', [ClientLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [ClientLoginController::class, 'login'])->name('customer.login.submit');
Route::group(['prefix' => 'customer',
    'middleware' => ['XSS','auth:client'],
], function () {
    // Route::get('/refreshcaptcha','Auth\ClientLoginController@refreshCaptcha');

    Route::get('/register', [ClientLoginController::class, 'showRegisterForm'])->name('customer.register');
    Route::get('/reset', [ClientLoginController::class, 'showMDPOubliee'])->name('customer.motDePasseOubliee');
    Route::get('/reset/{token}', [ClientLoginController::class, 'showUpdatePassword'])->name('customer.showUpdatePassword');
    Route::post('/reset', [ClientLoginController::class, 'reset'])->name('customer.sendmail');
    Route::post('/reset/{token}', [ClientLoginController::class, 'UpdatePassword'])->name('customer.UpdatePassword');


    //Route::post('customer-file-data', [FileUploadController::class, 'getAllFilesByType'])->name('customer-files.datatable');
    //Route::get('file-customer/show/{id}/{param}', [FileUploadController::class, 'fileUploadGet'])->name('customer-file.upload.get');

    Route::post('dossiers/datatable', [CustomerController::class, 'getAllDossiersDatatable'])->name('dossiers-clients.data');
    Route::get('dossiers/{id}', [CustomerController::class, 'show'])->name('dossiers-clients.show');
    Route::post('lignesdossier/datatable', [CustomerController::class, 'getLigneDossierADataTable'])->name('lignes-dossier-clients.data');
    Route::post('dossiers/datatable/offres', [CustomerController::class, 'getOffresDataTable'])->name('dossiers-clients.offres.data');
    Route::post('dossiers/datatable/ccdocs', [CustomerController::class, 'getCCDocsDatatable'])->name('dossiers-clients.cc-docs.data');
    Route::get('customer-consultations/show/{consultation}', [ConsultationController::class,'showCustomer'])->name('customer-consultations.show');
    Route::post('logout/', [ClientLoginController::class, 'logout'])->name('customer.logout');

    Route::get('/', [CustomerController::class, 'index'])->name('customer.home');



});
