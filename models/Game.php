<?php
/**
 * Created by PhpStorm.
 * User: VitProg
 * Date: 10.04.17
 * Time: 12:50
 */

namespace app\models;


use yii\base\Model;
use yii\redis\ActiveRecord;

/**
 * Class Game
 * @package app\models
 *
 * @property integer $id
 * @property GameBoard $board
 */
class Game extends ActiveRecord {
    public $id;
    public $created_at;
    public $player_type;
    public $last_access_at;

    /** @var GameBoard */
    protected $gameBoard;

    /**
     * @return array the list of attributes for this record
     */
    public function attributes()
    {
        return ['id', 'player_type', 'board', 'created_at', 'last_access_at'];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
//            [['created_at', 'last_access_at']]
        ];
    }

    /**
     * Game constructor.
     * @param array $config
     */
    public function __construct(array $config = []) {
        $gameBoardConfiguration = [];

        if (isset($config['width'])) {
            $gameBoardConfiguration['width'] = $config['width'];
            unset ($config['width']);
        }
        if (isset($config['height'])) {
            $gameBoardConfiguration['height'] = $config['height'];
            unset ($config['height']);
        }

        parent::__construct($config);

        $this->gameBoard = new GameBoard($gameBoardConfiguration);
        $this->player_type = rand(0, 1) ? GameBoard::FILED_TYPE_X : GameBoard::FILED_TYPE_O;
    }

    /** @return GameBoard */
    public function getBoard() {
        return $this->gameBoard;
    }

    public function playerMove($x, $y) {
        // fixme
    }

    public function aiMove() {
        // fixme
    }

    public function getIsFinished() {
        // fixme
    }

    public function getIsPlayerWin() {
        // fixme
    }

    public function getIsAiWin() {
        // fixme
    }
}