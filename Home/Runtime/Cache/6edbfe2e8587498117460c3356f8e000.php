<?php if (!defined('THINK_PATH')) exit(); if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                <div class="list-good buy">
                    <div class="good-pic">
                        <a target="_blank" class="pic-img" href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>">
                            <img class="lazy good-pic" src="<?php echo ($vo["pic_url"]); ?>" alt="<?php echo ($vo["title"]); ?>" style="display: inline;">
                        </a>
                    </div>
                    <h3 class="good-title">
                        <a target="_blank" href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>"><?php echo ($vo["title"]); ?></a>
                        <div style="display:none;" class="icon-all">
                        </div>
                    </h3>
                    <div class="good-price">
                        <span class="price-current">
                            <em>￥</em>
                            <?php if($vo['discount_price']>0){echo bcmul($vo['discount_price'], 1, 2);}else{echo bcmul($vo['price'], 1, 2);} ?>
                        </span>
                        <span class="des-other">
                            <span class="price-old">
                                <em>￥</em>
                                <?php echo bcmul($vo['price'], 1, 2); ?>
                            </span>
                            <span class="discount">(
                                <em>
                                    <?php echo sprintf( "%.2f",$vo['discount_price']/$vo['price'])*10; ?>
                                </em>折)
                            </span>
                        </span>
                        <div class="btn buy m-buy">
                            <a rel="nofollow" target="_blank" href="<?php echo U('goods/detail',array('id'=>$vo['goods_id']));?>">
                                <?php if(($vo["goods_type"]) == "tmall"): ?><em class="m-icon"></em>
                                    <span>天猫</span><?php endif; ?>
                                <?php if(($vo["goods_type"]) == "taobao"): ?><em class="t-icon"></em>
                                    <span>淘宝</span><?php endif; ?>
                                <?php if(($vo["goods_type"]) == "qugoumai"): ?><span>去购买</span><?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <!-- like -->
                    <a href="javascript:;" data-title="<?php echo ($vo["title"]); ?>" onclick="favor(<?php echo ($vo['goods_id']); ?>)" data-key="" title="加入收藏" class="y-like my-like active">
                        <i class="like-ico l-active"><span class="heart_left"></span><span class="heart_right"></span></i>
                    </a>
                    <!-- end like -->
                    <div style="display:block" class="box-hd">
                    </div>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
            <script>
            page = <?php echo ($page); ?>;
			$(".goods-list li").hover(
			function(){
			   //当鼠标放上去的时候,程序处理
			   $(this).addClass("hover1 hover");
			},
			function(){
			   //当鼠标离开的时候,程序处理
			   $(this).removeClass("hover1 hover");
			});
            </script>