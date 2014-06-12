<?php

class DefaultController extends AdminController
{
	public function actionIndex()
	{
		$this->render('index');
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
}