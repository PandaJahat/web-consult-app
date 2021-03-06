<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Area')
            ->prefix('area')
            ->group(base_path('routes/web/area.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\University')
            ->prefix('university')
            ->group(base_path('routes/web/university.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Notification')
            ->prefix('notification')
            ->group(base_path('routes/web/notification.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\User')
            ->prefix('user')
            ->group(base_path('routes/web/user.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Questionnaire')
            ->prefix('questionnaire')
            ->group(base_path('routes/web/questionnaire.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Schedule')
            ->prefix('schedule')
            ->group(base_path('routes/web/schedule.php'));
        
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Profile')
            ->prefix('profile')
            ->group(base_path('routes/web/profile.php'));
        
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Consult')
            ->prefix('consult')
            ->group(base_path('routes/web/consult.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Information')
            ->prefix('information')
            ->group(base_path('routes/web/information.php'));
        
        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Content')
            ->prefix('content')
            ->group(base_path('routes/web/content.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Quiz')
            ->prefix('quiz')
            ->group(base_path('routes/web/quiz.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Counseling')
            ->prefix('counseling')
            ->group(base_path('routes/web/counseling.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Evaluation')
            ->prefix('evaluation')
            ->group(base_path('routes/web/evaluation.php'));

        Route::middleware(['web', 'auth'])
            ->namespace($this->namespace.'\Report')
            ->prefix('report')
            ->group(base_path('routes/web/report.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
          Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
