<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapLayerController extends Controller
{
    //
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
     * Lists all MapLayer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MapLayerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MapLayer model.
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
     * Finds the MapLayer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MapLayer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MapLayer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Creates a new MapLayer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MapLayer();
        $modelsMapLayerVersion = [new MapLayerVersion];

        if ($model->load(Yii::$app->request->post())) {

            $modelsMapLayerVersion = Model::createMultiple(MapLayerVersion::classname());
            Model::loadMultiple($modelsMapLayerVersion, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMapLayerVersion),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsMapLayerVersion) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsMapLayerVersion as $index => $modelMapLayerVersion) {
                            $modelMapLayerVersion->map_layer_id = $model->id;
                            $modelMapLayerVersion->sort_order = $index;
                            $file = $modelMapLayerVersion->uploadFile("[{$index}]file");
                            if ($file) {
                                $loc = $model->getLoc();
                                if (!is_dir($loc)) {
                                    mkdir($loc);
                                }
                                $path = $modelMapLayerVersion->getFile();
//                              Yii::$app->session->setFlash('info', $path);
                                $file->saveAs($path);
                                $zip = new \ZipArchive;
                                $res = $zip->open($path);
                                if ($res === TRUE) {
                                    $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $modelMapLayerVersion->filename);
                                    $extractedFileLoc = $model->getLoc() . $filename . '/';
                                    $zip->extractTo($extractedFileLoc);
                                    $zip->close();

                                    // create table for map layer
                                    $modelMapLayerVersion->tablename = strtolower(preg_replace('/\s+/', '_', $model->name) . '_' . Yii::$app->security->generateRandomString(3));
//                                    $createTableCommand = "/usr/local/bin/shp2pgsql " . $extractedFileLoc . "*.shp " . $modelMapLayerVersion->tablename . " | /usr/local/bin/psql -p 5432 -d sitr -U sitr";
//                                    $createTableCommand = "/usr/local/bin/shp2pgsql -s 2100 /Volumes/Data/wwwroot/sitr/backend/uploads/kabupaten.shp kabupaten | /usr/local/bin/psql -h localhost -p 5432 -d sitr -U sitr 2>&1";
                                    $createTableCommand = "/usr/local/bin/uploadshp.sh " . $extractedFileLoc . " " . $modelMapLayerVersion->tablename;
                                    exec($createTableCommand, $out, $ret);
                                    Yii::$app->session->setFlash('info', $ret);
                                }



                            }

                            if (($flag = $modelMapLayerVersion->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
//                        Yii::$app->db->createCommand("select update_map_layer_jsondata(:paramName1)")
//                            ->bindValue(':paramName1', $model->id)
//                            ->execute();
                        exec("/usr/local/bin/psql -U sitr -d sitr -c 'select update_map_layer_jsondata(" . $model->id . ")'");
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsMapLayerVersion' => (empty($modelsMapLayerVersion)) ? [new MapLayerVersion] : $modelsMapLayerVersion
        ]);
    }

    /**
     * Updates an existing MapLayer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsMapLayerVersion = $model->mapLayerVersions;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsMapLayerVersion, 'id', 'id');
            $oldNewestTableId = $model->newestTableId;
            $modelsMapLayerVersion = Model::createMultiple(MapLayerVersion::classname(), $modelsMapLayerVersion);
            Model::loadMultiple($modelsMapLayerVersion, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsMapLayerVersion, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsMapLayerVersion),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsMapLayerVersion) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            foreach ($deletedIDs as $delID) {
                                MapLayerVersion::findOne($delID)->deleteFile();
                            }
                            MapLayerVersion::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsMapLayerVersion as $index => $modelMapLayerVersion) {
                            $modelMapLayerVersion->sort_order = $index;
                            if (!(empty($modelMapLayerVersion->deletedFile))) {
                                $modelMapLayerVersion->deleteFile();
                            }
                            $modelMapLayerVersion->map_layer_id = $model->id;


                            $oldFile = $modelMapLayerVersion->getFile();
                            $file = $modelMapLayerVersion->uploadFile("[{$index}]file");
                            if ($file) {
                                if ($oldFile !== null) {
                                    unlink($oldFile);
                                    $modelMapLayerVersion->dropTable();
                                }

                                $loc = $model->getLoc();
                                if (!is_dir($loc)) {
                                    mkdir($loc);
                                }
                                $path = $modelMapLayerVersion->getFile();
//                              Yii::$app->session->setFlash('info', $path);
                                $file->saveAs($path);
                                $zip = new \ZipArchive;
                                $res = $zip->open($path);
                                if ($res === TRUE) {
                                    $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $modelMapLayerVersion->filename);
                                    $extractedFileLoc = $model->getLoc() . $filename . '/';
                                    $zip->extractTo($extractedFileLoc);
                                    $zip->close();
                                    // create table for map layer
                                    $modelMapLayerVersion->tablename = strtolower(preg_replace('/\s+/', '_', $model->name) . '_' . Yii::$app->security->generateRandomString(3));
//                                    $createTableCommand = "/usr/local/bin/shp2pgsql " . $extractedFileLoc . "*.shp " . $modelMapLayerVersion->tablename . " | /usr/local/bin/psql -p 5432 -d sitr -U sitr";
//                                    $createTableCommand = "/usr/local/bin/shp2pgsql -s 2100 /Volumes/Data/wwwroot/sitr/backend/uploads/kabupaten.shp kabupaten | /usr/local/bin/psql -h localhost -p 5432 -d sitr -U sitr 2>&1";
                                    $createTableCommand = "/usr/local/bin/uploadshp.sh " . $extractedFileLoc . " " . $modelMapLayerVersion->tablename;
                                    exec($createTableCommand, $out, $ret);
//                                    Yii::$app->session->setFlash('info', $ret);

                                }
                            }

                            if (($flag = $modelMapLayerVersion->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        $newNewestTableId = $model->newestTableId;
                        if ($oldNewestTableId != $newNewestTableId) {
//                            Yii::$app->db->createCommand("select update_map_layer_jsondata(:paramName1)")
//                                ->bindValue(':paramName1', $model->id)
//                                ->execute();
                            exec("/usr/local/bin/psql -U sitr -d sitr -c 'select update_map_layer_jsondata(" . $model->id . ")' > /dev/null 2>/dev/null &");
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsMapLayerVersion' => (empty($modelsMapLayerVersion)) ? [new MapLayerVersion] : $modelsMapLayerVersion
        ]);
    }


    /**
     * Deletes an existing MapLayer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        foreach ($model->mapLayerVersions as $mapLayerVersion) {
            $mapLayerVersion->deleteFile();
            $mapLayerVersion->dropTable();
            $mapLayerVersion->delete();
        }

        $loc = $model->getLoc();
        if (is_dir($loc)) {
            rmdir($loc);
        }
        MapLayerJsondata::findOne($model->id)->delete();
        $model->delete();

        return $this->redirect(['index']);
    }


    public function actionMapedit()
    {
        $this->layout = 'mapLayout';

        $defaultMaplayers = MapLayerSummary::find()->where(['default_on_frontpage' => 1])->all();
        $searchModel = new MapLayerSummarySearch();
        $mapLayerProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('mapedit', [
            'defaultMaplayers' => $defaultMaplayers,
            'mapLayerProvider' => $mapLayerProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
