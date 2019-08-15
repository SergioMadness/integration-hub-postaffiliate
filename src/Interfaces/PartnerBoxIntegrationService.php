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
     * @param string $eventName
     * @param array  $data
     *
     * @return mixed
     */
    public function sendEvent(string $eventName, array $data);

    /**
     * Get event by order id
     *
     * @param string $orderId
     *
     * @return array
     */
    public function getEvent(string $orderId): array;

    /**
     * Set status to transaction
     *
     * @param string $orderId
     * @param string     $status
     *
     * @return mixed
     */
    public function setTransactionStatus(string $orderId, string $status): bool;

    /**
     * Update order
     *
     * @param string $orderId
     * @param array  $data
     *
     * @return bool
     */
    public function updateEvent(string $orderId, array $data): bool;
}