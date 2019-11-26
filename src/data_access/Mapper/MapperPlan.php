<?php
class MapperPlan extends Mapper {
	/**
	 * @param DtoPlan $dto
	 *
	 * @return Plan
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createPlan($dto->id, $dto->name, $dto->price, $dto->active);
	}

	/**
	 * @param Plan $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoPlan($entity->getId(), $entity->getName(), $entity->getPrice(),
			$entity->getActive());
	}
}