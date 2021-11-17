<?php

namespace DrPeter\LockUser;

use Illuminate\Support\Facades\Auth;
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
        // Add controller
        $this->app->make('DrPeter\LockUser\LockUserController');
        // Load views
        $this->loadViewsFrom(__DIR__ . '/views', 'userlock');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Add routes
        include(__DIR__ . '/routes.php');

        // Set publish files
        $this->publishes([
            __DIR__ . '/views/lockscreen.blade.php' =>  resource_path('views/vendor/dr-peter/lock-user/lockscreen.blade.php'),
        ], 'lock-user-views');

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
}
