<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $url
 * @property string $token
 * @property int $click
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    const SCENARIO_CREATE = "create";

    public static function tableName()
    {
        return 'link';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['url','token'],
        ];

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['click', 'status', 'created_at', 'updated_at'], 'integer'],
            [['url'], 'url' ,],
            [['token'], 'string', 'max' => 10],
            ['token' , 'unique'],
            ['token', 'match', 'pattern' => '/^[a-zA-Z0-9]*$/'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'token' => 'Token',
            'click' => 'Click',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    private function generateToken($length){
        if (YII_ENV_TEST) return  "aaaaa";
        do $token = self::genRandomString(Yii::$app->params['length'] ,  '0123456789abcdefghijklmnopqrstuvwxyz');
           while (self::find()->where(['token' => $token])->exists());
        return $token;
    }

    function genRandomString($length = 6, $chars='', $type=array()) {
        $alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
        $alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';
        $characters = "";
        $string = '';
        isset($type['alphaSmall'])  ? $type['alphaSmall']: $type['alphaSmall'] = true;
        isset($type['alphaBig'])    ? $type['alphaBig']: $type['alphaBig'] = true;
        isset($type['num'])         ? $type['num']: $type['num'] = true;
        isset($type['duplicate'])   ? $type['duplicate']: $type['duplicate'] = true;

        if (strlen(trim($chars)) == 0) {
            $type['alphaSmall'] ? $characters .= $alphaSmall : $characters = $characters;
            $type['alphaBig'] ? $characters .= $alphaBig : $characters = $characters;
            $type['num'] ? $characters .= $num : $characters = $characters;
        }
        else
            $characters = str_replace(' ', '', $chars);

        if($type['duplicate'])
            for (; $length > 0 && strlen($characters) > 0; $length--) {
                $ctr = mt_rand(0, (strlen($characters)) - 1);
                $string .= $characters[$ctr];
            }
        else
            $string = substr (str_shuffle($characters), 0, $length);

        return $string;
    }

    public function createLink($url , $token = ''){
            if (!$token){
                $token = self::generateToken(Yii::$app->params['length']);
            }
            if (!(substr($url , 0 ,7) ==="http://") && !(substr($url , 0, 8) === "https://")){
                $url = "http://" . $url;
            }
            $this->token = $token;
            $url = str_replace(' ', '' , $url);
            $this->url = $url;
            $this->status = self::STATUS_ACTIVE;
            $this->click = 0;
            if ($this->validate() && $this->save()){
                return [
                    'status' => true,
                    'token' => $this->token
                ];
            }else{
                return
                    [
                        'status' => false,
                        $this->getErrors(),
                    ];

            }
    }

}
