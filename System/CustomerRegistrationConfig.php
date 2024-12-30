<?php

declare(strict_types=1);

namespace System;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Module related customer registration config data provider
 */
class CustomerRegistrationConfig
{
    private const BASE_CONFIG_PATH = 'atwix_customer_registration/general/';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * Returns support notify functionality status
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::BASE_CONFIG_PATH . 'enabled');
    }

    /**
     * Retrieve support notify template
     *
     * @return string
     */
    public function getTemplateId(): string
    {
        return $this->scopeConfig->getValue(self::BASE_CONFIG_PATH . 'template');
    }
}
