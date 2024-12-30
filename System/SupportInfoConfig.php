<?php

declare(strict_types=1);

namespace System;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Module related support info config provider
 */
class SupportInfoConfig
{
    private const BASE_CONFIG_PATH = 'trans_email/ident_support/';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * Get website support email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->scopeConfig->getValue(self::BASE_CONFIG_PATH . 'email');
    }

    /**
     * Get website support name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->scopeConfig->getValue(self::BASE_CONFIG_PATH . 'name');
    }
}
