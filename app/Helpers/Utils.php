<?php


namespace App\Helpers;


class Utils
{
    // HEADERS PADRÕES PARA COMUNICAÇÃO DA API mLEARN
    /**
     * @return array
     */
    static function HeadersmLearn()
    {
        return ['Authorization: Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w', 'service-id: qualifica', 'app-users-group-id: 20', 'Content-Type: application/json'];
    }

    /**
     * @param string $url
     * @param string $dados
     * @return array
     */
    static function ApiRequestGet(string $url, string $dados)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.'/?'.$dados,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => self::HeadersmLearn(),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        return $err || array_key_exists('status_code', $data) ? ['success' => false, 'message' => $err, 'data' => $data] :  ['success' => true, 'message' => '', 'data' => $data];
    }

    /**
     * @param string $url
     * @param array $dados
     * @return array
     */
    static function ApiRequestPost(string $url, array $dados)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($dados),
            CURLOPT_HTTPHEADER => self::HeadersmLearn(),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);



        $data = json_decode($response, true);

        return $err || array_key_exists('status_code', $data) ? ['success' => false, 'message' => $err, 'data' => $data] :  ['success' => true, 'message' => '', 'data' => $data];
    }

    /**
     * @param string $url
     * @return array
     */
    static function ApiRequestPut(string $url)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_HTTPHEADER => self::HeadersmLearn(),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        return $err || array_key_exists('status_code', $data) ? ['success' => false, 'message' => $err, 'data' => $data] :  ['success' => true, 'message' => '', 'data' => $data];
    }

    // METODO PARA PADRONIZAÇÃO DE RESPOSTAS DA API
    static function ResponseJson($response, $statusCode = 200)
    {
        if(is_string($response) || (is_array($response) && !$response['success']))
        {
            return response()->json(['data' => $response, 'message' => $response, 'success' => false], 400);
        }
        return response()->json(['data' => $response['data'], 'message' => $response['message'], 'success' => true], $statusCode);
    }
}
