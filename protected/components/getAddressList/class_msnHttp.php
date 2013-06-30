<?php   
define( "COOKIEJAR", tempnam( ini_get( "upload_tmp_dir" ), "cookie" ) );   //定义COOKIES存放的路径,要有操作的权限   
define( "TIMEOUT", 1000 ); //超时设定   
class msnHttp   
{   
  
        function getAddressList($username, $password)   
        {                  
                //第一步：模拟抓取登录页面的数据,并记下cookies   
                $cookies = array();   
                $ch = curl_init();   
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
                curl_setopt($ch, CURLOPT_URL, "http://login.live.com/login.srf?wa=wsignin1.0&rpsnv=11&ct=".time()."&rver=6.0.5285.0&wp=MBI&wreply=http:%2F%2Fmail.live.com%2Fdefault.aspx&lc=2052&id=64855&mkt=en");   
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);   
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
                $str = curl_exec($ch);                 
                curl_close($ch);   
  
                //参数的分析   
                $matches = array();          
                preg_match('/<input\s*type="hidden"\s*name="PPFT"\s*id="(.*?)"\s*value="(.*?)"\s*\/>/i', $str, $matches);    
                $PPFT = $matches[2];   
                   
                preg_match('/srf_sRBlob=\'(.*?)\';/i', $str, $matches);    
                $PPSX = $matches[1];   
                   
                $type = 11;   
                   
                $LoginOptions = 3;   
                   
                $Newuser = 1;   
                   
                $idsbho = 1;   
                   
                $i2 = 1;   
                   
                $i12 = 1;   
                   
                $i3 = '562390';   
                   
                $PPSX = 'Pa';   
                //合并参数   
                $postfiles = "login=".$username."&passwd=".$password."&type=".$type."&LoginOptions=".$LoginOptions."&Newuser=".$Newuser."&idsbho=".$idsbho."&i2=".$i2."&i3=".$i3."&PPFT=".$PPFT."&PPSX=".$PPSX."&i12=1";   
         
                //第二步：开始登录   
                $ch = curl_init();   
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);   
                curl_setopt($ch, CURLOPT_URL, 'https://login.live.com/ppsecure/post.srf?wa=wsignin1.0&rpsnv=11&ct='.(time()+5).'&rver=6.0.5285.0&wp=MBI&wreply=http:%2F%2Fmail.live.com%2Fdefault.aspx&lc=2052&id=64855&mkt=en&bk='.(time()+715)); //此处的两个time()是为了模拟随机的时间               
                curl_setopt($ch, CURLOPT_POST, 1);   
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postfiles);   
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);   
                //curl_setopt($ch, CURLOPT_HEADER, 1);   
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
         
                $content = curl_exec($ch);   
                curl_close($ch);   
    
                if( stripos($content,'WLWorkflow') !== FALSE ) {     //WLWorkflow登录页面JS   
                    return false;      //登录失败   
                }   
                //获取location链接   
                $matches = array();          
                preg_match('/window.location.replace\(\"(.*?)\"\)/i', $content, $matches);    
                $url_contiune_1 = $matches[1]; //接下来的链接   
                if(!$url_contiune_1) {   
                    return false;   
                }   
                //第三步: 进入引导页面   
                   
                $ch = curl_init();   
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);   
                curl_setopt($ch, CURLOPT_URL, $url_contiune_1);   
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);   
                curl_setopt($ch, CURLOPT_HEADER, 1);    
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
                $content_2 = curl_exec($ch);   
                   
                //echo $postfiles;     
                curl_close($ch);   
                   
                //获取redicturl链接   
                $matches = array();          
                preg_match('/<a\s*href=\"(.*?)\"\s*>/i', $content_2, $matches);    
                $url_contiune_2 = $matches[1]; //接下来的链接   
                if(!$url_contiune_2) {   
                    return false;   
                }   
                   
                //跳过进入首页   
                /*  
                $ch = curl_init();  
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);  
                curl_setopt($ch, CURLOPT_URL, $url_contiune_2);  
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);  
                curl_setopt($ch, CURLOPT_HEADER, 1);   
                curl_setopt($ch, CURLOPT_TIMEOUT, 1000);  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
                $content_3 = curl_exec($ch);  
                   
                curl_close($ch);  
                */  
                //获取邮箱请求基址 读取host   
                $matches = array();          
                preg_match('/(.*?)\/\/(.*?)\/(.*?)/i', $url_contiune_2, $matches);    
                $url_contiune_3 = trim($matches[1]).'//'.trim($matches[2]); //首页定义的站点基址   
                $url_4 = $url_contiune_3.'/mail/ContactMainLight.aspx?n=435707983'; //n后面的数字是随机数   
                if(!$url_contiune_3) {   
                    return false;   
                }   
                   
                //第四步: 开始获取邮箱联系人   
                //base  $url_4   
                $ch = curl_init();   
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);   
                curl_setopt($ch, CURLOPT_URL, $url_4);   
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
                $str = curl_exec($ch);   
                //分析数据 (此处的数据因为hotmail的JS处理机制,所以在页面上看不出来,源码上可以看到数据)   
                return $this->hanlde_date($str);   
                   
        }   
        function hanlde_date($data) {   
                $new_str = array();   
                if(!empty($data)) {   
                        $ops_start = stripos($data,'ic_control_data');   
                        $ops_end = stripos($data,';',$ops_start);   
                        $new_str = substr($data, $ops_start + strlen('ic_control_data = '), $ops_end - $ops_start - strlen('ic_control_data = ') );   
                        return $new_str; //返回JSON对象   
                } else {   
                    return array();   
                }   
                   
                                       
        }   
}   