<?php
class MapperProperty extends Mapper {
	private $_mapperExtra;
	private $_mapperRequest;

	/**
	 * @param DtoProperty $dto
	 *
	 * @return Property
	 */
	public function fromDtoToEntity ($dto):Entity {
		return FactoryEntity::createProperty($dto->id, $dto->name, $dto->area, $dto->description, $dto->state,
			$dto->floor, $dto->type, $dto->location, $dto->active, $dto->delete, $dto->userCreator, $dto->userModifier,
			$dto->dateCreated, $dto->dateModified);
	}

	/**
	 * @param Property $entity
	 *
	 * @return DtoProperty
	 */
	public function fromEntityToDto ($entity):Dto {
		$commandGetAllExtras = FactoryCommand::createCommandGetAllExtrasByPropertyId($entity);
		$commandGetPropertyPrice = FactoryCommand::createCommandGetPropertyPriceByPropertyId(FactoryEntity::createPropertyPrice(-1,
			-1, 1, $entity->getId()));
		$mapperExtra = FactoryMapper::createMapperExtra();
		$mapperPropertyPrice = FactoryMapper::createMapperPropertyPrice();
		$extras = [];
		$propertyPrice = [];
		try {
			$commandGetAllExtras->execute();
			$extras = $mapperExtra->fromEntityArrayToDtoArray($commandGetAllExtras->return());
			$commandGetPropertyPrice->execute();
			$propertyPrice = $mapperPropertyPrice->fromEntityArrayToDtoArray($commandGetPropertyPrice->return());
		}
		catch (DatabaseConnectionException $exception) {
			Logger::exception($exception, Logger::ERROR);
		}
		catch (ExtraNotFoundException $exception) {
		}
		catch (InvalidPropertyPriceException $e) {
		}

		return FactoryDto::createDtoProperty($entity->getId(),
			$entity->getUserCreator(),
			$entity->getUserModifier(),
			$entity->getDateCreated(),
			$entity->getDateModified(),
			$entity->isActive(),
			$entity->isDelete(),
			$entity->getName(),
			$entity->getArea(),
			$entity->getDescription(),
			$entity->getState(),
			$entity->getFloor(),
			$entity->getType(),
			$entity->getLocation(),
			$extras,
			[],
			$propertyPrice);
	}
}