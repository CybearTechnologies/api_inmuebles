<?php
class MapperSubscription extends Mapper {
	/**
	 * @param DtoSubscription $dto
	 *
	 * @return Subscription
	 */
	public function fromDtoToEntity ($dto):Entity {
		if (!isset($dto->id))
			$dto->id = -1;
		if (!isset($dto->passport))
			$dto->passport = "";
		if ($dto->seat == "" || !is_numeric($dto->seat))
			$dto->seat = null;
		if ($dto->agency == "" || !is_numeric($dto->agency))
			$dto->agency = null;
		return FactoryEntity::createSubscription($dto->id, $dto->firstName, $dto->lastName,
			$dto->address, $dto->ci, $dto->passport, $dto->email, $dto->password,
			$dto->plan, $dto->seat, $dto->agency,$dto->location);
	}

	/**
	 * @param Subscription $entity
	 *
	 * @return DtoSubscription
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoSubscription($entity->getId(), $entity->getFirstName(),
			$entity->getLastName(), $entity->getAddress(), $entity->getPlan(),
			$entity->getSeat(), $entity->getAgency(),$entity->getLocation(), $entity->getCi(), $entity->getPassport(),
			$entity->getEmail(), $entity->getPassword(), Values::DEFAULT_ARRAY,
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete(), $entity->isStatus());
	}
}