<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class TestController extends Controller
{

    public function getGithub()
    {
        $client = new Client();
        $res    = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

        return $res->getBody();
    }

    public function getAccount()
    {
        $client = new Client();
        $res    = $client->request('POST', 'https://api.finhacks.id/fire/accounts',[
            'Authentication' => [
                'CorporateID'   => 'FHK1ID',
                'AccessCode'    => 'rqdJtRKxhEeOk9jsxJCx',
                'BranchCode'    => 'FHK1ID01',
                'UserID'        => 'FHK1OPR1',
                'LocalID'       => '0405'
            ],
            'BeneficiaryDetails' => [
                'BankCodeType'  => 'BIC',
                'BankCodeValue' => 'CENAIDJAXXX',
                'AccountNumber' => '0106666011'
            ]
        ]);

        return $res->getBody();
    }

    public function getToken()
    {
        $client = new Client();
        $res    = $client->request('POST', 'https://api.finhacks.id/api/oauth/token',[
            'headers'       => [
                                'Authentication' => 'Basic '.base64_encode('d4384a01-a055-4d83-a9ea-378dcd946a68:df0608f0-3314-4ae4-89db-f27f04317398')
            ],
            'form_params'   => [
                                'grant_type' => 'client_credentials'
            ]
        ]);

        return $res->getBody();
    }
}
