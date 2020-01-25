<?php
class MapperAgency extends Mapper {
	/**
	 * @param DtoAgency $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAgency($dto->id, $dto->name, $dto->active);
	}

	/**
	 * @param Agency $entity
	 *
	 * @return DtoAgency
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAgency($entity->getId(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(),$entity->isActive(),$entity->isDelete(),$entity->getName());
	}
}