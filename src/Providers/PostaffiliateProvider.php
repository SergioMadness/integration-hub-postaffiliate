<?php namespace professionalweb\IntegrationHub\Postaffiliate\Providers;

use Illuminate\Support\ServiceProvider;
use professionalweb\IntegrationHub\Postaffiliate\Models\NewEventOptions;
use professionalweb\IntegrationHub\Postaffiliate\Models\GetEventOptions;
use professionalweb\IntegrationHub\Postaffiliate\Models\SetStatusOptions;
use professionalweb\IntegrationHub\Postaffiliate\Services\GetEventService;
use professionalweb\IntegrationHub\Postaffiliate\Services\SendEventService;
use professionalweb\IntegrationHub\Postaffiliate\Models\UpdateEventOptions;
use professionalweb\IntegrationHub\Postaffiliate\Services\PartnerBoxService;
use professionalweb\IntegrationHub\Postaffiliate\Services\SetStatusSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\NewEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\GetEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Services\UpdateEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Services\PartnerBoxIntegrationService;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\SubsystemPool;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService as IPartnerBoxService;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\SetStatusSubsystem as ISetStatusSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\UpdateEventSubsystem as IUpdateEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

class PostaffiliateProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'IntegrationHubPostaffiliate');

        $this->app->booted(static function () {
            /** @var SubsystemPool $pool */
            $pool = app(SubsystemPool::class);
            $pool->register(trans('IntegrationHubPostaffiliate::common.new-event'), SendEventService::POSTAFFILIATE_NEW_TRANSACTION, new NewEventOptions());
            $pool->register(trans('IntegrationHubPostaffiliate::common.get-event'), GetEventService::POSTAFFILIATE_GET_TRANSACTION, new GetEventOptions());
            $pool->register(trans('IntegrationHubPostaffiliate::common.set-status'), SetStatusSubsystem::POSTAFFILIATE_SET_STATUS, new SetStatusOptions());
            $pool->register(trans('IntegrationHubPostaffiliate::common.update-event'), UpdateEventSubsystem::POSTAFFILIATE_UPDATE_EVENT, new UpdateEventOptions());
        });
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind(GetEventSubsystem::class, GetEventService::class);
        $this->app->bind(NewEventSubsystem::class, SendEventService::class);
        $this->app->bind(IPartnerBoxService::class, PartnerBoxService::class);
        $this->app->bind(ISetStatusSubsystem::class, SetStatusSubsystem::class);
        $this->app->bind(IUpdateEventSubsystem::class, UpdateEventSubsystem::class);
        $this->app->bind(IPartnerBoxIntegrationService::class, PartnerBoxIntegrationService::class);
    }
}