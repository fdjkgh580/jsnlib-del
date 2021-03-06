<?
namespace Jsnlib;

class Del {
    
    //指定的dir
    private $dir;
    private $listary ;
    
    function __construct()
    {
        $this->listary['dir'] = [];
        $this->listary['file'] = [];
    }
    
    
    function get(string $dir)
    {
        if (!file_exists($dir)) return false; 
        
        //指定的根目錄
        if (empty($this->dir)) $this->dir = $dir;
        
        //1.將目錄名稱為 .xx 或檔案 .xx 先行指定檔名才能刪除
        $newdir = trim($dir, "\ /") . "/";
        $open   = scandir($newdir);
        

        if (is_array($open)) 
        {
            
            foreach ($open as $val) 
            {
                if ($val == "." or $val == "..") continue;
                
                //實際路徑
                $val = realpath($newdir . $val);

                if (is_file($val)) 
                {
                    $this->listary['file'][] = $val;
                }
                else 
                {
                    $this->listary['dir'][] = $val;
                    $this->get($val);
                }
            }
        }
            
        return $this->listary;
    }
    
    private function del(): bool
    {
        $is_delete = false;

        //先刪檔案再刪路徑
        foreach ($this->listary['file'] as $val)
        {
            if ($is_delete === false) $is_delete = true;
            
            unlink($val);
        }
        foreach ($this->listary['dir'] as $val)
        {
            if ($is_delete === false) $is_delete = true;

            rmdir($val);
        }

        return $is_delete;     
    }
    
    /*
     * 刪除包含自己的指定路徑與檔案
     */ 
    public function all(): bool
    {
        //倒轉dir陣列
        $this->listary['dir'] = array_reverse($this->listary['dir']);

        //加入自己
        if (empty($this->dir))
        {
            $this->listary['dir'] = [];
        }
        else 
        {
            $this->listary['dir'][] = trim($this->dir, "\ /") . "\\";
        }

        return $this->del();
    }
    
    /*
     * 刪除自己之下的路徑與檔案
    */  
    public function under(): bool
    {
        //倒轉dir陣列
        $this->listary['dir'] = array_reverse($this->listary['dir']);
        $this->del();
        return true;
    }
        
}
