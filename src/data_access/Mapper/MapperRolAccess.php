<?php
class MapperRolAccess extends Mapper {
	/**
	 * @inheritDoc
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRolAccess($dto->id, $dto->rol, $dto->access, $dto->accessName);
	}

	/**
	 * @inheritDoc
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRolAccess($entity->getId(), $entity->getRol(), $entity->getAccess(),
			$entity->getAccessName(),
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}