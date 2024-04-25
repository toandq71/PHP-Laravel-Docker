<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class ImportPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controllers = [];

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();

            if (array_key_exists('controller', $action)
                && strpos($action['controller'], 'Controllers\Admin\Auth\\') !== false) {
                continue;
            }

            $listGuards = array_flip(array_keys(config('auth.guards')));
            $listGuards = array_flip(array_change_key_case($listGuards, CASE_UPPER));
            $prefix = array_key_exists('controller', $action) ? str_replace('/', '', strtoupper($action['prefix'])) : '';

            if (array_key_exists('controller', $action)
                && array_key_exists('prefix', $action)
                && in_array($prefix, $listGuards)
                && strpos($action['controller'], 'App\Http\Controllers\\') !== false) {
                $prefix = ucfirst(strtolower($prefix));
                $contAction = str_replace('App\Http\Controllers\\'.$prefix.'\\', '', $action['controller']);
                $contAction = str_replace('Controller@', '-', $contAction);
                $controllers[strtolower($prefix)][] = strtolower($contAction);
            }
        }

        foreach ($controllers as $guardName => $permissions) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guardName]);
            }
        }
    }
}
