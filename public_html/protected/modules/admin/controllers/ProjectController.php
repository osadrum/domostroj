<?php

class ProjectController extends AdminController
{
   /* public function actionView($id)

    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }*/

    public function actionImage($id)

    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $images=new CActiveDataProvider('ProjectImage', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

        $this->render('image',array(
            'model'=>$this->loadModel($id),
            'images' => $images,
        ));
    }

    public function actionImageOptionEdit() {
        $image = ProjectImage::model()->findByPk($_POST['id']);

        $image->title = $_POST['title'];
        $image->sort = $_POST['sort'];
        if ($image->save()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

   /* public function actionLayout($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);
        $layout=new CActiveDataProvider('Layout', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));
        $this->render('layout',array(
            'model'=>$this->loadModel($id),
            'layout' => $layout,
        ));
    }*/

    public function actionLayoutSave($id=null){
        if (isset($_POST['Layout']) && isset($_POST['Project'])){
            $layoutModel = Layout::model()->findByPk($id);
            if ($layoutModel == null){
                $layoutModel = new Layout();
            }
            $layoutModel->_project = $_POST['Project']['id'];
            $layoutModel->_type = $_POST['Layout']['_type'];
            if ($_POST['Layout']['_type'] == 1){
                $layoutModel->floor = $_POST['Layout']['floor'];
            }
            $layoutModel->image = $_POST['Layout']['image'];
            if ($layoutModel->save()){
                $this->redirect(array('/admin/project/update/id/' . $_POST['Project']['id']));
            }
        }
    }

    public function actionAjaxLayout($id=null)
    {
        if ($id != null){
            $layoutModel = Layout::model()->findByPk($id);
            $model = $layoutModel->project;
        } else {
            $model = $this->loadModel($_POST['project_id']);
            $layoutModel = new Layout();
        }
        if ($_POST['project_id'] != null){
                $this->renderPartial('_layoutForm',
                    array(
                        'model'=>$model,
                        'layoutModel' => $layoutModel), false, true);
        }
    }

    public function actionAjaxLayoutOption()
    {
        if ($_POST['layout_id'] != null){
            $catLayoutOption = CatLayoutOption::model()->findAll();
            $layoutList = array();
          /*  foreach ($layoutOptionModel as $layout) {
                $layoutList[$layout->_option] = $layout->value;
            }*/
            if (!empty($_POST['option_id'])){
                $layoutOptionModel =  LayoutOption::model()->findByPk($_POST['id']);
            } else {
                $layoutOptionModel = new LayoutOption();
            }
            if (Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_layoutOptionForm',
                    array('layoutOptionModel'=>$layoutOptionModel,
                          'catLayoutOption'=>$catLayoutOption,
                          'layout_id'=>$_POST['layout_id']), false, true);
            }
        }
    }

    public function actionLayoutOptionSave()
    {
        if (!empty($_POST['layout_id']) && !empty($_POST['option_id']) && !empty($_POST['value'])){
            $project_id = Layout::model()->findByPk($_POST['layout_id'])->_project;
            if (!empty($_POST['id'])){
                $layoutOptionModel = LayoutOption::model()->findByPk($_POST['id']);
            } else {
                $layoutOptionModel = new LayoutOption();
            }
            $layoutOptionModel->_layout = $_POST['layout_id'];
            $layoutOptionModel->_option = $_POST['option_id'];
            $layoutOptionModel->value = $_POST['value'];
            if ($layoutOptionModel->save()){
                $this->redirect(array('/admin/project/update/id/' . $project_id));

            }
        }
    }

    public function actionAjaxDelLayoutOption()
    {
        if (!empty($_POST['id'])){
            $layoutOption = LayoutOption::model()->findByPk($_POST['id']);
            if ($layoutOption->delete()){
                echo 'ok';
            } else {
                echo 'error';
            }
        }
        Yii::app()->end();
    }

    public function actionLayoutDelete($id){
        $layoutOptionModel = LayoutOption::model()->findAllByAttributes(array('_layout'=>$id));
        foreach ($layoutOptionModel as $layout){
            $layout->delete();
        }
        $layoutModel = Layout::model()->findByPk($id);
        $project_id = $layoutModel->_project;
        $layoutModel->delete();
        $this->redirect(array('/admin/project/update/id/' . $project_id));
    }

   /* public function actionGrade($id)

    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $grade=new CActiveDataProvider('Grade', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

        $this->render('grade',array(
            'model'=>$this->loadModel($id),
            'grade' => $grade,
        ));
    }*/

    public function actionAjaxGrade($id=null)
    {
        if ($id != null){
            $gradeModel = Grade::model()->findByPk($id);
            $model = $gradeModel->project;
        } else {
            $model = $this->loadModel($_POST['project_id']);
            $gradeModel = new Grade();
        }
        if ($_POST['project_id'] != null){
            $this->renderPartial('_gradeForm',
                array(
                    'model'=>$model,
                    'gradeModel' => $gradeModel), false, true);
        }
    }

    public function actionGradeSave($id=null){
        if (isset($_POST['Grade']) && isset($_POST['Project'])){
            $gradeModel = Grade::model()->findByPk($id);
            if ($gradeModel == null){
                $gradeModel = new Grade();
            }
            $gradeModel->_project = $_POST['Project']['id'];
            $gradeModel->_type = $_POST['Grade']['_type'];
            $gradeModel->price = $_POST['Grade']['price'];
            if ($gradeModel->save()){
                $this->redirect(array('/admin/project/update/id/' . $_POST['Project']['id']));
            }
        }
    }

    public function actionAjaxGradeConstructType()
    {
        if ($_POST['grade_id'] != null){
            $catConstruct = CatConstruct::model()->findAll();

            $catConstructType = CatConstructType::model()->findAll();
            $gradeConstructModel = GradeConstruct::model()->findAllByAttributes(array('_grade'=>$_POST['grade_id']));

            $gradeList = array();
            foreach ($gradeConstructModel as $grade) {
                $gradeList[$grade->_construct] = $grade->_construct;
            }

            if (Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_gradeConstructTypeForm',
                    array('gradeConstructModel'=>$gradeList,
                        'catConstruct'=>$catConstruct,
                        'catConstructType'=>$catConstructType,
                        'grade_id'=>$_POST['grade_id']), false, true);
            }
        }
    }

