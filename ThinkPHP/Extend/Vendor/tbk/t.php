<?php
require("TopSdk.php");
$c = new TopClient;
$c->appkey = '23189880';
$c->secretKey = 'ee9cf899214be7c4eaf8ba4468a77f25';
$req = new TbkItemsGetRequest;
$req->setFields("num_iid");
$req->setKeyword("半身裙");

foreach($_POST as $val){
	
}
/*
//$req->setCid(123);
$req->setStartPrice("1");
$req->setEndPrice("999");
$req->setAutoSend("true");
//$req->setArea("杭州");
$req->setStartCredit("1heart");
$req->setEndCredit("1heart");
$req->setSort("price_desc");
$req->setGuarantee("true");
$req->setStartCommissionRate("1234");
$req->setEndCommissionRate("2345");
$req->setStartCommissionNum("1000");
$req->setEndCommissionNum("10000");
$req->setStartTotalnum("1");
$req->setEndTotalnum("10");
$req->setCashCoupon("true");
$req->setVipCard("true");
$req->setOverseasItem("true");
$req->setSevendaysReturn("true");
$req->setRealDescribe("true");
$req->setOnemonthRepair("true");
$req->setCashOndelivery("true");
$req->setMallItem("true");
$req->setPageNo(1);
$req->setPageSize(40);
$req->setIsMobile("true");
*/
$resp = $c->execute($req);
print_r($resp);