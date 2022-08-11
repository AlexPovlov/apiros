<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="OpenApi Documentation",
     *      description="Документация для микро сервиса",
     *      
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Основной API"
     * )
     *
     */

class BaseController extends Controller
{
    
    public function sendResponse($result)
    {
      $response = [
            'success' => true,
            'data'    => $result,
        ];
        return response()->json($response, 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError( $errorMessages = [], $code = 404)
    {
      $response = [
            'success' => false,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}