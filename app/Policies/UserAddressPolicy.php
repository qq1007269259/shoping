<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
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


    /**
     * [own description]
     * @param  User        $user    [description]
     * @param  UserAddress $address [description]
     * @return [type]               [description]
     */
    public function own(User $user, UserAddress $address)
    {
        return $address->user_id == $user->id;
    }
}
