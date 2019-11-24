<?php
class MapperRequest extends Mapper {
	/**
	 * @param DtoRequest $dto
	 *
	 * @return Request
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRequest($dto->id, $dto->date);
	}

	/**
	 * @param Request $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRequest($entity->getId(), $entity->getDate());
	}
}