<?php


class CurlController{

	/*=============================================
	Peticiones a la API
	=============================================*/	

	static public function request($url, $method, $fields) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://api.com/'.$url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $method,
			CURLOPT_POSTFIELDS => $fields,
			//CURLOPT_SSL_VERIFYPEER => false,  // Ignora la verificación del certificado
        	//CURLOPT_SSL_VERIFYHOST => 0,  // Ignora la verificación del nombre del host
			CURLOPT_HTTPHEADER => array(
				'Authorization: SSDFzdg235dsgsdfAsa44SDFGDFDadg'
			),
		));
		
		$response = curl_exec($curl);
		
		if (curl_errno($curl)) {
			echo 'Curl error: ' . curl_error($curl); // Imprime errores cURL
		}
		
		curl_close($curl);
		
		$response = json_decode($response);
		
		// Depuración adicional
		if (json_last_error() !== JSON_ERROR_NONE) {
			echo 'JSON decode error: ' . json_last_error_msg(); // Imprime errores de JSON
		}
		
		return $response;
	}
	

}