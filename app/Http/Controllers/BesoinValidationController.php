<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\LignesBesoin;
use App\Models\Service;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IBesoinRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class BesoinValidationController extends Controller
{
    use ApiResponser;
    public function __construct(IBesoinRepository $repository, IFileUploadRepository $fileRepository)
    {
        $this->repository = $repository;
        $this->fileRepository = $fileRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::select('id', 'libelle')->get();
        return view('besoins.validation.index', compact('services'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'file' => 'file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'date_besoin' => 'required',
            'annee_gestion' => 'required|max:4|min:4',
        ]);
        $besoin = $this->repository->create($request->all());
        if ($besoin) {
            if ($request->ligne_besoin) {
                // create LigneBesoin if Besoin exists
                foreach (json_decode($request->ligne_besoin) as $item) {
                    $ligneBesoin = LignesBesoin::create([
                        'libelle' => $item[0],
                        'qte_demande' => $item[1],
                        'cout_unite_ttc' => $item[2],
                        'cout_total_ttc' => $item[3],
                        'besoins_id' => $besoin->id,
                    ]);
                    // dd($rpis);
                }
            }
            $request['path'] = "besoin_documents";
            $request['besoins_id'] = $besoin->id;
            $file = $this->fileRepository->fileUploadPost($request);

        }
        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $notification = $this->notifyArr('Success [create new Client]', 'Client created successfully!', 'success', false);
        } else {
            $notification = $this->notifyArr('إضافة الحاجيات', '!تم إضافة الحاجيات بنجاح', 'success', true);
        }

        return redirect()->route('besoins.index')
            ->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $besoin = $this->repository->getBesoinByParam('id', $id);
        $userService = Service::select('*')->where('id', $besoin->services_id)->first();

        return view('besoins.validation.edit', compact('userService', 'besoin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date_besoin' => 'required|date',
            'annee_gestion' => 'required|min:4|max:4',
        ]);
        $user = $this->repository->update($request, $id);
        /*$locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            $notification = $this->notifyArr('Success [Update Client]', 'Client updated successfully!', 'success', false);
        } else {
            */
            $notification = $this->notifyArr('', '!تم تحيين ضبط الحاجيات بنجاح', 'success', true);
        //}

        return redirect()->route('besoins-validation.index')
            ->with('notification', $notification);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validerBesoin($id)
    {
        Log::info("Validation besoin " .$id);
        $this->repository->validerBesoin($id);
        $locale = LaravelLocalization::getCurrentLocale();
        /*if (session()->has('delete_error')) {
        if ($locale == 'en') {
        return $this->notify('Error', 'ِِOnly Clients without relations can be deleted', 'error', false);
        } else {
        return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف عميل له تسجيلات مرتبطة');
        }
        }*/
        if ($locale == 'en') {
            return $this->notify('Notification', 'ِِClient deleted successfully', 'success', false);
        }
        return $this->notify('المصادقة على الحاجيات', 'تمت المصادقة على الحاجيات  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        $locale = LaravelLocalization::getCurrentLocale();
        /*if (session()->has('delete_error')) {
        if ($locale == 'en') {
        return $this->notify('Error', 'ِِOnly Clients without relations can be deleted', 'error', false);
        } else {
        return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف عميل له تسجيلات مرتبطة');
        }
        }*/
        if ($locale == 'en') {
            return $this->notify('Notification', 'ِِClient deleted successfully', 'success', false);
        }
        return $this->notify('حذف الحاجيات', 'تم حذف الحاجيات  بنجاح');
    }
    //return besoin selected
    public function getBesoinSelected(Request $request)
    {
        $data = Besoin::find($request->id);
        return Response()->json($data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBesoinDatatable(Request $request)
    {
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getAllBesoin($request->services_id, $request->start_date, $request->end_date, $request->status, $request->mode);
        }
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneBesoinsByBesoin(Request $request)
    {
        Log::info("controller");
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getLigneBesoinsByBesoin($request->besoins_id, $request->mode);
        }
    }
    public function multidestroy(Request $request)
    {
        Log::info($request->ids);
        $this->repository->multiDestroy($request->ids);

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('User delete', ' User(s) deleted successfully!', 'success', false);
        }
        return $this->notify('!حذف مستعمل', 'تم حذف المستعمل(ين) بنجاح');
    }

    // Edit Ligne Besoin from table
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editLigneBesoin(Request $request)
    {
        if ($request->ajax()) {
            return LignesBesoin::select('*')->where('id', $request->id)->first();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLigneBesoin(Request $request)
    {

        Log::info("Store Ligne besoin");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
        ]);
        Log::info($validator->errors());
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        $locale = LaravelLocalization::getCurrentLocale();
        if ($request->ajax()) {
            Log::info("Store Ligne besoin ضتضء");
            Log::info($request);
            $ligneBesoin = LignesBesoin::create([
                'libelle' => $request->libelle,
                'qte_demande' => $request->qte_demande,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->cout_total_ttc,
                'besoins_id' => $request->besoins_id,
            ]);
            if ($locale == 'en') {
                return $this->notify('Success [Add new Party]', 'New Party added successfully!', 'success', false);
            }
            return $this->notify('ضبط الحاجيات', '!تم إضافة مادة جديدة للحاجيات بنجاح', 'success', true);
        } else {
            if ($locale == 'en') {
                return $this->notify('Error', 'New Party added successfully!', 'error', false);
            }
            return $this->notify('ضبط الحاجيات', '!خطأ داخلي الرجاء إعادة المحاولة', 'error', true);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CasePartie  $pris
     * @return \Illuminate\Http\Response
     */
    public function updateLigneBesoin(Request $request)
    {
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            // 'pr_mail' => 'required|email|unique:pris,pr_mail,' . $request->id,
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
        if ($request->ajax()) {
            $locale = LaravelLocalization::getCurrentLocale();
            LignesBesoin::find($request->id)->update([
                'libelle' => $request->libelle,
                'qte_demande' => $request->qte_demande,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->cout_total_ttc,
            ]);
            if ($locale == 'en') {
                return $this->notify('Client Party update', 'Client Party updated successfully!', 'success', false);
            }
            return $this->notify('ضبط الحاجيات', '!تم تحيين للحاجيات بنجاح', 'success', true);
        } else {
            if ($locale == 'en') {
                return $this->notify('Client Party update Error', 'ِClient Party update error!', 'error', false);
            }
            return $this->notify('!  خطأ', 'خطأ عند تحيين الحاجيات', 'error');
        }

    }

    public function destroyLigneBesoin(Request $request)
    {
        LignesBesoin::find($request->id)->delete();
        /*$locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('Notification', 'ِِClient Contact deleted successfully', 'success', false);
        }
        */
        return $this->notify('ضبط الحاجيات', 'تم حذف المادة من الحاجيات بنجاح');
        // return $this->notify('حذف عميل',  session()->get('delete_error'));
    }
}
