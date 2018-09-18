<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxIntegrationService;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxService as IPartnerBoxService;

/**
 * Service to work with Post Affiliate Network (https://www.postaffiliatepro.com/)
 * @package professionalweb\IntegrationHub\Postaffiliate\Services
 */
class PartnerBoxService implements IPartnerBoxService
{
    /**
     * @var PartnerBoxIntegrationService
     */
    private $integrationService;

    public function __construct(PartnerBoxIntegrationService $partnerBoxIntegrationService)
    {
        $this->setIntegrationService($partnerBoxIntegrationService);
    }

    /**
     * Send event
     *
     * @param array $data
     *
     * @return int
     */
    public function sendEvent(array $data): int
    {
        $response = $this->getIntegrationService()
            ->sendEvent($data['event_name'], $data);

        return $response;
    }

    //<editor-fold desc="Getters and setters" defaultstate="collapsed">
    /**
     * Get integration service
     *
     * @return PartnerBoxIntegrationService
     */
    public function getIntegrationService(): PartnerBoxIntegrationService
    {
        return $this->integrationService;
    }

    /**
     * Set integration service
     *
     * @param PartnerBoxIntegrationService $integrationService
     *
     * @return $this
     */
    public function setIntegrationService(PartnerBoxIntegrationService $integrationService): self
    {
        $this->integrationService = $integrationService;

        return $this;
    }

    /**
     * Set service settings
     *
     * @param array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings): IPartnerBoxService
    {
        $newIntegrationService = app(PartnerBoxIntegrationService::class);
        foreach ($settings as $key => $value) {
            $methodName = 'set' . camel_case($key);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            } elseif (method_exists($newIntegrationService, $methodName)) {
                $newIntegrationService->$methodName($value);
            }
        }
        $this->setIntegrationService($newIntegrationService);

        return $this;
    }
    //</editor-fold>
}