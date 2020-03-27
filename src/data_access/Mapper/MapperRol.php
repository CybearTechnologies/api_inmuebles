<?php
class MapperRol extends Mapper {
	/**
	 * @param DtoRol $dto
	 *
	 * @return Rol
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRol($dto->id, $dto->name);
	}

	/**
	 * @param Rol $entity
	 *
	 * @return DtoRol
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRol($entity->getId(), $entity->getName(), Values::DEFAULT_ARRAY,
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}