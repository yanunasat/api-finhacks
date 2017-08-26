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
                                'Authentication' => base64_encode('268b2069-b099-4fa2-8148-1f1c0327fe63:b383c35d-3c11-4ce6-b631-8767f4c2084b')
            ],
            'form_params'   => [
                                'grant_type' => 'client_credentials'
            ]
        ]);

        return $res->getBody();
    }
}
