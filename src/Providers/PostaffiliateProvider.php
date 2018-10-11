<?php namespace professionalweb\IntegrationHub\Postaffiliate\Providers;

require __DIR__ . '/../Lib/PapApi.class.php';

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Postaffiliate\Services\SendEventService;
use professionalweb\IntegrationHub\Postaffiliate\Services\PartnerBoxService;
use professionalweb\IntegrationHub\Postaffiliate\Services\SetStatusSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\NewEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Services\PartnerBoxIntegrationService;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService as IPartnerBoxService;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\SetStatusSubsystem as ISetStatusSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

class PostaffiliateProvider extends ServiceProvider
{
    public function boot(): void
    {
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind(IPartnerBoxIntegrationService::class, PartnerBoxIntegrationService::class);
        $this->app->bind(IPartnerBoxService::class, PartnerBoxService::class);
        $this->app->bind(NewEventSubsystem::class, SendEventService::class);
        $this->app->bind(ISetStatusSubsystem::class, SetStatusSubsystem::class);
    }
}