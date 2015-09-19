<?php
class HomeAction extends IniAction{
	public function __construct(){
		parent::__construct();
		$this->isLogin();
		$order_num = M('order')->where("buy_id={$this->my['uid']}")->count();
		$evaluate_num = M('evaluate')->where("uid={$this->my['uid']}")->count();
		$this->a('$order_num',$order_num);
		$this->a('$evaluate_num',$evaluate_num);
	}

	public function order(){
		$tpl = '';
		$op = isset($_GET['op'])?$_GET['op']:99;
		if($op=='vieworder'){
			$tpl = $op;
			$order_id = intval($this->gp['order_id']);
			$order = OrderModel::I()->getMyOrder($this->my['uid'],null, $order_id);
			$this->a('$order',$order['data'][0]);
		}else{
			$op = $state= intval($op);
			$myOrder = OrderModel::I()->getMyOrder($this->my['uid'], $state);
	        $this->assign('myOrder', $myOrder['data']);
	        $this->assign('page', $myOrder['page']);
	        $this->assign('op', $op);
		}               
        $this->display($tpl);
	}
	
	public function finishOrder(){
            $order_id = gg('order_id:i');
            $where = "state=3 and order_id={$order_id} and buy_id={$this->my['uid']}";
            $pay_price = M("order")->where($where)->getField("pay_price");
            if(M('order')->where($where)->save(array('state'=>'4'))){
                $jifen = ceil($this->setting['jifen_order']*$pay_price);
                MemberModel::I()->addJifen($this->my['uid'],$jifen);
                MemberModel::I()->addjfLog($this->my['uid'],$this->my['uname'],$order_id,0-$jifen,'3',"完成订单送积分");
                $this->mySuccess('msg_common_update_success');
            }
            $this->mySuccess('error_common_error');
	}
	
	public function cancelOrder(){
            $order_id = gg('order_id:i');
            $where = "(state in (1,2,6)) and order_id={$order_id} and buy_id={$this->my['uid']}";
            if(M('order')->where($where)->save(array('state'=>'5'))){
                $p = getPre();
                $order = M()->table("{$p}order o")
                ->join("{$p}store s on o.store_id=s.sid")
                ->where("o.order_id={$order_id}")
                ->field('o.order_sn,s.mobile,o.buy_name')
                ->find();
                sms($order['mobile'],"买家[{$order['buy_name']}]已取消还没配送订单号为:{$order['order_sn']}的订单。",$this->setting);
                $jifen = M("jf_log")->where("order_id={$order_id}")->find();
                if($jifen){
                    $uid['uid'] = $jifen['uid'];
                    M("member")->where($uid)->setInc("jifen",$jifen['jf_goods_jf']);
                    $jifen['jf_goods_jf'] = 0-$jifen['jf_goods_jf'];
                    unset($jifen['jf_log_id']);
                    $jifen['beizhu'] = "退款返还积分";
                    $jifen['ctime'] = TIME;
                    M("jf_log")->add($jifen);
                }//取消订单返还积分
                $this->mySuccess('msg_common_update_success');
            }

            $this->myError('error_common_error');
	}
	
	public function address(){
		$tpl = '';
		$op = $this->gp['op'];
		if($op=='update') {
			$tpl = $op;
			$id = intval($_GET['id']);
			$address = M('address')->where("id='{$id}'")->find();
			$this->assign('address',$address);
		}else if($op=='setdefault'){
			$id = intval($_GET['id']);
			if(empty($id)){
				$this->error(L('error_common_param_error'));exit;
			}
			M('address')->where("`default`=1 and uid='{$this->my['uid']}'")->save(array('default'=>0));
			M('address')->where("id='{$id}' and uid='{$this->my['uid']}'")->save(array('default'=>1));
			$this->success(L('msg_common_update_success'));
			exit;
		}else if($op=='doupdate'){
			$id = intval($_POST['id']);
			
			$_POST['address'] 	= I('post.address','');
			$_POST['mobile'] 	= I('post.mobile','','number_float');
			M('address')->where("id='{$id}' and uid='{$this->my['uid']}'")->save($_POST);
			$this->mySuccess('msg_update_address_success',U('home/address'));
		}else{
			$myAddress = M('address')->where("uid='{$this->my['uid']}'")->select();
			$this->assign('myAddress',$myAddress);
		}
		$this->display($tpl);
	}
	
