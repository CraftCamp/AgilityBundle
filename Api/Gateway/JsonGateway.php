<?php

namespace Developtech\AgilityBundle\Api\Gateway;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class JsonGateway
{
	/** @var Client **/
	protected $client;
	
	/**
	 * @param string $route
	 * @param array $parameters
	 * @param array $headers
	 * @return ResponseInterface
	 */
	public function post($route, $parameters = [], $headers = [])
	{
		return $this->client->post($route, [
			'headers' => array_merge([
				'Content-Type' => 'application/json'
			], $headers),
			'body' => json_encode($parameters)
        ]);
	}
}