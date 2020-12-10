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
     * BaseRequest
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        $options['headers'] = [
            'Authorization' => 'Bearer ' . $this->getJwt(),
            'Accept' => 'application/json',
        ];

        $options['base_uri'] = config('sage.api_endpoint');

        return parent::request($method, $uri, $options);
    }

    /**
     * constructAuthenticationUrl
     * @return string
     */
    public function constructAuthenticationUrl(): string
    {
        return config('sage.auth_endpoint') . '&response_type=code'
            . '&client_id=' . config('sage.authentication.client_id')
            . '&redirect_uri=' . config('sage.authentication.redirect_url');
    }

    /**
     * getJwt
     * @return string
     */
    private function getJwt(): string
    {
        if (Cache::has("sage.jwt")) return Cache::get("sage.jwt");

        return Cache::remember("sage.jwt", 4 * 60, function () {
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
                        'refresh_token' => decrypt(Cache::get("sage.jwt-refresh"))
                    ]
                ]);

            $jsResp = json_decode($response->getBody());
            Cache::add("sage.jwt-refresh", encrypt($jsResp->refresh_token));

            return $jsResp->access_token;
        });
    }
}
