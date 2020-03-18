<?php
class MapperFavorite extends Mapper {
	/**
	 * @param DtoFavorite $dto
	 *
	 * @return Favorite
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createFavorite($dto->id, $dto->property);
	}

	/**
	 * @param Favorite $entity
	 *
	 * @return DtoFavorite
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoFavorite($entity->getId(), $entity->getProperty(), $entity->getUserCreator(),
			$entity->getUserModifier(), $entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(),
			$entity->isDelete());
	}
}