<?php

namespace MatthC\Laradmin\Repositories;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use MatthC\Privileges\Models\Role;

class RoleRepository
{
    public function getPaginated($perPage)
    {
        $page = Request::get('page');

        if(!$page) {
            $page = 0;
        }

        $cacheKey = 'laradmin_roles_page'.$page;
        return Cache::tags('laradmin_roles')->remember($cacheKey, 60, function () use($perPage) {
            return Role::paginate($perPage);
        });
    }

    /**
     * Clear the laradmin user cache
     */
    public function clearCache()
    {
        Cache::tags('laradmin_roles')->flush();
    }
}
