<?php

namespace App\Http\Controllers;

use App\Models\DossiersAchat;
use DB;

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
        $settings =\App\Models\Etablissement::first();
        $count = \DB::table('dossiers_achats')
        ->select(\DB::raw('count(*) as count'))
        ->count();
        if($settings->ajouter_annee){
            $code = \Str::replaceFirst('{code}', str_pad($count, 4, '0', STR_PAD_LEFT), $settings->code_pa);
            $code = \Str::replaceFirst('{annee}', date('Y'), $code);
        }else{
            $code = \Str::replaceFirst('{code}', str_pad($count, 4, '0', STR_PAD_LEFT), $settings->code_pa);
        }

        dd($code);


        // get infos by current year
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

        //dd($count_dossiersGroupedConsultation);
        return view('home', compact('count_dossiersAnnuler','count_dossiersFini','count_dossiersEncours','count_dossiers', 'count_dossiersGroupedConsultation', 'count_dossiersGroupedAon', 'count_dossiersGroupedAos', 'count_dossiersGroupedGreGre'));
        /*$count_sessions = CaseSession::Select('id')->whereMonth('created_at', date('m'))
    ->whereYear('created_at', date('Y'))->count();

    $total_incomes = Income::select('amount')->whereMonth('payement_date', date('m'))
    ->whereYear('payement_date', date('Y'))
    ->sum('amount');
    $total_incomes_subMonth = Income::select('amount')->whereMonth(
    'payement_date', '=', Carbon::now()->subMonth()->month)
    ->whereYear('payement_date', date('Y'))
    ->sum('amount');
    // Client payements
    $total_payement_incomes = ClientPayement::select('payement_amount')->whereMonth('payement_date', date('m'))
    ->whereYear('payement_date', date('Y'))
    ->sum('payement_amount');
    //  إحصائيات المدفوعات الشهرية الشهر الفارط
    $total_payement_incomes_subMonth = ClientPayement::select('payement_amount')->whereMonth(
    'created_at', '=', Carbon::now()->subMonth()->month)
    ->whereYear('created_at', date('Y'))
    ->sum('payement_amount');

    // المتبقي من الدفوعات
    $total_client_credit = 0;
    if($total_incomes >= $total_payement_incomes){
    $total_client_credit = $total_incomes - $total_payement_incomes;
    }
    $total_expenses = Expense::select('expense_amount')->whereMonth('expense_date', date('m'))
    ->whereYear('expense_date', date('Y'))
    ->sum('expense_amount');
    $total_expenses_subMonth = Expense::select('expense_amount')->whereMonth(
    'expense_date', '=', Carbon::now()->subMonth()->month)
    ->whereYear('expense_date', date('Y'))
    ->sum('expense_amount');
    // Expense payements
    $total_payement_expenses = ExpensePayement::select('expense_amount')->whereMonth('payement_date', date('m'))
    ->whereYear('payement_date', date('Y'))
    ->sum('payement_amount');
    // benefits
    $benefits = $total_incomes - $total_expenses;
    $benefits_subMonth = $total_incomes_subMonth - $total_expenses_subMonth;
    //  Taux de variation (%) = 100 x (Valeur finale – Valeur initiale) / Valeur initiale
    $pourcentageIncomes = 0;
    if ($total_incomes>0) {
    $pourcentageIncomes = round(100 * ($total_incomes - $total_incomes_subMonth) / $total_incomes, 2);
    }else{
    if ($total_incomes_subMonth > $total_incomes){
    $pourcentageIncomes = -100;
    }else {
    $pourcentageIncomes = 100;
    }
    }

    $pourcentageBenefits = 0;
    if ($benefits>0) {
    $pourcentageBenefits = round(100 * ($benefits - $benefits_subMonth) / $benefits, 2);
    } else{
    if ($benefits_subMonth > $benefits){
    $pourcentageBenefits = -100;
    }else {
    $pourcentageBenefits = 100;
    }
    }
    $total_incomes_subMonth +=0;
    $total_expenses +=0;
    $total_incomes +=0;
    $total_payement_incomes +=0;
    $total_client_credit +=0;
    $total_payement_expenses +=0;
    $total_payement_incomes_subMonth +=0;
    $benefits_subMonth +=0;
    // dd($total_payement_incomes_subMonth);

    return view('home', compact('count_clients', 'count_cases', 'count_sessions', 'total_incomes',
    'total_payement_incomes', 'total_client_credit', 'total_expenses', 'total_payement_expenses',
    'total_payement_incomes_subMonth', 'total_incomes_subMonth', 'pourcentageIncomes', 'benefits', 'benefits_subMonth', 'pourcentageBenefits'));
     */
    }

    public function layout()
    {

        return view('dashboard');
    }
}
