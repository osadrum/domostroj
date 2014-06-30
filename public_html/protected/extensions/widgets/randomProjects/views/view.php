
        <?php $cnt=0; ?>
        <?php foreach ($projects as $project) : ?>
            <?php $cnt++; ?>
            <div class="mix project_<?php echo $cnt; ?> col-lg-3 col-md-3 col-sm-6 mix_all" data-project="<?php echo $cnt; ?>" style="display: inline-block; opacity: 1;">
                <div class="w-box inverse">
                    <div class="figure">
                        <img alt="" src="<?php echo Statics::getImageLink($project->image) ?>" class="img-responsive">
                        <div class="figcaption bg-2"></div>
                        <div class="figcaption-btn">
                            <a href="<?php echo Statics::getImageLink($project->image, 'large') ?>" class="btn btn-xs btn-one theater"><i class="fa fa-search-plus"></i> Увеличить</a>
                            <a href="<?php echo Yii::app()->createUrl('/catalog/default/view', array('id'=>$project->id)) ?>" class="btn btn-xs btn-one"><i class="fa fa-link"></i> Посмотреть</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h2><?php echo $project->title; ?></h2>
                            <div class="grades">
                                <?php foreach ($project->grades as $grade) : ?>
                                    <span class="grade-title"><?php echo $grade->type->title ?></span>
                                    <span class="grade-price"><?php echo $grade->price ?> </span><i class="fa fa-rub"></i><br>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="gap"></div>


