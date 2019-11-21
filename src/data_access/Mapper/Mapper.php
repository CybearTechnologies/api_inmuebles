<?php
abstract class Mapper {
	/**
	 * @param Dto[] $dtoArray
	 *
	 * @return Entity[]
	 */
	public function fromDtoArrayToEntityArray ($dtoArray) {
		$array = [];
		foreach ($dtoArray as $dto)
			array_push($array, $this->fromDtoToEntity($dto));

		return $array;
	}

	/**
	 * @param Dto $dto
	 *
	 * @return Entity
	 */
	public abstract function fromDtoToEntity ($dto):Entity;

	/**
	 * @param Entity[] $entityArray
	 *
	 * @return Dto[]
	 */
	public function fromEntityArrayToDtoArray ($entityArray) {
		$array = [];
		foreach ($entityArray as $entity)
			array_push($array, $this->fromEntityToDto($entity));

		return $array;
	}

	/**
	 * @param Entity $entity
	 *
	 * @return Dto
	 */
	public abstract function fromEntityToDto ($entity):Dto;
}