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
        $id = 2;
        $listName = array('id'=>'2',
                            'taskName'=>'task2');
        $this->taskList->createList(array('taskName'=>'task2'));
        $result = $this->taskList->getLists($id);
        $this->assertEquals($listName, $result);
    }
    /**
     * @test
     */
    public function should_get_all_list()
    {
        $id = 1;
        $result = $this->taskList->getLists($id);
        $expected = array('id'=>'1',
            'taskName'=>'task1');
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function should_throw_error_when_try_create_a_list_with_a_name_existing()
    {
        $this->expectExceptionMessage("Ya existe taskList");
        $this->taskList->createList(array('taskName'=>'task1'));

    }
}
