<?php

namespace App\Repository;

use App\User;

class UserRepository
{
    public function createOrUpdate($profile, $token)
    {
        if (!isset($profile->id)) {
            throw new \InvalidArgumentException('There must be an ID field');
        }

        $user = User::findOrNew($profile->id);

        if (is_null($user->id)) {
            $user->id = $profile->id;
        }

        $user = $user->fill([
            'name'         => $profile->name,
            'email'        => $profile->email,
            'picture'      => $profile->picture,
            'access_token' => $token
        ]);

        $user->save();

        return $user;
    }
}
