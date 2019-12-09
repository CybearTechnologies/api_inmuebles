<?php
class CreateAgencyCommand extends Command {
	private $_command;
	/**
	 * CreateAgencyCommand constructor.
	 *
	 * @param Agency $agency
	 */
	public function __construct ($agency) {
		$this->_command = FactoryCommand::createGetAgencyByNameCommand($agency);
		$this->_dao = FactoryDao::createDaoAgency($agency);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AgencyAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			Throw new AgencyAlreadyExistException("Agencia ya existente");
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