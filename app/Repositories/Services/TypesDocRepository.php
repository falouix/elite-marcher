<?php

namespace App\Repositories\Services;

use App\Models\TypesDoc;
use App\Repositories\Interfaces\ITypesDocRepository;
use carbon\Carbon;
use Log;

class TypesDocRepository implements ITypesDocRepository
{
    public function create($request)
    {
        Log::alert("Create TypeDoc Request repository");
        Log::info($request['libelle']);
        // dd($request);
        //dd($request['date_Article']);
        $Article = TypesDoc::create($request);
        return $Article;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $Article = TypesDoc::find($id);
        $Article->update($input);
        return $Article;
    }

    public function getAllTypesDoc()
    {
        $dataAction = "types_docs.datatable-actions";
            $query = TypesDoc::select('*');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('type_doc', function ($typesDoc) {
                $typeDocLibelle = "";
                switch ($typesDoc->type_doc) {
                    case 'RECEPTION_OFFRES':
                        $typeDocLibelle = "وصول العروض";
                        break;
                        case 'SESSION_OP':
                            $typeDocLibelle ="جلسات فتح الظروف";
                            break;
                            case 'COM_OPTECH':
                                $typeDocLibelle ="جلسات الفرز";
                            break;
                            case 'ENGAGEMENT':
                                $typeDocLibelle ="إسناد الصفقة";
                            break;
                            case 'ENREGISTREMENT':
                                $typeDocLibelle ="تسجيل الصفقة";
                            break;
                            case 'ORDRE_SERVICE':
                                $typeDocLibelle ="إذن بداية الأشغال";
                            break;
                            case 'RECEPTIONDEFINITIVE':
                                $typeDocLibelle ="القبول النهائي";
                            case 'RECEPTIONPROVISOIRE':
                                $typeDocLibelle ="القبول الوقتي";
                            break;
                            case 'CLOTURE':
                                $typeDocLibelle ="التسوية النهائية";
                            break;
                            case 'ANNULATION':
                                $typeDocLibelle ="إلغاء الصفقة";
                            break;
                }
                return $typeDocLibelle;
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'action'])
            ->make(true);
    }

    public function destroy($id)
    {
        TypesDoc::find($id)->delete();
    }
    public function multiDestroy($ids){
        TypesDoc::whereIn('id', $ids)->delete();
    }

}
