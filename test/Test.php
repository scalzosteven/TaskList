<?php

namespace App;

use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public $taskList;
    public function setUp()
    {
        $this->taskList = new SQLiteConnection();
    }

    /**
   * @test
   */
    public function should_generate_table()
    {
        $taskListMock = $this->getMockBuilder(SQLiteConnection::class)
            ->setMethods(['generateTable'])
            ->getMock();
        $taskListMock->expects($this->once())
            ->method('generateTable');
        $taskListMock->connect();
    }


    /**
     * @test
     */
    public function should_create_list()
    {
        $listName = array('id'=>'1',
                            'taskName'=>'task1');
        $this->taskList->createList(array('taskName'=>'task1'));
        $result = $this->taskList->getLists();
        $this->assertEquals($listName, $result);
    }
    /**
     * @test
     */
    public function should_get_all_list()
    {
        $result = $this->taskList->getLists();
        $expected = array('id'=>'1',
            'taskName'=>'task1');
        $this->assertEquals($expected, $result);
    }
}
