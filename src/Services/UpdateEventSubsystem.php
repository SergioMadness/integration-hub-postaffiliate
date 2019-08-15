<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Models\UpdateEventOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\SetStatusSubsystem as ISetStatusSubsystem;

/**
 * Subsystem to update events in partnerbox
 * @package professionalweb\IntegrationHub\Postaffiliate\Services
 */
class UpdateEventSubsystem implements ISetStatusSubsystem
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
     * @return UpdateEventOptions
     */
    public function getAvailableOptions(): SubsystemOptions
    {
        return new UpdateEventOptions();
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
        $transactionId = $eventData->getData()['transaction_id'] ?? null;
        $params = $eventData->getData()['params'] ?? [];
        if ($transactionId !== null && !empty($params)) {
            $this->getPartnerBoxService()->updateEvent($transactionId, $params);
        }

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