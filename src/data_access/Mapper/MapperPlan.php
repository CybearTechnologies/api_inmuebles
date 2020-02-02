<?php
class MapperPlan extends Mapper {
	/**
	 * @param DtoPlan $dto
	 *
	 * @return Plan
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPlan($dto->id, $dto->name, $dto->price);
	}

	/**
	 * @param Plan $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPlan($entity->getId(), $entity->getUserCreator(), $entity->getUserModifier(),
			$entity->getDateCreated(), $entity->getDateModified(), $entity->isActive(), $entity->isDelete()
			, $entity->getName(), $entity->getPrice());
	}
}