<?php

namespace App\Repositories\Services;

use App\Models\Notif;
use App\Repositories\Interfaces\INotifRepository;
use carbon\Carbon;
use Auth;
use Log;

class NotifRepository implements INotifRepository
{
    public function create($request)
    {
        Log::alert("Create Notif Request repository");
        Log::info($request['libelle']);
        // dd($request);
        //dd($request['date_Notif']);
        $Notif = Notif::create($request);
        return $Notif;
    }

    public function markNotifAsRead($id)
    {
        $input = $request->all();
        $Notif = Notif::find($id);
        $Notif->update([
            'read_at'=> Carbon::now()
        ]);
        return $Notif;
    }
    public function markNotifAsTraited($id)
    {
        $input = $request->all();
        $Notif = Notif::find($id);
        $Notif->update([
            'date_traitement'=> Carbon::now(),
            'traiter_par'=>Auth::user()->id
        ]);
        return $Notif;
    }

    public function getAllNotifByUser($user)
    {
        $dataAction = "notifs.notif-actions";
            $query = Notif::select('*')->where('');
            if($type){
                $query->where('natures_demande_id',$type);
            }
            $query->orderByDesc('libelle');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('status', function ($article) {
                if ($article->valider == true) {
                    return '<label class="badge badge-success">مفعل</label>';
                } else {
                    return '<label class="badge badge-info">غير مفعل</label>';
                }
                return '<label class="badge badge-info">غير مفعل</label>';
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'status', 'action'])
            ->make(true);
    }

    public function GenererNotif($type, $texte, $from_table, $from_table_id, $users_id, $action){
        Log::alert("Generate Notif from repository");
        $notif = Notif::create([
            'type'=> $type,
            'texte'=> $texte,
            'from_table'=> $from_table,
            'from_table_id'=> $from_table_id,
            'users_id'=> $users_id,
            'action'=> $action,
            'valider'=> false,
        ]);
        return $notif;
    }


}
