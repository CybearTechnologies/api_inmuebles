<?php
class MapperPropertyPrice extends Mapper {
	/**
	 * @param DtoPropertyPrice $dto
	 *
	 * @return PropertyPrice
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPropertyPrice($dto->id, $dto->price, $dto->final, $dto->propertyId);
	}

	/**
	 * @param PropertyPrice $entity
	 *
	 * @return DtoPropertyPrice
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPropertyPrice($entity->getId(), $entity->getPrice(), $entity->isFinal(),
			$entity->getPropertyId(), $entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}