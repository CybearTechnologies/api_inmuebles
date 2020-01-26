<?php
class DaoPropertyExtra extends Dao {


	protected function extract ($dbObject) {
		return FactoryEntity::createExtra($dbObject->id, $dbObject->name,
			is_null($dbObject->icon) ? "" : $dbObject->icon, $dbObject->active,
			$dbObject->delete, $dbObject->userCreator, $dbObject->userModifier,
			$dbObject->dateCreated, $dbObject->dateModified);
	}
}