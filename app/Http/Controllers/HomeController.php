<?php

namespace App\Http\Controllers;

use App\Models\CaseSession;
use App\Models\Client;
use App\Models\ClientPayement;
use App\Models\Expense;
use App\Models\ExpensePayement;
use App\Models\Income;
use App\Models\MCase;
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


        return view('home');
    }

    public function layout()
    {

        return view('dashboard');
    }
}
