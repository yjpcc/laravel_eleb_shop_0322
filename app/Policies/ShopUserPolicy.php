<?php

namespace App\Policies;

use App\Model\ShopUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(ShopUser $currentShupUser, ShopUser $shopUser)
    {
        return $currentShupUser->id === $shopUser->id;
    }

}
