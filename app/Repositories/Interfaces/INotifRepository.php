<?php
namespace App\Repositories\Interfaces;

interface INotifRepository
{
    public function getAllNotifByUser(); // Return datatable ( if admin get all)
    public function getLignesNotifByNotif($notif_id); // Return datatable
    public function getNotifsAxios(); // Liste notifs Axios VueJs
    public function getNotifsCountByType(); // Count notifs for desktop notification by type

    public function postNotifAction($id);
    public function GenererNotif($newNotif);
    public function updateNotif($notifToUpdate);
    public function ArchiverNotif($start_date, $end_date);
    public function GetArchiveNotif();
    public function deleteNotif($from_table, $from_table_id);
}
