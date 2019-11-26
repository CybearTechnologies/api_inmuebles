<?php
class MapperPropertyType extends Mapper {
	/**
	 * @param DtoPropertyType $dto
	 *
	 * @return PropertyType
	 */
	public function fromDTOToEntity ($dto):Entity {
		return FactoryEntity::createPropertyType($dto->id, $dto->name, $dto->active);
	}

	/**
	 * @param PropertyType $entity
	 *
	 * @return DtoPropertyType
	 */
	public function fromEntityToDTO ($entity):Dto {
		return FactoryDto::createDtoPropertyType($entity->getId(), $entity->getName(), $entity->getActive());
	}
}