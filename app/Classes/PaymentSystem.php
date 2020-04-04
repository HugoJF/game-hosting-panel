<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 5/7/2019
 * Time: 7:16 AM
 */

namespace App\Classes;

use Ixudra\Curl\Facades\Curl;

class PaymentSystem
{
	public static $saving = false;
	public static $mocking = false;
	public static $responses = [];

	/**
	 * @param      $path
	 * @param null $data
	 * @param bool $post
	 *
	 * @return bool|mixed
	 * @throws \Exception
	 */
	public static function curl($path, $data = null, $post = false)
	{
		if (static::$mocking) {
			if (array_key_exists($path, static::$responses))
				return static::$responses[ $path ];

			throw new \Exception('Trying to mock response that does not have a saved file', ['path' => $path]);
		}

		$result = Curl::to(config('payment-system.url') . $path);

		if ($data)
			$result = $result->withData($data);

		$result = $result->asJson()->withHeader('Accept: application/json')->returnResponseObject();

		if ($post) {
			$response = $result->post();
		} else {
			$response = $result->get();
		}

		return $response;
	}

	public static function fileMock($request, $fileName)
	{
		$path = app_path('Mock/mp/') . $fileName;

		$file = fopen($path, 'r');
		$content = fread($file, filesize($path));
		fclose($file);

		static::mock($request, json_decode($content));
	}

	public static function saveResponse($name, $response)
	{
		if (static::$saving === true) {
			$path = app_path('Mock/' . str_replace('/', '-', $name));
			$file = fopen($path, 'w');
			fwrite($file, json_encode($response));
			fclose($file);
		}

		return $response;
	}

	public function createOrder($details)
	{
		$response = self::curl('orders', $details, true);

		return $response;
	}

	public function getOrder($reference)
	{
		$response = self::curl("orders/$reference");

		return $response;
	}

}