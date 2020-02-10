<?php
class MapperRating extends Mapper {
	/**
	 * @param DtoRating $dto
	 *
	 * @return Rating
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRating($dto->id, $dto->score, $dto->message);
	}

	/**
	 * @param Rating $entity
	 *
	 * @return DtoRating
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRating($entity->getId(), $entity->getScore(), $entity->getMessage(),
			$entity->getUserTarget(),
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}