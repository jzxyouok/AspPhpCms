<?PHP
//ASP和PHP通用函数


//文章相关标签 组  待改进
function aritcleRelatedTags($relatedTags){
    $c=''; $splStr=''; $s=''; $url ='';
    $splStr= aspSplit($relatedTags, ',');
    foreach( $splStr as $s){
        if( $s <> '' ){
            if( $c <> '' ){
                $c= $c . ',';
            }
            $url= getColumnUrl($s, 'name');
            $c= $c . '<a href="' . $url . '" rel="category tag" class="ablue">' . $s . '</a>' . vbCrlf();
        }
    }

    $c= '<footer class="articlefooter">' . vbCrlf() . '标签： ' . $c . '</footer>' . vbCrlf();
    $aritcleRelatedTags= $c;
    return @$aritcleRelatedTags;
}


//获得随机文章id列表
function getRandArticleId($addSql, $topNumb){
    $splStr=''; $s=''; $c=''; $nIndex ='';
    $rsObj=$GLOBALS['conn']->query( 'select * from ' . $GLOBALS['db_PREFIX'] . 'articledetail ' . $addSql);
    while( $rs= $GLOBALS['conn']->fetch_array($rsObj)){
        if( $c <> '' ){ $c= $c . ',' ;}
        $c= $c . $rs['id'];
    }
    $getRandArticleId= randomShow($c, ',', 4);
    $splStr= aspSplit($c, ',') ; $c= '' ; $nIndex= 0;
    foreach( $splStr as $s){
        if( $c <> '' ){ $c= $c . ',' ;}
        $c= $c . $s;
        $nIndex= $nIndex + 1;
        if( $nIndex >= $topNumb ){ break; }
    }
    $getRandArticleId= $c;
    return @$getRandArticleId;
}

//上一篇文章 这里面的sortrank(排序)也可以改为id,在引用的时候就要用id
function upArticle($parentid, $lableName, $lableValue){
    $sql ='';
    $sql= 'select * from ' . $GLOBALS['db_PREFIX'] . 'articledetail where parentid=' . $parentid . ' and ' . $lableName . '<' . $lableValue . ' order by ' . $lableName . ' desc';
    $upArticle= handleUpDownArticle('上一篇：', $sql);
    return @$upArticle;
}
//下一篇文章
function downArticle($parentid, $lableName, $lableValue){
    $sql ='';
    $sql= 'select * from ' . $GLOBALS['db_PREFIX'] . 'articledetail where parentid=' . $parentid . ' and ' . $lableName . '>' . $lableValue . ' order by ' . $lableName . ' asc';
    $downArticle= handleUpDownArticle('下一篇：', $sql);
    return @$downArticle;
}
//处理上下页
function handleUpDownArticle($lableTitle, $sql){
    $c=''; $url ='';
    //call echo("sql",sql)
    $rsxObj=$GLOBALS['conn']->query( $sql);
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        if( $GLOBALS['isMakeHtml']== true ){
            $url= getRsUrl($rsx['filename'], $rsx['customaurl'], '/detail/detail' . $rsx['id']);
        }else{
            $url= handleWebUrl('?act=detail&id=' . $rsx['id']);
        }
        $c= '<a href="' . $url . '">' . $lableTitle . $rsx['title'] . '</a>';
    }else{
        $c= $lableTitle . '没有';
    }
    $handleUpDownArticle= $c;
    return @$handleUpDownArticle;
}
//获得RS网址 配置上一页 下一页
function getRsUrl( $fileName, $customAUrl, $defaultFileName){
    $url ='';
    //用默认文件名称
    if( $fileName== '' ){
        $fileName= $defaultFileName;
    }
    //网址
    if( $fileName <> '' ){
        $fileName=strtolower($fileName);		//让文件名称小写20160315
        $url= $fileName;
        if( instr(strtolower($url), '.html')== false && substr($url, - 1) <> '/' ){
            $url= $url . '.html';
        }
    }
    if( AspTrim($customAUrl) <> '' ){
        $url= AspTrim($customAUrl);
    }
    if( instr($GLOBALS['cfg_flags'], '|addwebsite|') > 0 ){
        //url = replaceGlobleVariable(url)   '替换全局变量
        if( instr($url,'$cfg_websiteurl$')==false ){
            $url= urlAddHttpUrl($GLOBALS['cfg_webSiteUrl'], $url);
        }
    }
    $getRsUrl= $url;
    return @$getRsUrl;
}
//获得处理后RS网址
function getHandleRsUrl($fileName, $customAUrl, $defaultFileName){
    $url='';
    $url=getRsUrl($fileName, $customAUrl, $defaultFileName);
    //因为URL如果为自定义的则需要处理下全局变量，这样程序运行又会变慢，不就可以使用生成HTML方法解决这个问题，20160308
    $url= replaceGlobleVariable($url);
    $getHandleRsUrl=$url;
    return @$getHandleRsUrl;
}

