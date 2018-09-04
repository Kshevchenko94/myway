<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goals;

/**
 * GoalsSearch represents the model behind the search form of `app\models\Goals`.
 */
class GoalsSearch extends Goals
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'is_public','status'], 'integer'],
            [['goal', 'date_finish_goal', 'criterion_fifnish_goal', 'need_goal', 'doc', 'category_goal', 'priority_goal'], 'safe'],
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
        $query = Goals::find()->where(['id_user'=>Yii::$app->user->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort'=>['defaultOrder'=>['id' => SORT_DESC]],
			'pagination' => [
				'pageSize' => 10,
			],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status' => $this->status,
            'category_goal' => $this->category_goal,
            'priority_goal' => $this->priority_goal,
            /* 'date_finish_goal' => $this->date_finish_goal,
            'id_user' => $this->id_user,
            'category_goal' => $this->category_goal,
            'priority_goal' => $this->priority_goal,
            'is_public' => $this->is_public, */
        ]);

        return $dataProvider;
    }
}
