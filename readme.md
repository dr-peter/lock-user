## Lock User

This package uses [Laravel](https://laravel.com/)'s own authentication system to set a [jQuery](https://jquery.com/) and [Bootstrap](https://getbootstrap.com/docs/5.1/getting-started/introduction/) based timer and view.
You just add the Blade directive to your app's view, set the time in minutes, add the `routes middleware` and it's ready to go.

## Add middleware to Kernel
Go to `app/Http/Kernel.php` find `protected $routeMiddleware = [` and add `'lock' => \DrPeter\LockUser\LockUserMiddleware::class,`.
Now you can add the Blade directive to your view and use the `lock` middleware in your routes file.

### Add to view
All you need to do is to add `@lockUser($time_in_minutes)` to your view. Make sure it is located after jQuery is initialized.

### Publish view
You can edit the view used for the lock screen by publishing it.
```bash
php artisan vendor:publish --tag=lock-user-views
```
You can update the view as you please.

### Routes
The package uses two named routes.
- uri: `lock`, name: `lock-user`
- uri: `unlock`, name: `unlock-user`
