<?php
namespace App\Helpers\Response;

class ResponseHelper {

    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function getResponse($data, $error_code, $errors) {

        $subarray = [];
        foreach ($errors as $key => $value) {
            $subarray[] = $value[0];
        }
        $errorMessage = implode(',', $subarray);
        return response()->json([
            'data' => $data,
            'error_code' => $error_code,
            "message" => $errorMessage 
                ], 200);
    }

}
