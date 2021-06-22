<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Sentinel;
use View;
use Artisan;
use Str;

class JoshController extends Controller
{


    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    /**
     * Initializer.
     *
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;
    }

    public function showHome()
    {

        if (Sentinel::check()) {
            return view('index');
        } else {
            return view('login')->with('error', 'You must be logged in!');
        }
    }

    public function showView($name = null)
    {

        if (View::exists($name)) {
            if (Sentinel::check()) {
                return view($name);
            } else {
                return redirect('signin')->with('error', 'You must be logged in!');
            }
        } else {
            abort('404');
        }
    }


    /**
     * CRUD BUILDER
     * Check for folder permissions and return view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function builder()
    {
        //check for permissions
        $permissions['models'] = is_writable(app_path('Models'));
        $permissions['controllers'] = is_writable(app_path('Http/Controllers'));
        $permissions['requests'] = is_writable(app_path('Http/Requests'));
        $permissions['repositories'] = is_writable(app_path('Repositories'));
        $permissions['views'] = is_writable(resource_path('views'));
        $permissions['migrations'] = is_writable(database_path('migrations'));
        $permissions['routes'] = is_writable(base_path('routes/web_builder.php'));
        $permissions['menu'] = is_writable(resource_path('views/layouts/menu.blade.php'));

        //check for pending migrations
        $pendingMigrations = $this->checkMigrations();

        return view(config('infyom.generator_builder.views.builder'), compact('permissions', 'pendingMigrations'));
    }

    public function checkMigrations(): bool
    {
        Artisan::call('migrate:status');
        $output = Artisan::output();
        if (Str::contains(trim($output), 'No migrations')) {
            return true;
        }
        $output = collect(explode("\n", $output));
        $output = $output->reject(
            function ($item) {
                return !Str::contains($item, '| N');
            }
        );
        $count = $output->count() !== 0;
        if ($count) {
            return false;
        }
        return true;
    }
}
