<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ViewDetail;

/**
 * ViewDetailSearch represents the model behind the search form about `common\models\ViewDetail`.
 */
class ViewDetailSearch extends ViewDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_id'], 'integer'],
            [['name', 'summary'], 'safe'],
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
        $query = ViewDetail::find();

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
            'view_id' => $this->view_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'summary', $this->summary]);
        $query->orderBy(['id' => SORT_DESC]);

        return $dataProvider;
    }
}
