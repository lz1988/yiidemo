
<div class="post">
	<div class="title">
		<h3><?php echo $model['article_title']; ?></h3>
	</div>
    
    <div id="mainnav">
		<br/>
		作者：<?php echo $model['article_author']?> &nbsp;&nbsp;
		时间：<?php echo $model['fstcreate']?>&nbsp;&nbsp;
		浏览量：<?php echo $model['article_click_count'];?>
	</div>
	<br/>

    <div id="maincontent">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $model['article_content'];
			$this->endWidget();
		?>
	</div>

<div id="maintag">
	<?php
	 if ($model['key_words']){
	 	$html = '';
	 	$html .= '标签：';
		$new_key_words = explode(',',$model['key_words']);
		foreach($new_key_words as $val)
		{
			$html .= '<a href ="?r=site/search_article&search_article='.CHtml::encode($val).'">'.$val.'</a>&nbsp;&nbsp;';
		}
		echo $html;

	}
	 ?>
</div>

<div class="page_nav">
    <div class="pre_page" title="上一篇">
		<?php echo CHtml::link($last_data->article_title,array('site/show','id'=>$last_data->id));?>
	</div>
    <div class="next_page" title="下一篇">
        	<?php echo CHtml::link($next_data->article_title,array('site/show','id'=>$next_data->id));?>
    </div>
</div>



<div id="comments">
	<div class="titles">相关推荐</div>
		<div class="portlet-content">
			<ul>
				<?php foreach($new_title_array as $id=>$title): ?>
		 	 		<li><?php echo CHtml::link($title,array('site/show','id'=>$id));?></li></span>
				<?php endforeach;?>
	 		</ul>

		</div>
	</div>
</div>


<div id="comments">
	<div class="titles">发表评论</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	'enableClientValidation'=>false,
	'enableAjaxValidation'=>true,
	'action'=>array('site/comments'),  
	'clientOptions'=>array(
		'validateOnSubmit'=>true,

	),
)); ?>

	<?php echo $form->errorSummary($comments); ?>

	<div class="row">
		<?php echo $form->labelEx($comments,'name'); ?>
		<?php echo $form->textField($comments,'name'); ?>
		<?php echo $form->error($comments,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($comments,'email'); ?>
		<?php echo $form->textField($comments,'email'); ?>
		<?php echo $form->error($comments,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($comments,'subject'); ?>
		<?php echo $form->textField($comments,'subject',array('size'=>60,'maxlength'=>128,'readonly'=>true,'value'=>$model['article_title'])); ?>
		<?php echo $form->error($comments,'subject'); ?>
		<?php echo $form->hiddenField($comments,'article_id',array('value'=>$model['id'])); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($comments,'body'); ?>
		<?php echo $form->textArea($comments,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($comments,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($comments,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha',array(
        'showRefreshButton'=>true,
        'clickableImage'=>true,
        'buttonLabel'=>'',
        'imageOptions'=>array(
            'alt'=>'点击换图',
            'title'=>'点击换图',
            'style'=>'cursor:pointer'))
            ); ?>
		<?php echo $form->textField($comments,'verifyCode'); ?>
		</div>
		<div class="hint">请输入上面图片上的字母，不区分大小写。</div>
		<?php echo $form->error($comments,'verifyCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<?php endif; ?>
</div>
