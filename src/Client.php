<?php

namespace DualityStudio\Sage;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use function PHPUnit\Framework\isJson;

class Client extends Auth
{
    use Transformer;

    /** @var string $endpoint */
    public string $endpoint;

    /**
     * base
     * @param string $method
     * @param string $uri
     * @param $data
     * @return Client
     * @throws \Exception
     */
    public function base(string $method, string $uri, $data = null): Client
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getJwt(),
                'Content-Type' => 'application/json'
            ],
            'base_uri' => config('sage.api_endpoint'),
        ];

        $options[(is_array($data) ? 'form_params' : 'body')] = $data;

        try {
            $request = $this->request($method, $uri, $options);
        } catch (GuzzleException $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $this->parse($request);
    }
}
