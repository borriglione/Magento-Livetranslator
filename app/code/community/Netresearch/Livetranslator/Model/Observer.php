<?php
/**
 * Netresearch_Livetranslator_Model_Observer
 *
 * @category    Livetranslator
 * @package     Netresearch_Livetranslator
 * @author      Mario Behrendt <mario.behrendt@netresearch.de>
 * @copyright   Copyright (c) 2011 Netresearch GmbH & Co. KG <http://www.netresearch.de/>
 */
class Netresearch_Livetranslator_Model_Observer
{
    /**
     * Disable caching if inline editing is enabled 
     * 
     * @return void
     */
    public function disableCache()
    {
        if (Mage::getSingleton('core/session')->getInlineTranslationEnabled()) {
            // Disable cache for current request
            Mage::app()->getCache()->setOption('caching', false);
        }
    }
}
