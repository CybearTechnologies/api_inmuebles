<?php
class MapperUser extends Mapper {
	/**
	 * @param DtoUser $dto
	 *
	 * @return User
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createUser($dto->id, $dto->firstName, $dto->lastName, $dto->address, $dto->email,
			$dto->password, $dto->userCreator, $dto->userModifier, $dto->active, $dto->blocked, $dto->delete,
			$dto->seat, $dto->rol, $dto->plan, $dto->location, $dto->dateCreated, $dto->dateModified);
	}

	/**
	 * @param User $entity
	 *
	 * @return DtoUser
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoUser($entity->getId(),$entity->getFirstName(),$entity->getLastName(),
			$entity->getAddress(),$entity->getEmail(),$entity->getPassword(),Values::DEFAULT_INT,Values::DEFAULT_STRING,
			$entity->getUserCreator(),$entity->getUserModifier(),
			$entity->isActive(),$entity->isBlocked(),$entity->isDelete(),
			$entity->getSeat(),$entity->getRol(),$entity->getPlan(),
			$entity->getLocation(),$entity->getDateCreated(),$entity->getDateModified());
	}
}