	public function password(){
		$op = $this->gp['op'];
		if($op=='dopassword'){
			$_POST['cur_pwd'] = I('post.cur_pwd');
			$_POST['new_pwd'] = I('post.new_pwd');
			$my = M('member')->where("uid='{$this->my['uid']}' and password='".md5($_POST['cur_pwd'])."'")->find();
			if(empty($my)){
				$this->myError('error_member_password_2');
			}
			
			if($_POST['new_pwd']!=$_POST['comfirm_pwd']){
				$this->myError('error_member_password_5');
			}
			
			M('member')->where("uid='{$this->my['uid']}'")->save(array('password'=>md5($_POST['new_pwd'])));
			$this->mySuccess('msg_common_update_success');
		}
		
		$this->d();
	}
	
	public function evaluate(){
		$tpl = '';
    	$op = $this->gp['op'];
    	if($op=='evaluateupdate'){
    		$tpl = $op;
    		$eid = intval($this->gp['eid']);
    		$evaluate = M('evaluate')->where("uid='{$this->my['uid']}' and eid='{$eid}'")->find();
    		$this->a('$evaluate',$evaluate);
    	}else if($op=='doevaluateupdate'){
    		$p = $_POST;
    		$eid = intval($this->gp['eid']);
    		$p['score']		= ceil(($p['kouwei']+$p['service']+$p['speed'])/3);
    		$p['content'] = I('post.content','','strip_tags');
    		M('evaluate')->where("uid='{$this->my['uid']}' and eid={$eid}")->save($p);
    		$evaluate = M('evaluate')->where("uid='{$this->my['uid']}' and eid={$eid}")->find();
    		$avg = M('evaluate')->field("AVG( kouwei ) k, AVG( service ) s, AVG( speed ) sp")->where("store_id={$evaluate['store_id']}")->find();
			foreach($avg as $key=>$val){
				$avg[$key] = floor($val);
			}
		
			M('store')->where("sid={$evaluate['store_id']}")->save(array('star_kouwei'=>$avg['k'],'star_service'=>$avg['s'],'star_speed'=>$avg['sp']));
    		$this->mySuccess('msg_common_update_success',U('home/evaluate'));
    	}else{
    		$page = $this->iniPage(M('evaluate')->where("uid='{$this->my['uid']}'")->count());
    		$evaluateList = M('evaluate')->where("uid='{$this->my['uid']}'")->limit("{$page->firstRow},{$page->listRows}")->select();
    		$this->assign('evaluateList',$evaluateList);
    		$this->assign('page',$page->show());
    	}
		$this->d($tpl);
	}
	
	public function cuidan(){
		$order_id = $this->gp['order_id'];
		import('ORG.Util.Cookie');
		if(Cookie::get("cd_{$order_id}"))
			$this->myError('催单频繁，请稍后再试');
		
		$order = OrderModel::I()->getOrderById($order_id);
		$store = StoreModel::I()->getStoreBySid($order['store_id']);
		if(mobile_sms($store['mobile'],"订单号为{$order['order_sn']}的订单请尽快配送，买家催单", $this->setting)){
			/*
			if($store['sms_num']>0){
				M('setting')->where("setting_key='site_sms_num'")->setDec('setting_key');
			}
			*/
		}else{
			$this->myError('催单失败');
		}
		$this->setting['cuidan'] = $this->setting['cuidan']?intval($this->setting['cuidan']):5;
		Cookie::set("cd_{$order_id}",1,60*$this->setting['cuidan']);
		$this->mySuccess('催单成功');
	}

