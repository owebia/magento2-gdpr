<?php
/**
 * Copyright © 2018 OpenGento, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Opengento\Gdpr\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Opengento\Gdpr\Model\Config\ErasureComponentStrategy;

/**
 * Class Config
 */
class Config
{
    /**#@+
     * Scope Config: Data Settings Paths
     */
    const CONFIG_PATH_GENERAL_ENABLED = 'gdpr/general/enabled';
    const CONFIG_PATH_GENERAL_INFORMATION_PAGE = 'gdpr/general/page_id';
    const CONFIG_PATH_GENERAL_INFORMATION_BLOCK = 'gdpr/general/block_id';
    const CONFIG_PATH_ERASURE_ENABLED = 'gdpr/erasure/enabled';
    const CONFIG_PATH_ERASURE_STRATEGY = 'gdpr/erasure/strategy';
    const CONFIG_PATH_ERASURE_TIME_LAPSE = 'gdpr/erasure/time_lapse';
    const CONFIG_PATH_ERASURE_INFORMATION_BLOCK = 'gdpr/erasure/block_id';
    const CONFIG_PATH_ERASURE_STRATEGY_COMPONENTS = 'gdpr/erasure/components';
    const CONFIG_PATH_ANONYMIZE_INFORMATION_BLOCK = 'gdpr/anonymize/block_id';
    const CONFIG_PATH_ANONYMIZE_CUSTOMER_ATTRIBUTES = 'gdpr/anonymize/customer_attributes';
    const CONFIG_PATH_ANONYMIZE_CUSTOMER_ADDRESS_ATTRIBUTES = 'gdpr/anonymize/customer_address_attributes';
    const CONFIG_PATH_EXPORT_ENABLED = 'gdpr/export/enabled';
    const CONFIG_PATH_EXPORT_INFORMATION_BLOCK = 'gdpr/export/block_id';
    const CONFIG_PATH_EXPORT_RENDERER = 'gdpr/export/renderer';
    const CONFIG_PATH_EXPORT_CUSTOMER_ATTRIBUTES = 'gdpr/export/customer_attributes';
    const CONFIG_PATH_EXPORT_CUSTOMER_ADDRESS_ATTRIBUTES = 'gdpr/export/customer_address_attributes';
    const CONFIG_PATH_COOKIE_DISCLOSURE_ENABLED = 'gdpr/cookie/enabled';
    const CONFIG_PATH_COOKIE_DISCLOSURE_INFORMATION = 'gdpr/cookie/information';
    /**#@-*/

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var \Opengento\Gdpr\Model\Config\ErasureComponentStrategy
     */
    private $erasureComponentStrategy;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Opengento\Gdpr\Model\Config\ErasureComponentStrategy $erasureComponentStrategy
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErasureComponentStrategy $erasureComponentStrategy
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->erasureComponentStrategy = $erasureComponentStrategy;
    }

    /**
     * Check if the current module is enabled
     *
     * @return bool
     */
    public function isModuleEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_GENERAL_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the privacy information page ID
     *
     * @return string
     */
    public function getPrivacyInformationPageId(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_GENERAL_INFORMATION_PAGE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the privacy information block ID
     *
     * @return string
     */
    public function getPrivacyInformationBlockId(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_GENERAL_INFORMATION_BLOCK, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if the erasure is enabled
     *
     * @return bool
     */
    public function isErasureEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_ERASURE_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the default strategy to apply
     *
     * @return string
     */
    public function getDefaultStrategy(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_ERASURE_STRATEGY, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the components configured for the deletion strategy
     *
     * @return array
     */
    public function getErasureStrategyComponents(): array
    {
        return $this->getValueArray(self::CONFIG_PATH_ERASURE_STRATEGY_COMPONENTS, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the erasure time lapse before execution
     *
     * @return int
     */
    public function getErasureTimeLapse(): int
    {
        return (int) $this->scopeConfig->getValue(self::CONFIG_PATH_ERASURE_TIME_LAPSE, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the erasure information block ID
     *
     * @return string
     */
    public function getErasureInformationBlockId(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_ERASURE_INFORMATION_BLOCK, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the anonymize information block ID
     *
     * @return string
     */
    public function getAnonymizeInformationBlockId(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_ANONYMIZE_INFORMATION_BLOCK, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the anonymous customer attributes codes
     *
     * @return array
     */
    public function getAnonymizeCustomerAttributes(): array
    {
        return $this->getValueArray(self::CONFIG_PATH_ANONYMIZE_CUSTOMER_ATTRIBUTES, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the anonymous customer address attributes codes
     *
     * @return array
     */
    public function getAnonymizeCustomerAddressAttributes(): array
    {
        return $this->getValueArray(
            self::CONFIG_PATH_ANONYMIZE_CUSTOMER_ADDRESS_ATTRIBUTES,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Check if the export is enabled
     *
     * @return bool
     */
    public function isExportEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_EXPORT_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the export information block ID
     *
     * @return string
     */
    public function getExportInformationBlockId(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_EXPORT_INFORMATION_BLOCK, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the export renderer code
     *
     * @return string
     */
    public function getExportRendererCode(): string
    {
        return $this->scopeConfig->getValue(self::CONFIG_PATH_EXPORT_RENDERER, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the export customer attributes codes
     *
     * @return array
     */
    public function getExportCustomerAttributes(): array
    {
        return $this->getValueArray(self::CONFIG_PATH_EXPORT_CUSTOMER_ATTRIBUTES, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the export customer address attributes codes
     *
     * @return array
     */
    public function getExportCustomerAddressAttributes(): array
    {
        return $this->getValueArray(self::CONFIG_PATH_EXPORT_CUSTOMER_ADDRESS_ATTRIBUTES, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if the cookie disclosure is enabled
     *
     * @return bool
     */
    public function isCookieDisclosureEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::CONFIG_PATH_COOKIE_DISCLOSURE_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Retrieve the cookie disclosure text information
     *
     * @return string
     */
    public function getCookieDisclosureInformation(): string
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_PATH_COOKIE_DISCLOSURE_INFORMATION,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Retrieve the scope config value as an array
     *
     * @param string $path
     * @param string $scopeType
     * @param null|string $scopeCode
     * @return array
     */
    private function getValueArray(
        string $path,
        string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        string $scopeCode = ''
    ): array
    {
        return \explode(',', $this->scopeConfig->getValue($path, $scopeType, $scopeCode ?: null));
    }
}
