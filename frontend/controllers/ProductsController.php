<?php

namespace frontend\controllers;

use frontend\models\Baskets;
use frontend\models\FilterForm;
use frontend\models\Likes;
use frontend\models\Products;
use frontend\models\ProductsSearch;
use frontend\models\SearchForm;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'client', 'search', 'filter'],
                            'roles' => ['admin', 'manager'],
                        ],
                        [
                            'allow' => false,
                            'actions' => ['addlike'],
                            'roles' => ['admin', 'manager'],
                        ],
                        [
                            'allow' => false,
                            'actions' => ['index', 'view', 'create', 'update', 'delete'],
                            'roles' => ['@', '?'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['client', 'addlike', 'client', 'search', 'filter'],
                            'roles' => ['@', '?'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // загружаем изображение и выполняем resize исходного изображения
                $model->upload = UploadedFile::getInstance($model, 'image');
                if ($name = $model->uploadImage()) { // если изображение было загружено
                    // сохраняем в БД имя файла изображения
                    $model->image = $name;
                }
                $model->save();
//            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        // старое изображение, которое надо удалить, если загружено новое
        $old = $model->image;
        if ($model->load($this->request->post()) && $model->validate()) {
            // если отмечен checkbox «Удалить изображение»
            if ($model->remove) {
                // удаляем старое изображение
                if (!empty($old)) {
                    $model::removeImage($old);
                }
                // сохраняем в БД пустое имя
                $model->image = '';
                // чтобы повторно не удалять
                $old = '';
            } else { // оставляем старое изображение
                $model->image = $old;
            }
            // загружаем изображение и выполняем resize исходного изображения
            $model->upload = UploadedFile::getInstance($model, 'image');
            if ($new = $model->uploadImage()) { // если изображение было загружено
                // удаляем старое изображение
                if (!empty($old)) {
                    $model::removeImage($old);
                }
                // сохраняем в БД новое имя
                $model->image = $new;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function showProducts($query)
    {
        $model = new Baskets();
        $search = new SearchForm();
        $filter = new FilterForm();

        $pagination=new Pagination(['defaultPageSize'=>5,'totalCount'=>$query->count()]);
        $products=$query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $likes_arr = array();
        $Products = $query->all();
        foreach ($Products as $Product){
            $count_likes=Likes::find()->where(['product_id' => $Product['id']])->count();
            $likes_arr[$Product['id']] = $count_likes;
        }

        $likes_user_query=Likes::find()->where(['user_id' => Yii::$app->user->id])->all();
        $likes_user = array();
        foreach ($likes_user_query as $like_user){
            array_push($likes_user, $like_user->product_id);
        }
        return [
            'products'=>$products,
            'pagination'=>$pagination,
            'model'=>$model,
            'search'=>$search,
            'filter'=>$filter,
            'likes_arr'=>$likes_arr,
            'likes_user'=>$likes_user,
        ];
    }

    public function actionClient()
    {
//        $query=Products::find();
        $query = (new Query())->from('products');

        $result = $this->showProducts($query);

        return $this->render('clientView',[
            'products'=>$result["products"],
            'pagination'=>$result["pagination"],
            'model'=>$result["model"],
            'search'=>$result["search"],
            'filter'=>$result["filter"],
            'likes'=>$result["likes_arr"],
            'likes_user'=>$result["likes_user"],
            'selected'=>0,
        ]);
    }

    public function actionSearch()
    {
        $search = new SearchForm();
        if ($search->load(Yii::$app->request->post()) && $search->validate()) {
            $query = (new Query())->from('products')->where(['like', 'sort', $search->search])->orWhere(['like', 'category', $search->search]);

            $result = $this->showProducts($query);

            return $this->render('clientView',[
                'products'=>$result["products"],
                'pagination'=>$result["pagination"],
                'model'=>$result["model"],
                'search'=>$result["search"],
                'filter'=>$result["filter"],
                'likes'=>$result["likes_arr"],
                'likes_user'=>$result["likes_user"],
                'selected'=>0,
            ]);
        }
    }

    public function actionFilter()
    {
        $filter = new FilterForm();
        $products = Yii::$app->request->get('products');
        if ($filter->load(Yii::$app->request->post()) && $filter->validate()) {
            if ($filter->filter == 1) $query = (new Query())->from('products')->orderBy('price ASC');
//            if ($filter->filter == 1) $query = asort($products, $products[]['price']);
            elseif ($filter->filter == 2) $query = (new Query())->from('products')->orderBy('price DESC');
//            elseif ($filter->filter == 2) $query = asort($products, $products[]['price']);
            elseif ($filter->filter == 3) {
                $query = (new Query())->from('products');
                $Products = $query->all();
                foreach ($Products as $Product){
                    $count_likes=Likes::find()->where(['product_id' => $Product['id']])->count();
                    $likes_arr[$Product['id']] = $count_likes;

                }
                foreach ($Products as $Product){
                    foreach ($likes_arr as $key => $value) {
                        if ($Product['id'] == $key) $Product['like_count'] = $value;
                    }
                }

                $model = new Baskets();
                $search = new SearchForm();
                $filter = new FilterForm();

                $pagination=new Pagination(['defaultPageSize'=>5,'totalCount'=>$query->count()]);
                $products=$query->orderBy('like_count DESC')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
                $likes_arr = array();
                $Products = $query->all();
                foreach ($Products as $Product){
                    $count_likes=Likes::find()->where(['product_id' => $Product['id']])->count();
                    $likes_arr[$Product['id']] = $count_likes;
                }

                $likes_user_query=Likes::find()->where(['user_id' => Yii::$app->user->id])->all();
                $likes_user = array();
                foreach ($likes_user_query as $like_user){
                    array_push($likes_user, $like_user->product_id);
                }

                return $this->render('clientView',[
                    'products'=>$products,
                    'pagination'=>$pagination,
                    'model'=>$model,
                    'search'=>$search,
                    'filter'=>$filter,
                    'likes'=>$likes_arr,
                    'likes_user'=>$likes_user,
                ]);

            }
            else $query = (new Query())->from('products');
            $result = $this->showProducts($query);

            return $this->render('clientView',[
                'products'=>$result["products"],
                'pagination'=>$result["pagination"],
                'model'=>$result["model"],
                'search'=>$result["search"],
                'filter'=>$result["filter"],
                'likes'=>$result["likes_arr"],
                'likes_user'=>$result["likes_user"],
                'selected'=>$filter->filter,
            ]);
        }
    }

    public function actionAddlike()
    {
        $likes_user_query=Likes::find()->where(['Product_id' => Yii::$app->request->get('product_id'), 'user_id' => Yii::$app->user->id])->count();
        if($likes_user_query == 0){
            $like = new Likes();
            $like->user_id = Yii::$app->user->id;
            $like->product_id = Yii::$app->request->get('product_id');
            $like->save();
        }
        else{
            $like = Likes::find()->where(['Product_id' => Yii::$app->request->get('product_id'), 'user_id' => Yii::$app->user->id])->one();
            $like->delete();
        }

        return $this->redirect(['products/client']);
    }
}
