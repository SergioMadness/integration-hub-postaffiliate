<?php namespace professionalweb\IntegrationHub\Postaffiliate\Services;

use professionalweb\IntegrationHub\Postaffiliate\Exceptions\WrongCredentialsException;
use professionalweb\IntegrationHub\Postaffiliate\Interfaces\PartnerBoxIntegrationService as IPartnerBoxIntegrationService;

/**
 * Service for integration with PartnerBox
 * @package professionalweb\IntegrationHub\Postaffiliate\Services
 */
class PartnerBoxIntegrationService implements IPartnerBoxIntegrationService
{
    /**
     * @var \Gpf_Api_Session
     */
    private $session;

    /**
     * @var string
     */
    private $serverUrl;

    /**
     * @var string
     */
    private $saleUrl;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string|int
     */
    private $visitorId;

    /**
     * @var \Pap_Api_SaleTracker
     */
    private $saleTracker;

    /**
     * @var string|int
     */
    private $accountId;

    /**
     * Create session
     *
     * @return \Gpf_Api_Session
     * @throws WrongCredentialsException
     */
    protected function createSession(): \Gpf_Api_Session
    {
        if ($this->session === null) {
            $this->session = new \Gpf_Api_Session($this->getServerUrl());
            if (!$this->session->login($this->getLogin(), $this->getPassword())) {
                throw new WrongCredentialsException();
            }
        }

        return $this->session;
    }

    /**
     * Create sale tracker
     *
     * @return \Pap_Api_SaleTracker
     */
    protected function createSaleTracker(): \Pap_Api_SaleTracker
    {
        if ($this->saleTracker === null) {
            $this->saleTracker = new \Pap_Api_SaleTracker($this->getSaleUrl());
            $this->saleTracker->setAccountId($this->getAccountId());
            $this->saleTracker->setVisitorId($this->getVisitorId());
        }

        return $this->saleTracker;
    }

    /**
     * Send event
     *
     * @param string $eventName
     * @param array  $data
     *
     * @return mixed
     */
    public function sendEvent(string $eventName, array $data)
    {
        $saleTracker = $this->createSaleTracker();
        $action = $saleTracker->createAction($eventName);
        foreach ($data as $param => $value) {
            $methodName = 'set' . studly_case($param);
            if (method_exists($action, $methodName)) {
                $action->$methodName($value);
            } elseif (method_exists($saleTracker, $methodName)) {
                $saleTracker->$methodName($value);
            } elseif (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }

        $saleTracker->register();

        return $saleTracker->getTrackerResponse();
    }

    /**
     * Get event by order id
     *
     * @param string $orderId
     *
     * @return array
     * @throws WrongCredentialsException
     */
    public function getEvent(string $orderId): array
    {
        $request = new \Pap_Api_TransactionsGrid($this->createSession());
        $request->addFilter('orderid', \Gpf_Data_Filter::EQUALS, $orderId);
        $request->sendNow();
        $grid = $request->getGrid();
        $recordSet = $grid->getRecordset();

        $rec = $recordSet->get(0);

        return $rec !== null ? $rec->getAttributes() : [];
    }

    /**
     * Set status to transaction
     *
     * @param int|string $orderId
     * @param string     $status
     *
     * @return mixed
     * @throws WrongCredentialsException
     */
    public function setTransactionStatus($orderId, string $status)
    {
        $event = $this->getEvent($orderId);
        if (!empty($event) && isset($event['id'])) {
            try {
                $sale = new \Pap_Api_Transaction($this->session);
                $sale->setTransid($event['id']);
                if ($sale->load()) {
                    $sale->setStatus($status);
                    if ($sale->save()) {
                        return true;
                    }
                }
            } catch (\Exception $ex) {
                return false;
            }
        }

        return false;
    }

    //<editor-fold desc="Getters and setters" defaultstate="collapsed">

    /**
     * Set server url
     *
     * @param string $url
     *
     * @return $this
     */
    public function setServerUrl(string $url): IPartnerBoxIntegrationService
    {
        $this->serverUrl = $url;

        return $this;
    }

    /**
     * Get server url
     *
     * @return string
     */
    public function getServerUrl(): ?string
    {
        return $this->serverUrl;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return $this
     */
    public function setLogin(string $login): IPartnerBoxIntegrationService
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): IPartnerBoxIntegrationService
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set visitor's ID
     *
     * @param mixed $visitorId
     *
     * @return $this
     */
    public function setVisitorId($visitorId): IPartnerBoxIntegrationService
    {
        $this->visitorId = $visitorId;

        return $this;
    }

    /**
     * Get visitor's ID
     *
     * @return int|string
     */
    public function getVisitorId()
    {
        return $this->visitorId;
    }

    /**
     * Set account id
     *
     * @return int|string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set account id
     *
     * @param int|string $accountId
     *
     * @return PartnerBoxIntegrationService
     */
    public function setAccountId($accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get sale url
     *
     * @return string
     */
    public function getSaleUrl(): string
    {
        return $this->saleUrl;
    }

    /**
     * Set sale url
     *
     * @param string $saleUrl
     *
     * @return $this
     */
    public function setSaleUrl(string $saleUrl): self
    {
        $this->saleUrl = $saleUrl;

        return $this;
    }


    //</editor-fold>
}