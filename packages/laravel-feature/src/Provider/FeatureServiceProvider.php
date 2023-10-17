<?php

declare(strict_types=1);

namespace LaravelFeature\Provider;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LaravelFeature\Domain\Repository\FeatureRepositoryInterface;
use LaravelFeature\Console\Command\ScanViewsForFeaturesCommand;

final class FeatureServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Migration');

        $this->publishes([
            __DIR__.'/../Config/features.php' => config_path('features.php'),
        ]);

        $this->registerBladeDirectives();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/features.php', 'features');

        $config = $this->app->make('config');

        $this->app->bind(FeatureRepositoryInterface::class, fn () => app()->make($config->get('features.repository')));

        $this->registerConsoleCommand();
    }

    private function registerBladeDirectives(): void
    {
        $this->registerBladeFeatureDirective();
        $this->registerBladeFeatureForDirective();
    }

    private function registerBladeFeatureDirective(): void
    {
        Blade::directive('feature', fn ($featureName) => "<?php if (app(\\LaravelFeature\\Domain\\FeatureManager::class)->isEnabled({$featureName})): ?>");

        Blade::directive('endfeature', fn () => '<?php endif; ?>');
    }

    private function registerBladeFeatureForDirective(): void
    {
        Blade::directive('featurefor', fn ($args) => "<?php if (app(\\LaravelFeature\\Domain\\FeatureManager::class)->isEnabledFor({$args})): ?>");

        Blade::directive('endfeaturefor', fn () => '<?php endif; ?>');
    }

    private function registerConsoleCommand(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ScanViewsForFeaturesCommand::class
            ]);
        }
    }
}
