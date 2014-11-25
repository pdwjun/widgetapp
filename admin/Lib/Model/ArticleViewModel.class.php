<?php 

    class ArticleViewModel extends ViewModel{
	      public $viewFields=array(
		    'article'=>array(
			    'title'=>'atitle',
				'creat_time',
				'keywords',
				'description',
				'content',
				'author',
				'id',
				'hits',
				'status',
				'cover',
				'htmlname',
				
				
			
			  ),
			  
			  'category'=>array(
			   'name',
			   'id'=>'classid',
			   '_on'=>'article.class_id=category.id',
			  ),
			  
			  'user'=>array(
			    'username',
				'_on'=>'article.publisher=user.id',
			  ),
		  
		  );
	}

?>