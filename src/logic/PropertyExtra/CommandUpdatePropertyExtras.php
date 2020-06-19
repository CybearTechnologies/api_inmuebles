<?php
class CommandUpdatePropertyExtras extends Command {
	private $_id;
	private $_extras;
	private $_mapper;
	private $_user;
	private $_dateModified;
	private $_command;
	private $_responseList;

	/**
	 * CommandUpdatePropertyExtras constructor.
	 *
	 * @param                 $id
	 * @param PropertyExtra[] $extras
	 * @param                 $user
	 * @param                 $dateModified
	 */
	public function __construct ($id, $extras, $user, $dateModified) {
		$this->_id = $id;
		$this->_extras = $extras;
		$this->_user = $user;
		$this->_dateModified = $dateModified;
		$this->_responseList = [];
		$this->_mapper = FactoryMapper::createMapperPropertyExtra();
		$this->_dao = FactoryDao::createDaoPropertyExtra();
	}

	/**
	 * @throws DatabaseConnectionException
	 */
	public function execute ():void {
		$this->_command = FactoryCommand::createCommandDeleteExtrasByPropertyId($this->_id, $this->_user);
		$this->_command->execute();
		//Se borran todos los extras de la propiedad.
		//Luego se recorre toda la lista de los extras y se insertan.
		foreach ($this->_extras as $extra) {
			$this->_command = FactoryCommand::createCommandCreatePropertyExtra($extra->getId(), $extra->getValue(),
				$this->_id, $this->_user);
			$this->_command->execute();
			array_push($this->_responseList, $this->_command->return());
		}
		$this->setData($this->_responseList);
	}

	/***
	 * @return mixed
	 */
	public function return () {
		return $this->getData();
	}
}