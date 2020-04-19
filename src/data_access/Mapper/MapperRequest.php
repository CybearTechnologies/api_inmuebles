<?php
class MapperRequest extends Mapper {
	/**
	 * @param DtoRequest $dto
	 *
	 * @return Request
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRequest($dto->id, $dto->property, $dto->userCreator, $dto->userModifier,
			$dto->dateCreated, $dto->dateModified, $dto->active, $dto->delete);
	}

	/**
	 * @param Request $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRequest($entity->getId(), $entity->getProperty(), $entity->getUserCreator(),
			$entity->getUserModifier(), $entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(),
			$entity->isDelete());
	}
}