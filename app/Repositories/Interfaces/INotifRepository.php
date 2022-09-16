<?php
namespace App\Repositories\Interfaces;

interface INotifRepository
{
    public function getAllNotifByUser($user); // Return datatable ( if admin get all)
    //public function getAllNotifValidationByUser($user); // Liste notifs à valider
    public function markNotifAsRead($noifId);
    public function markNotifAsTraited($noifId);
    public function GenererNotif($type, $texte, $from_table, $from_table_id, $users_id, $action);
}
