<?php
class CommandCreateAccess extends Command {
	private $_command;

	/**
	 * CommandCreateAccess constructor.
	 *
	 * @param Access $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAccess($entity);
		$this->_command = FactoryCommand::createCommandGetAccessByName($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AccessAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			$this->_command = FactoryCommand::createCommandGetAccessByAbbreviation($this->_command->return());
			$this->_command->execute();
			throw new AccessAlreadyExistException("Este acceso ya existe");
		}
		catch (AccessNotFoundException $e) {
			$this->setData($this->_dao->createAccess());
		}
	}

	/**
	 * @return Access
	 */
	public function return ():Access {
		return $this->getData();
	}
}