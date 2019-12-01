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
		return FactoryDto::createDtoProperty($entity->getId(), $entity->getName(), $entity->getArea(),
			$entity->getDescription(), Tools::formatDate($entity->getPublishDate()), $entity->getState(),
			$entity->getFloor());
	}
}