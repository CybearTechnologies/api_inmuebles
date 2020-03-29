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
	 * @return Dto
	 */
	public function build ():Dto {
		return $this->_data;
	}

	/**
	 * @return Builder
	 */
	public function unsetUsers () {
		if (is_numeric($this->_data->userCreator))
			unset($this->_data->userCreator);
		if (is_numeric($this->_data->userModifier))
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