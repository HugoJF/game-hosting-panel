<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 1:58 AM
 */

namespace App\Services;

use App\ApiKey;
use App\User;

class ApiKeyService
{
    /**
     * Stores new API Key.
     *
     * @param User  $user
     * @param array $form
     *
     * @param array $data
     *
     * @return ApiKey
     */
    public function store(User $user, array $form, array $data = []): ApiKey
    {
        $key = new ApiKey($form);

        $key->forceFill($data);
        $key->user()->associate($user);

        return save($key);
    }

    /**
     * Updates API Key information.
     *
     * @param ApiKey $key
     * @param array  $form
     * @param array  $data
     *
     * @return ApiKey
     */
    public function update(ApiKey $key, array $form, array $data = []): ApiKey
    {
        $key->fill($form);
        $key->forceFill($data);

        return save($key);
    }
}
