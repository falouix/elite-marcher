<?php

namespace App\Repositories\Services;

use App\Models\{
    Notif, LignesNotif, User
};
use App\Repositories\Interfaces\INotifRepository;
use Auth;
use carbon\Carbon;
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
    public function postNotifAction($id)
    {
        $notif = Notif::find($id);
        if ($notif) {
            switch ($notif->type) {
                case 'RAPPEL':
                    self::markNotifAsRead($notif->id, 'RAPPEL');
                    break;
                case 'VALIDATION':
                    $notif->update([
                        'date_traitement' => Carbon::now(),
                        'traiter_par' => Auth::user()->id,
                        'valider' => true,
                    ]);
                    self::markNotifAsRead($notif->id, 'VALIDATION');
                    break;
                default:
                    self::markNotifAsRead($notif->id, 'MESSAGE');
                    break;
            }
        }
    }

    private function markNotifAsRead($id, $type)
    {
        $users_count = 0;
        LignesNotif::create([
            'read_at' => Carbon::now(),
            'users_ids' => Auth::user()->id,
            'notifs_id' => $id,
        ]);
        switch ($type) {
            case 'RAPPEL':
                $users_count = User::permission('notifs-rappel-action')->count();
                break;
            case 'VALIDATION':
                $users_count = User::permission('notifs-validation-action')->count();
                break;
            default:
                $users_count = User::permission('notifs-validation-action')-> count();
                break;
        }
        $users_read_notif_count = LignesNotif::where('notifs_id', $id)->count();
        Log::alert("count users read notif ".$users_read_notif_count);
        Log::alert("count users permission action notif ".$users_count);
        if (($users_count > 0 && $users_read_notif_count > 0) && ($users_count == $users_read_notif_count)) {
            Notif::find($id)->delete();
        }
    }

    public function getNotifsAxios()
    {
        $notifsRappel = null;
        if (Auth::user()->hasPermissionTo('notifs-rappel')) {
            $notifsRappel = Notif::select('*')->where('type', 'RAPPEL')->get();
        }
        $notifsValidation = null;
        if (Auth::user()->hasPermissionTo('notifs-validation')) {
            $notifsValidation = Notif::select('*')->where('type', 'VALIDATION')->get();
        }
        $notifsMessage = null;
        if (Auth::user()->hasPermissionTo('notifs-message')) {
            $notifsMessage = Notif::select('*')->where('type', 'MESSAGE')->get();
        }
        // $ntifs = Notif::select('*')->get()->groupBy('type');

        return [
            "notifsRappel" => $notifsRappel,
            "notifsValidation" => $notifsValidation,
            "notifsMessage" => $notifsMessage,
        ];
    }
    public function getNotifsCountByType()
    {
        $notifsRappel = 0;
        if (Auth::user()->hasPermissionTo('notifs-rappel')) {
            $notifsRappel = Notif::select('id')->where('type', 'RAPPEL')->count();
        }
        $notifsValidation = 0;
        if (Auth::user()->hasPermissionTo('notifs-validation')) {
            $notifsValidation = Notif::select('id')->where('type', 'VALIDATION')->count();
        }
        $notifsMessage = 0;
        if (Auth::user()->hasPermissionTo('notifs-message')) {
            $notifsMessage = Notif::select('id')->where('type', 'MESSAGE')->count();
        }
        // $ntifs = Notif::select('*')->get()->groupBy('type');
        Log::emergency([
            "notifsRappelCount" => $notifsRappel,
            "notifsValidationCount" => $notifsValidation,
            "notifsMessageCount" => $notifsMessage,
        ]);
        return [
            "notifsRappelCount" => $notifsRappel,
            "notifsValidationCount" => $notifsValidation,
            "notifsMessageCount" => $notifsMessage,
        ];
    }
    public function getAllNotifByUser()
    {
        if (Auth::user()->user_type == "admin") {
            $query = Notif::withTrashed();
        } else {
            $query = Notif::select('*');
        }
        $dataAction = "notifs.datatable-actions";

        $query->orderByDesc('type');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('type_notif', function ($article) {
                switch ($article->type) {
                    case 'VALIDATION':
                        # code...

                    return '<label class="badge badge-danger">إشعارات مهام</label>';
                        case 'RAPPEL':
                            # code...
                    return '<label class="badge badge-success">إشعارات تذكير</label>';

                    default:
                        # code...
                    return '<label class="badge badge-info">إشعارات أخرى</label>';

                }
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'type_notif', 'action'])
            ->make(true);
    }

    public function GenererNotif($newNotif)
    {
        Log::alert("Generate Notif from repository");
        $notif = Notif::create([
            'type' => $newNotif->type,
            'texte' => $newNotif->texte,
            'from_table' => $newNotif->from_table,
            'from_table_id' => $newNotif->from_table_id,
            'users_id' => $newNotif->users_id,
            'action' => $newNotif->action,
            'valider' => false,
        ]);
        return $notif;
    }
    // Delete Existant Notif and generate new notif
    // exemple : lors de la modification des dates (date avis prevu : cahier des charges)
    public function updateNotif($notifToUpdate)
    {
        Log::alert("Generate Update Notif from repository");
        self::deleteNotif($notifToUpdate->from_table, $notifToUpdate->from_table_id);
        return self::GenererNotif($notifToUpdate);
    }
    public function ArchiverNotif($start_date, $end_date)
    {
        return "";
    }
    public function GetArchiveNotif()
    {
        return "";
    }
    public function deleteNotif($from_table, $from_table_id)
    {
        Notif::where('from_table', $from_table)->where('from_table_id', $from_table_id)->first()->delete();
    }

}
