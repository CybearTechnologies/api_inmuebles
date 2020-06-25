<?php
class MapperAgency extends Mapper {
	/**
	 * @param DtoAgency $dto
	 *
	 * @return Agency
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createAgency($dto->id, $dto->name, $dto->icon);
	}

	/**
	 * @param Agency $entity
	 *
	 * @return DtoAgency
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoAgency($entity->getId(), $entity->getName(),
			Environment::baseURL() . $entity->getIcon(),// se le setea la baseurl, donde se almacena la imagen
			Values::DEFAULT_ARRAY,
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(), $entity->isActive(), $entity->isDelete());
	}
}