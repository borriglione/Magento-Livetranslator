<?php
/**
 * @category    Mage
 * @package     Netresearch_Livetranslator
 */


/**
 * Inline Translations PHP part
 *
 * @category   Mage
 * @package     Netresearch_Livetranslator
 * @author     Thomas Kappel <thomas.kappel@netresearch.de>
 */
class Netresearch_Livetranslator_Model_Translate_Inline extends Mage_Core_Model_Translate_Inline
{
    /**
     * Is enabled and allowed Inline Translates
     *
     * @param mixed $store
     * @return bool
     */
    public function isAllowed($store = null)
    {
        if (is_null($store)) {
            $store = Mage::app()->getStore();
        }
        if (!$store instanceof Mage_Core_Model_Store) {
            $store = Mage::app()->getStore($store);
        }

        if (is_null($this->_isAllowed)) {
            if (Mage::getDesign()->getArea() == 'adminhtml') {
                $active = Mage::getStoreConfigFlag('dev/translate_inline/active_admin', $store);
            } else {
                $active = Mage::getStoreConfigFlag('dev/translate_inline/active', $store)
			  or user has permission to translate...
            }

            $this->_isAllowed = $active && Mage::helper('core')->isDevAllowed($store);
        }

        $translate = Mage::getSingleton('core/translate');
        /* @var $translate Mage_Core_Model_Translate */

        return $translate->getTranslateInline() && $this->_isAllowed;
    }
}
