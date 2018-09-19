<?php namespace professionalweb\IntegrationHub\Postaffiliate\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface NewEventSubsystem extends Subsystem
{
    public const POSTAFFILIATE_NEW_TRANSACTION = 'postaffiliate-new-transaction';
}