<?php 
namespace App\Repositories;

interface IUserRepository{
	
	public function create($user);
	public function update($request, $id);
    public function login($request);
	public function forgotPwd($request);
	public function updatePwd($request);
	public function logout();

	public function getAllUser($AuthUser); // return datatable
	public function getAllUserByType($type);  // return datatables
	public function getUserByEmail($email);
	public function getUserByToken($token);
	public function updateUserPwdByToken($token, $newPwd);
	public function update_profile($request, $user_id);
	public function Change_password($request, $user_id, $hashedPassword);
	public function getUserByParam($key, $value);
	public function userHasActivities($id);
	public function destroy($id);
	public function multiDestroy($ids);
	public function getAllLawyerToSelect($term);
	public function getAllUserByTypeToSelect($term,$type);
	


	// more
}