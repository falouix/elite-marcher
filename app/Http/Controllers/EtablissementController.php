<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Models\Periodes;

use App\Repositories\Interfaces\IEtablissementRepository;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Common\Utility;

class EtablissementController extends Controller
{

    use ApiResponser;
    public function __construct(IEtablissementRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodes = Periodes::select('*')->get();
        $etablissement = Etablissement::first();
        return view('etablissements.index', compact('etablissement','periodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         // Prevent XSS Attack
        Utility::stripXSS($request);
        $settings = Etablissement::first();
        $mode = 'create';
        if ($settings) {
            $mode = 'update';
        }
        $input = $request->all();
       // dd($input);
       //dd($request->all());die();
       Periodes::where('type', $request->type_periode)
       ->update([
        'periodeavisprvu' => $request->periodeavisprvu,
           'periode_ordre_serv_prvu' => $request->periode_ordre_serv_prvu,
           'periode_avis_soumissionaire_prvu' => $request->periode_avis_soumissionaire_prvu,
           'periode_pub_reslt_prvu' => $request->periode_pub_reslt_prvu,
           'periode_repca_prvu' => $request->periode_repca_prvu,
           'periode_trsfert_cao_prvu' => $request->periode_trsfert_cao_prvu,
           'periode_trsfert_ca_prvu' => $request->periode_trsfert_ca_prvu,
           'periode_op_prvu' => $request->periode_op_prvu,
           'periode_cc_prvu' => $request->periode_cc_prvu
       ]);
       if($input["notif_duree_session_op"]==""){
        $input["notif_duree_session_op"] = 0;
       }
       if($input["notif_duree_caution_provisoire"]==""){
        $input["notif_duree_caution_provisoire"] = 0;
       }
       if($input["notif_duree_caution_final"]==""){
        $input["notif_duree_caution_final"] = 0;
       }
       if($input["notif_duree_rp"]==""){
        $input["notif_duree_rp"] = 0;
       }
       if($input["notif_duree_rd"]==""){
        $input["notif_duree_rd"] = 0;
       }

        (isset($input["ajouter_annee"]) && $input["ajouter_annee"] == "on") ? $input["ajouter_annee"] ="1" : $input["ajouter_annee"] ="0";
        (isset($input["reset_code"]) && $input["reset_code"] == "on") ? $input["reset_code"] ="1" : $input["reset_code"] ="0";
        (isset($input["notif_validation_besoins"]) && $input["notif_validation_besoins"] == "on") ? $input["notif_validation_besoins"] ="1" : $input["notif_validation_besoins"] ="0";
        (isset($input["notif_cc"]) && $input["notif_cc"] == "on") ? $input["notif_cc"] ="1" : $input["notif_cc"] ="0";
        (isset($input["notif_avis_pub"]) && $input["notif_avis_pub"] == "on") ? $input["notif_avis_pub"] ="1" : $input["notif_avis_pub"] ="0";
        (isset($input["notif_session_op"]) && $input["notif_session_op"] == "on") ? $input["notif_session_op"] ="1" : $input["notif_session_op"] ="0";
        (isset($input["notif_caution_provisoire"]) && $input["notif_caution_provisoire"] == "on") ? $input["notif_caution_provisoire"] ="1" : $input["notif_caution_provisoire"] ="0";
        (isset($input["notif_date_caution_final"]) && $input["notif_date_caution_final"] == "on") ? $input["notif_date_caution_final"] ="1" : $input["notif_caution_final"] ="0";
        (isset($input["notif_delais_rp"]) && $input["notif_delais_rp"] == "on") ? $input["notif_delais_rp"] ="1" : $input["notif_delais_rp"] ="0";
        (isset($input["notif_delais_rd"]) && $input["notif_delais_rd"] == "on") ? $input["notif_delais_rd"] ="1" : $input["notif_delais_rd"] ="0";
       // $input["notif_publication_achat"] == "on" ? $input["notif_publication_achat"] ="1" : $input["notif_publication_achat"] ="0";
         //dd($input);
        // dd(Etablissement::find(1)->update($input));
        switch ($mode) {
            case 'update':
                Etablissement::first()->update($input);

            default:
            Etablissement::create($input);

        }
         $notification = $this->notifyArr('ظبط إعدادات النظام', '!تم ظبط إعدادات النظام بنجاح', 'success', true);
        return redirect()->route('etablissements.index')
            ->with('notification', $notification);
    }
}
