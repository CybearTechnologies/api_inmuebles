<?php
class Location extends Entity{
	private $_name;
	private $_type;

    /**
     * Location constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $type
     */
	public function __construct ($id,$name,$type) {
		$this->setId($id);
		$this->_name = $name;
		$this->_type = $type;
	}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->_type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->_type = $type;
    }

}