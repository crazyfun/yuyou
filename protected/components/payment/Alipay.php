<?php
/**
 * 类
 */
class Alipay
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function Alipay()
    {
    }

    function __construct()
    {
        $this->Alipay();
    }

    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
        $charset = 'utf-8';
        $real_method = $payment['alipay_pay_method'];
        switch ($real_method){
            case '0':
                $service = 'trade_create_by_buyer';
                break;
            case '1':
                $service = 'create_partner_trade_by_buyer';
                break;
            case '2':
                $service = 'create_direct_pay_by_user';
                break;
        }
        $extend_param = 'isv^sh22';
        $parameter = array(
            'extend_param'      => $extend_param,
            'service'           => $service,
            'partner'           => $payment['alipay_partner'],
            //'partner'           => ALIPAY_ID,
            '_input_charset'    => $charset,
            'notify_url'        => $order['notify_url'],
            'return_url'        => $order['return_url'],
            /* 业务参数 */
            'subject'           => $order['subject'],
            'out_trade_no'      => $order['order_sn'],
            'price'             => $order['order_amount'],
            'quantity'          => 1,
            'payment_type'      => 1,
            /* 物流参数 */
            'logistics_type'    => 'EXPRESS',
            'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',
            /* 买卖双方信息 */
            'seller_email'      => $payment['alipay_account']
        );
        ksort($parameter);
        reset($parameter);
        $param = '';
        $sign  = '';
        foreach ($parameter AS $key => $val)
        {
            $param .= "$key=" .urlencode($val). "&";
            $sign  .= "$key=$val&";
        }
        $param = substr($param, 0, -1);
        $sign  = substr($sign, 0, -1). $payment['alipay_key'];
        //$sign  = substr($sign, 0, -1). ALIPAY_AUTH;
        $controller_id=Yii::app()->controller->getId();
        $button = '<div style="text-align:center"><input class="btn_submit" type="button" onclick="show_pay_tip(\''.$controller_id.'\');window.open(\'https://www.alipay.com/cooperate/gateway.do?'.$param. '&sign='.md5($sign).'&sign_type=MD5\')" value="在线支付" /></div>';
        return $button;
    }

    /**
     * 响应操作
     */
    function respond()
    {
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
        $payment  = Util::get_payment($_GET['code']);
        $seller_email = rawurldecode($_GET['seller_email']);
        $order_sn =  $_GET['out_trade_no'];
        $order_sn = trim($order_sn);
        $pays=Pays::model();
        /* 检查支付的金额是否相符 */
        if (!$pays->check_money($order_sn,$_GET['total_fee']))
        {
        	  
            return false;
        }
        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);
        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }
        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }
        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_SUCCESS')
        {
           $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        else
        {
            return false;
        }
    }
    
     /**
     * 响应操作
     */
    function travelrespond()
    {
    	  
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
        $order_sn =  $_GET['out_trade_no'];
        $order_sn = trim($order_sn);
        $travel_pays=TravelPays::model();
        $travel_pays_data=$travel_pays->findByPk($order_sn);
        $travel_order=TravelOrder::model();
        $travel_order_data=$travel_order->findByPk($travel_pays_data->order_id);
        
        $payment  = Util::get_payment($_GET['code'],$travel_order_data->company_id);
        $seller_email = rawurldecode($_GET['seller_email']);
        $pays=TravelPays::model();
        /* 检查支付的金额是否相符 */
        if (!$pays->check_money($order_sn,$_GET['total_fee']))
        {
        	  
            return false;
        }
        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);
        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }
        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }
        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_SUCCESS')
        {
           $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
      /**
     * 响应操作
     */
    function grouprespond()
    {
    	  
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
        $order_sn =  $_GET['out_trade_no'];
        $order_sn = trim($order_sn);
        $travel_pays=GroupPays::model();
        $travel_pays_data=$travel_pays->findByPk($order_sn);
        $travel_order=GroupOrder::model();
        $travel_order_data=$travel_order->findByPk($travel_pays_data->order_id);
        
        $payment  = Util::get_payment($_GET['code'],'0');
        $seller_email = rawurldecode($_GET['seller_email']);
        $pays=GroupPays::model();
        /* 检查支付的金额是否相符 */
        if (!$pays->check_money($order_sn,$_GET['total_fee']))
        {
        	  
            return false;
        }
        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);
        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }
        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }
        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_SUCCESS')
        {
           $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    
     function hotelsrespond()
    {
    	  
        if (!empty($_POST))
        {
            foreach($_POST as $key => $data)
            {
                $_GET[$key] = $data;
            }
        }
        $order_sn =  $_GET['out_trade_no'];
        $order_sn = trim($order_sn);
        $travel_pays=HotelsPays::model();
        $travel_pays_data=$travel_pays->findByPk($order_sn);
        $travel_order=HotelsOrder::model();
        $travel_order_data=$travel_order->with("Hotels")->findByPk($travel_pays_data->order_id);
        
        $payment  = Util::get_payment($_GET['code'],$travel_order_data->Hotels->company_id);
        $seller_email = rawurldecode($_GET['seller_email']);
        $pays=HotelsPays::model();
        /* 检查支付的金额是否相符 */
        if (!$pays->check_money($order_sn,$_GET['total_fee']))
        {
        	  
            return false;
        }
        /* 检查数字签名是否正确 */
        ksort($_GET);
        reset($_GET);
        $sign = '';
        foreach ($_GET AS $key=>$val)
        {
            if ($key != 'sign' && $key != 'sign_type' && $key != 'code')
            {
                $sign .= "$key=$val&";
            }
        }
        $sign = substr($sign, 0, -1) . $payment['alipay_key'];
        if (md5($sign) != $_GET['sign'])
        {
            return false;
        }
        if ($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_FINISHED')
        {
            $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        elseif ($_GET['trade_status'] == 'TRADE_SUCCESS')
        {
           $pays->change_order_status($order_sn,$_GET['trade_no']);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    
    
    
}

?>