<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set the default string length for SQLite/MySQL
        Schema::defaultStringLength(191);
        
        // Force HTTPS in production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        
        // If using SQLite in production, ensure the path is set correctly
        if (config('app.env') === 'production' && config('database.default') === 'sqlite') {
            Config::set('database.connections.sqlite.database', env('DB_DATABASE', '/var/data/database.sqlite'));
        }
        
        // Set correct SSL mode for MySQL in Render (if using MySQL)
        if (config('app.env') === 'production' && config('database.default') === 'mysql') {
            Config::set('database.connections.mysql.options', [
                \PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/cert.pem',
                \PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            ]);
        }
    }
}
