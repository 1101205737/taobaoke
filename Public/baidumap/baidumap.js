function $(id) { return document.getElementById(id); }	
var souceKey = 0;   //决定是否开启源代码，0为关闭，1为开启。
var isInt = 0;      //判断源码是否已经获取过，如果获取过，则直接显示当前页面源码，否则从服务器获取
var isTab = 1;
/** 获取浏览器高度和宽度 **/
var myWidth = 0, myHeight = 0, isOpen = 0, heightRecord = 350,
editor = null;//高亮代码编辑器
if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
} 
else if(document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight)){
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;  
}

window.onresize = function () 
{ 
    if( typeof( window.innerWidth ) == 'number' ) {
        //Non-IE
        myWidth = window.innerWidth;
        myHeight = window.innerHeight;
    } 
    else if(document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight)){
        //IE 6+ in 'standards compliant mode'
        myWidth = document.documentElement.clientWidth;
        myHeight = document.documentElement.clientHeight;  
    }
    mapheight();
} 

/** 显示还是隐藏 **/
function Contextdisplay(whichID){
	$(whichID).style.display=($(whichID).style.display!= 'block'? 'block' : 'none');
}
/** 隐藏 **/
function displayHidden(whichID){
	$(whichID).style.display= 'none';
}
/** 显示 **/
function displayBlock(whichID){
	$(whichID).style.display= 'block';
}

/**设置显示源码的拖拽效果**/
function dragfooter(){
	document.onmousemove = function(e) {
		e = e||window.event;   
		bottomY= myHeight - e.clientY;
		if($("overiframe").style.display!="block"){
		    $("overiframe").style.display="block";
        }
        if(isOpen ==0){
            isOpen=1;
        }
		if(bottomY >=38){
    		$("footer").style.height=bottomY+"px";
    		$("myresource").style.height=(bottomY*0.8)+"px";
            heightRecord= e.clientY-41;
    		if(heightRecord<0){
    			heightRecord=0
    		}
    		$("container").style.height =heightRecord + "px";
    		$("overiframe").style.height=heightRecord + "px";
		}
    };
	document.onmouseup=function(){
  		document.onmousemove=null;
        jQuery("#overiframe").hide();	
   };
}


//开关代码编辑器

function toggleFooter () {
    var footer = jQuery('#footer');
    var toggleImg = jQuery('#toggle-img');
    if(isOpen == 1){//如果已经打，则关闭
        $("container").style.height = myHeight - 80 + "px";
        footer.animate({ 
             height: 36
        }, 500);
        toggleImg.attr({"src":"jsdemo/img/up.gif"});
        isOpen = 0;
    }else{
        
        footer.animate({ 
             height: 350
        }, 500 ,function(){
             $("container").style.height = myHeight - 350 + "px";
        });
        toggleImg.attr({"src":"jsdemo/img/down.gif"});
        isOpen = 1;
    }
}


/**将用户修改过的代码加载到iframe中**/
function run(){

	var iframeContent=$("myresource").value;
	if(editor){
        iframeContent=editor.getValue();
    }
    var nr=iframeContent.indexOf("<body>");
	var iframeHead=iframeContent.slice(0,nr);
	iframeHead = iframeHead.replace('您的密钥', 'E4805d16520de693a3fe707cdc962045');
	var iframeFooter=iframeContent.slice(nr,iframeContent.length);
	var iFrame=$("container").contentWindow;
	
	iFrame.document.write(iframeHead);
	setTimeout(function(){
		iFrame.document.write(iframeFooter);
		iFrame.document.close();		
    },200);

}
/** 设置地图容器高度 **/
function mapheight(){
    $("container").style.height = myHeight - 76 + "px";
}

