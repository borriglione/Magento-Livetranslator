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
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2011 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Create link for enabling live translation
 *
 * @category   Netresearch
 * @package    Netresearch_Livetranslator
 * @author     Mario Behrendt <mario.behrendt@netresearch.de>
 */
class Netresearch_Livetranslator_Block_System_Config_Form_Field_LinkRenderer
extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * Return the link which enables inline translation 
     * 
     * @param Varien_Data_Form_Element_Abstract $element 
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        // Timeout text
        $id = 'enable-inline-translation-link';
        $txt = $this->__('Disabled for security reasons, please reload.');

        // Build Javascript
        $script = sprintf('setTimeout("$(\'%s\').update(\'%s\')", 60000)', $id, $txt);
        $js = sprintf('<script type="text/javascript">%s</script>', $script);

        $hash = Mage::helper('livetranslator')->getCurrentHash();

        $store = Mage::getModel('core/store')->getCollection()->addFieldToFilter('is_active = ?', 1)->getFirstItem();

        $url = Mage::getUrl('livetranslator/switch/enable', array('hash' => $hash, '_store' => $store->getId()));
        $trans = $this->__('Enable inline translation for this session');

        $link = sprintf('<a href="%s" target="_blank">%s</a>', $url, $trans);

        return sprintf('%s<span id="%s">%s</span>', $js, $id, $link);
    }
}
