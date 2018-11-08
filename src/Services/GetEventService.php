<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Models\GetEventOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\GetEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

class GetEventService implements GetEventSubsystem
{

    /**
     * @var PartnerBoxService
     */
    private $partnerBoxService;

    public function __construct(PartnerBoxService $partnerBoxService)
    {
        $this->setPartnerBoxService($partnerBoxService);
    }

    /**
     * Set options with values
     *
     * @param ProcessOptions $options
     *
     * @return Subsystem
     */
    public function setProcessOptions(ProcessOptions $options): Subsystem
    {
        $this->getPartnerBoxService()->setSettings($options->getOptions());

        return $this;
    }

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new GetEventOptions();
    }

    /**
     * Process event data
     *
     * @param EventData $eventData
     *
     * @return EventData
     */
    public function process(EventData $eventData): EventData
    {
        $this->getPartnerBoxService()->getEvent($eventData->getData()['order_id'] ?? '');

        return $eventData;
    }

    /**
     * @return PartnerBoxService
     */
    public function getPartnerBoxService(): PartnerBoxService
    {
        return $this->partnerBoxService;
    }

    /**
     * @param PartnerBoxService $partnerBoxService
     *
     * @return $this
     */
    public function setPartnerBoxService(PartnerBoxService $partnerBoxService): self
    {
        $this->partnerBoxService = $partnerBoxService;

        return $this;
    }
}