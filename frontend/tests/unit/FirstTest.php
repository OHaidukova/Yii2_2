<?php namespace frontend\tests;

use common\models\Tasks;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->assertEquals(4, 2+2);
    }

    public function testTasksCurrentMonths()
    {
        $tasks = Tasks::getTasksCurrentMonth();
        $this->assertEquals(101, $tasks[0].number);
    }

}