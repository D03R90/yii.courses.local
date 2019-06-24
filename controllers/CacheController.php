<?php


namespace app\controllers;


use yii\web\Controller;

class CacheController extends Controller
{
    public function actionIndex()
    {
        $cache = \Yii::$app->cache;
        $key = "number";

        if($cache->exists($key)){
            $number = $cache->get($key);
        }else{
            $number = rand();
            $cache->set($key, $number, 10);
        }

        var_dump($number);
        exit;
    }

//    public function actionIndex()
//    {
//        $number = rand();
//        Var_dump($number);
//        exit;
//    }
}