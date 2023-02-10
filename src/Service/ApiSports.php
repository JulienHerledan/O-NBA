<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiSports 
{
    // private $apiKey;
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    
    public function fetchBySeasons():array
    {
        $response = $this->client->request(
            'GET',
            'https://api-nba-v1.p.rapidapi.com/seasons',
            [
                "headers" => [
                    'X-RapidAPI-Key' => 'a996169d2dmsh74e67f641b52bc1p1614c4jsn61ca3d907122',
                    'X-RapidAPI-Host'=> 'api-nba-v1.p.rapidapi.com'
                ]
            ]
        );
        $result = $response->toArray();
        return $result;

    }

    public function fetchByTeams():array
    {
        $response = $this->client->request(
            'GET',
            'https://api-nba-v1.p.rapidapi.com/teams',
            [
                "headers" => [
                    'X-RapidAPI-Key' => 'a996169d2dmsh74e67f641b52bc1p1614c4jsn61ca3d907122',
                    'X-RapidAPI-Host'=> 'api-nba-v1.p.rapidapi.com'
                ],
            ]
        );

        $results = $response->toArray();
       
   
            return $results;
   

    }
}