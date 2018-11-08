<?php namespace professionalweb\IntegrationHub\Postaffiliate\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface GetEventSubsystem extends Subsystem
{
    public const POSTAFFILIATE_GET_TRANSACTION = 'postaffiliate-get-transaction';
}