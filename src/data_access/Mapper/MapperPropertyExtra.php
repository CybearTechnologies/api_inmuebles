<?php
class MapperPropertyExtra extends Mapper {
	/**
	 * @return Entity
	 * @var DtoPropertyExtra $dto
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPropertyExtra($dto->id, $dto->amount, $dto->propertyId, $dto->extraId, $dto->active,$dto->delete,
			$dto->userCreator, $dto->userModifier, $dto->dateCreated, $dto->dateModified);
	}

	/**
	 * @return Dto
	 * @var PropertyExtra $entity
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPropertyExtra($entity->getId(), $entity->getAmount(), $entity->getPropertyId(),
			$entity->getExtraId(),$entity->isActive(), $entity->isDelete(), $entity->getUserCreator(),
			$entity->getUserModifier(),$entity->getDateCreated(), $entity->getDateModified());
	}
}