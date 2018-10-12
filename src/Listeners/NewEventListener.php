<?php namespace professionalweb\IntegrationHub\Postaffiliate\Listeners;

use professionalweb\IntegrationHub\Postaffiliate\Interfaces\NewEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\SetStatusSubsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Events\EventToProcess;

class NewEventListener
{
    public function handle(EventToProcess $eventToProcess)
    {
        /** @var Subsystem $subsystem */
        $subsystem = null;
        switch ($eventToProcess->getProcessOptions()->getSubsystemId()) {
            case SetStatusSubsystem::POSTAFFILIATE_SET_STATUS:
                /** @var SetStatusSubsystem $subsystem */
                $subsystem = app(SetStatusSubsystem::class);
                break;
            case NewEventSubsystem::POSTAFFILIATE_NEW_TRANSACTION:
                /** @var NewEventSubsystem $subsystem */
                $subsystem = app(NewEventSubsystem::class);
                break;
        }

        if ($subsystem !== null) {
            return $subsystem->setProcessOptions($eventToProcess->getProcessOptions())->process($eventToProcess->getEventData());
        }
    }
}