	public function go_pay(){
		$order_id = intval($_GET['order_id']);
		if(!$order_id) $this->myError("error_illegal_op");
		$where['order_id'] = $order_id;
		$where['state'] = 6;
		$where['buy_id'] = $this->my['uid'];
		$result = M("order")->field("pay_price,store_name,payment_id")->where($where)->find();
		$order['order_sn'] = $order_id;
		$order['order_id'] = $result['store_name'];
		$order['order_price'] = $result['pay_price'];
		if($result['payment_id']==2){
                    $this->payType1($order);
                }else if($result['payment_id']==3){
                    $this->wxPay($order);
                }
	}

	private function payType2($order){
		require_once(ROOT."api/payment/alipay_double/alipay.config.php");
		require_once(ROOT."api/payment/alipay_double/lib/alipay_submit.class.php");
		
		$payment_type = '1';
		$quantity = "1";
	        //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
	        //物流费用
	        $logistics_fee = "0.00";
	        //必填，即运费
	        //物流类型
	        $logistics_type = "EXPRESS";
	        //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
	        //物流支付方式
	        $logistics_payment = "SELLER_PAY";
	        //$order['order_price'] = 0.01;
	        $pre = getPre();
	        
	        
		$service = array('2'=>'create_partner_trade_by_buyer','3'=>'trade_create_by_buyer');
		$parameter = array(
				"service" => $service[$this->setting['alipay_on']],
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> SITE_URL.'web_notify.php',
				"return_url"	=> SITE_URL.'web_callback.php',
				"seller_email"	=> $alipay_config['alipay_account'],
				"out_trade_no"	=> $order['order_sn'],
				"subject"		=> $order['order_id'],
				"price"			=> $order['order_price'],
				"quantity"	=> $quantity,
				"logistics_fee"	=> $logistics_fee,
				"logistics_type"	=> $logistics_type,
				"logistics_payment"	=> $logistics_payment,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"receive_name"	=> $receive_name,
				"receive_address"	=> $receive_address,
				"receive_zip"	=> $receive_zip,
				"receive_phone"	=> $receive_phone,
				"receive_mobile"	=> $receive_mobile,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);					
		$url = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        
		@header("Location:{$url}");
		exit;  
    }
    private function payType1($order){
    	$inc_file = ROOT . '/api/payment/alipay/alipay.php';
                if (!file_exists($inc_file))
                    $this->myError('error_common_param_error');
                require_once ($inc_file);
                $payment_api = new alipay($this->getPaymentInfo(1), $order);
                @header("Location:" . $payment_api->get_payurl());
                exit;
    }

    public function alipay(){
    	$success		= 'success';
		$fail			= 'fail';
		$out_trade_no 	= ggp('out_trade_no');
    	$trade_status 	= ggp('trade_status');
    	$trade_status_array = array('WAIT_SELLER_SEND_GOODS','TRADE_FINISHED','TRADE_SUCCESS');
    	if(ggp('op')=='callback'){
    		if(in_array($trade_status, $trade_status_array)){
    			$order = M('order')->where("order_id='{$out_trade_no}' or order_sn='{$out_trade_no}'")->find();
                $this->mySuccess('msg_common_add_success',
                $this->my['uid']?"index.php?m=home&a=order":"index.php?m=order&vieworder&order_id={$order['order_id']}");
			}
    		$this->myError('error_common_error',U('home/order'));
    	}else if(ggp('op') == 'notify'){
			if($trade_status=='WAIT_BUYER_PAY'){
    			exit($success);
    		}else if(in_array($trade_status, $trade_status_array)){
    			if(count(explode(',',$out_trade_no))>1){
    				$wheresql = "order_id in({$out_trade_no})";
    			}else{
    				$wheresql = "(order_sn='{$out_trade_no}' or order_id='{$out_trade_no}')";
    			}
                $wheresql .= " and state=6";
    			M('order')->where($wheresql)->save(array('state'=>'2'));
                $order = M('order')->where($wheresql)->select();
    			Vendor('notification.android.AndroidUnicast');
    			foreach($order as $key=>$val){
    				$msg = "您有新的订单!订单号为：{$val['order_sn']}";
    				$store = M("store")->where("sid={$val['store_id']}")->find();
    				mobile_sms($store['mobile'],$msg,$this->setting);
    				if($store['device_token']){
	    				$unicast = new AndroidUnicast($msg,$msg,$msg,$store['device_token'],1,"{order_id:{$val['order_id']}}");
						$unicast->send();
    				}
    			}
                exit($success);
    		}else if($trade_status=='WAIT_BUYER_CONFIRM_GOODS') {
    			//卖家已经发货等待买家确认收货	
    			exit($success);
    		}
			exit($fail);
    	}
    }

