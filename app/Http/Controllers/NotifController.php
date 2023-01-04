<?php

namespace App\Http\Controllers;

use App\Models\Notif;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\INotifRepository;
use App\Traits\ApiResponser;
use Auth;
use Log;

class NotifController extends Controller
{
    use ApiResponser;
    public function __construct(INotifRepository $repository)
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
        return view("notifs.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function show(Notif $notif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function edit(Notif $notif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notif $notif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notif  $notif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notif $notif)
    {
        //
    }

    // Axios & VueJs getNotifs
    public function getNotifs(){
        return $this->repository->getNotifsAxios();
    }
    public function postNotifAction(Request $request){
        Log::info("Contenu de notification from axios view");
        $this->repository->postNotifAction($request->notifs_id);
        return $this->notify('تثبيت الإشعار', 'تم تثبيت الإشعار مع وضع علامة مقروءة بالنسبة للمستعمل الحالي');
    }
    public function postNotifDesktop(){
        return $this->repository->getNotifsCountByType();
    }


}
