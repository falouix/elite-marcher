<?php

namespace App\Traits;

use Carbon\Carbon;

trait ApiResponser{

	protected function token($personalAccessToken, $message = null, $data = null, $code = 200)
	{
		$tokenData = [

			'access_token' => $personalAccessToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($personalAccessToken->token->expires_at)->toDateTimeString(),
			'user' =>$data
		];

		return $this->success($tokenData, $message, $code);
	}

    protected function success($data, $message = null, $code = 200)
	{
		return response()->json([
			'status'=> 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	protected function error($message = null, $code = 403)
	{
		return response()->json([
			'status'=>'Error',
			'message' => $message,
			'data' => null
		], $code);
	}

	protected function notify($title, $message = null, $type = 'success', $rtl = true, $data = null)
	{
		return response()->json([
			'title'=> $title,
			'message' => $message,
			'type' => $type,
			'rtl' => $rtl,
            'data' => $data,
		]);
	}

	protected function notifyArr($title, $message = null, $type = 'success', $rtl = true)
	{
		return \json_encode(array(
			'title'=> $title,
			'message' => $message,
			'type' => $type,
			'rtl' => $rtl
		));
	}



}
