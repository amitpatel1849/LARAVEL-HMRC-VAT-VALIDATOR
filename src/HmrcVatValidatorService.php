<?php

namespace AmitPatel\HmrcVatValidator;

use Illuminate\Support\Facades\Http;

class HmrcVatValidatorService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUrl = config('hmrcvatvalidator.base_url');
        $this->clientId = config('hmrcvatvalidator.client_id');
        $this->clientSecret = config('hmrcvatvalidator.client_secret');
    }

    public function validateVat(string $vatNumber): array
    {
        $accessToken = $this->getAccessToken();
        $response = Http::withToken($accessToken)
            ->accept('application/vnd.hmrc.1.0+json')
            ->get($this->baseUrl."/organisations/vat/check-vat-number/lookup/$vatNumber");
        if ($response->successful()) {
            return $response->json();
        }
        return $response->json();
    }

    private function getAccessToken(): string
    {
        $response = Http::asForm()->post("{$this->baseUrl}/oauth/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'scope' => 'read:vat',
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }
        return $response->json();
    }
}
