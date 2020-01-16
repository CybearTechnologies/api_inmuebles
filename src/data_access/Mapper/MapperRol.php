<?php
class MapperRol extends Mapper {
	/**
	 * @param DtoRol $dto
	 *
	 * @return Rol
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createRol($dto->id, $dto->name, $dto->active, $dto->delete, $dto->userCreator->id,
			$dto->userModifier->id, $dto->dateCreated, $dto->dateModified);
	}

	/**
	 * @param Rol $entity
	 *
	 * @return DtoRol
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoRol($entity->getId(), $entity->getName(), $entity->getName(),
			$entity->getUserCreator(), $entity->getUserModifier());
	}
}