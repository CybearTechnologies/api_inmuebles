<?php
interface IBuilder {
	/**
	 * @param int $id
	 *
	 * @return Dto|Dto[]
	 */
	function getMinimumById (int $id);

	function withUsers ();

	function unsetUsers ();

	function unsetDate ();

	function build ();

	function clean ();
}