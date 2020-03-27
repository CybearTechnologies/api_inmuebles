<?php
abstract class Builder {
	/**@var Dto $_data */
	protected $_data;
	protected $_dao = null;

	/**
	 * @param int $id
	 *
	 * @return $this
	 */
	public abstract function getMinimumById (int $id);

	/**
	 * @return $this
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function withUsers () {
		Tools::setUserToDto($this->_data, $this->_data->userCreator, $this->_data->userModifier);

		return $this;
	}

	/**
	 * @return Dto
	 */
	public function build ():Dto {
		return $this->_data;
	}

	/**
	 * @return Builder
	 */
	public function unsetUsers () {
		unset($this->_data->userCreator);
		unset($this->_data->userModifier);

		return $this;
	}

	/**
	 * @return Builder
	 */
	public function unsetDate () {
		unset($this->_data->dateCreated);
		unset($this->_data->dateModified);

		return $this;
	}

	/**
	 * @return $this
	 */
	public function clean () {
		$this->unsetUsers();
		$this->unsetDate();

		return $this;
	}
}