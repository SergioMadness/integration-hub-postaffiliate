<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Models\SetStatusOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\EventData;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\ProcessOptions;
use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\SetStatusSubsystem as ISetStatusSubsystem;

/**
 * Subsystem to approve transaction status in partnerbox
 * @package professionalweb\IntegrationHub\Postaffiliate\Services
 */
class SetStatusSubsystem implements ISetStatusSubsystem
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
        return new SetStatusOptions();
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
        $status = $eventData->getData()['status'] ?? null;
        if ($transactionId !== null) {
            $this->getPartnerBoxService()->setTransactionStatus($transactionId, $status);
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