    public function actionAjaxGradeConstruct()
    {
        if (!empty($_POST['grade_id']) && !empty($_POST['catConstructType'])){

            $criteria = new CDbCriteria();
            $criteria->condition = '_type=:type';
            $criteria->params = array(':type'=>$_POST['catConstructType']);

            $catConstruct = CatConstruct::model()->findAll($criteria);
            if (!empty($_POST['construct_id'])){
                $construct_old_id = $_POST['construct_id'];
            } else {
                $construct_old_id = 0;
            }
            $this->renderPartial('_gradeConstructForm',
                array(
                    'construct_old_id'=>$construct_old_id,
                    'catConstruct'=>$catConstruct,
                    'grade_id'=>$_POST['grade_id']), false, true);
        }
    }

    public function actionAjaxDelGradeConstruct()
    {
        if (!empty($_POST['grade_id']) && !empty($_POST['construct_id'])){
            $gradeConstruct = GradeConstruct::model()->findByAttributes(array('_grade'=>$_POST['grade_id'],'_construct'=> $_POST['construct_id']));
            if ($gradeConstruct->delete()){
                echo 'ok';
            } else {
                echo 'error';
            }
        }
        Yii::app()->end();
    }

    public function actionAjaxGradeConstructSave()
    {
        if (!empty($_POST['grade_id']) && !empty($_POST['construct_id'])){
            if (!empty($_POST['construct_old_id'])){
                $gradeConstruct = GradeConstruct::model()->findByAttributes(array('_grade'=>$_POST['grade_id'],'_construct'=>$_POST['construct_old_id']));
            }
            if ($gradeConstruct == null){
                $gradeConstruct = new GradeConstruct();
            }
            $gradeConstruct->_construct = $_POST['construct_id'];
            $gradeConstruct->_grade = $_POST['grade_id'];
            if ($gradeConstruct->save()){
                echo 'ok';
            } else {
                echo 'error';
            }
        }
        Yii::app()->end();
    }

    public function actionGradeDelete($id){
        $gradeConstruct = GradeConstruct::model()->findAllByAttributes(array('_grade'=>$id));
        foreach ($gradeConstruct as $construct){
            $construct->delete();
        }
        $grade = Grade::model()->findByPk($id);
        $project = $grade->_project;
        $grade->delete();
        $this->redirect(array('/admin/project/update/id/' . $project));

    }

