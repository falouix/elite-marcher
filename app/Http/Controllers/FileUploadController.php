<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\IFileUploadRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Storage;
use File;
use Illuminate\Support\Facades\Response;

class FileUploadController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IFileUploadRepository $repository)
    {
        $this->repository = $repository;
        //$this->middleware('auth');

    }

    public function fileUploadGet($id, $param)
    {
      // dd($param);
        $file = $this->repository->getfileById($id, $param);
        //dd($this->repository->getFileByPath($file->path));
        //dd($file);
        if($file){
            switch ($param) {
                case 'poa_docuements':
                    $path = storage_path($file->poa_file_path);
                    break;

                case 'legal_links':
                    $path = storage_path($file->url);
                    break;

                default:
                $path = storage_path($file->path);
                    break;
            }
           /*  if ($param =="poa_docuements"){
                $path = storage_path($file->poa_file_path);
            }else{
                $path = storage_path($file->path);
            } */
            //$path = storage_path('app/documents/' . $file->path);
            try {
                $filer = File::get($path);
                $type = File::mimeType($path);
                $response = Response::make($filer, 200);
                $response->header("Content-Type", $type);
                return $response;
            } catch (FileNotFoundException $exception) {
                abort(404);
            }
            //return $this->repository->getFileByPath($file->path);
        }
         abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            'file_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        if ($request->ajax()) {
            $file = $this->repository->fileUploadPost($request);

            $locale = LaravelLocalization::getCurrentLocale();

            /* Store $fileName name in DATABASE from HERE */
            switch ($request->path) {
                case 'user_documents':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('User Document', ' User document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للمستخدم', 'تم إضافة ملف للمستخدم بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'User document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للمستعمل', 'خطأ', 'error');

                    break;
                case 'case_documents':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('Case Document', ' Case document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للقضية', 'تم إضافة ملف للقضية بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'Case document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للقضية', 'خطأ', 'error');

                    break;
                case 'session_docuements':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('Session Document', ' Session document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للجلسة', 'تم إضافة ملف للجلسة بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'Session document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للجلسة', 'خطأ', 'error');

                    break;

                case 'prosecution_docuements':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('Prosecution Document', ' Prosecution document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للدعوى', 'تم إضافة ملف للدعوى بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'Case document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للدعوى', 'خطأ', 'error');

                    break;

                case 'event_docuements':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('ُAppointement Document', ' ُAppointement document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للموعد', 'تم إضافة ملف للموعد بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'ُAppointement document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للموعد', 'خطأ', 'error');

                    break;
                case 'poa_docuements':
                    if ($file) {
                        if ($locale == 'en') {
                            return $this->notify('POA Document', ' POA document added successfully!', 'success', false);
                        }
                        return $this->notify('إضافة ملف للتوكيل', 'تم إضافة ملف للتوكيل بنجاح');
                    }
                    if ($locale == 'en') {
                        return $this->notify('Error', 'POA document upload error!', 'error', false);
                    }
                    return $this->notify('خطأ عند إضافة ملف للتوكيل', 'خطأ', 'error');

                    break;
            }
        }

    }

    public function fileUploadDelete(Request $request)
    {

        $locale = LaravelLocalization::getCurrentLocale();
        $file =  $this->repository->getfileById($request->id, $request->param);

        Log::alert('dddddddddd');
        Log::alert($request);
        Log::info($file);

        if ($file){
            Log::info("here im");
             $this->repository->fileUploadDelete($file->path);
             $this->repository->deleteRecordByFileType($request->id, $request->param);
            Log::info("here im". $file->path);
            if ($locale == 'en') {
                return $this->notify('Delete Document', ' Document deleted successfully!', 'success', false);
            }
            return $this->notify('حذف ملف ', 'تم حذف ملف  بنجاح');
        }
        if ($locale == 'en') {
            return $this->notify('Delete', 'Error when deleting file', 'error', false);
        }
        return $this->notify('خطأ', 'حدث خظأ عند الحذف الرجاء إعادة المحاولة','error');

    }
    public function getAllFilesByType(Request $request){
        Log::info($request);
        return $this->repository->getAllFilesByType($request->id, $request->param);
    }
}
