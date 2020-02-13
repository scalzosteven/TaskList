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
    public function should_get_all_list()
    {
        $result[] = array();
        $result = $this->taskList->getLists();
        $expected = array('name' => 'steven');
        $this->assertEquals($expected, $result);
    }

}
