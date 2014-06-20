<?php

class DefaultController extends AdminController
{
    public $defaultAction = 'index';

    public function actionIndex()
	{
		$this->render('index');
	}

    public function actionCatalog()
    {
        $this->render('catalog');
    }


    public function actionProfile() {
        $this->render('profile');
    }

    public function actionAjaxEditPassword(){
        //var_dump($_POST);die;

        if ( isset($_POST['password']) ) {
            $user = User::model()->find(array('select'=>'id, password','condition'=>'id=:user_id', 'params'=>array(':user_id'=>$_POST['id'])));
            $user->password = $_POST['password'];
            $user->save();

        }
    }

    public function actionImgUpload()
    {
        $callback = $_GET['CKEditorFuncNum'];
        $file_name_tmp = $_FILES['upload']['tmp_name'];
        $file_new_name = Yii::getPathOfAlias('webroot').Yii::app()->params['imagePath'];

        $name = $_FILES['upload']['name'];
        $arrName = explode(".", $name);
        $ext = end($arrName);
        $file_name = FileHelper::getRandomFileName($file_new_name, $name);
        $full_path = $file_new_name.$file_name.'.'.$ext;
        $http_path = Yii::app()->params['imagePath'].$file_name.'.'.$ext;
        $error = '';
        if( move_uploaded_file($file_name_tmp, $full_path) ) {}
        else
        {
            $error = 'Some error occured please try again later';
            $http_path = '';
        }
        echo "<script type=\"text/javascript\">
                 window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );
             </script>";
    }
}