function getresourceTab(){ 
    isTab = 1;
    setTimeout(getresource,800)
}
function getresource(){
    init();
    function createXmlHttpRequest(){
        try {
            return new XMLHttpRequest();
        }
        catch(e){
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    var mylink = frames['container'].document.URL;
    var xmlHttp = createXmlHttpRequest();
    xmlHttp.open("get",mylink,false);
    xmlHttp.send();
    if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
        str = xmlHttp.responseText;//str即为返回的html内容
		str = str.replace('E4805d16520de693a3fe707cdc962045', '您的密钥');
		str = str.replace('63ebcdc7ae2791e5c03acda6aca6de52', '您的密钥');
        $("myresource").value = str;
        
        initEditor();
        //editor.setOption("fullScreen", !editor.getOption("fullScreen"));
		
        isInt = 1;
		isTab = 0;
    }	
}
function initEditor(){
    if(!editor){
        editor = CodeMirror.fromTextArea(document.getElementById("myresource"), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            mode:"htmlmixed",
            viewportMargin: Infinity
        });
    }else{
        editor.setValue($("myresource").value);
    }
}


/** 关闭示例说明 **/
function introClose(){
    displayHidden("introduction");
}
/** 打开示例说明 **/
function openIntro(){
    displayBlock("introduction");
}

