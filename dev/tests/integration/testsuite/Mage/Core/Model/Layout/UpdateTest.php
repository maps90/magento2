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
 * @package     Mage_Core
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Core_Model_Layout_UpdateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mage_Core_Model_Layout_Update
     */
    protected $_model;

    protected function setUp()
    {
        $this->_model = Mage::getModel('Mage_Core_Model_Layout_Update');
    }

    protected function tearDown()
    {
        $this->_model = null;
    }

    public function testConstructor()
    {
        $this->_model = Mage::getModel('Mage_Core_Model_Layout_Update');
        $this->assertInstanceOf('Mage_Core_Model_Resource_Layout_Update', $this->_model->getResource());
    }

    /**
     * @magentoDbIsolation enabled
     */
    public function testCrud()
    {
        $this->_model->setData(array(
            'handle' => 'default',
            'xml' => '<layout/>',
            'sort_order' => 123,
        ));
        $entityHelper = new Magento_Test_Entity($this->_model, array(
            'handle' => 'custom',
            'xml' => '<layout version="0.1.0"/>',
            'sort_order' => 456,
        ));
        $entityHelper->testCrud();
    }
}
