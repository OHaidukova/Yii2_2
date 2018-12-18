<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/2018
 * Time: 22:09
 */

namespace common\models;


use yii\base\Model;
use yii\db\ActiveQuery;

class MessageFilter extends Model
{
    public function filter($filter, ActiveQuery $query) {
        $query->filterWhere([
                'user_id' => $filter['user_id']
        ]);

        return $query;
    }
}