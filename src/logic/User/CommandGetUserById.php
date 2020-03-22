<?php
class CommandGetUserById extends Command {
	private $_user;
	private $_mapperUser;

	/**
	 * CommandGetUserById constructor.
	 *
	 * @param int $user
	 */
	public function __construct ($user) {
		$this->_dao = FactoryDao::createDaoUser();
		$this->_mapperUser = FactoryMapper::createMapperUser();
		$this->_user = $user;
	}

	/**
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	public function execute ():void {
		$user = $this->_dao->getUserById($this->_user);
		$dtoUser = $this->_mapperUser->fromEntityToDto($user);
		Tools::setUserToDto($dtoUser, $dtoUser->userCreator, $dtoUser->userModifier);
		$this->setSeatToUser($dtoUser, $user);
		$this->setRolToUser($dtoUser, $user);
		$this->setLocationToUser($dtoUser, $user);
		$this->setPlanToUser($dtoUser, $user);
		$this->setData($dtoUser);
		$this->clean($dtoUser);
	}

	/**
	 * @param $dtoUser
	 */
	private function clean ($dtoUser) {
		unset($dtoUser->seat->agency->userCreator);
		unset($dtoUser->seat->agency->userModifier);
		unset($dtoUser->seat->location->userCreator);
		unset($dtoUser->seat->location->userModifier);
		unset($dtoUser->seat->location->dateCreated);
		unset($dtoUser->seat->location->dateModified);
		unset($dtoUser->plan->userCreator);
		unset($dtoUser->plan->userModifier);
		unset($dtoUser->rol->userCreator);
		unset($dtoUser->rol->userModifier);
	}

	/**
	 * @param DtoUser $dtoUser
	 * @param User    $user
	 *
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	private function setSeatToUser ($dtoUser, $user) {
		$command = FactoryCommand::createCommandGetSeatById(FactoryEntity::createSeat($user->getSeat()));
		try {
			$command->execute();
			$dtoUser->seat = $command->return();
		}
		catch (AgencyNotFoundException $e) {
			unset($dtoUser->seat);
		}
		catch (SeatNotFoundException $e) {
			unset($dtoUser->seat);
		}
		catch (LocationNotFoundException $e) {
			unset($dtoUser->location);
		}
	}

	/**
	 * @param DtoUser $dtoUser
	 * @param User    $user
	 *
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	private function setRolToUser ($dtoUser, $user) {
		$command = FactoryCommand::createCommandGetRolById(FactoryEntity::createRol($user->getRol()));
		try {
			$command->execute();
			$dtoUser->rol = $command->return();
		}
		catch (RolNotFoundException $e) {
			unset($dtoUser->rol);
		}
	}

	/**
	 * @param DtoUser $dtoUser
	 * @param User    $user
	 *
	 * @throws DatabaseConnectionException
	 */
	private function setLocationToUser ($dtoUser, $user) {
		$command = FactoryCommand::createCommandGetLocationById(FactoryEntity::createLocation($user->getLocation()));
		try {
			$command->execute();
			$dtoUser->location = $command->return();
		}
		catch (LocationNotFoundException $e) {
			unset($dtoUser->location);
		}
	}

	/**
	 * @return DtoUser
	 */
	public function return ():DtoUser {
		return $this->getData();
	}

	/**
	 * @param DtoUser $dtoUser
	 * @param User    $user
	 *
	 * @throws DatabaseConnectionException
	 * @throws MultipleUserException
	 * @throws UserNotFoundException
	 */
	private function setPlanToUser (DtoUser $dtoUser, User $user) {
		$command = FactoryCommand::createCommandGetPlanById(FactoryEntity::createPlan($user->getPlan()));
		try {
			$command->execute();
			$dtoUser->plan = $command->return();
		}
		catch (PlanNotFoundException $e) {
			unset($dtoUser->plan);
		}
	}
}