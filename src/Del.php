<?
namespace Jsnlib;

class Del {
	
	//指定的dir
	private $dir;
	private $listary ;
	
	function __construct(){
		$this->listary['dir'] = array();
		$this->listary['file'] = array();
		}
	
	
	
	function get($dir) {
		if (!file_exists($dir)) return "0"; 
		
		//指定的根目錄
		if (empty($this->dir)) $this->dir = $dir;
		
		//1.將目錄名稱為 .xx 或檔案 .xx 先行指定檔名才能刪除
		$newdir = trim($dir, "\ /") . "/";
		$open	= scandir($newdir);
		
		if (is_array($open)) {
			
			foreach ($open as $val) {
				if ($val == "." or $val == "..") continue;
				
				//實際路徑
				$val = realpath($newdir . $val);
				if (is_file($val)) $this->listary['file'][] = $val;
				else {
					$this->listary['dir'][] = $val;
					$this->get($val);
					}
				}
			}
			
		return $this->listary;
		}
	
	private function del(){
		//先刪檔案再刪路徑
		foreach ($this->listary['file'] as $val) unlink($val);
		foreach ($this->listary['dir'] as $val) rmdir($val);
		return "1";		
		}
	
	/*
	 * 刪除包含自己的指定路徑與檔案
	 */	
	public function all() {
		//倒轉dir陣列
		$this->listary['dir'] = array_reverse($this->listary['dir']);
		//加入自己
		$this->listary['dir'][] = trim($this->dir, "\ /") . "\\";
		$this->del();
		return "1";
		}
	/*
	 * 刪除自己之下的路徑與檔案
	*/	
	public function under (){
		//倒轉dir陣列
		$this->listary['dir'] = array_reverse($this->listary['dir']);
		$this->del();
		return "1";
		}
		
	}

?>