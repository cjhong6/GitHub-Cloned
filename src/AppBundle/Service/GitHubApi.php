<?php

namespace AppBundle\Service;

class GitHubApi{
    public function getProfile($username){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://api.github.com/users/' . $username);
        $data = json_decode($response->getBody()->getContents(),true);

        return [
            'avatar_url' => $data['avatar_url'],
            'name' => $data['name'],
            'login' => $data['login'],
            'bio' => $data['bio'],
            'details' => [
                'company' => $data['company'],
                'location' => $data['location'],
                'created_at' => 'Joined on ' . (new \DateTime($data['created_at']))->format('Md Y'),
            ],
            'blog' => $data['blog'],
            'social_data' => [
                'Public Repos' => $data['public_repos'],
                'Followers' => $data['followers'],
                'Following' => $data['following'],
            ]
         ];
    }

    public function getRepos($username){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET','http://api.github.com/users/' . $username . '/repos' );
        $data = json_decode($response->getBody()->getContents(),true);

        dump($data);

        return [
            'repo_count' => count($data),
// oop through all of the arrays in $data and return the most start value, default value for most start is 0
            'most_stars' => array_reduce($data, function($mostStar,$currentRepo){
                return $currentRepo['stargazers_count'] > $mostStar ? $currentRepo['stargazers_count'] : $mostStar;
            }, 0),
            'repos' => $data
        ];
    }
}