<?php

/*
 *一个简单的php解析md的类
 */
class MdTpl {

	//核心的解析模板方法
	private function _tpl ($str){
		$str = preg_replace_callback('/^-{3,}/m','self::_replace_hr',$str);
		$str = preg_replace_callback('/^>(.*)/m','self::_replace_vicetitle',$str);
		$str = preg_replace_callback('/~~(.*)~~/Us','self::_replace_delete',$str);
		$str = preg_replace_callback('/==(.*)==/Us','self::_replace_mark',$str);
		$str = preg_replace_callback('/\*\*(.*)\*\*/Us','self::_replace_bold',$str);
		$str = preg_replace_callback('/\*(.*)\*/Us','self::_replace_italic',$str);
		$str = preg_replace_callback('/\+\+(.*)\+\+/Us','self::_replace_underline',$str);

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


