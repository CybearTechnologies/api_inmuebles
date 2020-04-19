<?php
abstract class ListBuilder implements IBuilder {
	/**@var Dto[] $_data */
	protected $_data;
	protected $_dao = null;

	/**
	 * @return Dto[]
	 */
	abstract function getAll ();

	/**
	 * @throws DatabaseConnectionException
	 */
	public function withUsers () {
		foreach ($this->_data as $datum) {
			try {
				Tools::setUserToDto($datum, $datum->userCreator, $datum->userModifier);
			}
			catch (MultipleUserException $e) {
				$datum->userCreator = null;
				$datum->userModifier = null;
			}
			catch (UserNotFoundException $e) {
				$datum->userCreator = null;
				$datum->userModifier = null;
			}
		}
	}

	/**
	 * @return Dto[]
	 */
	public function build () {
		return $this->_data;
	}

	/**
	 * @return $this
	 */
	public function unsetUsers () {
		foreach ($this->_data as $item) {
			unset($item->userCreator);
			unset($item->userModifier);
		}

		return $this;
	}

	/**
	 * @return $this
	 */
	public function unsetDate () {
		foreach ($this->_data as $item) {
			unset($item->dateCreated);
			unset($item->dateModified);
		}

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