<?php
class MapperSeat extends Mapper {
	/**
	 * @param DtoSeat $dto
	 *
	 * @return Seat
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createSeat($dto->id, $dto->name, $dto->rif);
	}

	/**
	 * @param Seat $entity
	 *
	 * @return DtoSeat
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoSeat($entity->getId(), $entity->getName(), $entity->getRif());
	}
}