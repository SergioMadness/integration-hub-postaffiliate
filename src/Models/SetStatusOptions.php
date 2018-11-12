<?php namespace professionalweb\IntegrationHub\Postaffiliate\Models;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Postaffiliate\Models
 */
class SetStatusOptions extends NewEventOptions
{


    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [
            'transaction_id' => 'transaction_id',
            'status'         => 'status',
        ];
    }

    /**
     * Get array fields, that subsystem generates
     *
     * @return array
     */
    public function getAvailableOutFields(): array
    {
        return [];
    }
}