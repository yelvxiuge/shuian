<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Wechat extends Model {



    public $appid;
    public $appScret;
    public $domain;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->appid = Yii::$app->params['appid'];
        $this->appScret= Yii::$app->params['appscret'];
    }

    public function getActoken(){




    }



}