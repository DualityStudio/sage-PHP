<?php

namespace NicolJamie\Sage;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Exception\GuzzleException;

class Auth extends \GuzzleHttp\Client
{
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
     * authorizationToAccess
     * @param $code
     * @throws GuzzleException
     */
    public function authorizationToAccess($code)
    {
        $request = $this->post("https://oauth.accounting.sage.com/token", [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'redirect_uri' => config('sage.authentication.redirect_url'),
                'client_id' => config('sage.authentication.client_id'),
                'client_secret' => config('sage.authentication.client_secret'),
                'grant_type' => 'authorization_code',
                'code' => $code
            ]
        ]);

        $response = json_decode($request->getBody()->getContents());

        Cache::add("sage.jwt", $response->access_token, (4 * 60));
        Cache::forever("sage.jwt.refresh", $response->refresh_token);
    }

    /**
     * getJwt
     * @return string
     */
    public function getJwt(): string
    {
        return Cache::remember("sage.jwt", 4 * 60, function () {
            try {
                $request = $this->post("https://oauth.accounting.sage.com/token", [
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded'
                    ],
                    'form_params' => [
                        'client_id' => config('sage.authentication.client_id'),
                        'client_secret' => config('sage.authentication.client_secret'),
                        'grant_type' => 'refresh_token',
                        'refresh_token' => Cache::get("sage.jwt.refresh")
                    ]
                ]);

                $response = json_decode($request->getBody()->getContents());
            } catch (GuzzleException $exception) {
                throw new \Exception($exception->getMessage());
            } finally {
                Cache::forget("sage.jwt.refresh");
                Cache::add("sage.jwt.refresh", $response->refresh_token);

                return $response->access_token;
            }
        });
    }
}
