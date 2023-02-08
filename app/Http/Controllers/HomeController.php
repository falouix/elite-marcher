<?php

namespace App\Http\Controllers;

use App\Models\DossiersAchat;
use App\Models\Offres;
use App\Models\AvisDossier;
use DB;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:appointement-list|dashboard-list|statistic-list', ['only' => ['index', 'layout']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cc = \App\Models\CahiersCharge::find(5)->first();

        $dateavis = Carbon::createFromFormat('Y-m-d', $cc->date_pub_prevu);

        $read_at = $dateavis->subDays(10)->format('Y-m-d');
        dd($read_at);
        // get infos by current year
        //dd(Carbon::now()->subDays(30)->format('d-m-Y'));
        $annee_gestion = strftime('%Y');
        $count_dossiers = DossiersAchat::Select('id')->where('annee_gestion', $annee_gestion)->count();
        $count_dossiersEncours = DossiersAchat::Select('id')
            ->where('situation_dossier', 4)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        $count_dossiersFini = DossiersAchat::Select('id')
            ->where('situation_dossier', 7)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        $count_dossiersAnnuler = DossiersAchat::Select('id')
            ->where('situation_dossier', 8)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        // 1 :
        $count_dossiersGroupedConsultation = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('type_dossier', 'CONSULTATION')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedAon = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('type_dossier', 'AON')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedAos = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('type_dossier', 'AOS')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedGreGre = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('type_dossier', 'AOGREGRE')
            ->groupBy('situation_dossier')
            ->get();
      //  return view('pdf.ppm');
        //dd($count_dossiersGroupedConsultation);
        return view('home', compact('count_dossiersAnnuler','count_dossiersFini','count_dossiersEncours','count_dossiers', 'count_dossiersGroupedConsultation', 'count_dossiersGroupedAon', 'count_dossiersGroupedAos', 'count_dossiersGroupedGreGre'));
    }

    public function layout()
    {

        return view('dashboard');
    }
}
