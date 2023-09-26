<?php

namespace App\Repositories\Services;

use App\Models\{Notif, LignesNotif, User};
use App\Repositories\Interfaces\INotifRepository;
use Auth;
use carbon\Carbon;
use Log;

class NotifRepository implements INotifRepository
{
    public function create($request)
    {
        Log::alert('Create Notif Request repository');
        Log::info($request['libelle']);
        // dd($request);
        //dd($request['date_Notif']);
        $Notif = Notif::create($request);
        return $Notif;
    }
    public function postNotifAction($id, $mode='user')
    {
        Log::alert("Mode Notif Action : ".$mode);
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
            // Mark As Read For All Users if Mode is Admin
            if((Auth::user()->user_type == 'admin') && $mode =='admin'){
                Notif::find($id)->delete();
            }
        }
    }

    private function markNotifAsRead($id, $type)
    {
        LignesNotif::create([
            'read_at' => Carbon::now(),
            //'date_traitement' => Carbon::now(),
            'users_ids' => Auth::user()->id,
            'notifs_id' => $id,
        ]);
        $users_count = 0;
        switch ($type) {
            case 'RAPPEL':
                $users_count = User::permission('notifs-rappel-action')->count();
                break;
            case 'VALIDATION':
                $users_count = User::permission('notifs-validation-action')->count();
                break;
            default:
                $users_count = User::permission('notifs-validation-action')->count();
                break;
        }
        $users_read_notif_count = LignesNotif::where('notifs_id', $id)->count();
        Log::alert('count users read notif ' . $users_read_notif_count);
        Log::alert('count users permission action notif ' . $users_count);
        if ($users_count > 0 && $users_read_notif_count > 0 && $users_count == $users_read_notif_count) {
            Notif::find($id)->delete();
        }
    }

    public function getNotifsAxios()
    {
        $notifsRappel = null;
        if (Auth::user()->user_type != 'admin') {
            if (Auth::user()->hasPermissionTo('notifs-rappel')) {
                $notifsRappel = Notif::select('*')
                    ->where('type', 'RAPPEL')
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
            $notifsValidation = null;
            if (Auth::user()->hasPermissionTo('notifs-validation')) {
                $notifsValidation = Notif::select('*')
                    ->where('type', 'VALIDATION')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
            $notifsMessage = null;
            if (Auth::user()->hasPermissionTo('notifs-message')) {
                $notifsMessage = Notif::select('*')
                    ->where('type', 'MESSAGE')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
        } else {
            if (Auth::user()->hasPermissionTo('notifs-rappel')) {
                $notifsRappel = Notif::select('*')
                    ->where('type', 'RAPPEL')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
            $notifsValidation = null;
            if (Auth::user()->hasPermissionTo('notifs-validation')) {
                $notifsValidation = Notif::select('*')
                    ->where('type', 'VALIDATION')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
            $notifsMessage = null;
            if (Auth::user()->hasPermissionTo('notifs-message')) {
                $notifsMessage = Notif::select('*')
                    ->where('type', 'MESSAGE')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->get();
            }
        }

        // $ntifs = Notif::select('*')->get()->groupBy('type');

        return [
            'notifsRappel' => $notifsRappel,
            'notifsValidation' => $notifsValidation,
            'notifsMessage' => $notifsMessage,
        ];
    }
    public function getNotifsCountByType()
    {
        $notifsRappel = 0;
        $notifsValidation = 0;
        $notifsMessage = 0;
        if (Auth::user()->user_type != 'admin') {
            if (Auth::user()->hasPermissionTo('notifs-rappel')) {
                $notifsRappel = Notif::select('id')
                    ->where('type', 'RAPPEL')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }

            if (Auth::user()->hasPermissionTo('notifs-validation')) {
                $notifsValidation = Notif::select('id')
                    ->where('type', 'VALIDATION')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }

            if (Auth::user()->hasPermissionTo('notifs-message')) {
                $notifsMessage = Notif::select('id')
                    ->where('type', 'MESSAGE')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('user_service', Auth::user()->services_id)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }
        } else {
            if (Auth::user()->hasPermissionTo('notifs-rappel')) {
                $notifsRappel = Notif::select('id')
                    ->where('type', 'RAPPEL')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }

            if (Auth::user()->hasPermissionTo('notifs-validation')) {
                $notifsValidation = Notif::select('id')
                    ->where('type', 'VALIDATION')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }

            if (Auth::user()->hasPermissionTo('notifs-message')) {
                $notifsMessage = Notif::select('id')
                    ->where('type', 'MESSAGE')
                    ->where('user_group', Auth::user()->user_type)
                    ->where('read_at','<=',Carbon::now()->format('Y-m-d'))
                    ->count();
            }
        }

        // $ntifs = Notif::select('*')->get()->groupBy('type');
        Log::emergency([
            'notifsRappelCount' => $notifsRappel,
            'notifsValidationCount' => $notifsValidation,
            'notifsMessageCount' => $notifsMessage,
        ]);
        return [
            'notifsRappelCount' => $notifsRappel,
            'notifsValidationCount' => $notifsValidation,
            'notifsMessageCount' => $notifsMessage,
        ];
    }
    public function getAllNotifByUser()
    {
        if (Auth::user()->user_type == 'admin') {
            $query = Notif::withTrashed();
        } else {
            $query = Notif::withTrashed()
                ->where('user_group', Auth::user()->user_type)
                ->where('user_service', Auth::user()->services_id)
                ->where('read_at','<=',Carbon::now()->format('Y-m-d'));
        }
        $dataAction = 'notifs.datatable-actions';

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
    public function getLignesNotifByNotif($notif_id)
    {
        if (Auth::user()->user_type == 'admin') {
            $query = LignesNotif::select('*')->where('notifs_id', $notif_id);
        }
        else{
            $query = LignesNotif::select('*')->where('notifs_id', $notif_id)->where('users_ids',Auth::user()->id);
        }
        Log::info($query->get());
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('user_name', function ($article) {
                $user = User::select('name')->where('id', $article->users_ids)->first();
                return $user->name ?? '';
            })
            ->rawColumns(['id', 'user_name'])
            ->make(true);
    }


    public function GenererNotif($newNotif)
    {
        Log::alert('Generate Notif from repository');
        $notif = Notif::create([
            'type' => $newNotif->type,
            'texte' => $newNotif->texte,
            'from_table' => $newNotif->from_table,
            'from_table_id' => $newNotif->from_table_id,
            'users_id' => $newNotif->users_id,
            'user_group' => Auth::user()->user_type,
            'user_service' => Auth::user()->services_id,
            'action' => $newNotif->action,
            'read_at' => ($newNotif->read_at ?? Carbon::now()->format('Y-m-d')),
            'valider' => false,
        ]);
        return $notif;
    }
    // Delete Existant Notif and generate new notif
    // exemple : lors de la modification des dates (date avis prevu : cahier des charges)
    public function updateNotif($notifToUpdate)
    {
        Log::alert('Generate Update Notif from repository');
      self::deleteNotif($notifToUpdate->from_table, $notifToUpdate->from_table_id);
        return self::GenererNotif($notifToUpdate);
    }
    public function ArchiverNotif($start_date, $end_date)
    {
        return '';
    }
    public function GetArchiveNotif()
    {
        return '';
    }
    public function deleteNotif($from_table, $from_table_id)
    {
        if (isset($from_table) && isset($from_table_id)){
            Notif::where('from_table', $from_table)
            ->where('from_table_id', $from_table_id)
            ->delete();
        }

    }
}
