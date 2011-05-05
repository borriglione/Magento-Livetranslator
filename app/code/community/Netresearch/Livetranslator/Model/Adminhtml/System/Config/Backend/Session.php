<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Core
 * @copyright  Copyright (c) 2011 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Overrides load and save of the select box
 *
 * @category   Netresearch
 * @package    Netresearch_Livetranslator
 * @author     Mario Behrendt <mario.behrendt@netresearch.de>
 */
class Netresearch_Livetranslator_Model_Adminhtml_System_Config_Backend_Session extends Mage_Core_Model_Config_Data
{
    /**
     * Get select value from session and set it
     * 
     * @return void
     */
    protected function _afterLoad()
    {
        $session = Mage::getSingleton('core/session');
        $enabled = $session->getInlineEditingEnabled();

        $this->setValue($enabled); 
    }

    /**
     * Save value into session and save 'false' in the database 
     * 
     * @return void
     */
    protected function _beforeSave()
    {
        $value = (bool) $this->getValue();

        $session = Mage::getSingleton('core/session');
        $session->setInlineEditingEnabled($value);

        $this->setValue(0);
    }
}
