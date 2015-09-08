<?php

namespace App\Services;

use Google_Client;

class Google
{
    /** @var Google_Client */
    private $client;

    /**
     * Returns an authorized API client.
     *
     * @return Google_Client the authorized client object
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new Google_Client();
            $this->client->setApplicationName(config('google.app_name'));
            $this->client->setAuthConfigFile(config('google.client_secret_path'));
            $this->client->setScopes(config('google.scopes'));
            $this->client->setRedirectUri(url('google/callback'));
            $this->client->setAccessType("offline");
            $this->client->setApprovalPrompt("force");
        }

        return $this->client;
    }

    public function getProfile()
    {
        $oauth2 = new \Google_Service_Oauth2($this->client);
        $userInfo = $oauth2->userinfo->get();
        return $userInfo;
    }
}
