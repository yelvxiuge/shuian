<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Wechat;
use Yii;
use yii\httpclient\Client;
use yii\redis;

class ShuiController extends Controller {


    public function  actionIndex()
    {
        $wechat = new Wechat;
//        $redis = Yii::$app->redis;

//            $client = new Client([
//                'transport' => 'yii\httpclient\CurlTransport' // only cURL supports the options we need
//            ]);
//            $response = $client->createRequest()
//                ->setUrl('https://api.weixin.qq.com/cgi-bin/token')
//                ->setData(['access_token' => $wechat->getActoken()])
//                ->addOptions([
//                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                ])->setUrl('https://api.weixin.qq.com/cgi-bin/getcallbackip')
//                ->setMethod('GET')
//                ->send();
//            echo '<pre>';
//            print_r($response->data);
            return $this->render('index',[
                'jsAr'=>$wechat->getJsArray("http://shuian.md5crack.cn/index.php?r=shui/index")
            ]);
    }

    public function actionRecords(){

        $wechat = new Wechat;
        return $this->render('records',[
            'jsAr'=>$wechat->getJsArray("http://shuian.md5crack.cn/index.php?r=shui/records")
        ]);
    }

    public function actionShare(){
        $wechat = new Wechat;

        if(isset($_GET['from'])){
            $from = $_GET['from'];
            return $this->render('share', [
                'jsAr' => $wechat->getJsArray("http://shuian.md5crack.cn/index.php?r=shui/share&from=$from&isappinstalled=0")
            ]);

        }else {
            return $this->render('share', [
                'jsAr' => $wechat->getJsArray("http://shuian.md5crack.cn/index.php?r=shui/share")
            ]);
        }


    }


}