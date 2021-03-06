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
 * @category    Magento
 * @package     Mage_Sales
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Sales_Block_Order_Print_InvoiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @magentoAppIsolation enabled
     */
    public function testGetInvoiceTotalsHtml()
    {
        $order = Mage::getModel('Mage_Sales_Model_Order');
        Mage::register('current_order', $order);
        $payment = Mage::getModel('Mage_Sales_Model_Order_Payment');
        $payment->setMethod('checkmo');
        $order->setPayment($payment);

        $layout = Mage::getModel('Mage_Core_Model_Layout');
        $block = $layout->createBlock('Mage_Sales_Block_Order_Print_Invoice', 'block');
        $childBlock = $layout->addBlock('Mage_Core_Block_Text', 'invoice_totals', 'block');

        $expectedHtml = '<b>Any html</b>';
        $invoice = Mage::getModel('Mage_Sales_Model_Order_Invoice');
        $this->assertEmpty($childBlock->getInvoice());
        $this->assertNotEquals($expectedHtml, $block->getInvoiceTotalsHtml($invoice));

        $childBlock->setText($expectedHtml);
        $actualHtml = $block->getInvoiceTotalsHtml($invoice);
        $this->assertSame($invoice, $childBlock->getInvoice());
        $this->assertEquals($expectedHtml, $actualHtml);
    }
}
