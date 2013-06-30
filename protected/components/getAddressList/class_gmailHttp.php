<?php
define( "COOKIEJAR", tempnam( ini_get( "upload_tmp_dir" ), "cookie" ) );   //定义COOKIES存放的路径,要有操作的权限
define( "TIMEOUT", 1000 ); //超时设定
class gmailHttp
{

        private function login($username, $password)
        {               
                //第一步：模拟抓取登录页面的数据,并记下cookies
                $cookies = array();
                $matches = array();
                //获取表单
                $login_url = "https://www.google.com/accounts/ServiceLoginAuth";
                $ch = curl_init($login_url);
                
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $contents = curl_exec($ch);
                curl_close($ch);

                //模拟参数
                $name = array('dsh','timeStmp','secTok'); 
                foreach($name as $v) {
                     preg_match('/<input\s*type="hidden"\s*name="'.$v.'"\s*id="'.$v.'"\s*value="(.*?)"\s*\/>/i', $contents, $matches);
                    if(!empty($matches)) {
                        $$v = $matches[1];
                        $matches = array();
                    }        
                }
                $server = 'mail';
                preg_match('/<input\s*type="hidden"\s*name="GALX"\s*value="(.*?)"\s*\/>/i', $contents, $matches);
                if(!empty($matches)) {
                    $GALX = $matches[1];
                    $matches = array();
                } 
                $timeStmp = time();
                
                //第二步: 开始登录
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ServiceLoginAuth");
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR); 
                curl_setopt($ch, CURLOPT_POST, 1);
                $fileds = "dsh=$dsh&Email=".$username."&Passwd={$password}&GALX=$GALX&timeStmp=$timeStmp&secTok=$secTok&signIn=Sign in&rmShown=1&asts=&PersistentCookie=yes"; 
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fileds); 
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);              
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $str = curl_exec($ch);               
                curl_close($ch);
     
                //第三步：check Cookies即也算是个引导页面
                $ch = curl_init("https://www.google.com/accounts/CheckCookie?chtml=LoginDoneHtml");
               
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_COOKIEFILE,COOKIEJAR);
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIEJAR);                 
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);     
                $str2 = curl_exec($ch);
                 
                curl_close($ch);
                                                
                if (strpos($contents, "安全退出") !== false)
                {                        
                        return FALSE;
                }               
                return TURE;
        }
        
        //获取邮箱通讯录-地址
        public function getAddressList($username, $password)
        {               
                if (!$this->login($username, $password))
                {
                        return FALSE;
                }
                //开始进入模拟抓取
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://mail.google.com/mail/contacts/data/contacts?thumb=true&groups=true&show=ALL&enums=true&psort=Name&max=300&out=js&rf=&jsx=true");  //out=js返回json数据,不设置返回为xml数据   
                curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIEJAR);
                /*  对于返回xml数据时需要此设置
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
                $str = "<?xml version=\"1.0\"?><object><array name=\"items\"><object><string name=\"func\">pab:searchContacts</string><object name=\"var\"><array name=\"order\"><object><string name=\"field\">FN</string><boolean name=\"ignoreCase\">true</boolean></object></array></object></object><object><string name=\"func\">user:getSignatures</string></object><object><string name=\"func\">pab:getAllGroups</string></object></array></object>";
                curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
                
                */
                curl_setopt($ch, CURLOPT_POST, 1);
                  
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
                $contents = curl_exec($ch);
                curl_close($ch);
                //die($contents);
                //get mail list from the page information username && emailaddress
                /* 对于返回xml数据时的处理
                preg_match_all("/<string\s*name=\"EMAILREF\">(.*)<\/string>/Umsi",$contents,$mails);
                preg_match_all("/<string\s*name=\"FN\">(.*)<\/string>/Umsi",$contents,$names);
                $users = array();
                foreach($names[1] as $k=>$user)
                {
                    //$user = iconv($user,'utf-8','gb2312');
                    $users[$mails[1][$k]] = $user;
                }
                if (!$users)
                {
                    return '您的邮箱中尚未有联系人';
                }  
                */ 
                $contents = substr($contents, strlen('while (true); &&&START&&&'),  -strlen('&&&END&&& ')); 
                return $contents;
        }
}