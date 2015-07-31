<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'cognome',
            'telefono',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
