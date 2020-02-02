<?php
class MapperPropertyType extends Mapper {
	/**
	 * @param DtoPropertyType $dto
	 *
	 * @return PropertyType
	 */
	public function fromDTOToEntity ($dto):Entity {
		return FactoryEntity::createPropertyType($dto->id, $dto->name);
	}

	/**
	 * @param PropertyType $entity
	 *
	 * @return DtoPropertyType
	 */
	public function fromEntityToDTO ($entity):Dto {
		return FactoryDto::createDtoPropertyType($entity->getId(), $entity->getUserCreator(),
			$entity->getUserModifier(), $entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(),
			$entity->isDelete(), $entity->getName());
	}
}