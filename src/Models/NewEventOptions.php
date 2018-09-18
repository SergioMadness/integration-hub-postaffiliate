<?php namespace professionalweb\IntegrationHub\Postaffiliate\Models;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Models\SubsystemOptions;

/**
 * Subsystem options
 * @package professionalweb\IntegrationHub\Postaffiliate\Models
 */
class NewEventOptions implements SubsystemOptions
{


    /**
     * Get available fields for mapping
     *
     * @return array
     */
    public function getAvailableFields(): array
    {
        return [];
    }

    /**
     * Get service settings
     *
     * @return array
     */
    public function getOptions(): array
    {
        return [
            'server_url' => [
                'name' => 'Url сервиса',
                'type' => 'string',
            ],
            'sale_url'   => [
                'name' => 'Sales url',
                'type' => 'string',
            ],
            'login'      => [
                'name' => 'Логин',
                'type' => 'string',
            ],
            'password'   => [
                'name' => 'Пароль',
                'type' => 'password',
            ],
            'account_id' => [
                'name' => 'Account id',
                'type' => 'string',
            ],
            'event_name' => [
                'name' => 'Event name',
                'type' => 'string',
            ],
        ];
    }
}