//获得单页url 20160114
function getOnePageUrl($title){
    $url ='';
    $rsxObj=$GLOBALS['conn']->query( 'select * from ' . $GLOBALS['db_PREFIX'] . 'onepage where title=\'' . $title . '\'');
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        if( $GLOBALS['isMakeHtml']== true ){
            $url= getRsUrl($rsx['filename'], $rsx['customaurl'], '/page/page' . $rsx['id']);
        }else{
            $url= handleWebUrl('?act=onepage&id=' . $rsx['id']);
            if( $rsx['customaurl'] <> '' ){
                $url= $rsx['customaurl'];
            }
        }
    }

    $getOnePageUrl= $url;
    return @$getOnePageUrl;
}
//获得文章
function getArticleUrl($title){
    $url ='';
    $rsxObj=$GLOBALS['conn']->query( 'select * from ' . $GLOBALS['db_PREFIX'] . 'articledetail where title=\'' . $title . '\'');
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        if( $GLOBALS['isMakeHtml']== true ){
            $url= getRsUrl($rsx['filename'], $rsx['customaurl'], '/detail/' . $rsx['id']);
        }else{
            $url= handleWebUrl('?act=article&id=' . $rsx['id']);
            if( $rsx['customaurl'] <> '' ){
                $url= $rsx['customaurl'];
            }
        }
    }

    $getArticleUrl= $url;
    return @$getArticleUrl;
}
//获得栏目url 20160114
function getColumnUrl($columnNameOrId, $sType){
    $url=''; $addSql ='';

    $columnNameOrId= replaceGlobleVariable($columnNameOrId); //处理动作 <a href="{$GetColumnUrl columnname='[$glb_columnName$]' $}" >更多图片</a>

    if( $sType== 'name' ){
        $addSql= ' where columnname=\'' . $columnNameOrId . '\'';
    }else{
        $addSql= ' where id=' . $columnNameOrId . '';
    }
    $rsxObj=$GLOBALS['conn']->query( 'select * from ' . $GLOBALS['db_PREFIX'] . 'webcolumn' . $addSql);
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        if( $GLOBALS['isMakeHtml']== true ){
            $url= getRsUrl($rsx['filename'], $rsx['customaurl'], '/nav' . $rsx['id']);
        }else{
            $url= handleWebUrl('?act=nav&columnName=' . $rsx['columnname']);
            if( $rsx['customaurl'] <> '' ){
                $url= $rsx['customaurl'];
            }
        }
    }

    $getColumnUrl= $url;
    return @$getColumnUrl;
}

//获得文章标题对应的id
function getArticleId($title){
    $title= Replace($title, '\'', ''); //注意，这个不能留
    $getArticleId= -1;
    $rsxObj=$GLOBALS['conn']->query( 'Select * from ' . $GLOBALS['db_PREFIX'] . 'ArticleDetail where title=\'' . $title . '\'');
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        $getArticleId= $rsx['id'];
    }
    return @$getArticleId;
}

//获得栏目名称对应的id
function getColumnId($columnName){
    $columnName= Replace($columnName, '\'', ''); //注意，这个不能留
    $getColumnId= -1;
    $rsxObj=$GLOBALS['conn']->query( 'Select * from ' . $GLOBALS['db_PREFIX'] . 'webcolumn where columnName=\'' . $columnName . '\'');
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        $getColumnId= $rsx['id'];
    }
    return @$getColumnId;
}


//获得栏目ID对应的名称
function getColumnName($columnID){
    $rsxObj=$GLOBALS['conn']->query( 'Select * from ' . $GLOBALS['db_PREFIX'] . 'webcolumn where id=' . $columnID);
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        $getColumnName= $rsx['columnname'];
    }
    return @$getColumnName;
}




//获得栏目ID对应的类型
function getColumnType($columnID){
    $rsxObj=$GLOBALS['conn']->query( 'Select * from ' . $GLOBALS['db_PREFIX'] . 'webcolumn where id=' . $columnID);
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        $getColumnType= $rsx['columntype'];
    }
    return @$getColumnType;
}

//获得栏目ID对应的内容
function getColumnBodyContent($columnID){
    $rsxObj=$GLOBALS['conn']->query( 'Select * from ' . $GLOBALS['db_PREFIX'] . 'webcolumn where id=' . $columnID);
    $rsx=mysql_fetch_array($rsxObj);
    if( @mysql_num_rows($rsxObj)!=0 ){
        $getColumnBodyContent= $rsx['bodycontent'];
    }
    return @$getColumnBodyContent;
}







