<?php
/**
 * Created by PhpStorm.
 * User: VitProg
 * Date: 10.04.17
 * Time: 12:52
 */

namespace app\models;


use yii\base\InvalidValueException;
use yii\base\Object;
use yii\helpers\Json;

/**
 * Class GameBoard
 * @package app\models
 *
 * ;
 * @property integer $width
 * @property integer $height
 * @property integer $size
 */
class GameBoard extends Object {

    const FILED_TYPE_NULL = 0;
    const FILED_TYPE_X = 1;
    const FILED_TYPE_O = 2;

    protected $map = [];
    protected $mapWidth = 3;
    protected $mapHeight = 3;

    public function init() {
        $this->map = array_fill(0, $this->size, 0);
    }

    public function serialize() {
        return [$this->mapWidth, $this->mapHeight, $this->map];
    }

    static public function deserialize($data) {
        if (is_array($data) === false) {
            $data = Json::decode($data);
        }
        if (is_array($data) && count($data) === 3 && is_array($data[3])) {
            /** @noinspection SpellCheckingInspection */
            return new static([
                'mapWidth' => $data[0],
                'mapHeight' => $data[1],
                'map' => array_map('intval', $data[2]),
            ]);
        } else {
            throw new InvalidValueException();
        }
    }

    public function getSize() {
        return $this->mapWidth * $this->mapHeight;
    }

    public function getWidth() {
        return $this->mapWidth;
    }

    public function getHeight() {
        return $this->mapHeight;
    }

    public function getCell($x, $y) {
        return $this->map[$this->getIndex($x, $y)];
    }

    public function setCell($x, $y, $val = self::FILED_TYPE_NULL) {
        if ($val != self::FILED_TYPE_X && $val != self::FILED_TYPE_O) {
            $val = self::FILED_TYPE_NULL;
        }
        return $this->map[$this->getIndex($x, $y)] = $val;
    }

    protected function getIndex($x, $y) {
        return (intval($y) * $this->width) + intval($x);
    }
}