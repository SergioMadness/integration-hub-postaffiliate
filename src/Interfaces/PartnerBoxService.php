<?php namespace professionalweb\IntegrationHub\Postaffiliate\Interfaces;

interface PartnerBoxService
{
    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings): self;

    /**
     * Send event
     *
     * @param array $data
     *
     * @return string
     */
    public function sendEvent(array $data): string;

    /**
     * Approve transaction
     *
     * @param string $transactionId
     */
    public function approveTransaction(string $transactionId): void;

    /**
     * Decline transaction
     *
     * @param string $transactionId
     */
    public function declineTransaction(string $transactionId): void;

    /**
     * Set status to transaction
     *
     * @param string $transactionId
     * @param string $transactionStatus
     */
    public function setTransactionStatus(string $transactionId, string $transactionStatus): void;
}