<?php

namespace App\Providers;

use App\Nova\Answer;
use App\Nova\Chapter;
use App\Nova\Course;
use App\Nova\Dashboards\Main;
use App\Nova\Question;
use App\Nova\Test;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function (Request $request) {
           return [
               MenuSection::dashboard(Main::class)->icon('chart-bar'),

               MenuSection::make('Пользователи', [
                   MenuItem::resource(User::class)
               ])->icon('user')->collapsable(),

               MenuSection::make('Тесты', [
                   MenuItem::resource(Test::class),
                   MenuItem::resource(Question::class),
                   MenuItem::resource(Answer::class),
               ])->icon('puzzle')->collapsable(),

               MenuSection::make('Курсы', [
                   MenuItem::resource(Course::class),
                   MenuItem::resource(Chapter::class),
               ])->icon('puzzle')->collapsable(),
           ];
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'admin@gmail.com'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
