<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxIntegrationService;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService as IPartnerBoxService;

/**
 * Service to work with Post Affiliate Network (https://www.postaffiliatepro.com/)
 * @package professionalweb\IntegrationHub\Postaffiliate\Services
 */
class PartnerBoxService implements IPartnerBoxService
{
    /**
     * @var PartnerBoxIntegrationService
     */
    private $integrationService;

    /**
     * @var string
     */
    private $eventName;

    public function __construct(PartnerBoxIntegrationService $partnerBoxIntegrationService)
    {
        $this->setIntegrationService($partnerBoxIntegrationService);
    }

    /**
     * Send event
     *
     * @param array $data
     *
     * @return string
     */
    public function sendEvent(array $data): string
    {
        $response = $this->getIntegrationService()
            ->sendEvent($this->getEventName(), $data);

        return $response;
    }

    /**
     * Get event
     *
     * @param string $orderId
     *
     * @return array
     */
    public function getEvent(string $orderId): array
    {
        $response = $this->getIntegrationService()
            ->getEvent($orderId);

        return $response;
    }

    /**
     * Approve transaction
     *
     * @param string $transactionId
     */
    public function approveTransaction(string $transactionId): void
    {
        $this->getIntegrationService()->setTransactionStatus($transactionId, PartnerBoxIntegrationService::STATUS_APPROVED);
    }

    /**
     * Decline transaction
     *
     * @param string $transactionId
     */
    public function declineTransaction(string $transactionId): void
    {
        $this->getIntegrationService()->setTransactionStatus($transactionId, PartnerBoxIntegrationService::STATUS_DECLINED);
    }

    /**
     * Set status to transaction
     *
     * @param string $transactionId
     * @param string $transactionStatus
     */
    public function setTransactionStatus(string $transactionId, string $transactionStatus): void
    {
        $this->getIntegrationService()->setTransactionStatus($transactionId, $transactionStatus);
    }

    //<editor-fold desc="Getters and setters" defaultstate="collapsed">

    /**
     * Get integration service
     *
     * @return PartnerBoxIntegrationService
     */
    public function getIntegrationService(): PartnerBoxIntegrationService
    {
        return $this->integrationService;
    }

    /**
     * Set integration service
     *
     * @param PartnerBoxIntegrationService $integrationService
     *
     * @return $this
     */
    public function setIntegrationService(PartnerBoxIntegrationService $integrationService): self
    {
        $this->integrationService = $integrationService;

        return $this;
    }

    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings): IPartnerBoxService
    {
        $newIntegrationService = app(PartnerBoxIntegrationService::class);
        foreach ($settings as $key => $value) {
            $methodName = 'set' . camel_case($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            } elseif (method_exists($newIntegrationService, $methodName)) {
                $newIntegrationService->$methodName($value);
            }
        }
        $this->setIntegrationService($newIntegrationService);

        return $this;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     *
     * @return $this
     */
    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    //</editor-fold>
}