<?php
namespace App\Repositories;

interface IFileUploadRepository
{
    public function fileUploadPost(Request $request);
    // return datatable by Type docs (user_docs, case_docs...)
    public function getAllFilesByType($id, $param = "user_documents", $permission ="all");

    public function fileUploadDelete($path);
    public function getFileByPath($file);
    public function getfileById($id, $param);
    public function deleteRecordByFileType($id, $param);

}
