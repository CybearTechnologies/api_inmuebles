<?php
class MapperUser extends Mapper {
	/**
	 * @param DtoUser $dto
	 *
	 * @return User
	 */
	public function fromDtoToEntity ($dto):Entity {
		if ($dto->seat == "")
			$dto->seat = null;
		if ($dto->agency == "")
			$dto->agency = null;
		if ($dto->phone == "")
			$dto->phone = null;
		return FactoryEntity::createUser($dto->id, $dto->firstName, $dto->lastName, $dto->address, $dto->email,$dto->phone,
			$dto->password, $dto->userCreator, $dto->userModifier, $dto->active, $dto->blocked, $dto->delete,
			$dto->seat, $dto->agency,$dto->rol, $dto->plan, $dto->location, $dto->dateCreated, $dto->dateModified);
	}

	/**
	 * @param User $entity
	 *
	 * @return DtoUser
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoUser($entity->getId(), $entity->getFirstName(), $entity->getLastName(),
			$entity->getAddress(), $entity->getEmail(), $entity->getPhone(),$entity->getPassword(), Values::DEFAULT_INT,
			Values::DEFAULT_STRING, Values::DEFAULT_ARRAY,
			$entity->getUserCreator(),$entity->getUserModifier(),
			$entity->isActive(),$entity->isBlocked(),$entity->isDelete(),
			$entity->getSeat(),$entity->getAgency(),$entity->getRol(),$entity->getPlan(),
			$entity->getLocation(),$entity->getDateCreated(),$entity->getDateModified());
	}
}