<?php
class MapperExtra extends Mapper {
	/**
	 * @param DtoExtra $dto
	 *
	 * @return Extra
	 */
	public function fromDtoToEntity ($dto):Entity {
		$length = strlen(Environment::baseURL()) - 1;
		$dto->icon = substr_replace($dto->icon, '', 0, $length);

		return FactoryEntity::createExtra($dto->id, $dto->name, $dto->icon);
	}

	/**
	 * @param Extra $entity
	 *
	 * @return DtoExtra
	 */
	public function fromEntityToDto ($entity):Dto {
		return FactoryDto::createDtoExtra($entity->getId(), $entity->getName(),
			Environment::baseURL() . $entity->getIcon(), // se le setea la baseurl, donde se almacena la imagen
			$entity->getUserCreator(), $entity->getUserModifier(), $entity->getDateCreated(),
			$entity->getDateModified(),
			$entity->isActive(), $entity->isDelete());
	}
}