//网站统计2014
function webStat($folderPath){
    $dateTime=''; $content=''; $splStr ='';
    $thisUrl=''; $goToUrl=''; $caiShu=''; $c=''; $fileName=''; $co=''; $ie=''; $xp ='';
    $goToUrl= ServerVariables('HTTP_REFERER');
    $thisUrl= 'http://' . ServerVariables('HTTP_HOST') . ServerVariables('SCRIPT_NAME');
    $caiShu= ServerVariables('QUERY_STRING');
    if( $caiShu <> '' ){
        $thisUrl= $thisUrl . '?' . $caiShu;
    }
    $goToUrl= @$_REQUEST['GoToUrl'];
    $thisUrl= @$_REQUEST['ThisUrl'];
    $co= @$_GET['co'];
    $dateTime= Now();
    $content= ServerVariables('HTTP_USER_AGENT');
    $content= Replace($content, 'MSIE', 'Internet Explorer');
    $content= Replace($content, 'NT 5.0', '2000');
    $content= Replace($content, 'NT 5.1', 'XP');
    $content= Replace($content, 'NT 5.2', '2003');

    $splStr= aspSplit($content . ';;;;', ';');
    $ie= $splStr[1];
    $xp= AspTrim($splStr[2]);
    if( substr($XP, - 1)== ')' ){ $XP= mid($XP, 1, strlen($XP) - 1) ;}
    $c= '来访' . $goToUrl . vbCrlf();
    $c= $c . '当前：' . $thisUrl . vbCrlf();
    $c= $c . '时间：' . $dateTime . vbCrlf();
    $c= $c . 'IP:' . getIP() . vbCrlf();
    $c= $c . 'IE:' . getBrType('') . vbCrlf();
    $c= $c . 'Cookies=' . $co . vbCrlf();
    $c= $c . 'XP=' . $xp . vbCrlf();
    $c= $c . 'Screen=' . @$_REQUEST['screen'] . vbCrlf(); //屏幕分辨率
    $c= $c . '用户信息=' . ServerVariables('HTTP_USER_AGENT') . vbCrlf(); //用户信息

    $c= $c . '-------------------------------------------------' . vbCrlf();
    //c=c & "CaiShu=" & CaiShu & vbcrlf
    $fileName= $folderPath . format_Time(Now(), 2) . '.txt';
    createAddFile($fileName, $c);
    $c= $c . vbCrlf() . $fileName;
    $c= Replace($c, vbCrlf(), '\\n');
    $c= Replace($c, '"', '\\"');
    //Response.Write("eval(""var MyWebStat=\""" & C & "\"""")")

    $splxx=''; $nIP=''; $nPV=''; $ipList=''; $s=''; $ip='';
    //判断是否显示回显记录
    if( @$_REQUEST['stype']=='display' ){
        $content= getftext($fileName);
        $splxx= aspSplit($content, vbCrlf() . '-------------------------------------------------' . vbCrlf());
        $nIP= 0;
        $nPV= 0;
        $ipList= '';
        foreach( $splxx as $s){
            if( instr($s, '当前：') > 0 ){
                $s= vbCrlf() . $s . vbCrlf();
                $ip= ADSql(getStrCut($s, vbCrlf() . 'IP:', vbCrlf(), 0));
                $nPV= $nPV + 1;
                if( instr(vbCrlf() . $ipList . vbCrlf(), vbCrlf() . $ip . vbCrlf())== false ){
                    $ipList= $ipList . $ip . vbCrlf();
                    $nIP= $nIP + 1;
                }
            }
        }
        rw('document.write(\'网长统计 | 今日IP['. $nIP .'] | 今日PV['. $nPV .'] \')');
    }
    $webStat= $c;
    return @$webStat;
}

//判断传值是否相等

//HTML标签参数自动添加(target|title|alt|id|class|style|)    辅助类
function setHtmlParam($content, $ParamList){
    $splStr=''; $startStr=''; $endStr=''; $c=''; $paramValue=''; $ReplaceStartStr ='';
    $endStr= '\'';
    $splStr= aspSplit($ParamList, '|');
    foreach( $splStr as $startStr){
        $startStr= AspTrim($startStr);
        if( $startStr <> '' ){
            //替换开始字符   因为开始字符类型可变 不同
            $ReplaceStartStr= $startStr;
            if( substr($ReplaceStartStr, 0 , 3)== 'img' ){
                $ReplaceStartStr= mid($ReplaceStartStr, 4,-1);
            }else if( substr($ReplaceStartStr, 0 , 1)== 'a' ){
                $ReplaceStartStr= mid($ReplaceStartStr, 2,-1);
            }else if( instr('|ul|li|', '|' . substr($ReplaceStartStr, 0 , 2) . '|') > 0 ){
                $ReplaceStartStr= mid($ReplaceStartStr, 3,-1);
            }
            $ReplaceStartStr= ' ' . $ReplaceStartStr . '=\'';

            $startStr= ' ' . $startStr . '=\'';
            if( instr($content, $startStr) > 0 && instr($content, $endStr) > 0 ){
                $paramValue= strCut($content, $startStr, $endStr, 2);
                $paramValue= handleInModule($paramValue, 'end'); //处理内部模块
                $c= $c . $ReplaceStartStr . $paramValue . $endStr;
            }
        }
    }
    $setHtmlParam= $c;
    return @$setHtmlParam;
}
?>