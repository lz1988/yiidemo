<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/adminweb/zebra_dialog/css/zebra_dialog.css" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>

	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/adminweb/zebra_dialog/zebra_dialog.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/comment.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items' =>  array(
                array('label'=>'首页', 'url'=>array('/site')),
                array('label'=>'关于站长', 'url'=>array('/about')),
                array('label'=>'联系站长', 'url'=>array('/contact')),
            )
		)); ?>

	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="tool">
		<?php echo CHtml::link("",array('#top'),array('id'=>'back-to-top'));?>
		<?php echo CHtml::link("意 见 反 馈",array('/contact'),array('id'=>'feedback'));?>
	</div>

	<div id="footer">
        <div class="foot_info">
        <?php echo CHtml::link("联系站长",array('/contact'));?>
        <?php echo CHtml::link("关于站长",array('/about'));?>
         </div>
		Copyright &copy; <?php echo date('Y'); ?> by <a href="http://miucool.cn">miucool.cn</a>.
		All Rights Reserved.
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
