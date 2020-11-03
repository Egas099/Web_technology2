<?php

namespace app\controllers;

use Yii;
use app\models\Img;
use app\models\ImgSearch;
use app\models\UploadImg;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\base\Inflector;

/**
 * ImgController implements the CRUD actions for Img model.
 */
class ImgController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Img models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        $query = IMG::find()
            ->where(['user_id' => Yii::$app->user->identity->id]);
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);
        $imgs = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('index', [
            'imgs' => $imgs,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Img model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Img model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelImg = new Img(); // Модель для описания изображения
        $modelUploadImg = new UploadImg(); // Модель для описания загружаемого файла

        // Загружаем данные с форм в модель
        if ($modelUploadImg->load(Yii::$app->request->post())) {
            // Получаем экземпляр загруженного файла
            if ($modelUploadImg->imageFile = UploadedFile::getInstance($modelUploadImg, 'imageFile')) {
                // Указываем путь к файлу, и сохраняем изображение
                $modelImg->path = $modelUploadImg->upload();
                // Указываем пользователя, который загрузил изображение
                $modelImg->user_id = Yii::$app->user->identity->id;

                // Если загруженны данные с формы и данные из модели сохранена в базе данных
                if ($modelImg->load(Yii::$app->request->post()) && $modelImg->save()) {
                    return $this->redirect(['index']);
                    // Иначе удаляем сохранённый файл
                } else {
                    if (file_exists('../web/upload/' . $modelImg->path)) {
                        unlink('../web/upload/' . $modelImg->path);
                    }
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('create', [
            'modelImg' => $modelImg,
            'modelUploadImg' => $modelUploadImg,
        ]);
    }

    /**
     * Updates an existing Img model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelImg = $this->findModel($id);
        $modelUploadImg = new UploadImg();

        if ($modelUploadImg->load(Yii::$app->request->post())) {
            // Получаем экземпляр загруженного файла
            if ($modelUploadImg->imageFile = UploadedFile::getInstance($modelUploadImg, 'imageFile')) {
                if (file_exists('../web/upload/' . $this->findModel($id)->path)) {
                    unlink('../web/upload/' . $this->findModel($id)->path);
                }
                $modelImg->path = $modelUploadImg->upload();
                $modelImg->user_id = Yii::$app->user->identity->id;

                if ($modelImg->load(Yii::$app->request->post()) && $modelImg->save()) {
                    return $this->redirect(['index']);
                } else {
                    if (file_exists('../web/upload/' . $modelImg->path)) {
                        unlink('../web/upload/' . $modelImg->path);
                    }
                }
            }
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('update', [
            'modelImg' => $modelImg,
            'modelUploadImg' => $modelUploadImg,
        ]);
    }

    /**
     * Deletes an existing Img model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (file_exists('../web/upload/' . $model->path)) {
            unlink('../web/upload/' . $model->path);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Img model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Img the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Img::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
