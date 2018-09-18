<?php namespace professionalweb\IntegrationHub\Postaffiliate\Interfaces;

/**
 * Interface for service for integration with partner box
 * @package professionalweb\IntegrationHub\Postaffiliate\Interfaces
 */
interface PartnerBoxIntegrationService
{
    public const STATUS_APPROVED = 'A';

    public const STATUS_PENDING = 'P';

    public const STATUS_DECLINED = 'D';

    /**
     * Set visitor's ID
     *
     * @param mixed $visitorId
     *
     * @return PartnerBoxIntegrationService
     */
    public function setVisitorId($visitorId): self;

    /**
     * Send event
     *
     * @param string     $eventName
     * @param array      $data
     *
     * @return mixed
     */
    public function sendEvent(string $eventName, array $data);

    /**
     * Set status to transaction
     *
     * @param int|string $orderId
     * @param string     $status
     *
     * @return mixed
     */
    public function setTransactionStatus($orderId, string $status);
}