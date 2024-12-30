<?php

declare(strict_types=1);

namespace Plugin\Customer\Model;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;

/**
 * This plugin is responsible for trimming customer name before saving it
 */
class TrimCustomerName
{
    /**
     * Trim whitespaces from customer name
     *
     * @param AccountManagementInterface $subject
     * @param CustomerInterface $customer
     * @param string $password
     * @param string $redirectUrl
     *
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeCreateAccount(
        AccountManagementInterface $subject,
        CustomerInterface $customer,
        $password,
        $redirectUrl
    ): array {
        $customer->setFirstname(preg_replace('/\s+/', '', $customer->getFirstname()));

        return [$customer, $password, $redirectUrl];
    }
}
