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

//
//    /**
//     * @test
//     */
//    public function should_create_list()
//    {
//        $id = 3;
//        $listName = array('id'=>'3',
//            'taskName'=>'task3');
//        $this->taskList->createList(array('taskName'=>'task3'));
//        $result = $this->taskList->getListsById($id);
//        $this->assertEquals($listName, $result);
//    }
    /**
     * @test
     */
    public function should_get_list_by_id()
    {
        $id = 1;
        $result = $this->taskList->getListsById($id);
        $expected = array('id'=>'1',
            'taskName'=>'task1');
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function should_get_list_by_taskName()
    {
        $taskName = 'task1';
        $result = $this->taskList->getListsByTaskName($taskName);
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

//    /**
//     * @test
//     */
//    public function should_remove_list()
//    {
//        $taskListMock = $this->getMockBuilder(SQLiteConnection::class)
//            ->setMethods(['removeList'])
//            ->getMock();
//        $taskListMock->expects($this->once())
//            ->method('removeList');
//        $taskListMock->removeList(array('taskName'=>'task2'));
//    }
}
