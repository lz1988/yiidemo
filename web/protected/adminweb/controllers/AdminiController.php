<?php
class AdminiController extends Controller
{
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$condition 	= '1';
		$adminname 	= Yii::app()->request->getParam('adminname');
		$status		= Yii::app()->request->getParam('status'); 
		$adminname && $condition .= ' AND adminname LIKE \'%' . $adminname . '%\'';	
		$status && $condition 	.= ' AND status ='. $status;
		$criteria->condition = $condition;
		$criteria->order = 'id desc' ;
        $count = Manage::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 20;         
        $pages->applyLimit($criteria);
        $parameter  = Bases::mapcondition( $_GET, array ( 'adminname' , 'status') );
        $pages->params = $parameter;
        $datalist = Manage::model()->findAll($criteria);
		$this->render('admini',array('datalist'=>$datalist));		
	}

	/**
	*管理员批量操作
	*/
	public function actionCommand()
	{
		if ( Bases::method() == 'GET' ) {
            $command = trim( $_GET['command'] );
            $ids = intval( $_GET['id'] );
        } elseif ( Bases::method() == 'POST' ) {
            $command = trim( $_POST['command'] );
            $ids = $_POST['id'];
            is_array( $ids ) && $ids = implode( ',', $ids );
        } else {
            Bases::message( 'errorBack', '只支持POST,GET数据' );
        }

        empty( $ids ) && Bases::message( 'error', '未选择记录' );

        switch ( $command ) {
        case 'delete':
            $user = new Manage;
            $ret = $user->deleteAll( 'id IN(' . $ids . ')' );
            Bases::adminiLogger(array ('catalog' => 'delete' , 'intro' => '删除管理员,编号为:'.$ids ));
            $this->redirect(array('index'));
            break;
        
        default:
            throw new CHttpException(404, '错误的操作类型:' . $command);
            break;
        }
	}

	/*管理员新增操作*/
	public function actionCreate()
	{
		$model = new Manage('create');
		if ($_POST['Manage']){
			$post = $_POST['Manage'];
			$model->attributes = $post;
			if ($model->save()){
				Bases::adminiLogger(array ('catalog' => 'create' , 'intro' => '新增管理员,用户名为:'.$post['adminname'] ));
			 	$this->redirect( array ( 'index' ) );
			}
		}
		
		$this->render('admini_create', array ( 'model' => $model) );

	}

	/*修改管理员页面*/
	public function actionUpdate()
	{
		$model=Bases::loadModel(new Manage('update'),$_GET['id']);
		if ($_POST['Manage']){
			$post = $_POST['Manage'];
			$model->attributes = $post;
			if ($model->save()){
				Bases::adminiLogger(array ('catalog' => 'update' , 'intro' => '修改管理员,用户名为:'.$post['adminname'] ));
			 	$this->redirect( array ( 'index' ) );
			}
		}
		$this->render('admini_update',array('model'=>$model));
	}

}
?>