<?php

namespace NicolJamie\Sage;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client extends Auth
{
    /** @var string $endpoint */
    public string $endpoint;

    /** @var array $config */
    public array $config = [];

    /**
     * BaseRequest
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws \Exception
     */
    public function base(string $method, $uri = '', array $data = []): ResponseInterface
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'Content-Type' => 'application/json'
            ],
            'base_uri' => config('sage.api_endpoint'),
            'form_params' => $data
        ];

        try {
            $request = $this->request($method, $uri, $options);
        } catch (GuzzleException $exception) {
            throw new \Exception($exception->getMessage());
        } finally {
            return $request;
        }
    }
}
