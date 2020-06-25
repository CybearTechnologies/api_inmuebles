<?php
class MapperPasswordToken extends Mapper {
	/**
	 * @param DtoPasswordToken $dto
	 *
	 * @return Entity
	 */
	public function fromDtoToEntity ($dto):Entity {
		return new PasswordToken($dto->id,$dto->token,$dto->userCreator,$dto->userModifier,$dto->dateCreated,
			$dto->dateModified,$dto->active,$dto->delete);
	}

	/**
	 * @param PasswordToken $entity
	 *
	 * @return Dto
	 */
	public function fromEntityToDto ($entity):Dto {
		return new DtoPasswordToken($entity->getId(),$entity->getToken(),$entity->getUserCreator(),$entity->getUserModifier(),
			$entity->getDateCreated(),$entity->getDateModified(),$entity->isActive(),$entity->isDelete());
	}
}