<?php

namespace app\modules\link\controllers;

use yii\web\Controller;
use app\models\Link;
/**
 * Default controller for the `link` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionGet($token)
    {
        $link = Link::findOne(['token' => $token , 'status' => Link::STATUS_ACTIVE]);
        if ($link) {
            $link->updateCounters(['click' => 1]);
            return $this->redirect($link->url);
        }else{
            print_r('not found.');die;
        }
    }
}
