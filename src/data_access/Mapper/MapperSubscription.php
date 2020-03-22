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

		return FactoryEntity::createSubscription($dto->id, $dto->ci, $dto->passport, $dto->email, $dto->password,
			$dto->plan, $dto->seat, $dto->location);
	}

	/**
	 * @param Subscription $entity
	 *
	 * @return DtoSubscription
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoSubscription($entity->getId(), $entity->getPlan(),
			$entity->getSeat(), $entity->getLocation(), $entity->getCi(), $entity->getPassport(),
			$entity->getEmail(), $entity->getPassword(), Values::DEFAULT_ARRAY,
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete(), $entity->isStatus());
	}
}