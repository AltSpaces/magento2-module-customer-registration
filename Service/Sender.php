<?php

declare(strict_types=1);

namespace Service;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Area;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\Store;
use Psr\Log\LoggerInterface;
use System\CustomerRegistrationConfig;
use System\SupportInfoConfig;

/**
 * This class is responsible notifying support that customer has been registered
 */
class Sender
{
    /**
     * @param CustomerRegistrationConfig $customerRegistrationConfigProvider
     * @param SupportInfoConfig $supportConfigProvider
     * @param TimezoneInterface $timezone
     * @param StateInterface $inlineTranslation
     * @param TransportBuilder $transportBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        private CustomerRegistrationConfig $customerRegistrationConfigProvider,
        private SupportInfoConfig $supportConfigProvider,
        private TimezoneInterface $timezone,
        private StateInterface $inlineTranslation,
        private TransportBuilder $transportBuilder,
        private LoggerInterface $logger
    ) {
    }

    /**
     * Send email to support
     *
     * @param CustomerInterface $customer
     *
     * @return void
     */
    public function send(CustomerInterface $customer): void
    {
        if (!$this->customerRegistrationConfigProvider->isEnabled()) {
            return;
        }

        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->supportConfigProvider->getName(),
                'email' => $this->supportConfigProvider->getEmail(),
            ];

            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->customerRegistrationConfigProvider->getTemplateId())
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_ADMINHTML,
                        'store' => Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'customer'  => $customer,
                    'date' => $this->timezone->date()->format('Y-m-d H:i:s')
                ])
                ->setFromByScope($sender)
                ->addTo($this->supportConfigProvider->getEmail())
                ->getTransport();

            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}
