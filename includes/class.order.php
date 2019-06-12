<?php



class order {
	const PARENT_ID = 'pid';
	const ID = 'id';
	const CHILDREN = 'children';
  

  // 将数据变成分类树
  public static function getTree($items) 
  {
		$children = [];
		// group by parent id
		foreach ($items as &$item) {
			$children[ $item[self::PARENT_ID] ][] = &$item;
			unset($item);
		}
		foreach ($items as &$item) {
			$pid = $item[self::ID];
			if (array_key_exists($pid, $children)) {
				$item[self::CHILDREN] = $children[ $pid ];
			}
			unset($item);
		}
		return $children[0];
  }
  

  //将分类树变成二维数组
  public static function orderTree($arr)
  {
    $child = array();
    foreach($arr as $item)
    {

      $current = array();

      $current['id'] = $item['id'];
      $current['url'] = $item['url'];
      $current['title'] = $item['title'];
      $current['pid'] = $item['pid'];
      $current['ismenu'] = $item['ismenu'];

      $child[] = $current;


      if(isset($item['children']))
      {
          $sbb = order::orderTree($item['children']);

          $child = array_merge($child,$sbb);
      }
    
    }

    return $child;
  }

  //同级数组，始终为二维数组
  public static function getSubTree($data,$parent,$son,$pid=0,$lev='')
  {
    //$parent == pid
    //$son == id
    $tmp = array();
    foreach($data as $key=>$value)
    {
       if($value[$parent] == $pid)
       {
          $value['lev'] = $lev;
          $tmp[] = $value;
          //合并
          $tmp = array_merge($tmp,order::getSubTree($data,$parent,$son,$value[$son],$lev."--"));
       }
    }

    return $tmp;
  }


}

?>