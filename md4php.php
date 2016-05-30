<?php

/*
 *一个简单的php解析md的类
 */
class MdTpl {

	private $has_code=false;

	//核心的解析模板方法
	private function _tpl ($str){
		$str = preg_replace_callback('/^-{3,}/m','self::_replace_hr',$str);
		$str = preg_replace_callback('/^>(.*)/m','self::_replace_vicetitle',$str);
		$str = preg_replace_callback('/^-\s(.*)/m','self::_replace_li',$str);
		$str = preg_replace_callback('/\[(\s|x)\]/m','self::_replace_checkbox',$str);
		$str = preg_replace_callback('/~~(.*)~~/Us','self::_replace_delete',$str);
		$str = preg_replace_callback('/==(.*)==/Us','self::_replace_mark',$str);
		$str = preg_replace_callback('/\*\*(.*)\*\*/Us','self::_replace_bold',$str);
		$str = preg_replace_callback('/\*(.*)\*/Us','self::_replace_italic',$str);
		$str = preg_replace_callback('/\+\+(.*)\+\+/Us','self::_replace_underline',$str);
		$str = preg_replace_callback('/```(\w*)\s(.*)```/Us','self::_replace_code',$str);

		return $str;

	}

	//换行的替换
	private function _replace_hr($parm){
		return '<hr></hr>';
	}

	//子标题的替换
	private function _replace_vicetitle($parm){
		return 
			'<blockquote data-source-line="3">
			<p>'.$parm[1].'</p>
			</blockquote>';
	}

	//匹配删除线
	private function _replace_delete($parm){
		return '<s>'.$parm[1].'</s>';
	}

	//高亮替换
	private function _replace_mark($parm){
		return '<mark>'.$parm[1].'</mark>';
	}

	//粗体替换
	private function _replace_bold($parm){
		return '<b>'.$parm[1].'</b>';
	}

	//斜体替换
	private function _replace_italic($parm){
		return '<i>'.$parm[1].'</i>';
	}

	//下划线替换
	private function _replace_underline($parm){
		return '<ins>'.$parm[1].'</ins>';
	}

	//匹配列表
	private function _replace_li($parm){
		return '<li>'.$parm[1].'</li>';
	}

	//对选择框的替换
	private function _replace_checkbox($parm){
		if($parm[1] == 'x'){
			return '<input type="checkbox" checked="checked"/>';
		}elseif($parm[1] == ' '){
			return '<input type="checkbox"/>';
		}
	}


	//对代码的替换
	private function _replace_code($parm){
		$str = '';
		//加载公共的文件
		if(!$this->has_code){
			$str = '<script type="text/javascript" src="sl/scripts/shCore.js"></script>';
			$str .= '<link type="text/css" rel="stylesheet" href="sl/styles/shCoreEmacs.css"/>';
			$str .= '<script type="text/javascript">SyntaxHighlighter.config.bloggerMode = true;SyntaxHighlighter.all();</script>';
		}
		//加载此类的文件
		if(! isset($this->has_code[$parm[1]])){
			$str .= '<script type="text/javascript" src="sl/scripts/shBrush'.ucfirst($parm[1]).'.js"></script>';
			$this->has_code[$parm[1]] = true;
		}
		return $str.'<pre class="brush:'.$parm[1].'">'.$parm[2].'</pre>';
	}

	/*
	 *外部调用的解析函数
	 *$str:需要解析的文件名或者字符串
	 *$view:显示||返回
	 *$type:默认为字符串，file时为文件
	 */
	public function display($str,$view=false,$type='str'){
		if($type == 'file'){
			if(file_exists($str)){
				$str = file_get_contents($str);
			}
		}else{
			$str = strval($str);
		}
		$str = $this->_tpl($str);
		if($view){
			echo $str;
		}else{
			return $str;
		}

	}

}


