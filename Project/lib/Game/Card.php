<?php
/**
 * Created by PhpStorm.
 * User: George's PC
 * Date: 2/17/2019
 * Time: 1:59 PM
 */

namespace Game;


class Card
{
    const TYPE_ROOM = 0;
    const TYPE_PLAYER = 1;
    const TYPE_WEAPON = 2;

    public function __construct($name,$type,$bitmap) {
        $this->name=$name;

        $this->type=$type;
        $this->bitmap=$bitmap;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getBitmap()
    {
        return $this->bitmap;
    }

    private $name;
    private $code;
    private $type;
    private $bitmap;

}