<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IEtablissementRepository;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Validator;

class EtablissementRepository implements IEtablissementRepository
{

    public function getEtablissement()
    {
        $data = Etablissement::find("1");
        if ($data->count() == 1) {
            return response()->json($data);
        }
    }

    public function createOrUpdate($request)
    {
        $NombLigneEtb = Etablissement::all()->count();
        $id = '1';
        if ($NombLigneEtb == 0) {
            $id = null;
        } else {
            $id = '1';
        }
        if ($request->viewName == 'reglagesGeneraux') {

            $request->validate(
                [
                    'libelle' => 'required|max:45',
                    'code_pa' => 'required|max:45',
                    'code_consult' => 'required|max:45',
                    'code_ao' => 'required|max:45',
                    'matricule_fiscale' => 'max:45',
                    'email' => 'max:45',
                    'adresse' => 'max:191',
                    'responsable' => 'max:45',
                    'entete' => 'max:45'
                ],
                [
                    'libelle.required' => 'حقل اسم المؤسسة مطلوب.',
                    'libelle.max' => ' يجب أن لا يزيد اسم المؤسسة عن 45 حرفًا.',

                    'code_pa.required' => 'حقل ترقيم مشاريع الشراءات مطلوب.',
                    'code_pa.max' => ' يجب أن لا يزيد ترقيم مشاريع الشراءات عن 45 حرفًا.',

                    'code_consult.required' => 'حقل ترقيم الإستشارات مطلوب.',
                    'code_consult.max' => ' يجب أن لا يزيد ترقيم الإستشارات عن 45 حرفًا.',

                    'code_ao.required' => 'حقل ترقيم طلبات العروض مطلوب.',
                    'code_ao.max' => ' يجب أن لا يزيد ترقيم طلبات العروض عن 45 حرفًا.',

                    'matricule_fiscale.max' => ' يجب أن لا يزيد رقم التسجيل عن 45 رقماً.',
                    'email.max' => ' يجب أن لا يزيد البريد الإلكتروني عن 45 حرفًا.',
                    'adresse.max' => ' يجب أن لا يزيد العنوان عن 191 حرفًا.',
                    'responsable.max' => ' يجب أن لا يزيد اسم رئيس المؤسسة العروض عن 45 حرفًا.',
                    'entete.max' => ' يجب أن لا تزيد رأس الصفحة عن 45 حرفًا.'
                ]
            );
            Etablissement::updateOrCreate(
                ['id' => $id],
                [
                    'matricule_fiscale' => $request->matricule_fiscale,
                    'libelle' => $request->libelle,
                    'email' => $request->email,
                    'adresse' => $request->adresse,
                    'responsable' => $request->responsable,
                    'entete' => $request->entete,
                    'code_pa' => $request->code_pa,
                    'code_consult' => $request->code_consult,
                    'code_ao' => $request->code_ao,
                    'ajouter_annee' => $request->ajouter_annee,
                    'reset_code' => $request->reset_code
                ]
            );
            return back()->with('success', 'تم حفظ الإعدادات عامة بنجاح.');
        } else {
            Etablissement::updateOrCreate(
                ['id' => $id],
                [
                    'notif_validation_besoins' => $request->notif_validation_besoins,
                    'notif_pa' => $request->notif_pa,
                    'notif_duree_pa' => $request->notif_duree_pa,
                    'notif_publication_achat' => $request->notif_publication_achat,
                    'notif_duree_publication' => $request->notif_duree_publication,
                    'notif_session_op' => $request->notif_session_op,
                    'notif_duree_session_op' => $request->notif_duree_session_op,
                    'notif_date_caution_final' => $request->notif_date_caution_final,
                    'notif_duree_caution_final' => $request->notif_duree_caution_final,
                    'notif_delais_rp' => $request->notif_delais_rp,
                    'notif_duree_rp' => $request->notif_duree_rp,
                    'notif_delais_rd' => $request->notif_delais_rd,
                    'notif_duree_rd' => $request->notif_duree_rd
                ]
            );
            return back()->with('success', 'تم حفظ  إعدادات التنبيهات بنجاح.');
        }
    }
}