    public function actionAjaxProjectOption()
    {
        if ($_POST['project_id'] != null){
            $catProjectOption = CatProjectOption::model()->findAll();
            $projectOptionModel = ProjectOption::model()->findAllByAttributes(array('_project'=>$_POST['project_id']));
            $projectList = array();
            foreach ($projectOptionModel as $project) {
                $projectList[$project->_option] = $project->value;
            }
            if (Yii::app()->request->isAjaxRequest){
                $this->renderPartial('_projectOptionForm',
                    array('projectOptionModel'=>$projectList,
                        'catProjectOption'=>$catProjectOption,
                        'project_id'=>$_POST['project_id']), false, true);
            }
        }
    }

    public function actionProjectOptionSave()
    {
        $projectOptionModel = ProjectOption::model()->findAllByAttributes(array('_project'=>$_POST['project_id']));
        if ($projectOptionModel != null){
            foreach ($projectOptionModel as $project){
                $project->delete();
            }
        }
        foreach ($_POST['Project']['value'] as $key=>$value){
            $projectOptionModel = new ProjectOption();
            $projectOptionModel->_project = $_POST['project_id'];
            $projectOptionModel->_option = $key;
            $projectOptionModel->value = $value;
            $projectOptionModel->save();
        }

        $this->redirect(array('/admin/project/update/id/' . $_POST['project_id']));

    }

    public function actionCreate()
	{
		$model=new Project;
        $image = new ProjectImage();
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			$model->is_published=0;
			if($model->save())
                $this->redirect(array('update','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'image'=>$image,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('admin'));
		}
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $projectImage=new CActiveDataProvider('ProjectImage', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>4,
            ),
        ));
        $projectLayout=new CActiveDataProvider('Layout', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>4,
            ),
        ));
        $projectGrade=new CActiveDataProvider('Grade', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>4,
            ),
        ));
        $projectOption= ProjectOption::model()->findAllByAttributes(array('_project'=>$id));
		$this->render('update',array(
			'model'=>$model,
			'projectImage'=>$projectImage,
			'projectLayout'=>$projectLayout,
			'projectGrade'=>$projectGrade,
			'projectOption'=>$projectOption,
		));
	}

    public function actionProjectImage($project_id)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder = Yii::getPathOfAlias('webroot').Yii::app()->params['imagePath'];
        $originalFolder = $folder.'original/';

        if (!file_exists($originalFolder))
            mkdir($originalFolder, 0775, true);

        $allowedExtensions = Yii::app()->params['imageTypes'];
        $sizeLimit = Yii::app()->params['sizeLimit'];
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($originalFolder);

        if ($result['success']) {
            $arrName = explode(".", $result['filename']);
            $ext = end($arrName);
            $newName = FileHelper::getRandomFileName($originalFolder, $result['filename']);

            rename($originalFolder.$result['filename'],$originalFolder.$newName.'.'.$ext);

            foreach (Yii::app()->params['imageSizeGallery'] as $path => $size) {
                $resizeImage = Yii::app()->image->load($originalFolder.$newName.'.'.$ext);
                $resizeImage->resize($size[0], $size[1])->quality(Yii::app()->params['imageQuality']);
                if (!file_exists($folder.$path))
                    mkdir($folder.$path, 0775, true);
                $resizeImage->save($folder.$path.'/'.$newName.'.'.$ext);
            }

            $image = new ProjectImage();
            $image->image = $newName.'.'.$ext;
            $image->_project = $project_id;
            $image->is_published = 1;
            if ($image->save()) {
                echo CJSON::encode(array(
                    'success' => true,
                    'filename' => $newName.'.'.$ext
                ));
            }
        }
    }

    public function actionImageDelete() {
        $image = ProjectImage::model()->findByPk($_POST['id']);
        if ($image->delete()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function actionImagePublish() {
        $image = ProjectImage::model()->findByPk($_POST['id']);
        $image->is_published = $_POST['publish'];
        if ($image->save()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
            $project = $this->loadModel($id);
            $projectImage = ProjectImage::model()->findAllByAttributes(array('_project'=>$id));
            $projectOptionModel = ProjectOption::model()->findAllByAttributes(array('_project'=>$id));

            foreach ($projectImage as $image){
                $image->delete();
            }
            foreach ($project->layouts as $layout){
                foreach ($layout->layoutOptions as $layoutOption){
                    $layoutOption->delete();
                }
                $layout->delete();
            }
            foreach ($project->grades as $grade){
                $grade->delete();
                    foreach ($grade->gradeConstructs as $construct){
                        $construct->delete();
                    }
            }
            foreach ($projectOptionModel as $project){
                $project->delete();
            }
            $project->delete();

			// we only allow deletion via POST request

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
