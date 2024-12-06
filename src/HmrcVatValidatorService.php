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
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.hmrc.1.0+json',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ])->get("{$this->baseUrl}/organisations/vat/check-vat-number", [
            'vatNumber' => $vatNumber,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("VAT validation failed: " . $response->body());
    }

    private function getAccessToken(): string
    {
        $response = Http::asForm()->post("{$this->baseUrl}/oauth/token", [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        if ($response->successful()) {
            return $response->json()['access_token'];
        }

        throw new \Exception("Unable to retrieve access token: " . $response->body());
    }
}