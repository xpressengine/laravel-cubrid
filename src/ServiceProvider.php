<?php
/**
 * CubridServiceProvider.php
 *
 * PHP version 7
 *
 * @category    Database
 * @package     Xpressengine\Cubrid
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER Corp. <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        https://xpressengine.io
 */

namespace Xpressengine\Cubrid;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('db', function($db) {
            $db->extend('cubrid', function ($config, $name) {
                $config['name'] = $name;
                return new CubridConnection($config);
            });
        });
    }
}
