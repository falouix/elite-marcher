<?php

use App\Http\Controllers\Auth\ClientLoginController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseSessionController;
use App\Http\Controllers\CaseStageController;
use App\Http\Controllers\CaseStatusController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientOfferController;
use App\Http\Controllers\ClientTypeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpensePayementController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ClientPayementController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalLinkController;
use App\Http\Controllers\HelpfulLinkController;
use App\Http\Controllers\PoaController;
use App\Http\Controllers\ProsecutionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionStatusController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//************************************************* USES FOR ROUTES SANA */
use App\Http\Controllers\BesoinController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\LigneBesoinController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SoumissionnaireController;
use App\Http\Controllers\ProjetController;
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
    ['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['XSS', 'localize', 'localizationRedirect', 'localeSessionRedirect', 'localeCookieRedirect', 'localeViewPath'],
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

Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['XSS', 'auth', 'localize', 'localizationRedirect', 'localeSessionRedirect', 'localeCookieRedirect', 'localeViewPath'],
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

//-----------------------------route bilel----------------------------
//route besoin
Route::resource('besoins',BesoinController::class);
Route::post('besoin/createOrUpdate',[BesoinController::class,'createOrUpdate'])->name('besoin.createOrUpdate');
Route::post('besoin/datatable', [BesoinController::class, 'getAllBesoinDatatable'])->name('besoin.datatable');
Route::post('besoin/edit',[BesoinController::class,'edit'])->name('besoinDataTable.edit');
Route::post('besoin/destroy',[BesoinController::class,'destroy'])->name('besoinDataTable.destroy');
Route::post('/besoins-multi-delete',[BesoinController::class,'/users-multi-delete'])->name('besoins_datatable.multidestroy');

//route ligneBesoin
Route::get('/ligneBesoin',[LigneBesoinController::class,'index'])->name('ligneBesoin');
Route::post('ligneBesoin/createOrUpdate',[LigneBesoinController::class,'createOrUpdate'])->name('ligneBesoin.createOrUpdate');
Route::post('ligneBesoin/datatable', [LigneBesoinController::class, 'getAllLigneBesoinDatatable'])->name('ligneBesoin.datatable');
Route::post('ligneBesoin/edit',[LigneBesoinController::class,'edit'])->name('ligneBesoin.edit');
Route::post('ligneBesoin/destroy',[LigneBesoinController::class,'destroy'])->name('ligneBesoin.destroy');

Route::get('/modifier_demande/1',function(){
    return view('demande_budget.edit1');
})->name('modifier_demande1');
Route::get('/modifier_demande/2',function(){
    return view('demande_budget.edit2');
})->name('modifier_demande2');

//route confirmationBudget
Route::get('/confirmationBudget', function () {return view('demande_budget.confirmationBudget');})->name('confirmationBudget');
Route::get('/confirmationDemande', function () {return view('demande_budget.confirmationDemande');})->name('confirmationDemande');
Route::post('/confirmationDemande/getBesoinSelected',[BesoinController::class,'getBesoinSelected'])->name('confirmationDemande.getBesoinSelected');

//route projet
Route::get('/projet', function () {return view('demande_budget.projet');})->name('projet');
Route::get('projet/datatable', [ProjetController::class, 'getAllProjetDatatable'])->name('projet.datatable');

//route ligneProjet
Route::get('/ligneProjet', function () {return view('demande_budget.ligneProjet');})->name('ligneProjet');

Route::get('/projet_approvisionnement', function () {
    return view('projets_approvisionnement.index');
})->name('approvisionnement');

Route::get('/projet_approvisionnement_edit/1', function () {
    return view('projets_approvisionnement.edit1');
})->name('approvisionnement_edit1');
Route::get('/projet_approvisionnement_edit/2', function () {
    return view('projets_approvisionnement.edit2');
})->name('approvisionnement_edit2');


Route::get('/Dossier_achat',function(){
    return view('Dossier_achat');
})->name('Dossier_achat');


Route::get('/confirmation_rapports', function () {
    return view('confirmation_des _rapports');
})->name('confirmation');

Route::get('/entreprendre/consultation', function () {
    return view('EntreprendreConsultation');
})->name('entrependreConsultation');

Route::get('/entreprendre/appelOffres', function () {
    return view('EntreprendreAppelOffres');
})->name('entrependreAppelOffres');

Route::get('/consulations',function(){
    return view('consultation');
})->name('consultations');

Route::get('/procédures_simplifiées',function(){
    return view('appel_offres.procédures_simplifiées');
})->name('simplifiées');

Route::get('/procédures_normales',function(){
    return view('appel_offres.procédures_normales');
})->name('normales');

Route::get('/négociations_directe',function(){
    return view('appel_offres.négociations_directes');
})->name('négociations_directes');

// route soumissionnaire
Route::get('/soumissionnaire',function(){return view('soumissionnaire');})->name('soumissionnaire');
Route::get('soumissionnaire/datatable', [SoumissionnaireController::class, 'getAllSoumissionnaireDatatable'])->name('soumissionnaire.datatable');
Route::post('soumissionnaire/createOrUpdate',[SoumissionnaireController::class,'createOrUpdate'])->name('soumissionnaire.createOrUpdate');
Route::post('soumissionnaire/edit',[SoumissionnaireController::class,'edit'])->name('soumissionnaireDataTable.edit');
Route::post('soumissionnaire/destroy',[SoumissionnaireController::class,'destroy'])->name('soumissionnaireDataTable.destroy');

Route::get('/criée_fournisseur',function(){
    return view('fournisseur.create');
})->name('create_fournisseur');

Route::get('/edit_fournisseur',function(){
    return view('fournisseur.edit');
})->name('editFournisseur');

//route reglages
Route::get('/reglages',function(){return view('etablissement.reglagesGeneraux');})->name('reglages');
Route::post('reglages/createOrUpdate',[EtablissementController::class,'createOrUpdate'])->name('reglages.createOrUpdate');
Route::get('reglages/getEtablissement',[EtablissementController::class,'getEtablissement'])->name('reglages.getEtablissement');

 Route::get('/recevoirOffres/consutation',function(){
    return view('recevoirOffres.consultation');
})->name('recevoirOffresConsultation');

Route::get('/recevoirOffres/appel_offres',function(){
    return view('recevoirOffres.appel_offres');
})->name('recevoirOffresAppelOffres');

Route::get('/ouvrirEnveloppes/consultation',function(){
    return view('ouvrirEnveloppes.consultation');
})->name('ouvrirEnveloppesConsultation');

Route::get('/ouvrirEnveloppes/appelOffres',function(){
    return view('ouvrirEnveloppes.appel_offres');
})->name('ouvrirEnveloppesAppelOffres');

Route::get('/RapportSelctionOffres/appelOffres',function(){
    return view('RapportSelectionOffres.appelOfffres');
})->name('RapportSelctionOffresAppelOffres');

Route::get('/RapportSelctionOffres/consultation',function(){
    return view('RapportSelectionOffres.consultation');
})->name('RapportSelctionOffresConsultation');

 //-----------------------------route sana----------------------------

Route::get('/dossierConsultation', function () {
    return view('dossierConsultation');
 })->name('dossierConsultation');

 Route::get('/dossierAppelOffreS', function () {
    return view('dossierAppelOffreS');
 })->name('dossierAppelOffreS');

 Route::get('/dossierAppelOffreN', function () {
    return view('dossierAppelOffreN');
 })->name('dossierAppelOffreN');

 Route::get('/dossierAppelOffreNegociationD', function () {
    return view('dossierAppelOffreNegociationD');
 })->name('dossierAppelOffreNegociationD');

//**routes dossiers d'achats : consultation**

 Route::get('/enregistrementCahierCharges', function () {
    return view('dossiers_achats.consultations.enregistrementCahierCharges');
 })->name('enregistrementCahierCharges');

 Route::get('/enregistrementPub', function () {
    return view('dossiers_achats.consultations.enregistrementPub');
 })->name('enregistrementPub');

 Route::get('/recevoirOffres', function () {
    return view('dossiers_achats.consultations.recevoirOffres');
 })->name('recevoirOffres');

 Route::get('/recevoirOffresN1', function () {
    return view('dossiers_achats.consultations.recevoirOffresN1');
 })->name('recevoirOffresN1');

 Route::get('/recevoirOffresN2', function () {
    return view('dossiers_achats.consultations.recevoirOffresN2');
 })->name('recevoirOffresN2');

 Route::get('/recevoirOffresN3', function () {
    return view('dossiers_achats.consultations.recevoirOffresN3');
 })->name('recevoirOffresN3');

 Route::get('/ouvertureEnveloppesN06', function () {
    return view('dossiers_achats.consultations.ouvertureEnveloppesN06');
 })->name('consultationOuvertureEnveloppesN06');

 Route::get('/ouvrirEnveloppes', function () {
    return view('dossiers_achats.consultations.ouvrirEnveloppes');
 })->name('ouvrirEnveloppes');

 Route::get('/enregistrementMarche', function () {
    return view('dossiers_achats.consultations.enregistrementMarche');
 })->name('enregistrementMarche');

 Route::get('/autorisationDebutTravaux', function () {
    return view('dossiers_achats.consultations.autorisationDebutTravaux');
 })->name('autorisationDebutTravaux');

 Route::get('/acceptationTemporaire', function () {
    return view('dossiers_achats.consultations.acceptationTemporaire');
 })->name('acceptationTemporaire');

 Route::get('/acceptationFinale', function () {
    return view('dossiers_achats.consultations.acceptationFinale');
 })->name('acceptationFinale');

 Route::get('/reglementFinal', function () {
    return view('dossiers_achats.consultations.reglementFinal');
 })->name('reglementFinal');

Route::get('/annulationConsultation', function () {
    return view('dossiers_achats.consultations.annulationConsultation');
 })->name('annulationConsultation');

//**routes dossiers d'achats : appel d'offres **

Route::get('/AppelOffresEnregistrementMarche', function () {
   return view('dossiers_achats.appel_offres.enregistrementMarche');
})->name('AppelOffresEnregistrementMarche');

Route::get('/AppelOffresAutorisationDebutTravaux', function () {
   return view('dossiers_achats.appel_offres.autorisationDebutTravaux');
})->name('AppelOffresAutorisationDebutTravaux');

Route::get('/AppelOffresAcceptationTemporaire', function () {
   return view('dossiers_achats.appel_offres.acceptationTemporaire');
})->name('AppelOffresAcceptationTemporaire');

Route::get('/AppelOffresAcceptationFinale', function () {
   return view('dossiers_achats.appel_offres.acceptationFinale');
})->name('AppelOffresAcceptationFinale');

Route::get('/AppelOffresReglementFinal', function () {
   return view('dossiers_achats.appel_offres.reglementFinal');
})->name('AppelOffresReglementFinal');

Route::get('/appelOffresRecevoirOffresN1', function () {
    return view('dossiers_achats.appel_offres.recevoirOffresN1');
 })->name('appelOffresRecevoirOffresN1');

 Route::get('/appelOffresOuvertureEnveloppesN04', function () {
    return view('dossiers_achats.appel_offres.ouvertureEnveloppesN04');
 })->name('appelOffresOuvertureEnveloppesN04');

 Route::get('/appelOffresEnregistrementCahierCharges', function () {
   return view('dossiers_achats.appel_offres.enregistrementCahierCharges');
})->name('appelOffresEnregistrementCahierCharges');

Route::get('/appelOffresEnregistrementPub', function () {
   return view('dossiers_achats.appel_offres.enregistrementPub');
})->name('appelOffresEnregistrementPub');

//**fin route appel d'offres**

 Route::get('/annexe', function () {
   return view('annexe');
})->name('annexe');

// route Services
Route::get('/service', function () {return view('service');})->name('service');
Route::get('service/datatable', [ServicesController::class, 'getAllServiceDatatable'])->name('service.datatable');
Route::post('service/createOrUpdate',[ServicesController::class,'createOrUpdate'])->name('service.createOrUpdate');
Route::post('service/edit',[ServicesController::class,'edit'])->name('serviceDataTable.edit');
Route::post('service/destroy',[ServicesController::class,'destroy'])->name('serviceDataTable.destroy');

// route parametreAvertissement
Route::get('/parametreAvertissement', function () {return view('etablissement.parametreAvertissement');})->name('parametreAvertissement');


        Route::get('file-upload/show/{id}/{param}', [FileUploadController::class, 'fileUploadGet'])->name('file.upload.get');
        Route::post('file-upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');
        Route::post('file-data', [FileUploadController::class, 'getAllFilesByType'])->name('files.datatable');
        Route::delete('file-delete', [FileUploadController::class, 'fileUploadDelete'])->name('files.delete');
        //Log Viewer
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    });



