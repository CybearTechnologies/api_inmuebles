<?php
class MapperPropertyDestiny extends Mapper {
	/**
	 * @param DtoPropertyDestiny $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPropertyDestiny($dto->id,$dto->name);
	}

	/**
	 * @param PropertyDestiny $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPropertyDestiny($entity->getId(),$entity->getName(),
			$entity->getUserCreator(),
			$entity->getUserModifier(),$entity->getDateCreated(),
			$entity->getDateModified(),$entity->isActive(),$entity->isDelete());
	}
}
