<?php

namespace App\Traits;

trait JsonResponseTrait
{

    /**
     * sendSuccessData
     *
     * @param mixed $message
     * @param mixed $payload
     * @return \Symfony\Component\HttpFoundation\Response $response
     */
    public function sendSuccessData(string $message, $payload = null, $code = 200)
    {
        $result = [
            'status' => true,
            'message' => $message,
            'data' => $payload,
        ];

        return response()->json($result, $code);
    }


    /**
     * sendErrorData
     *
     * @param mixed $message
     * @param mixed $payload
     * @return \Symfony\Component\HttpFoundation\Response $response
     */
    public function sendErrorData(string $message, $payload = null, $code = 206)
    {
        $result = [
            'status' => false,
            'message' => $message,
            'data' => $payload,
        ];

        return response()->json($result, $code);
    }


    public function sendSuccess($msg = "", $code = 200)
    {
        $responseArray = [
            'status' => true,
            'message' => $msg,
        ];

        return response()->json($responseArray, $code);
    }


    public function sendError($msg = "", $code = 400)
    {
        $responseArray = [
            'status' => false,
            'message' => $msg,
        ];

        return response()->json($responseArray, $code);
    }

}
