<?php

namespace MatthC\Laradmin\ViewComposers;

class MenuViewComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $menu;

    /**
     * Create a new profile composer.
     *
     * @internal param UserRepository $users
     */
    public function __construct()
    {
        $this->menu = config('laradmin.menu');
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', $this->menu);
    }
}