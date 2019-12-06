<?php
class MapperPropertyType extends Mapper {
	/**
	 * @param DtoPropertyType $dto
	 *
	 * @return PropertyType
	 */
	public function fromDTOToEntity ($dto):Entity {
		if (!isset($dto->id))
			$dto->id = -1;
		if (!isset($dto->active))
			$dto->active = 0;
		if (!isset($dto->user))
			$dto->user = -1;
		return FactoryEntity::createPropertyType($dto->id, $dto->name, $dto->active, $dto->user);
	}

	/**
	 * @param PropertyType $entity
	 *
	 * @return DtoPropertyType
	 */
	public function fromEntityToDTO ($entity):Dto {
		return FactoryDto::createDtoPropertyType($entity->getId(), $entity->getName(), $entity->isActive(), $entity->getUser());
	}
}