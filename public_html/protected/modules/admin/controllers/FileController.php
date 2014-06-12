<?php

class FileController extends AdminController
{

    // Загрузка фотографий
    // $type смотрим в config/main.php
    public function actionImageUpload($type, $size_image=null,$sub_folder=null)
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
            if ($size_image == null) {
                foreach (Yii::app()->params[$type] as $path => $size) {
                    $resizeImage = Yii::app()->image->load($originalFolder.$newName.'.'.$ext);
                    $resizeImage->resize($size[0], $size[1])->quality(Yii::app()->params['imageQuality']);
                    if ($sub_folder == null) {
                        if (!file_exists($folder.$path))
                            mkdir($folder.$path, 0775, true);
                        $resizeImage->save($folder.$path.'/'.$newName.'.'.$ext);
                    } else {
                        if (!file_exists($folder.$sub_folder.'/'.$path))
                            mkdir($folder.$path, 0775, true);
                        $resizeImage->save($folder.$sub_folder.'/'.$path.'/'.$newName.'.'.$ext);
                    }

                }
            } else {
                $resizeImage = Yii::app()->image->load($originalFolder.$newName.'.'.$ext);
                $resizeImage->resize(Yii::app()->params[$type][$size_image][0], Yii::app()->params[$type][$size_image][0])->quality(Yii::app()->params['imageQuality']);
                if ($sub_folder == null) {
                    if (!file_exists($folder.$size_image))
                        mkdir($folder.$size_image, 0775, true);
                    $resizeImage->save($folder.$size_image.'/'.$newName.'.'.$ext);
                } else {
                    if (!file_exists($folder.$sub_folder.'/'.$size_image))
                        mkdir($folder.$sub_folder.'/'.$size_image, 0775, true);
                    $resizeImage->save($folder.$sub_folder.'/'.$size_image.'/'.$newName.'.'.$ext);
                }
            }


            echo CJSON::encode(array(
                'success' => true,
                'filename' => $newName.'.'.$ext
            ));
        }

    }

    public function actionImageDelete() {
        if (isset($_POST['image'])) {
            $folder = Yii::getPathOfAlias('webroot').Yii::app()->params['imagePath'];
            $sizes = array(
                'original',
                'small',
                'medium',
                'large'
            );
            $errors = 0;
            foreach ($sizes as $size) {
                if (file_exists($folder.$size.'/'.$_POST['image'])){
                    if(!unlink($folder.$size.'/'.$_POST['image'])) {
                        $errors++;
                    }
                }
            }
            if ($errors == 0) {
                if (isset($_POST['modelName'])) {
                    $modelName = $_POST['modelName'];
                    $model = $modelName::model()->findByPk($_POST['id']);
                    $model->image = null;
                    $model->save();

                }
            }
            echo CJSON::encode(array(
                'errors'=>$errors,
            ));
        }
    }

    public function actionProductImages($product_id, $type='productImages')
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

            foreach (Yii::app()->params['imageSizeProduct'] as $path => $size) {
                $resizeImage = Yii::app()->image->load($originalFolder.$newName.'.'.$ext);
                $resizeImage->resize($size[0], $size[1])->quality(Yii::app()->params['imageQuality']);
                if (!file_exists($folder.$path))
                    mkdir($folder.$path, 0775, true);
                $resizeImage->save($folder.$path.'/'.$newName.'.'.$ext);
            }
            if ($type == 'productImages') {
                $image = new ProductImages();
            }
            if ($type == 'productColors') {
                $image = new ProductColors();
            }
            if ($type == 'productTechnicalDrawings') {
                $image = new ProductTechnicalDrawings();
            }

            $image->image = $newName.'.'.$ext;
            $image->_product = $product_id;
            $image->is_published = 1;
            if ($image->save()) {
                echo CJSON::encode(array(
                    'success' => true,
                    'filename' => $newName.'.'.$ext
                ));
            }
        }
    }

    public function actionGalleryImages($album_id)
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

            $image = new GalleryImages();
            $image->image = $newName.'.'.$ext;
            $image->_category = $album_id;
            $image->is_published = 1;
            if ($image->save()) {
                echo CJSON::encode(array(
                    'success' => true,
                    'filename' => $newName.'.'.$ext
                ));
            }
        }
    }

    public function actionFileUpload($type)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $docFolder = Yii::getPathOfAlias('webroot') . Documents::getDocFolder($type);
        if (!file_exists($docFolder))
            mkdir($docFolder, 0775, true);

        $allowedExtensions = Yii::app()->params['docTypes'];
        $sizeLimit = Yii::app()->params['sizeLimit'];
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($docFolder);
        if ($result['success']) {
            $arrName = explode(".", $result['filename']);
            $ext = end($arrName);
            $size = $result['size'];
            $newName = FileHelper::getRandomFileName($docFolder, $result['filename']);
            rename($docFolder.$result['filename'],$docFolder.$newName.'.'.$ext);

           /* foreach (Yii::app()->params[$type] as $path => $size) {
                $resizeImage = Yii::app()->image->load($docFolder.$newName.'.'.$ext);
                $resizeImage->resize($size[0], $size[1])->quality(Yii::app()->params['imageQuality']);
                if (!file_exists($folder.$path))
                    mkdir($folder.$path, 0775, true);
                $resizeImage->save($folder.$path.'/'.$newName.'.'.$ext);
            }*/

            echo CJSON::encode(array(
                'success' => true,
                'filename' => $newName.'.'.$ext,
                'size' => $size

            ));
        }

    }

    public function actionFileDelete($type=null) {
        if (isset($_POST['file'])) {
            $docFolder = Yii::getPathOfAlias('webroot') . Documents::getDocFolder($type);
            $errors = 0;

            if (file_exists($docFolder.'/'.$_POST['file'])){
                if(!unlink($docFolder.'/'.$_POST['file'])) {
                    $errors++;
                }
            }
            echo CJSON::encode(array(
                'errors'=>$errors,
            ));
        }
    }

}