<?php

namespace App\Http\Controllers\Application;

use App\Http\Requests\InstallRequest;
use App\Install\Functionality;
use Exception;
use App\Install\App;
use App\Install\Site;
use App\Install\Database;
use App\Install\Requirement;
use Illuminate\Routing\Controller;
use App\Install\AdminAccount;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use App\Http\Middleware\RedirectIfInstalled;

class InstallController extends Controller
{
    public function __construct()
    {
        $this->middleware(RedirectIfInstalled::class);
    }

    public function preInstallation(Requirement $requirement)
    {
        Artisan::call('key:generate', ['--force' => true]);
        return view('install.pre_installation', compact('requirement'));
    }

    public function getConfiguration(Requirement $requirement)
    {
        if (! $requirement->satisfied()) {
            return redirect()->route('install.pre_installation');
        }

        return view('install.configuration', compact('requirement'));
    }

    public function postConfiguration(
        InstallRequest $request,
        Database $database,
        AdminAccount $admin,
        Site $site,
        App $app
    ) {
        @set_time_limit(0);
        try {
            $database->setup($request->db);
            Functionality::setup();
            $admin->setup($request->admin);
            $site->setup($request->site);
            $app->setup();
        } catch (Exception $e) {
            return back()->withInput()
                ->with('error', $e->getMessage());
        }
        return redirect()->route('install.complete');

    }

    public function complete()
    {
        $env = DotenvEditor::load();
        $env->setKey('INSTAlLED','true');
        $env->save();
        return view('install.complete');
    }
}
