<?php
class GetExtraByIdCommand extends Command {
	/**
	 * GetExtraByIdCommand constructor.
	 *
	 * @param Extra $extra
	 */
	public function __construct ($extra) {
		$this->_dao = FactoryDao::createDaoExtra($extra);
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws ExtraNotFoundException
	 */
	public function execute ():void {
		$this->setData($this->_dao->getExtraById());
	}

	/**
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}