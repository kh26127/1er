<?php
/**
 * Created by PhpStorm.
 * User: abolfazl
 * Date: 9/19/18
 * Time: 1:30 AM
 */

namespace app\modules\v1\controllers;
use Yii;
use yii\rest\Controller;
use app\models\Link;

class LinkController extends Controller
{
    public function actionCreate(){
        $request = Yii::$app->request;
        $response = Yii::$app->response;

        $url = $request->post('url');
        $token = $request->post('token');
        if (!$url){
            $response->statusCode = 406;
            return [
              'status' => false,
              'message' => 'url not found.'
            ];
        }
        $link = new Link();
        $link->scenario = Link::SCENARIO_CREATE;
        $link->attributes = $request->post();
        $createLink = $link->createLink($url,$token);
        if ($createLink['status']){
            $response->statusCode = 200;
            return [
                $createLink['token'],
            ];
        }else{
            $response->statusCode = 400;
            return $createLink;
        }
    }

}