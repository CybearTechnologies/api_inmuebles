<?php
class MapperExtra extends Mapper {
	/**
	 * @param DtoExtra $dto
	 *
	 * @return Extra
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createExtra($dto->id, $dto->name, $dto->active);
	}

	/**
	 * @param Extra $entity
	 *
	 * @return DtoExtra
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoExtra($entity->getId(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(), $entity->isDelete(),
			$entity->getName());
	}
}