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
require_once __DIR__ . './../../src/logic/Plan/GetAllPlanCommand.php';
/**
 * Class UpdatePlanCommandTest
 * @covers GetPlanByIdCommand
 */
class UpdatePlanCommandTest extends TestCase {
	private $_command;
	private $_plan;

	public function testReturn () {
		try {
			$this->_command->execute();
			$this->assertNotEmpty($this->_command->return());
			$this->_plan = FactoryEntity::createPlan($this->_command->return()->getId(), 'pedro', 235435.0);
			$this->_command = FactoryCommand::createUpdatePlanCommand($this->_plan);
			$this->_command->execute();
			$plan = $this->_command->return();
			Environment::database()->exec('DELETE FROM plan WHERE pl_id =' . $this->_plan->getId());
			$this->assertEquals($this->_plan->getId(), $plan->getId());
			$this->assertEquals($this->_plan->getName(), $plan->getName());
			$this->assertEquals($this->_plan->getPrice(), $plan->getPrice());
			$this->assertNotEquals($this->_plan->getDateModified(), $plan->getDateModified());
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
		$this->_plan = FactoryEntity::createPlan(-1, '65ruy7iyui', 4849.0);
		$this->_command = FactoryCommand::createCreatePlanCommand($this->_plan);
	}
}
