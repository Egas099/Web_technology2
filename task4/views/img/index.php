<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

AppAsset::register($this);
$this->params['breadcrumbs'][] = 'Images';
?>
<div class="img-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    
    <ul class="main_ul">
        <?php foreach ($imgs as $img) : ?>
            <li class="img_li">
                <h1><strong><?= Html::encode("{$img->name}") ?></strong></h1>
                <?= $img->caption ?>
                <?= Html::img("../web/upload/{$img->path}", ['alt' => 'Could not open image', 'height' => '400px', 'class' => 'img']) ?>
                <div class="central_content">
                    <?= Html::a('Upload new image', ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Update', ['update', 'id' => $img->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $img->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="central_content">
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>

</div>