# Easy AdminLTE integration with Laravel 5

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeroennoten/Laravel-AdminLTE.svg?style=flat-square)](https://packagist.org/packages/jeroennoten/Laravel-AdminLTE)
[![Build Status](https://travis-ci.org/jeroennoten/Laravel-AdminLTE.svg?branch=master)](https://travis-ci.org/jeroennoten/Laravel-AdminLTE)
[![Quality Score](https://img.shields.io/scrutinizer/g/jeroennoten/Laravel-AdminLTE.svg?style=flat-square)](https://scrutinizer-ci.com/g/jeroennoten/Laravel-AdminLTE)
[![StyleCI](https://styleci.io/repos/38200433/shield?branch=master)](https://styleci.io/repos/38200433)
[![Total Downloads](https://img.shields.io/packagist/dt/jeroennoten/Laravel-AdminLTE.svg?style=flat-square)](https://packagist.org/packages/jeroennoten/Laravel-AdminLTE)

This package provides an easy way to quickly set up [AdminLTE](https://almsaeedstudio.com) with Laravel 5. It has no requirements and dependencies besides Laravel, so you can start building your admin panel immediately. The package just provides a Blade template that you can extend and advanced menu configuration possibilities. A replacement for the `make:auth` Artisan command that uses AdminLTE styled views instead of the default Laravel ones is also included.

1. [Installation](#1-installation)
2. [Updating](#2-updating)
3. [Usage](#3-usage)
4. [The `make:adminlte` artisan command](#4-the-makeadminlte-artisan-command)
   1. [Using the authentication views without the `make:adminlte` command](#41-using-the-authentication-views-without-the-makeadminlte-command)
5. [Configuration](#5-configuration)
   1. [Menu](#51-menu)
     - [Custom menu filters](#custom-menu-filters)
     - [Menu configuration at runtime](#menu-configuration-at-runtime)
     - [Active menu items](#active-menu-items)
   2. [Plugins](#52-plugins)
6. [Translations](#6-translations)
7. [Customize views](#7-customize-views)
8. [Issues, Questions and Pull Requests](#8-issues-questions-and-pull-requests)

## 1. Installation

1. Require the package using composer:

    ```
    composer require acharsoft/laravel-adminlte-rtl
    ```

2. Add the service provider to the `providers` in `config/app.php`:

    > Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider

    ```php
    acharsoft\LaravelAdminLte\ServiceProvider::class,
    ```

3. Publish the public assets:

    ```
    php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=assets
    ```

## 2. Updating

1. To update this package, first update the composer package:

    ```
    composer update acharsoft/laravel-adminlte-rtl
    ```

2. Then, publish the public assets with the `--force` flag to overwrite existing files

    ```
    php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=assets --force
    ```

## 3. Usage

To use the template, create a blade file and extend the layout with `@extends('adminlte::page')`.
This template yields the following sections:

- `title`: for in the `<title>` tag
- `content_header`: title of the page, above the content
- `content`: all of the page's content
- `css`: extra stylesheets (located in `<head>`)
- `js`: extra javascript (just before `</body>`)

All sections are in fact optional. Your blade template could look like the following.

```html
{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
```

Note that in Laravel 5.2 or higher you can also use `@stack` directive for `css` and `javascript`:

```html
{{-- resources/views/admin/dashboard.blade.php --}}

@push('css')

@push('js')
```

You now just return this view from your controller, as usual. Check out [AdminLTE](https://almsaeedstudio.com) to find out how to build beautiful content for your admin panel.

## 4. The `make:adminlte` artisan command

> Note: only for Laravel 5.2 and higher

This package ships with a `make:adminlte` command that behaves exactly like `make:auth` (introduced in Laravel 5.2) but replaces the authentication views with AdminLTE style views.

```
php artisan make:adminlte
```

This command should be used on fresh applications, just like the `make:auth` command

### 4.1 Using the authentication views without the `make:adminlte` command

If you want to use the included authentication related views manually, you can create the following files and only add one line to each file:

- `resources/views/auth/login.blade.php`:
```
@extends('adminlte::login')
```
- `resources/views/auth/register.blade.php`
```
@extends('adminlte::register')
```
- `resources/views/auth/passwords/email.blade.php`
```
@extends('adminlte::passwords.email')
```
- `resources/views/auth/passwords/reset.blade.php`
```
@extends('adminlte::passwords.reset')
```

By default, the login form contains a link to the registration form.
If you don't want a registration form, set the `register_url` setting to `null` and the link will not be displayed.

## 5. Configuration

First, publish the configuration file:

```
php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=config
```

    php artisan vendor:publish --provider="Yadahan\AuthenticationLog\AuthenticationLogServiceProvider"

Now, edit `config/adminlte.php` to configure the title, skin, menu, URLs etc. All configuration options are explained in the comments. However, I want to shed some light on the `menu` configuration.


### 5.0 Migrations

First, publish the migration file:

```
php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=migrations
```

Now, you run this command.

```
php artisan migrate
```
Finally, add the `AuthenticationLogable` and `Notifiable` traits to your authenticatable model (by default, `App\User` model). These traits provides various methods to allow you to get common authentication log data, such as last login time, last login IP address, and set the channels to notify the user when login from a new device:

```php
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, AuthenticationLogable;
}
```
### 5.1 Menu

You can configure your menu as follows:

```php
'menu' => [
    'MAIN NAVIGATION',
    [
        'text' => 'Blog',
        'url' => 'admin/blog',
    ],
    [
        'text' => 'Pages',
        'url' => 'admin/pages',
        'icon' => 'file'
    ],
    [
        'text' => 'Show my website',
        'url' => '/',
        'target' => '_blank'
    ],
    'ACCOUNT SETTINGS',
    [
        'text' => 'Profile',
        'route' => 'admin.profile',
        'icon' => 'user'
    ],
    [
        'text' => 'Change Password',
        'route' => 'admin.password',
        'icon' => 'lock'
    ],
],
```

With a single string, you specify a menu header item to separate the items.
With an array, you specify a menu item. `text` and `url` or `route` are required attributes.
The `icon` is optional, you get an [open circle](http://fontawesome.io/icon/circle-o/) if you leave it out.
The available icons that you can use are those from [Font Awesome](http://fontawesome.io/icons/).
Just specify the name of the icon and it will appear in front of your menu item.

Use the `can` option if you want conditionally show the menu item. This integrates with Laravel's `Gate` functionality. If you need to conditionally show headers as well, you need to wrap it in an array like other menu items, using the `header` option:

```php
[
    [
        'header' => 'BLOG',
        'can' => 'manage-blog'
    ],
    [
        'text' => 'Add new post',
        'url' => 'admin/blog/new',
        'can' => 'add-blog-post'
    ],
]
```

Use the `permission` option if you want conditionally show the menu item. If you need to conditionally show headers as well, you need to wrap it in an array like other menu items, using the `header` option:

```php
[
    [
        'header' => 'BLOG',
        'can' => 'manage-blog'
    ],
    [
        'text' => 'Add new post',
        'url' => 'admin/blog/new',
        'permission' => ['admin']
    ],
    [
            'text' => 'Add new comment',
            'url' => 'admin/blog/new/comment',
            'permission' => ['admin','master','user']
    ],
]
```

#### Custom Menu Filters

If you need custom filters, you can easily add your own menu filters to this package. This can be useful when you are using a third-party package for authorization (instead of Laravel's `Gate` functionality).

For example with Laratrust:

```php
<?php

namespace MyApp;

use acharsoft\LaravelAdminLte\Menu\Builder;
use acharsoft\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
            return false;
        }

        return $item;
    }
}
```

And then add to `config/adminlte.php`:

```php
'filters' => [
    acharsoft\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
    acharsoft\LaravelAdminLte\Menu\Filters\HrefFilter::class,
    acharsoft\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
    acharsoft\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
    //acharsoft\LaravelAdminLte\Menu\Filters\GateFilter::class, Comment this line out
    MyApp\MyMenuFilter::class,
]
```

#### Menu configuration at runtime

It is also possible to configure the menu at runtime, e.g. in the boot of any service provider.
Use this if your menu is not static, for example when it depends on your database or the locale.
It is also possible to combine both approaches. The menus will simply be concatenated and the order of service providers
determines the order in the menu.

To configure the menu at runtime, register a handler or callback for the `MenuBuilding` event, for example in the `boot()` method of a service provider:

```php
use Illuminate\Contracts\Events\Dispatcher;
use acharsoft\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{

    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'Blog',
                'url' => 'admin/blog',
            ]);
        });
    }

}
```
The configuration options are the same as in the static configuration files.

A more practical example that actually uses translations and the database:

```php
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add(trans('menu.pages'));

            $items = Page::all()->map(function (Page $page) {
                return [
                    'text' => $page['title'],
                    'url' => route('admin.pages.edit', $page)
                ];
            });

            $event->menu->add(...$items);
        });
    }
```

This event-based approach is used to make sure that your code that builds the menu runs only when the admin panel is actually displayed and not on every request.


#### Active menu items

By default, a menu item is considered active if any of the following holds:
- The current path matches the `url` parameter
- The current path is a sub-path of the `url` parameter
- If it has a submenu containing an active menu item

To override this behavior, you can specify an `active` parameter with an array of active URLs, asterisks and regular expressions are supported. Example:

```php
[
    'text' => 'Pages'
    'url' => 'pages',
    'active' => ['pages', 'content', 'content/*']
]
```

### 5.2 Plugins

#### Custum Blade @links and @scripts
Use the `plugins_js` and `plugins_css` option if you want to add your plugins.

```php
'plugins_js' => [
        'pace'    => 'plugins/pace/pace.min.js',
        ],
'plugins_css' => [
        'pace'    => 'plugins/pace/pace.min.css',
        ],
```
It is also possible to configure the Blade. in the boot of any service provider.

To configure the @links and @scripts for example in the `boot()` method of a service provider:

```php

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Blade::directive('links',function ($expression){
                    return "<?php  echo '<link rel=\'stylesheet\' href=\''.asset(config ('adminlte.plugins_css.'.$expression)).'\'>'; ?>";
        });
        
        Blade::directive('scripts',function ($expression){
                    return "<?php  echo '<script src=\''.asset(config ('adminlte.plugins_js.'.$expression)).'\'></script>'; ?>";
        });
        Blade::directive('langs',function ($expression){
                    return "<?php  echo __('adminlte::adminlte.'.$expression); ?>";
        });
    }

}
```
after this run this command
```
php artisan view:clear
```
in views just use ```@links('pace')``` to add this tag:
```
<link rel='stylesheet' href='http://localhost:8000/vendor/adminlte/plugins/pace/pace.min.css'>
```
or in your scripts just ```@scripts('pace')```

if you want to use translate just use ```@langs('your_message')```

## 6. Translations

At the moment, English, German, French, Dutch, Portuguese and Spanish translations are available out of the box.
Just specifiy the language in `config/app.php`.
If you need to modify the texts or add other languages, you can publish the language files:

```
php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=translations
```

Now, you can edit translations or add languages in `resources/lang/vendor/adminlte`.

if you want to use this in your menu items just uncomment this line
```
acharsoft\LaravelAdminLte\Menu\Filters\LangFilter::class
```
in your menu filters

## 7. Customize views

If you need full control over the provided views, you can publish them:

```
php artisan vendor:publish --provider="acharsoft\LaravelAdminLte\ServiceProvider" --tag=views
```

Now, you can edit the views in `resources/views/vendor/adminlte`.

## 7.1 Google Login

Install socialite using composer. Socialite is an official Laravel package documented [here](https://laravel.com/docs/5.6/socialite).

Add credentials to config/services.php. Socialite supports Facebook, Twitter, LinkedIn, Google, GitHub and Bitbucket. Other providers require packages from the community, which are all listed [here](https://socialiteproviders.github.io/about.html).

These providers follow the OAuth 2.0 spec and therefore require a client_id, client_secret and redirect url. We’ll obtain these in the next step! First, add the values to the config file because socialite will be looking for them when we ask it to.

```php
'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => env('GOOGLE_REDIRECT')
],
```
Since we added a new package, make sure to add to the service providers array in config/app.php:
```
/*
* Package Service Providers...
*/
Laravel\Socialite\SocialiteServiceProvider::class,
```

Service Providers are the central place for application bootstrapping. The above line let’s Laravel to know to make the Socialite available for use.

Add an alias to Socialite so it is easier to reference later, also in config/app.php file:
```
'aliases' => [
    // ...
    'Socialite' => Laravel\Socialite\Facades\Socialite::class,
]
```

- Create a project: https://console.developers.google.com/projectcreate

- Create credentials: https://console.developers.google.com/apis/credentials

A modal will pop up with your apps client id and client secret. Add these values to your .env file.
```
GOOGLE_CLIENT_ID=000000000000-XXXXXXXXXXX.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=XXXXXXXXXXXXX
GOOGLE_REDIRECT=http://localhost:8000/callback
```

Enable the Google+ API: https://console.cloud.google.com/apis/api/plus.googleapis.com/overview (This tells Google what services our application is going to use ie Google+ account login)

Update here January 2019: The Google+ API is being deprecated this March. The Laravel Socialite project latest release has been updated to not use the Google+ API so the above step is not necessary.

Head into routes/web.php and add endpoints for redirect and callback:
```
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
```

The first method will show the Google authentication page in the same window where the user is viewing your webpage (no annoying popups):
```
/**
  * Redirect the user to the Google authentication page.
  *
  * @return \Illuminate\Http\Response
  */
public function redirectToProvider()
{
    return Socialite::driver('google')->redirect();
}
```

The next method will handle after a successful Google authentication:
```
 /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'gmail.com'){
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }
```

## 8. RTL Support

For rtl supported you can change your locale to 'fa' or 'ar' in congig/app.php in other languages the template is ltr .

## 9. Issues, Questions and Pull Requests

You can report issues and ask questions in the [issues section](https://github.com/acharsoft/Laravel-AdminLTE/issues). Please start your issue with `ISSUE: ` and your question with `QUESTION: `

If you have a question, check the closed issues first. Over time, I've been able to answer quite a few.

To submit a Pull Request, please fork this repository, create a new branch and commit your new/updated code in there. Then open a Pull Request from your new branch. Refer to [this guide](https://help.github.com/articles/about-pull-requests/) for more info.

