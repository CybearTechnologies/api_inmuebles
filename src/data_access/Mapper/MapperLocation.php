<?php
class MapperLocation extends Mapper {
	
	/**
	 * @param DtoLocation $dto
	 *
	 * @return Location
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createLocation($dto->id, $dto->name, $dto->type);
	}

	/**
	 * @param Location $entity
	 *
	 * @return DtoLocation
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoLocation($entity->getId(), $entity->getName(), $entity->getType(),
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}

}