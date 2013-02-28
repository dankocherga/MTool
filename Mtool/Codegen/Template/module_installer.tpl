<?php
/**
 * #{module_owner} extension for Magento
 *
 * Long description of this file (if any...)
 *
 * NOTICE OF LICENSE
 *
#{license}
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the #{company_name} #{module} module to newer versions in the future.
 * If you wish to customize the #{company_name} #{module} module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   #{company_name}
 * @package    #{module_name}
 * @copyright  Copyright (C) #{year} #{copyright_company}
 * @license    #{license_short}
 */

/**
 * @var $this #{class}
 */

$installer = $this;
$installer->startSetup();

try {
    #code here...
} catch (Exception $e) {
    Mage::logException($e);
}
$installer->endSetup();
