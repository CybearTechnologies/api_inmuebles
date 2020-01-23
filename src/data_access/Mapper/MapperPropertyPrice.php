<?php
class MapperPropertyPrice extends Mapper {
	/**
	 * @param DtoPropertyPrice $dto
	 *
	 * @return PropertyPrice
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPropertyPrice($dto->id,$dto->price,$dto->final,$dto->propertyId,$dto->active,
			$dto->delete,$dto->userCreator,$dto->userModifier,$dto->dateCreated,$dto->dateModified);
	}

	/**
	 * @param PropertyPrice $entity
	 *
	 * @return DtoPropertyPrice
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPropertyPrice($entity->getId(), $entity->getPrice(),
			Tools::formatDate($entity->getDateCreated()), $entity->getFinal(), $entity->getPropertyId());
	}
}