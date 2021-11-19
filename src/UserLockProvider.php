<?php

namespace DrPeter\LockUser;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UserLockProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerControllers();
        $this->registerViews();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->includeRoutes();
        $this->publishFiles();
        $this->addBladeDirectives();
    }

    /**
     * Publish all files
     * 
     * @return void
     */
    private function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../resources/views/lockscreen.blade.php' =>  resource_path('views/vendor/dr-peter/lock-user/lockscreen.blade.php'),
        ], 'lock-user-views');
    }

    /**
     * Add routes
     * 
     * @return void
     */
    private function includeRoutes()
    {
        include(__DIR__ . '/routes.php');
    }

    /**
     * Add Blade directives
     * 
     * @return void
     */
    private function addBladeDirectives()
    {
        // Create Blade code
        Blade::directive('lockUser', function ($time_in_minutes = false) {
            if(!isset($time_in_minutes) || !$time_in_minutes) {
                $time_in_minutes = config('userlock.idle_time');
            }            
            return "<?php if(\Illuminate\Support\Facades\Auth::user()) { echo \"<script>\$(function() {
                var interval;
                settimeout();
                $(document).on('mousemove keyup keypress',function(){
                    clearTimeout(interval);
                    settimeout();
                })
            });
            function settimeout(){
                interval=setTimeout(function(){
                $.ajax({
                    type: 'POST',
                    url: '" . route('lock-user') . "',
                    data: {_token:'" . csrf_token() . "'},
                    success: function(response) {
                        if(response.locked) {
                            location.reload();
                        }
                    },
                });
              }, 1000*60*$time_in_minutes)
            }</script>\"; } ?>";
        });
    }

    /**
     * Register controllers
     * 
     * @return mixed
     */
    private function registerControllers()
    {
        return $this->app->make('DrPeter\LockUser\LockUserController');
    }

    /**
     * Register views
     * 
     * @return void
     */
    private function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'userlock');
    }
}
