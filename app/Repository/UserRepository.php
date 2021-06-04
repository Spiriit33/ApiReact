<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }


}
