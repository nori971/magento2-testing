<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Cms\Test\Unit\Model\ResourceModel;

abstract class AbstractCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Framework\DB\Select|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $select;

    /**
     * @var \Magento\Framework\DB\Adapter\Pdo\Mysql|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $connection;

    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $objectManager;

    /**
     * @var \Magento\Framework\Model\ModelResource\Db\AbstractDb|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $resource;

    protected function setUp()
    {
        $this->select = $this->getMockBuilder('Magento\Framework\DB\Select')
            ->disableOriginalConstructor()
            ->getMock();

        $this->connection = $this->getMockBuilder('Magento\Framework\DB\Adapter\Pdo\Mysql')
            ->disableOriginalConstructor()
            ->getMock();
        $this->connection->expects($this->any())->method('select')->willReturn($this->select);

        $this->resource = $this->getMockBuilder('Magento\Framework\Model\ModelResource\Db\AbstractDb')
            ->disableOriginalConstructor()
            ->setMethods(['getConnection', 'getMainTable', 'getTable'])
            ->getMockForAbstractClass();
        $this->resource->expects($this->any())->method('getConnection')->willReturn($this->connection);
        $this->resource->expects($this->any())->method('getMainTable')->willReturn('table_test');
        $this->resource->expects($this->any())->method('getTable')->willReturn('test');

        $this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
    }
}
