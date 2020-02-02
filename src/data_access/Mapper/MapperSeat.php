<?php
class MapperSeat extends Mapper {
	/**
	 * @param DtoSeat $dto
	 *
	 * @return Seat
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createSeat($dto->id, $dto->name, $dto->rif, $dto->location);
	}

	/**
	 * @param Seat $entity
	 *
	 * @return DtoSeat
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoSeat($entity->getId(), $entity->getName(), $entity->getRif(),
			$entity->getLocation(), $entity->getAgency(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}