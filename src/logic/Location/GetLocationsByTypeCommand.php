<?php
class GetLocationsByTypeCommand extends Command {
	private $_dao;
	private $_type;

    /**
     * GetLocationsByTypeCommand constructor.
     *
     * @param string $type
     */
	public function __construct ($type) {
        $this->_dao = FactoryDao::createDaoLocation();
		$this->_type = $type;
	}

    /**
     * @throws DatabaseConnectionException
     * @throws LocationNotFoundException
     */
	public function execute ():void {
		$this->setData($this->_dao->getLocationsByType($this->_type));
	}

    /**
     * @return Location[]
     */
	public function return () {
		return $this->getData();
	}
}