/** 设置示例说明 **/
var description = {

    a1_1 : "展示一张无控件的简单百度地图",
    a1_2 : "展示一张加载所有控件的百度官网效果的地图",
    a1_3 : "展示北京市三维地图。目前支持北京、上海、广州、深圳4个城市3D图，未来将增加25个城市",
    a1_4 : "展示北京市卫星图",
    a2_1 : "展示上海市地图",
    a2_2 : "初始化时，通过设置中心点坐标为（116.4035,39.915），缩放级别15，展示北京市地图，2秒后，可以看到通过设置城市名为广州，缩放级别10，展示广州市地图。",
    a2_3 : "设置地图允许缩放的范围是4至8级，滚动鼠标体验效果",
    a3_1 : "初始化地图，中心点为（116.4035,39.915），缩放级别为8的北京市地图，2秒后，通过改变中心点坐标，地图平移到广州",
    a3_2 : "初始化展示中心点为（116.4035,39.915），缩放级别为8的北京市地图，2秒后，通过设置缩放级别将地图放大到14级",
    a3_3 : "禁止地图拖拽。三秒后开启地图拖拽。",
    a4_1 : "当前地图中心点坐标为（116.4035,39.915）",
    a4_2 : "当前地图缩放级别为14",
    a4_3 : "当前地图可视范围是：（116.314676,39.886937）至（116.492324,39.943052）",
    a5_1 : "谷歌坐标（116.32715863448607，39.90923）转换为百度坐标后，以标注的形式展示在地图上",
    a5_2 : "真实GPS坐标（116.397428,39.90923）转换为百度坐标后，以标注的形式展示在地图上",
    a5_3 : "谷歌坐标转换为百度坐标，以标注的形式展示在地图上。该接口一次性支持转换20个坐标",
    a6_1 : "通过两点坐标获取两点距离，并构成折线展示在地图上",
    a6_2 : "根据在输入框输入的关键字，动态提示对应的所有词条供用户选择",
    a6_3 : "鼠标点击地图图区位置，右侧显示点击处经纬度坐标",

    b0_1 : "在地图的左上、右上、左下、右下位置分别展示完整、缩略、简单、迷你四种样式的缩放平移控件",
    b0_2 : "在地图的左上、右上、左下、右下位置分别展示比例尺控件",
    b0_3 : "点击地图类型控件切换普通地图、卫星图、三维图、混合图（卫星图+路网）",
    b0_4 : "在地图左下角添加版权控件。当地图所占的屏幕像素小于220时，版权控件变成简约状。",
    b0_5 : "在地图右下角和左上角各添加一个缩略地图控件。",
    b0_6 : "在地图左上角添加”放大2级“自定义控件，点击放大地图2级",

    c1_1 : "在北京市地图上添加一个点与一个自定义图标的点",
    c1_2 : "在北京市，天安门位置上添加一个动态弹跳的点",
    c1_3 : "在北京市地图上，添加很多标注点",
    c1_4 : "缩放地图，查看点聚合效果",
    c1_5 : "在地图上添加一条由多个点坐标构造的折线，设置折线颜色为蓝色、宽0.6px、透明度0.5",
    c1_6 : "在地图上添加一个由多个坐标点构造的不规则多边形，设置边线颜色为蓝色、线宽0.6px、透明度为0.5，填充区属颜色为白色，透明度为0.5",
    c1_7 : "在地图上添加一个由中心点、半径值构造的圆，圆的颜色为蓝色、线宽0.6px、透明度为1，填充颜色为白色，透明度为0.5",
    c1_8 : "在地图上添加一个由左上角和右下角的坐标构造的矩形，矩形的边线颜色为蓝色，线宽0.6px,透明度为0.5，填充颜色为白色，透明度为0.5",
    c1_9 : "在北京市地图的天安门和王府井地铁位置上分别添加热区，鼠标滑动到两位置时，分别出现“我爱北京天安门!”和“王府井地铁”文字标签。",
    c1_10 : "添加重庆市的行政区域边界",
    c1_11 : "图示中为房产覆盖物，鼠标移到覆盖物上，自动显示房屋套数",
    c1_12 : "用用户自己的数据在百度地图上显示，数据可以直接存储在页面中，然后用JS实现搜索及显示;信息窗口打开查找到的第一条数据。此样例带酒店和图书馆各10条数据。精准查找，如：【贵国酒店】,模糊查找,如【酒店】或【图书馆】",
    c1_13 : "在地图上添加一个的弧形，同画折线一样，可设置样式，可拖拽起终点。",
	c1_14 : "在北京市，王府井位置上添加一个文本标注",
    c1_15 : "使用<a href='library.htm'>JS开源库_热力图</a>功能,显示热力图效果,示例为王府井的客流量热力分布图",
    c2_1 : "点击”显示“或“隐藏”，观察效果",
    c2_2 : "点击“可拖拽”或“不可拖拽”，观察效果",
    c2_3 : "标注带文字标签",
    c2_4 : "获取标注点的位置信息",
    c2_5 : "单个标注点沿直线的轨迹运动",
    c2_6 : "多个标注点沿直线的轨迹运动",
    c2_7 : "线的编辑功能",

    d0_1 : "点击标注点，可查看由纯文本构成的简单型信息窗口",
    d0_2 : "点击标注点，可查看由文本，图片构成的复杂型信息窗口",
    d0_3 : "获取信息窗口内容，显示在右侧栏",
    d0_4 : "JSV1.5版本提供“百度地图样式”的信息窗口，且窗口内容可自由定制多种风格。该功能已制成开源库，具体查看<a href='library.htm' target='_blank'>JavaScript开源库。</a>",

    e0_1 : "在地图图区范围内，点击鼠标右键，可查看简单右键菜单效果",
    e0_2 : "在地图图区范围内，点击鼠标右键，可查看带分割线的右键菜单",
    e0_3 : "在地图图区范围内，点击鼠标右键，可查看带标注功能的右键菜单，选中添加标注，可在地图上添加标注点",

    f0_1 : "将鼠标放在图区，查看鼠标的样式效果",
    f0_2 : "将鼠标放在图区，用鼠标拖拽地图，查看鼠标的样式",
    f0_3 : "将鼠标放在图区，点击鼠标左键，获取点击处的经纬度",
    f0_4 : "将鼠标放在图区，滚动鼠标滚轮，查看地图缩放效果",
    f0_5 : "将鼠标放在图区，按照对角拉框，查看地图放大效果",
    f0_6 : "将鼠标放在图区，单击鼠标开始选择测距的点，双击鼠标结束测距",
    f0_7 : "提供鼠标绘制点、线、面、多边形（圆、矩形）的编辑工具条。该功能的代码全部开源，具体查看<br/><a href='http://developer.baidu.com/map/library.htm'>JavaScript开源库</a>。                    覆盖物的属性、编辑等功能请参考JavaScirpt API各覆盖物所提供的接口函数。",

    g0_1 : "在百度地图底图上叠加魔兽游戏地图",
    g0_2 : "在百度地图底图上叠加清华校园微观图",
    g0_3 : "叠加上海市行政区划图",
    g0_4 : "首先将小猪短租的房源数据存入LBS云，然后以麻点形式进行地图展示。",

    h0_1 : "添加地图的监听函数，点击地图，获得监听结果",
    h0_2 : "添加图块加载完毕事件，地图底图加载完毕，弹出加载完毕提示",
    h0_3 : "添加拖拽地图监听事件，拖拽地图后显示地图中心点经纬度",
    h0_4 : "添加点击地图监听事件，点击地图后显示当前经纬度",
    h0_5 : "为map添加滚轮缩放事件。地图级别改变时，即获得map的地图级别",
    h0_6 : "地图加载完成后,点击地图,当第一次点击时,弹出当前点击点的经纬度,第一次点击以外将无效(事件被移除了)。",

    i1_1 : "返回北京市“景点”关键字的检索结果，并展示在地图上",
    i1_2 : "返回北京市矩形框区域范围内的“银行”关键字的检索结果，并展示在地图上",
    i1_3 : "返回酒店和加油站的复合结果，并展示在地图上",
    i1_4 : "返回本地搜索结果数据集，并展示在右侧面板上",
    i1_5 : "返回本地搜索的结果数据集，并以自定义样式的方式显示在右侧面板上",
    i1_6 : "自动添加本地搜索的结果面板，且提供“详情”查看 <img src='static/img/new.png'/>",
    i2_1 : "返回北京市前门周边的“小吃”检索结果，并展示在地图上",
    i3_1 : "返回当前可视区域范围内的“银行”检索结果，并展示在地图上。拖拽地图后，展示新的检索结果。",
    i3_2 : "返回北京市地图上圆形覆盖范围内的“餐馆”检索结果，并展示在地图上",
    i3_3 : "返回全国范围内“南京路”的检索结果，并以省份的分类方式展示在右侧面板上",
    i3_4 : "请在地图上画圆，将会返回北京市地图上圆形覆盖范围内的用户数据检索结果(本示例是火车票代售点数据)，并展示在地图上。此外也支持本地、bounds检索用户数据。",
    i4_1 : "返回“王府井”到“西单”的公交换乘结果，并绘制在地图上",
    i4_2 : "返回点（116.301934,39.977552）到点（116.508328,39.919141）间公交换乘结果，并绘制在图上",
    i4_3 : "返回较便捷、可换乘、少步行、不乘地铁四种方案的公交换乘。本示例返回不乘地铁方案",
    i4_4 : "返回“331路”公交车的路线结果，并绘制在地图上",
    i4_5 : "多终点选择的公交换乘查询",
    i4_6 : "返回两点间公交换乘的时间和距离值",
    i4_7 : "展示“王府井”到“西单”的公交换乘的面板",
    i4_8 : "返回公交换乘的数据结果集",
    i4_9 : "返回公交换乘的数据结果集，展示在右侧，点击每条数据结果，在地图上绘制相应的线路",

    i5_1 : "返回“中关村”到“魏公村”的驾车导航线路",
    i5_2 : "返回点（116.301934,39.977552）到点（116.508328,39.919141）驾车路线结果，并绘制在地图上",
    i5_3 : "可以检索最小时间、最短距离、避开高速的驾车导航结果，本示例返回最少时间驾车导航检索结果，并绘制在地图上",
    i5_4 : "任意拖拽驾车的起/终点，及线路上的任意一点，驾车导航方案随之变化",
    i5_5 : "返回驾车方案的时间与距离值",
    i5_6 : "显示“安定门”到“王府井”的打车费用",
    i5_7 : "返回“中关村”到“魏公村”的驾车导航的数据结果集，路线和起终点图标需自己添加",
    i5_8 : "展示“中关村”到“魏公村”的驾车导航的结果面板",

    i6_1 : "返回“天坛公园”到“故宫”的步行导航路线，并绘制在地图上",
    i6_2 : "返回“天坛公园”到“故宫”的步行导航路线的数据结果集",
    i7_1 : "解析“北京市海淀区上地10街”地址信息，并以标注点形式展示在地图上",
    i7_2 : "点击地图，返回当前点的结构化地址信息",
    i7_3 : "批量解析地址信息返回百度经纬度，并以标注点形式展示在地图上",
    i7_4 : "批量反地址解析：批量解析百度经纬度（见地图上的标注点位置）获得结构化地址信息",
    i8_1 : "返回浏览器定位的信息值，适用于支持定位的浏览器。",
    i8_2 : "根据示例操作者的IP地址返回当前城市名",

    j1_0 : "在地图上添加全景控件，点击全景控件进入全景图",
    j1_1 : "展示指定坐标点、指定全景id的全景图",
    j1_2 : "全景图层用于展示全景覆盖的城市范围",
    j1_3 : "拖动普通地图的图标全景图视野改变，改变全景图位置普通地图也随之改变",
    j2_0 : "以指定位置为中心通过不断改变heading角度达到旋转效果",
    j3_0 : "获取指定位置点的全景id，路段名称及坐标",
    j4_0 : "注册全景位置点改变及视角改变事件，状态改变后会获取新的状态值",

    k0_1 : "通过设置地图底图样式为‘dark’、隐藏‘poi’自定义地图",
    k0_2 : "自定义底图,可以选择自己喜爱的风格, 查看<a href='http://developer.baidu.com/map/custom/list.htm'>个性模板列表页</a>,<br/>注:暂时只支持html5的浏览器"

}

