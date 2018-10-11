<?php namespace professionalweb\IntegrationHub\Postaffiliate\Interfaces;

use professionalweb\IntegrationHub\IntegrationHubCommon\Interfaces\Services\Subsystem;

interface SetStatusSubsystem extends Subsystem
{
    public const POSTAFFILIATE_APPROVE_TRANSACTION = 'postaffiliate-set-status';
}