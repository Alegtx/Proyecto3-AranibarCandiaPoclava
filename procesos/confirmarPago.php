<?php
		/// Debemos conocer el $receiverId y el $secretKey de ante mano.
	$receiverId = 354062;
	$secretKey = '10c44368986151d885b286cd8de65a7735ced448';

	require __DIR__ . '../../vendor/autoload.php';

	$configuration = new Khipu\Configuration();
	$configuration->setReceiverId($receiverId);
	$configuration->setSecret($secretKey);
	$configuration->setDebug(true);

	$client = new Khipu\ApiClient($configuration);
	$payments = new Khipu\Client\PaymentsApi($client);

	try
	{
	    /*$opts = array(
	        "transaction_id" => "MTI-100",
	        "return_url" => "http://mi-ecomerce.com/backend/return",
	        "cancel_url" => "http://mi-ecomerce.com/backend/cancel",
	        "picture_url" => "http://mi-ecomerce.com/pictures/foto-producto.jpg",
	        "notify_url" => "http://mi-ecomerce.com/backend/notify",
	        "notify_api_version" => "1.3"
	    );*/
	    $response = $payments->paymentsPost(
	        "Compra de prueba de la API", //Motivo de la compra
	        "BOB", //Monedas disponibles CLP, USD, ARS, BOB
	        100.0, //Monto. Puede contener ","
	        //$opts //campos opcionales
	);

	    print_r($response);
	} 
	catch (\Khipu\ApiException $e)
	{
	    echo print_r($e->getResponseBody(), TRUE);
	}
?>