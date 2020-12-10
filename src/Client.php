<?php

namespace NicolJamie\SagePHP;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Psr\Http\Message\ResponseInterface;

class Client extends \GuzzleHttp\Client
{
    /** @var string $endpoint */
    public string $endpoint;

    /** @var array $config */
    public array $config = [];

    /**
     * Client constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->resolveConfiguration();
    }

    /**
     * BaseRequest
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return parent::request($method, $uri, $options);
    }

    /**
     * get
     * @param \Psr\Http\Message\UriInterface|string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get($uri, array $options = []): ResponseInterface
    {
        parent::get($uri, $options);
    }

    public function constructAuthenticationUrl()
    {

    }

    /**
     * resolveConfiguration
     * @return array|string[]
     */
    private function resolveConfiguration(): array
    {
        return Cache::remember("sage.jwt", 15 * 60, function () {
            $response = app()
                ->make(\GuzzleHttp\Client::class)
                ->post('https://oauth.accounting.sage.com/token', [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'body' => [
                        'client_id' => config('sage.authentication.client_id'),
                        'client_secret' => config('sage.authentication.client_secret'),
                        'grant_type' => 'refresh_token',
                        'refresh_token' => ''
                    ]
                ]);

            $jsResp = json_decode($response->getBody());
            return $jsResp->token;
        });

        $this->config = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        return $this->config;
    }
}
