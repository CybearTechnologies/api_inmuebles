<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . './../../vendor/autoload.php';
require_once __DIR__ . './../../src/logic/FactoryCommand.php';
require_once __DIR__ . './../../src/logic/Command.php';
require_once __DIR__ . './../../src/data_access/Dao/FactoryDao.php';
require_once __DIR__ . './../../src/data_access/Dao/Dao.php';
require_once __DIR__ . './../../core/Environment.php';
//-----------------------------------------------------------------------
require_once __DIR__ . './../../src/data_access/Dao/DaoPlan.php';
require_once __DIR__ . './../../src/logic/Plan/CommandGetAllPlan.php';
/**
 * Class UpdatePlanCommandTest
 * @covers CommandGetPlanById
 */
class DeletePlanCommandTest extends TestCase {
	private $_command;
	private $_plan;

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
			$this->_command = FactoryCommand::createDeletePlanByIdCommand($this->_command->return());
			$this->_command->execute();
			$this->_plan = $this->_command->return();
			$this->assertEquals(true, $this->_plan->isDelete());
		}
		catch (DatabaseConnectionException $exception) {
			echo $exception->getMessage();
		}
		catch (PlanAlreadyExistException $exception) {
			echo $exception->getMessage();
		}
	}

	protected function setUp ():void {
		parent::setUp();
		$this->_plan = FactoryEntity::createPlan(-1, 'Pepito', 4849.0);
		$this->_command = FactoryCommand::createCommandCreatePlan($this->_plan);
	}

	protected function tearDown ():void {
		parent::tearDown();
		Environment::database()->exec('DELETE FROM plan WHERE pl_id =' . $this->_plan->getId());
	}
}
