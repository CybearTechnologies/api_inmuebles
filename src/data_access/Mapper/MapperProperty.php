<?php
class MapperProperty extends Mapper {
	private $_mapperExtra;
	private $_mapperRequest;

	/**
	 * @param DtoProperty $dto
	 *
	 * @return Property
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createProperty($dto->id, $dto->destiny,$dto->favorite,$dto->name, $dto->area, $dto->description, $dto->state,
			$dto->floor, $dto->type, $dto->location);
	}

	/**
	 * @param Property $entity
	 *
	 * @return DtoProperty
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoProperty($entity->getId(),$entity->getDestiny(),
			$entity->getFavorite(),
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
			$entity->getFloor(),
			$entity->getType(),
			$entity->getLocation(),
			Values::DEFAULT_ARRAY,
			Values::DEFAULT_ARRAY,
			Values::DEFAULT_ARRAY);
	}
}