function setIntro(id){
    var location = window.location.toString();
    if (location.indexOf('#') > 0) {
        location = location.substr(0, location.indexOf('#'));
    }
    window.location = location += '#' + id;
    //var content = id;
    $("intro-content").innerHTML = description[id];
    displayBlock("introduction");
     //高亮当前的链接
    jQuery("#menu a.selected").removeClass("selected");
    jQuery("#menu a[href$='"+id+".htm']").addClass("selected");
}

/** 复制功能 **/
var clip = null;	
var copyTimer = null;	//显示复制成功的定时器
function init() {
    // debugger;
    clip = new ZeroClipboard.Client();
    clip.setHandCursor( true );			
    clip.addEventListener('load', function (client) {
        debugstr("Flash movie loaded and ready.");
    });			
    clip.addEventListener('mouseOver', function (client) {
        // update the text on mouse over
        var iframeContent=$("myresource").value;
        if(editor){
            iframeContent=editor.getValue();
        }
        clip.setText( iframeContent );
    });			
    clip.addEventListener('complete', function (client, text) {
        //displayBlock("copyok");
        jQuery("#copyok").show();
        clearTimeout(copyTimer);
        copyTimer = setTimeout(function(){
            jQuery("#copyok").slideUp();
        },1000);
        debugstr("Copied text to clipboard: " + text );        
    });			
    clip.glue( 'd_clip_button', 'd_clip_container' );
}
setTimeout(function(){
    init();
},2000);


