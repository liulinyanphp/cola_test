<?php
namespace Admin\Model;
use Think\Model;
class HeadlineModel extends Model
{
	//定义主表名称
    protected $tableName = 't_headline_info';

	protected $_validate = array(
		array('title','require','资讯标题不能为空!',1),
		array('summary','require','资讯简介不能为空!',1),
        array('content','require','资讯内容不能为空!',1),
        array('author','require','资讯作者不能为空!',1)
	);

	public function getlist($where=array(),$pageNow='1',$limitRows='10')
	{
        return $this->field('a.*,b.count')->alias('a')->join('t_headline_stat as b on a.rand_code=b.headline_rand_code',left)->
        where($where)->order('a.created_date desc')->page($pageNow .','. $limitRows)->select();
	}


	
	public function getcount($w=array())
    {
        if (empty($w)) {
            return $this->alias('a')->count();
        } else {
            return $this->alias('a')->where($w)->count();
        }
    }
}
?>