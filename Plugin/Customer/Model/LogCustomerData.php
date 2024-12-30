<?php

declare(strict_types=1);

namespace Plugin\Customer\Model;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Psr\Log\LoggerInterface;

/**
 * This plugin is responsible for logging customer data after registration
 */
class LogCustomerData
{
    /**
     * @param TimezoneInterface $timezone
     * @param LoggerInterface $logger
     */
    public function __construct(
        private TimezoneInterface $timezone,
        private LoggerInterface $logger
    ) {
    }

    /**
     * Log customer data
     *
     * @param AccountManagementInterface $subject
     * @param CustomerInterface $customer
     *
     * @return CustomerInterface
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterCreateAccount(
        AccountManagementInterface $subject,
        CustomerInterface $customer
    ): CustomerInterface {
        $dateTime = $this->timezone->date()->format('Y-m-d H:i:s');
        $this->logger->info(
            $dateTime . ', '
            . $customer->getFirstname() . ' ' . $customer->getLastname() . ', '
            . $customer->getEmail()
        );

        return $customer;
    }
}
