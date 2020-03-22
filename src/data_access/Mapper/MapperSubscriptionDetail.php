<?php
class MapperSubscriptionDetail extends Mapper {
	/**
	 * @param DtoSubscriptionDetail $dto
	 *
	 * @return SubscriptionDetail
	 */
	public function fromDtoToEntity ($dto):Entity {
		if (!isset($dto->id)) { //Creando
			$dto->id = -1;
			$dto->subscription = -1;
		}

		return FactoryEntity::createSubscriptionDetail($dto->id, $dto->subscription, $dto->document);
	}

	/**
	 * @param SubscriptionDetail $entity
	 *
	 * @return DtoSubscriptionDetail
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoSubscriptionDetail($entity->getId(), $entity->getDocument(),
			$entity->getSubscription(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(),
			$entity->isDelete());
	}
}