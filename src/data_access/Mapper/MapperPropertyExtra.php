<?php
class MapperPropertyExtra extends Mapper {
	/**
	 * @return PropertyExtra
	 * @var DtoPropertyExtra $dto
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPropertyExtra($dto->id, $dto->name, $dto->amount, $dto->propertyId, $dto->extraId);
	}

	/**
	 * @return DtoPropertyExtra
	 * @var PropertyExtra $entity
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPropertyExtra($entity->getId(),
			$entity->getName(), $entity->getValue(), $entity->getPropertyId(),
			$entity->getExtraId(), $entity->isActive(), $entity->isDelete(), $entity->getUserCreator(),
			$entity->getUserModifier(), $entity->getDateCreated(), $entity->getDateModified());
	}
}