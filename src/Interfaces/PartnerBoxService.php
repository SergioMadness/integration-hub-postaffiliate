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
     * @return int
     */
    public function sendEvent(array $data): int;
}