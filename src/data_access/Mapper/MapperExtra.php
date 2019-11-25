<?php
class MapperExtra extends Mapper {
	/**
	 * @param DtoExtra $dto
	 *
	 * @return Extra
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createExtra($dto->id, $dto->name, $dto->active);
	}

	/**
	 * @param Extra $entity
	 *
	 * @return DtoExtra
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoExtra($entity->getId(), $entity->getName(), $entity->getActive());
	}
}