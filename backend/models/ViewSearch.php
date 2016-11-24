<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\View;

/**
 * ViewSearch represents the model behind the search form about `common\models\View`.
 */
class ViewSearch extends View
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province', 'city', 'level'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = View::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'province' => $this->province,
            'city' => $this->city,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
