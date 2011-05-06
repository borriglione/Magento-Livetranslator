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
 * Enabling inline translation if set in session
 *
 * @category   Netresearch
 * @package    Netresearch_Livetranslator
 * @author     Mario Behrendt <mario.behrendt@netresearch.de>
 */
class Netresearch_Livetranslator_Model_Translate_Inline extends Mage_Core_Model_Translate_Inline
{
    /**
     * Is enabled and allowes inline translations
     *
     * @param mixed $store
     * @return bool
     */
    public function isAllowed($store = null)
    {
        if (Mage::getSingleton('core/session')->getInlineTranslationEnabled()) {
            return true;
        }

        return parent::isAllowed($store);
    }
}
