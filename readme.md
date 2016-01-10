#Laradmin
This is an admin package for Laravel with roles and permissions integrated. This package is still under development.

##Installation
Install the package with the following command

```
$ composer require matthc/laradmin dev-master
```

This command will pull in 2 packages:

- Laradmin: the admin package
- Privileges: the package for roles and permissions

I will write here how to initialize everything for both of these packages.

After the packages are installed, add the following providers to the providers array in config/app.php

```
'providers' => [
        ...
        MatthC\Privileges\PrivilegesServiceProvider::class,
        MatthC\Laradmin\LaradminServiceProvider::class,
],
```

Next, publish the vendor files with the following command:

```
php artisan vendor:publish
```

Run the migrations

```
php artisan migrate
```

###Specific settings and commands for the privileges (roles and permissions)
You can change some configuration for the roles and permissions package in config/privileges.php. After doing the changes you can add default roles and permissions with the following command:

```
php artisan privileges:db:seed
```

If you also want to add some users with roles attached, run the following command:

```
php artisan privileges:db:users
```

If you want everything to work you have to add the following trait to your User model

```
use MatthC\Privileges\Traits\PrivilegesUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use PrivilegesUserTrait;
    ...
    
}
```

And for some routes to work you have to add 2 middlewares in app/Http/kernel.php

```
protected $routeMiddleware = [
		 ...
        'role' => \MatthC\Privileges\Middleware\PrivilegesRoleMiddleware::class,
        'permission' => \MatthC\Privileges\Middleware\PrivilegesPermissionMiddleware::class,
];
```

###Specific settings for the Laradmin package
First change the redirect if authenticated in app/Http/Middleware/RedirectIfAuthenticated.php to the prefix you have in your config/laradmin.php file.

In app/Http/Middleware/Authenticate.php : change the redirect link.

```
public function handle($request, Closure $next, $guard = null)
{
    if (Auth::guard($guard)->guest()) {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->guest('[prefix_from_laradmin_setting/login');
        }
    }

    return $next($request);
}
```

That's about it

###Add items to the menu
In config/laradmin.php there is a menu-setting. Here you can add specific menu-items with their route.

```
'menu' => [
    'Welcome' => [
        'route' =>  'welcome', //has to be a route
        'icon' => 'glass', // the font-icon you want
        'roles' => ['admin', 'author'], // roles needed to see this link
    ]
],
```

You can also make a submenu: it is important that you don't have a route parameter in the array

```
'menu' => [
    'Welcome' => [
        'icon' => 'glass', // the font-icon you want
        'roles' => ['admin', 'author'], // roles needed to see this link
        'submenu' => [
        		'Add a message' => 'messages.add' //the route
        ]
    ]
],
```