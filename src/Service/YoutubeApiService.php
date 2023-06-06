<?php

namespace App\Service;

use GuzzleHttp\Client;

class YoutubeApiService
{
    private $httpClient;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->httpClient = new Client();
        $this->apiKey = $apiKey;
    }

    public function searchVideos(string $query)
    {
        $url = 'https://www.googleapis.com/youtube/v3/search';
    
        $response = $this->httpClient->request('GET', $url, [
            'query' => [
                'key' => $this->apiKey,
                'part' => 'snippet',
                'q' => $query,
                'type' => 'video',
                'maxResults' => 2, // Définissez le nombre de résultats souhaité ici
            ],
            'verify' => false,

        ]);
    
        $data = json_decode($response->getBody(), true);
    
        return $data['items'];
    }
}
