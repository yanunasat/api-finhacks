<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use cURL;

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
                                'Authentication' => 'Basic ZDQzODRhMDEtYTA1NS00ZDgzLWE5ZWEtMzc4ZGNkOTQ2YTY4OmRmMDYwOGYwLTMzMTQtNGFlNC04OWRiLWYyN2YwNDMxNzM5OA=='
            ],
            'form_params'   => [
                                'grant_type' => 'client_credentials'
            ]
        ]);

        return $res->getBody();
    }

    public function getCurl()
    {
	return cURL::get('http://www.google.com');	
    }
}
