<?
$this->pageTitle = 'Создание страницы';
$this->pageIcon = '<i class="fa fa-file-o"></i> ';
$this->breadcrumbs = array(
    'Статические страницы' => array('index'),
    $this->pageTitle,
);
?>

<div class="col-lg-6">
    <?= $this->renderPartial('_form', array('model' => $model)) ?>
</div>
