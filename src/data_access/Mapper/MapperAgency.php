<?php
class MapperAgency extends Mapper {
	/**
	 * @param DtoAgency $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAgency($dto->id, $dto->name);
	}

	/**
	 * @param Agency $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAgency($entity->getId(), $entity->getName());
	}
}