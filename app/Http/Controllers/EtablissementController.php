<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
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
        $etablissement = Etablissement::find(1);
        return view('etablissements.index', compact('etablissement'));
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
        /* $this->validate($request, [
        'file' => 'file|mimes:jpg,jpeg,bmp,png',
        ]);*/
        $settings = Etablissement::first();
        $mode = 'create';
        if ($settings) {
            $mode = 'update';
        }
        //dd($request->file);
        $input = $request->all();
        switch ($mode) {
            case 'update':
                Etablissement::first()->update($input);
                break;
            default:
            Etablissement::create($input);
                break;
        }
         $notification = $this->notifyArr('ظبط إعدادات النظام', '!تم ظبط إعدادات النظام بنجاح', 'success', true);


        return redirect()->route('etablissements.index')
            ->with('notification', $notification);
    }
}
