<div class="pg-opt pin">
    <div class="container">
        <div class="row filter-row">
            <div class="col-md-4 text-center">
                <?php echo CHtml::dropDownList('filter[category]', '',
                    CHtml::listData(ProjectCategory::model()->published()->findAll(), 'id', 'title'), array('empty'=>'Выберите тип дома')) ?>
                <?php echo CHtml::dropDownList('filter[category]', '',array(1=>'1 Этаж', 2=>'2 Этажа'), array('empty'=>'Кол-во этажей')) ?>
            </div>
            <div class="col-md-4 text-center">
                Площадь от <span id="area-range">
                    <input type="text" id="minArea" value="10" class="range-field"> до <input type="text" id="maxArea" value="30000" class="range-field">
                </span>
                <?php


                $this->widget('zii.widgets.jui.CJuiSlider', array(
                    'id'=>'areaSlider',
                    'options'=>array(
                        'range' => true,
                        'min'=>300000,
                        'max'=>3000000,
                        'values' => array(300000, 3000000),
                        'step' => 10000,
                        'slide'=>'js:function(event, ui) {
                            $( "#area-range" ).html("<input type=\"text\" id=\"minArea\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input type=\"text\" id=\"maxArea\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">")
                        }'
                    ),
                    'htmlOptions'=>array(
                        'style'=>'display:inline-block;height:12px;width:240px;margin-top: 10px',
                    ),
                ));
                ?>


            </div>
            <div class="col-md-4 text-center">
                Стоимость от <span id="price-range">
                    <input type="text" id="minPrice" value="10"  class="range-field"> до <input type="text" id="maxPrice" value="30000" class="range-field">
                </span>
                <?php


                $this->widget('zii.widgets.jui.CJuiSlider', array(
                    'id'=>'priceSlider',
                    'options'=>array(
                        'range' => true,
                        'min'=>300000,
                        'max'=>3000000,
                        'values' => array(300000, 3000000),
                        'step' => 10000,
                        'slide'=>'js:function(event, ui) {
                            $( "#price-range" ).html("<input type=\"text\" id=\"minPrice\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input type=\"text\" id=\"maxPrice\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">")
                        }'
                    ),
                    'htmlOptions'=>array(
                        'style'=>'display:inline-block;height:12px;width:240px;margin-top: 10px',
                    ),
                ));
                ?>


            </div>

        </div>
    </div>
</div>
