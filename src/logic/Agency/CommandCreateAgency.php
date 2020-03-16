<?php
class CommandCreateAgency extends Command {
	private $_command;
	/**
	 * CommandCreateAgency constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_command = FactoryCommand::createCommandGetAgencyByName($agency);
		$this->_dao = FactoryDao::createDaoAgency($agency);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AgencyAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new AgencyAlreadyExistException("Agency already exist", 403);
		}
		catch (AgencyNotFoundException $exception) {
			$this->setData($this->_dao->createAgency());
		}
	}

	/**
	 * @return Agency
	 */
	public function return ():Agency {
		return $this->getData();
	}
}