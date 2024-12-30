<?php

declare(strict_types=1);

namespace Plugin\Customer\Model;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Service\Sender;

/**
 * This plugin is responsible for sending email notification about customer creation to support
 */
class NotifySupport
{
    /**
     * @param Sender $sender
     */
    public function __construct(
        private Sender $sender
    ) {
    }

    /**
     * Notify support about customer account creation
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
        $this->sender->send($customer);

        return $customer;
    }
}
