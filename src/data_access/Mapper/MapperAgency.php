<?php
class MapperAgency extends Mapper {
	/**
	 * @param DtoAgency $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAgency($dto->id, $dto->name, $dto->seat);
	}

	/**
	 * @param Agency $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAgency($entity->getId(), $entity->getName(),
			$this->createDtoSeat($entity->getSeats()));
	}

	/**
	 * @param $seats
	 *
	 * @return Seat[]
	 */
	function createDtoSeat ($seats) {
		$_seats = [];
		foreach ($seats as $seat) {
			array_push($_seats, FactoryDto::createDtoSeat($seat->getId(), $seat->getName(), $seat->getRif()));
		}

		return $_seats;
	}
}