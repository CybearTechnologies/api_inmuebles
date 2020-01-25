<?php
class MapperAccess extends Mapper {
	/**
	 * @param DtoAccess $dto
	 *
	 * @return Access
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAccess($dto->id, $dto->name, $dto->abbreviation, $dto->dateCreated,
			$dto->dateModified);
	}

	/**
	 * @param Access $entity
	 *
	 * @return DtoAccess
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAccess($entity->getId(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(), $entity->isDelete(),
			$entity->getName(), $entity->getAbbreviation());
	}
}