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
        return [
            'amount'       => 'Amount',
            'email'        => 'E-mail',
            'order_id'     => 'Order ID',
            'product_id'   => 'Product ID',
            'data1'        => 'Data 1',
            'data2'        => 'Data 2',
            'data3'        => 'Data 3',
            'data4'        => 'Data 4',
            'data5'        => 'Data 5',
            'affiliate_id' => 'Affiliate id',
            'banner_id'    => 'Banner id',
            'campaign_id'  => 'Campaign id',
            'channel_id'   => 'Channel id',
        ];
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