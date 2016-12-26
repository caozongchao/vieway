<?php

namespace common\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "view".
 *
 * @property integer $id
 * @property string $name
 * @property integer $province
 * @property integer $city
 * @property integer $level
 */
class View extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'province', 'city', 'level'], 'required'],
            [['province', 'city', 'level'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['img'],'string','max' => 1000],
            [['scan_img'],'string','max' => 255],
            [['summary'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '景区名称',
            'province' => '所在省',
            'city' => '所在市',
            'level' => '质量等级',
            'img' => '导游图',
            'summary' => '景区介绍',
            'scan_img' => '标志图',
        ];
    }

    public function getWays()
    {
        return $this->hasMany(Way::className(),['view_id' => 'id']);
    }

    public static function getAllPages(){
        $query = View::find();
        $id = Yii::$app->request->get('id');
        $level = Yii::$app->request->get('level');
        if ($id && $id != 'P0') {
            $query = $query->where(['or', 'province='.$id, 'city='.$id]);
        }
        if ($level && $level != 'L0') {
            $query = $query->andWhere(['level' => str_replace('L', "", $level)]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
        $views = $query->offset($pages->offset)->orderBy(['id' => SORT_DESC])->limit($pages->limit)->asArray()->all();
        return ['views'=>$views,'pages'=>$pages];
    }

    public static function getAjaxPages($id,$level)
    {
        $query = View::find();
        if ($id != 'P0') {
            $query = $query->where(['or', 'province='.$id, 'city='.$id]);
        }
        if ($level != 'L0') {
            $query = $query->andWhere(['level' => str_replace('L', "", $level)]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
        $views = $query->offset($pages->offset)->orderBy(['id' => SORT_DESC])->limit($pages->limit)->asArray()->all();
        return ['views'=>$views,'pages'=>$pages];
    }
}
