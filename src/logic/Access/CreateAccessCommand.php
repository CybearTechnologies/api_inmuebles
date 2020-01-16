<?php
class CreateAccessCommand extends Command {
	private $_command;

	/**
	 * CreateAccessCommand constructor.
	 *
	 * @param Access $entity
	 */
	public function __construct ($entity) {
		$this->_dao = FactoryDao::createDaoAccess($entity);
		$this->_command = FactoryCommand::createGetAccessByNameCommand($entity);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws AccessAlreadyExistException
	 */
	public function execute ():void {
		try {
			$this->_command->execute();
			$this->_command = FactoryCommand::createGetAccessByAbbreviationCommand($this->_command->return());
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