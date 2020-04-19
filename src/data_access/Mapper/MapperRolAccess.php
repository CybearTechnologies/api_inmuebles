<?php
class MapperRolAccess extends Mapper {
	/**
	 * @param DtoRolAccess $dto
	 *
	 * @return RolAccess
	 */
	public function fromDtoToEntity ($dto):Entity {
		if (!isset($dto->accessName))
			$dto->accessName = "";

		return FactoryEntity::createRolAccess($dto->id, $dto->rol, $dto->access, $dto->accessName);
	}

	/**
	 * @param RolAccess $entity
	 *
	 * @return DtoRolAccess
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRolAccess($entity->getId(), $entity->getRol(), $entity->getAccess(),
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}