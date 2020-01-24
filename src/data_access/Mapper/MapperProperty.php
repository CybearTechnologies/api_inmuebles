<?php
class MapperProperty extends Mapper {
	/**
	 * @param DtoProperty $dto
	 *
	 * @return Property
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createProperty($dto->id, $dto->name, $dto->area, $dto->description, $dto->publishDate,
			$dto->state, $dto->floor);
	}

	/**
	 * @param Property $entity
	 *
	 * @return DtoProperty
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoProperty($entity->getId(),
			$entity->getUserCreator(),
			$entity->getUserModifier(),
			$entity->getDateCreated(),
			$entity->getDateModified(),
			$entity->isActive(),
			$entity->isDelete(),
			$entity->getName(),
			$entity->getArea(),
			$entity->getDescription(),
			$entity->getState(),
			$entity->getFloor());
	}
}