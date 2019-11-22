<?php
class MapperLocation extends Mapper {
	/**
	 * @param Dto $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createLocation($dto->id,$dto->name,$dto->type);
	}

	/**
	 * @param Entity $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoLocation($entity->getId(),$entity->getName(),$entity->getType());
	}
}