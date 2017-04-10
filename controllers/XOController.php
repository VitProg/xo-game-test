<?php
/**
 * Created by PhpStorm.
 * User: VitProg
 * Date: 10.04.17
 * Time: 12:46
 */

namespace app\controllers;


use app\models\Game;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class XOController extends Controller {

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionNewGame() {
        $game = new Game();

        $game->aiMove();

        $game->save();

        return $game->toArray(['id', 'player_type', 'board', 'created_at', 'last_access_at']);
//        return [time()];//\Yii::$app->ajax->success([time()]);

        // fixme
    }

    public function actionGameStatus($gameId) {
        /** @var Game $game */
        $game = Game::findOne($gameId);

        if ($game === null) {
            throw new NotFoundHttpException('Игра не найдена');
        }

        // fixme
    }

    public function actionMakeMove($gameId, $x, $y) {
        /** @var Game $game */
        $game = Game::findOne($gameId);

        if ($game === null) {
            throw new NotFoundHttpException('Игра не найдена');
        }

        $game->playerMove($x, $y);

        // fixme
    }

}