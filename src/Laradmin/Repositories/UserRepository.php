<?php

namespace MatthC\Laradmin\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class UserRepository
{
    /**
     * Get a cached paginated result
     *
     * @param $perPage
     * @return mixed
     */
    public function getPaginated($perPage)
    {
        $page = Request::get('page');

        if(!$page) {
            $page = 0;
        }

        $cacheKey = 'laradmin_users_page'.$page;
        return Cache::tags('laradmin_users')->remember($cacheKey, 60, function () use($perPage) {
            return User::paginate($perPage);
        });
    }

    /**
     * Clear the laradmin user cache
     */
    public function clearCache()
    {
        Cache::tags('laradmin_users')->flush();
    }
}
