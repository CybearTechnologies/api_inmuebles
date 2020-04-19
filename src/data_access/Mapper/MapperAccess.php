<?php
class MapperAccess extends Mapper {
	/**
	 * @param DtoAccess $dto
	 *
	 * @return Access
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAccess($dto->id, $dto->name, $dto->abbreviation);
	}

	/**
	 * @param Access $entity
	 *
	 * @return DtoAccess
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAccess($entity->getId(), $entity->getName(), $entity->getAbbreviation(),
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}