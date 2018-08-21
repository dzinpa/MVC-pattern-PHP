<?php
/**
 * Calls function from models
 */

include_once ROOT.'/models/News.php';


class NewsController
{
    /**
     * Get news list
     */
    public function actionIndex()
    {
      $newsList = array();
      $newsList = News::getNewslist();
      
      require_once (ROOT.'/views/news/index.php');
    }
    
    /**
     * Get single news item with specified id
     * @param ineger $id 
     */
    public function actionView($id)
    {
       if ($id) {
           $newsItem = News::getNewsItemById($id);
           
           echo '<pre>';
           print_r($newsItem);
           echo '</pre>';
       }
    }
}

