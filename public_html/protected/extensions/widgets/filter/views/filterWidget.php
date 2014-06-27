<div class="pg-opt pin">
    <div class="container">
        <div class="row filter-row">
            <div class="col-md-4 filter-col text-center">
                <?php echo CHtml::dropDownList('filter[category]', '',
                    CHtml::listData(ProjectCategory::model()->published()->findAll(), 'id', 'title'), array('id'=>'filter-category','empty'=>'Выберите тип дома')) ?>
                <?php echo CHtml::dropDownList('filter[category]', '',array(1=>'1 Этаж', 2=>'2 Этажа'), array('id'=>'filter-floor','empty'=>'Кол-во этажей')) ?>
            </div>
            <div class="col-md-4 filter-col text-center">
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
                            $( "#area-range" ).html("<input type=\"text\" id=\"minArea\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input type=\"text\" id=\"maxArea\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">");
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
                            $( "#price-range" ).html("<input type=\"text\" id=\"minPrice\" value=\""+ui.values[ 0 ] + "\"  class=\"range-field\"> до <input type=\"text\" id=\"maxPrice\" value=\""+ui.values[ 1 ] + "\" class=\"range-field\">");
                            $( "#minPrice" ).change();
                        }'
                    ),
                    'htmlOptions'=>array(
                        'class'=>'filter-slider',
                    ),
                ));
                ?>


            </div>
            <a href="#" class="btn-filter">Показать</a>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.filter-row').on('change', '#filter-category, #filter-floor, #minArea, #maxArea, #minPrice, #maxPrice', function() {
           $('.btn-filter').show();
        });

        $('.btn-filter').on('click', function() {
            $(this).hide();
        });

        $('.btn-filter').hide();
    });
</script>