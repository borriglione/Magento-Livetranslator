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
 * Display 'deactive inline translation' layer in frontend
 *
 * @category   Netresearch
 * @package    Netresearch_Livetranslator
 * @author     Mario Behrendt <mario.behrendt@netresearch.de>
 */
class Netresearch_Livetranslator_Block_Layer extends Mage_Core_Block_Template
{
    /**
     * Display html 
     * 
     * @return string
     */
    public function _toHtml()
    {
        return $this->getLayer();
    }
    
    /**
     * Build layer html 
     * 
     * @return string
     */
    public function getLayer()
    {
        $session = Mage::getSingleton('core/session');
        if (!$session->getInlineTranslationEnabled()) {
            return;
        }

        $url = Mage::getUrl('livetranslator/switch/disable');

        $text = 'Deactivate inline translation';
        $translation = $this->__($text);

        $div = '<div id="disable-inline-translation""><a href="%s">%s</a></div>';
        return sprintf($div, $url, $translation);
    }
}