//sub tab
function subTitle1On1(){
    $("subTitle1").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On2(){
    $("subTitle2").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On3(){
    $("subTitle3").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On4(){
    $("subTitle4").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On5(){
    $("subTitle5").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On6(){
    $("subTitle6").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On7(){
    $("subTitle7").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On8(){
    $("subTitle8").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

function subTitle1On9(){
    $("subTitle9").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}
function subTitle1On10(){
    $("subTitle10").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle11").style.background = 'none';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}
function subTitle1On11(){
    $("subTitle11").style.background = '#eaeaea url(jsdemo/img/tab-a.png) no-repeat 0 3px';
    $("subTitle11a").style.background = '#eaeaea url(jsdemo/img/tab-b.png) no-repeat 100% 3px';

    $("subTitle2").style.background = 'none';
    $("subTitle2a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle3").style.background = 'none';
    $("subTitle3a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle4").style.background = 'none';
    $("subTitle4a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle5").style.background = 'none';
    $("subTitle5a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle6").style.background = 'none';
    $("subTitle6a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle7").style.background = 'none';
    $("subTitle7a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle8").style.background = 'none';
    $("subTitle8a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle1").style.background = 'none';
    $("subTitle1a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle9").style.background = 'none';
    $("subTitle9a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
    $("subTitle10").style.background = 'none';
    $("subTitle10a").style.background = '#eaeaea url(jsdemo/img/bg-menuli.gif) no-repeat 100% center';
}

//调转到对应的html
(function(){
    var location = window.location.toString();
    var page;
    var index = location.indexOf('#');
    if (index > 0) {
        page = location.substr(index + 1, location.length - 1);
        if (page in description) {
            $('container').src = 'jsdemo/demo/' + page + '.htm';
          	 mapheight();
            setIntro(page);                }
    }
    setTimeout(getresource,1000)
    $("drag").onmousedown = dragfooter;
})();