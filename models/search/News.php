<?php

namespace app\models\search;

use app\components\F;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News as NewsModel;

/**
 * News represents the model behind the search form of `app\models\News`.
 */
class News extends NewsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['title', 'pre', 'content', 'created', 'updated'], 'safe'],
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
        $query = NewsModel::find();

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
            'status' => $this->status,
//            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        if($o = F::array_get($params, ['News','created'])){
            $df = explode(' - ', $o);
            $query->andFilterWhere(['>', 'created', $df[0]]);
            $query->andFilterWhere(['<', 'created', $df[1]]);
        }

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'pre', $this->pre])
            ->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
