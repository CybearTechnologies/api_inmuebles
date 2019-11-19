<?php
class MapperPropertyType extends Mapper {
	/**
	 * @param DtoPropertyType $dto
	 *
	 * @return Entity
	 */
	public function fromDTOToEntity ($dto):Entity {
		return FactoryEntity::createPropertyType($dto->id, $dto->name);
	}

	/**
	 * @param PropertyType $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDTO ($entity):Dto {
		return FactoryDto::createDtoPropertyType($entity->getId(), $entity->getName());
	}
}