<?php
namespace App\Traits;

trait JsonResponseTrait{

    /**
     * sendResponse
     *
     * @param  mixed $message
     * @param  mixed $payload
     * @return \Symfony\Component\HttpFoundation\Response $response
     */
    public function sendResponse(string $message, $payload = null, $code=200)
    {
        $result = [
            'status'  => true,
            'message' == $message,
            'data' => $payload,
        ];

        return response()->json($result, $code);
    }


    /**
     * sendError
     *
     * @param  mixed $message
     * @param  mixed $payload
     * @return \Symfony\Component\HttpFoundation\Response $response
     */
    public function sendError(string $message, $payload=null, $code=206)
    {
        $result = [
            'status'  => false,
            'message' => $message,
            'data' => $payload,
        ];

        return response()->json($result, $code);
    }


    public function respondWithSuccess($msg="",$status=200)
    {
        $responseArray = [
            'status' =>$status,
            'messages' => $msg,
        ];

        return response()->json($responseArray,$status);
    }


    public function respondWithFail($msg="",$status=400)
    {
        $responseArray = [
            'status' =>$status,
            'messages' => $msg,
        ];

        return response()->json($responseArray,$status);
    }

}
