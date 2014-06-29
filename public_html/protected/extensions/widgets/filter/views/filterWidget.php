<div class="pg-opt pin">
    <div class="container filter-row">
        <div class="row ">
            <form id="filter-form">
            <div class="col-md-4 filter-col text-center">
                <?php echo CHtml::dropDownList('filter[category]', $category,
                    CHtml::listData(ProjectCategory::model()->published()->findAll(), 'id', 'title'), array('id'=>'filter-category','empty'=>'Выберите тип дома')) ?>
                <?php echo CHtml::dropDownList('filter[floor]', $filterParams['floor'],$floors, array('id'=>'filter-floor','empty'=>'Кол-во этажей')) ?>
            </div>
            <div class="col-md-4 filter-col text-center">
                Площадь от <span id="area-range">
                    <input name="filter[minArea]" type="text" id="minArea" value="<?php echo $minAreaValue ?>" class="range-field"> до <input name="filter[maxArea]" type="text" id="maxArea" value="<?php echo $maxAreaValue ?>" class="range-field">
                </span>
                <?php
                $this->widget('zii.widgets.jui.CJuiSlider', array(
                    'id'=>'areaSlider',
                    'options'=>array(
                        'range' => true,
                        'min'=>$minArea,
                        'max'=>$maxArea,
                        'values' => array($minAreaValue, $maxAreaValue),
                        'step' => 10,
                        'slide'=>'js:function(event, ui) {
                            $( "#area-range" ).html("<input name=\"filter[minArea]\" type=\"text\" id=\"minArea\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input name=\"filter[maxArea]\" type=\"text\" id=\"maxArea\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">");
                            $( "#minArea" ).change();
                        }'
                    ),
                    'htmlOptions'=>array(
                        'class'=>'filter-slider',
                    ),
                ));
                ?>
            </div>
            <div class="col-md-4 filter-col text-center">
                Стоимость от <span id="price-range">
                    <input  name="filter[minPrice]" type="text" id="minPrice" value="<?php echo $minPriceValue ?>"  class="range-field"> до <input  name="filter[maxPrice]" type="text" id="maxPrice" value="<?php echo $maxPriceValue ?>" class="range-field">
                </span>
                <?php
                $this->widget('zii.widgets.jui.CJuiSlider', array(
                    'id'=>'priceSlider',
                    'options'=>array(
                        'range' => true,
                        'min'=>$minPrice,
                        'max'=>$maxPrice,
                        'values' => array($minPriceValue, $maxPriceValue),
                        'step' => 10000,
                        'slide'=>'js:function(event, ui) {
                            $( "#price-range" ).html("<input name=\"filter[minPrice]\" type=\"text\" id=\"minPrice\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input name=\"filter[maxPrice]\" type=\"text\" id=\"maxPrice\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">");
                            $( "#minPrice" ).change();
                        }'
                    ),
                    'htmlOptions'=>array(
                        'class'=>'filter-slider',
                    ),
                ));
                ?>
            </div>
            </form>
            <!--a href="#" class="btn-show-filter">Показать</a-->
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.filter-row').on('change', ' #filter-floor, #minArea, #maxArea, #minPrice, #maxPrice', function() {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('/catalog/default/index'); ?>',
                type: 'post',
                data: $('#filter-form').serialize(),
                success: function() {
                    ajaxListUpdate('listProjects');
                }
            });
        });

        $('.filter-row').on('change', '#filter-category', function() {
            location.href = '<?php echo Yii::app()->createUrl('/catalog/default/index?category=') ?>'+$(this).val();
        });

        $('.btn-show-filter').on('click', function() {
            return false;
        });


        function ajaxListUpdate(listId){
            $("#"+listId).yiiListView.update(listId);
        }
    });
</script>