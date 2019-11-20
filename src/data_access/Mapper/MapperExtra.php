<?php
class MapperExtra extends Mapper {
	/**
	 * @param DtoExtra $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createExtra($dto->id,$dto->name);
	}

	/**
	 * @param Extra $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoExtra($entity->getId(),$entity->getName());
	}
}