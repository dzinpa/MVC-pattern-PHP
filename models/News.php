<?php
/**
 * Operations with datu base
 */

class News
{
    /**
     * Returns single news item with specified id
     * @param itneger $id 
     */
    public static function getNewsItemById($id)
    {
       $id = intval($id);
       
       if ($id) {
        $db = Db::getConnection();
           
       $result = $db->query('SELECT * from tableName WHERE id=' .$id);
        //$result->setFetchMode(PDO::FETCH_NUM);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $newsItem = $result->fetch();
        
        return $newsItem;
           
       }
    }
    
    /**
     * Returns an array of news items
     */
    public static function getNewslist()
    {
        $db = Db::getConnection();
        
        $newslist = array();
        
        $result = $db->query('SELECT id, title, date, short_content ' //table cells name
                . 'FROM tableName '
                . 'ORDER BY date DESC '
                . 'LIMIT 10');
        
        $i = 0;
        while($row = $result->fetch()) {
            $newslist[$i]['id'] = $row['id'];
            $newslist[$i]['title'] = $row['title'];
            $newslist[$i]['date'] = $row['date'];
            $newslist[$i]['short_content'] = $row['short_content'];
            $i++;
        }
        return $newslist;
    }
}
