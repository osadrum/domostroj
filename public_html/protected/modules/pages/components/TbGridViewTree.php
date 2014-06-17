<?php

Yii::import('bootstrap.widgets.TbGridView');

class TbGridViewTree extends TbGridView {
	
	public function renderTableRow($row)
	{
		$nodeId = $this->dataProvider->data[$row]->id;
		$parentId = $this->dataProvider->data[$row]->parent_id;

		if($this->rowCssClassExpression!==null)
		{
			$data=$this->dataProvider->data[$row];
			$class=$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data));
		}
		else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
			$class=$this->rowCssClass[$row%$n];
		else
			$class='';
		
		$nodeIdId = 'node-' . $nodeId;
		if ($parentId)
			$class .= ' child-of-node-' . $parentId;

		echo '<tr id="'.$nodeIdId.'" class="'.$class.'">';
		foreach($this->columns as $column)
			$column->renderDataCell($row);
		echo "</tr>\n";
	}

}