    private function getPaymentInfo($type=1){
		if($type==1){
			return array(
	            	'site'=>SITE_URL,
	            	'partner'=>$this->setting['alipay_partner'],
	            	'account'=>$this->setting['alipay_account'],
	            	'key'=>$this->setting['alipay_key'],);
		}else if($type==2){
	    	return array(
        	'site'=>SITE_URL,
        	'partner'=>$this->setting['alipay_partner'],
        	'account'=>$this->setting['alipay_account'],
        	'key'=>$this->setting['alipay_key'],);
		}
    }
    
    public function wxPay(){
        $order_id = ggp('order_id:i');
        vendor('WxPayPubHelper.WxPay','','.pub.config.php');
        WxPayConf_pub::$SSLCERT_PATH .= $_SERVER['SERVER_NAME'].'_cert.pem';
        WxPayConf_pub::$SSLKEY_PATH .= $_SERVER['SERVER_NAME'].'_key.pem';
        WxPayConf_pub::$APPID = $this->setting['wx_appid'];
        WxPayConf_pub::$MCHID = $this->setting['wx_mchid'];
        WxPayConf_pub::$KEY = $this->setting['wx_key'];
        WxPayConf_pub::$APPSECRET = $this->setting['wx_appsecret'];
        vendor('WxPayPubHelper.WxPayPubHelper');
        $where = "order_id='{$order_id}' and state=6";
        $order = M('order')->where($where)->find();
        if(empty($order)) exit('没有找到订单');
        
        $unifiedOrder = new UnifiedOrder_pub();
        $unifiedOrder->setParameter("body",$order['store_name']);//商品描述
        $unifiedOrder->setParameter("out_trade_no",$order['order_sn']);//商户订单号 
        $unifiedOrder->setParameter("total_fee",$order['pay_price']*100);//总金额
        $notify = "http://{$_SERVER['SERVER_NAME']}/wx_notify.php";
        $unifiedOrder->setParameter("notify_url",$notify);//通知地址
        $unifiedOrder->setParameter("trade_type","NATIVE");//交易类型
        $unifiedOrderResult = $unifiedOrder->getResult();

        //商户根据实际情况设置相应的处理流程
        if ($unifiedOrderResult["return_code"] == "FAIL") {
            //商户自行增加处理流程
            echo "通信出错：" . $unifiedOrderResult['return_msg'] . "<br>";
        } elseif ($unifiedOrderResult["result_code"] == "FAIL") {
            //商户自行增加处理流程
            echo "错误代码：" . $unifiedOrderResult['err_code'] . "<br>";
            echo "错误代码描述：" . $unifiedOrderResult['err_code_des'] . "<br>";
        } elseif ($unifiedOrderResult["code_url"] != NULL) {
            //从统一支付接口获取到code_url
            $codeUrl = $unifiedOrderResult["code_url"];
        }
        $this->a('codeUrl',$codeUrl);
        $this->a('order_id',$order_id);
        $this->d("Order:wxpay");
    }
}