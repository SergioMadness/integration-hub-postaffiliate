<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\NewEventSubsystem;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

class SendEventService implements NewEventSubsystem
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
        // TODO: Implement setProcessOptions() method.
    }

    /**
     * Get available options
     *
     * @return SubsystemOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        // TODO: Implement getAvailableOptions() method.
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
        // TODO: Implement process() method.
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