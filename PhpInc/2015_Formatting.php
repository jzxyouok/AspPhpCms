<?PHP
//格式化20150212


//Html格式化 简单版 加强于2014 12 09，20150709
function htmlFormatting($content){
    $htmlFormatting= handleHtmlFormatting($content, false, 0, '');
    return @$htmlFormatting;
}

//处理格式化
function handleHtmlFormatting( $content, $isMsgBox, $nErrLevel, $action){
    $splStr=''; $s=''; $tempS=''; $lCaseS=''; $c=''; $left4Str=''; $left5Str=''; $left6Str=''; $left7Str=''; $left8Str ='';
    $nLevel ='';//级别
    $elseS=''; $elseLable ='';

    $levelArray=array(299); $keyWord ='';
    $lableName ='';//标签名称
    $isJavascript ='';//为javascript
    $isTextarea ='';//为表单文本域<textarea
    $isPre ='';//为pre
    $isJavascript= false; //默认javascript为假
    $isTextarea= false; //表单文件域为假
    $isPre= false; //默认pre为假
    $nLevel= 0; //级别数

    $action= '|' . $action . '|'; //动作
    $splStr= aspSplit($content, vbCrlf());
    foreach( $splStr as $s){
        $tempS= $s ; $elseS= $s;
        $s= trimVbCrlf($s) ; $lCaseS= strtolower($s);
        //判断于20150710
        if((substr($lCaseS, 0 , 8)== '<script ' || substr($lCaseS, 0 , 8)== '<script>') && instr($s, '</script>')== false && $isJavascript== false ){
            $isJavascript= true;
            $c= $c . phptrim($tempS) . vbCrlf();
        }else if( $isJavascript== true ){

            if( substr($lCaseS, 0 , 9)== '</script>' ){
                $isJavascript= false;
                $c= $c . phptrim($tempS) . vbCrlf(); //最后清除两边空格
            }else{
                $c= $c . $tempS . vbCrlf(); //为js则显示原文本  不处理清空两边空格phptrim(tempS)
            }

            //表单文本域判断于20151019
        }else if((substr($lCaseS, 0 , 10)== '<textarea ' || substr($lCaseS, 0 , 10)== '<textarea>') && instr($s, '</textarea>')== false && $isTextarea== false ){
            $isTextarea= true;
            $c= $c . phptrim($tempS) . vbCrlf();
        }else if( $isTextarea== true ){
            $c= $c . phptrim($tempS) . vbCrlf();
            if( substr($lCaseS, 0 , 11)== '</textarea>' ){
                $isTextarea= false;
            }
            //表单文本域判断于20151019
        }else if((substr($lCaseS, 0 , 5)== '<pre ' || substr($lCaseS, 0 , 5)== '<pre>') && instr($s, '</pre>')== false && $isPre== false ){
            $isPre= true;
            $c= $c . phptrim($tempS) . vbCrlf();
        }else if( $isPre== true ){
            $c= $c . $tempS . vbCrlf();
            if( substr($lCaseS, 0 , 6)== '</pre>' ){
                $isPre= false;
            }


        }else if( $s <> '' && $isJavascript== false && $isTextarea== false ){
            $left4Str= '|' . substr($lCaseS, 0 , 4) . '|' ; $left5Str= '|' . substr($lCaseS, 0 , 5) . '|' ; $left6Str= '|' . substr($lCaseS, 0 , 6) . '|';
            $left7Str= '|' . substr($lCaseS, 0 , 7) . '|' ; $left8Str= '|' . substr($lCaseS, 0 , 8) . '|';

            $keyWord= ''; //关键词初始清空
            $lableName= ''; //标签名称
            if( instr('|<ul>|<ul |<li>|<li |<dt>|<dt |<dl>|<dl |<dd>|<dd |<tr>|<tr |<td>|<td |', $left4Str) > 0 ){
                $keyWord= $left4Str;
                $lableName= mid($left4Str, 3, 2);
            }else if( instr('|<div>|<div |', $left5Str) > 0 ){
                $keyWord= $left5Str;
                $lableName= mid($left5Str, 3, 3);
            }else if( instr('|<span>|<span |<form>|<form |', $left6Str) > 0 ){
                $keyWord= $left6Str;
                $lableName= mid($left6Str, 3, 4);

            }else if( instr('|<table>|<table |<tbody>|<tbody |', $left7Str) > 0 ){
                $keyWord= $left7Str;
                $lableName= mid($left7Str, 3, 5);

            }else if( instr('|<center>|<center |', $left8Str) > 0 ){
                $keyWord= $left8Str;
                $lableName= mid($left8Str, 3, 6);
            }
            $keyWord= AspTrim(Replace(Replace($keyWord, '<', ''), '>', ''));
            //call echo(KeyWord,lableName)
            //开始
            if( $keyWord <> '' ){
                $s= copyStr('    ', $nLevel) . $s;
                if( substr($lCaseS, - 3 + strlen($lableName)) <> '</' . $lableName . '>' && instr($lCaseS, '</' . $lableName . '>')== false ){
                    $nLevel= $nLevel + 1;
                    if( $nLevel >= 0 ){
                        $levelArray[$nLevel]= $keyWord;
                    }
                }
            }else if( instr('|</ul>|</li>|</dl>|</dt>|</dd>|</tr>|</td>|', '|' . substr($lCaseS, 0 , 5) . '|') > 0 || instr('|</div>|', '|' . substr($lCaseS, 0 , 6) . '|') > 0 || instr('|</span>|</form>|', '|' . substr($lCaseS, 0 , 7) . '|') > 0 || instr('|</table>|</tbody>|', '|' . substr($lCaseS, 0 , 8) . '|') > 0 || instr('|</center>|', '|' . substr($lCaseS, 0 , 9) . '|') > 0 ){
                $nLevel= $nLevel - 1;
                $s= copyStr('    ', $nLevel) . $s;
            }else{
                $s= copyStr('    ', $nLevel) . $s;
                //最后是结束标签则减一级
                if( substr($lCaseS, - 6)== '</div>' ){
                    if( checkHtmlFormatting($lCaseS)== false ){
                        $s= substr($s, 0 , strlen($s) - 6);
                        $nLevel= $nLevel - 1;
                        $s= $s . vbCrlf() . copyStr('    ', $nLevel) . '</div>';
                    }
                }else if( substr($lCaseS, - 7)== '</span>' ){
                    if( checkHtmlFormatting($lCaseS)== false ){
                        $s= substr($s, 0 , strlen($s) - 7);
                        $nLevel= $nLevel - 1;
                        $s= $s . vbCrlf() . copyStr('    ', $nLevel) . '</span>';
                    }
                }else if( instr('|</ul>|</dt>|<dl>|<dd>|', $left5Str) > 0 ){
                    $s= substr($s, 0 , strlen($s) - 5);
                    $nLevel= $nLevel - 1;
                    $s= $s . vbCrlf() . copyStr('    ', $nLevel) . substr($lCaseS, - 5);
                }


                //对   aaa</li>   这种进处理   20160106
                $elseS= phptrim(strtolower($elseS));
                if( instr($elseS, '</') > 0 ){
                    $elseLable= mid($elseS, instr($elseS, '</'),-1);
                    if( instr('|</ul>|</li>|</dl>|</dt>|</dd>|</tr>|</td>|</div>|</span>|<form>|', '|' . $elseLable . '|') > 0 && $nLevel > 0 ){
                        $nLevel= $nLevel - 1;
                    }
                }
                //call echo("s",replace(s,"<","&lt;"))


            }
            //call echo("",ShowHtml(temps)
            $c= $c . $s . vbCrlf();
        }else if( $s== '' ){
            if( instr($action, '|delblankline|')== false && instr($action, '|删除空行|')== false ){//删除空行
                $c= $c . vbCrlf();
            }
        }
    }
    $handleHtmlFormatting= $c;
    $nErrLevel= $nLevel; //获得错误级别
    if( $nLevel <> 0 &&(strtolower($isMsgBox)== '1' || strtolower($isMsgBox)== 'true') ){
        ASPEcho('HTML标签有错误', $nLevel);
    }
    //Call Echo("nLevel",nLevel & "," & levelArray(nLevel))                '显示错误标题20150212
    return @$handleHtmlFormatting;
}

//处理闭合HTML标签(20150902)  比上面的更好用 配合上面
function formatting($content, $action){
    $i=''; $endStr=''; $s=''; $c=''; $labelName=''; $startLabel=''; $endLabel=''; $endLabelStr=''; $nLevel=''; $isYes=''; $parentLableName ='';
    $nextLableName ='';//下一个标题名称
    $isA ='';//是否为A链接
    $isTextarea ='';//是否为多行输入文本框
    $isScript ='';//脚本语言
    $isStyle ='';//Css层叠样式表
    $isPre ='';//是否为pre
    $startLabel= '<';
    $endLabel= '>';
    $nLevel= 0;
    $action= '|' . $action . '|'; //层级
    $isA= false ; $isTextarea= false ; $isScript= false ; $isStyle= false ; $isPre= false;
    $content= Replace(Replace($content, vbCrlf(), Chr(10)), "\t", '    ');

    for( $i= 1 ; $i<= strlen($content); $i++){
        $s= mid($content, $i, 1);
        $endStr= mid($content, $i,-1);
        if( $s== '<' ){
            if( instr($endStr, '>') > 0 ){
                $s= mid($endStr, 1, instr($endStr, '>'));
                $i= $i + strlen($s) - 1;
                $s= mid($s, 2, strlen($s) - 2);
                if( substr($s, - 1)== '/' ){
                    $s= phptrim(substr($s, 0 , strlen($s) - 1));
                }
                $endStr= substr($endStr, - strlen($endStr) - strlen($s) - 2); //最后字符减去当前标签  -2是因为它有<>二个字符
                //注意之前放在labelName下面
                $labelName= mid($s, 1, instr($s . ' ', ' ') - 1);
                $labelName= strtolower($labelName);


                //call echo("labelName",labelName)
                if( $labelName== 'a' ){
                    $isA= true;
                }else if( $labelName== '/a' ){
                    $isA= false;
                }else if( $labelName== 'textarea' ){
                    $isTextarea= true;
                }else if( $labelName== '/textarea' ){
                    $isTextarea= false;
                }else if( $labelName== 'script' ){
                    $isScript= true;
                }else if( $labelName== '/script' ){
                    $isScript= false;
                }else if( $labelName== 'style' ){
                    $isStyle= true;
                }else if( $labelName== '/style' ){
                    $isStyle= false;
                }else if( $labelName== 'pre' ){
                    $isPre= true;
                }else if( $labelName== '/pre' ){
                    $isPre= false;

                }

                $endLabelStr= $endLabel;
                $nextLableName= getHtmlLableName($endStr, 0);
                //不为压缩HTML
                if( instr($action, '|ziphtml|')== false && $isPre== false ){
                    if( $isA== false ){
                        if( instr('|a|strong|u|i|s|script|', '|' . $labelName . '|')== false && '/' . $labelName <> $nextLableName && instr('|/a|/strong|/u|/i|/s|/script|', '|' . $nextLableName . '|')== false ){
                            $endLabelStr= $endLabelStr . Chr(10);
                        }
                    }
                }
                $s= $startLabel . $s . $endLabelStr;
                //不为压缩HTML
                if( instr($action, '|ziphtml|')== false && $isPre== false ){
                    //处理这个            aaaaa</span>
                    if( $isA== false && $isYes== false && substr($labelName, 0 , 1)== '/' && $labelName <> '/script' && $labelName <> '/a' ){
                        //排除这种    <span>天天发团</span>     并且判断上一个字段不等于vbcrlf换行
                        if( '/' . $parentLableName <> $labelName && substr(AspTrim($c), - 1) <> Chr(10) ){
                            $s= Chr(10) . $s;
                        }
                    }
                }
                $parentLableName= $labelName;
                $isYes= true;
            }
        }else if( $s <> '' ){
            $isYes= false;
            //call echo("isPre",isPre)
            if( $isPre== false ){
                if( $s== Chr(10) ){
                    if( $isTextarea== false && $isScript== false && $isStyle== false ){
                        $s= '';
                    }else if( $isScript== true ){
                        if( instr($action, '|zipscripthtml|') > 0 ){
                            $s= ' ';
                        }
                    }else if( $isStyle== true ){
                        if( instr($action, '|zipstylehtml|') > 0 ){
                            $s= '';
                        }
                    }else if( $isTextarea== true ){
                        if( instr($action, '|ziptextareahtml|') > 0 ){
                            $s= '';
                        }
                    }else{
                        $s= Chr(10);
                    }
                    // Right(Trim(c), 1) = ">")   为在压缩时用到
                }else if( (substr(AspTrim($c), - 1)== Chr(10) || substr(AspTrim($c), - 1)== '>') && phptrim($s)== '' && $isTextarea== false && $isScript== false ){
                    $s= '';
                }
            }
        }
        $c= $c . $s;
    }
    $c= Replace($c, Chr(10), vbCrlf());
    $formatting= $c;
    return @$formatting;
}

function zipHTML($c){
    $zipHTML= formatting($c, 'ziphtml|zipscripthtml|zipstylehtml'); //ziphtml|zipscripthtml|zipstylehtml|ziptextareahtml
    return @$zipHTML;
}

//检测HTML标签是否成对出现 如（<div><ul><li>aa</li></ul></div></div>）
function checkHtmlFormatting( $content){
    $splStr=''; $s=''; $c=''; $splxx=''; $nLable=''; $lableStr ='';
    $content= strtolower($content);
    $splStr= aspSplit('ul|li|dt|dd|dl|div|span', '|');
    foreach( $splStr as $s){
        $s= phptrim($s);
        if( $s <> '' ){
            $nLable= 0;
            $lableStr= '<' . $s . ' ';
            if( instr($content, $lableStr) > 0 ){
                $splxx= aspSplit($content, $lableStr);
                $nLable= $nLable + UBound($splxx);
            }
            $lableStr= '<' . $s . '>';
            if( instr($content, $lableStr) > 0 ){
                $splxx= aspSplit($content, $lableStr);
                $nLable= $nLable + UBound($splxx);
            }
            $lableStr= '</' . $s . '>';
            if( instr($content, $lableStr) > 0 ){
                $splxx= aspSplit($content, $lableStr);
                $nLable= $nLable - UBound($splxx);
            }
            //call echo(ShowHtml(lableStr),nLable)
            if( $nLable <> 0 ){
                $checkHtmlFormatting= false;
                return @$checkHtmlFormatting;
            }
        }
    }
    $checkHtmlFormatting= true;
    return @$checkHtmlFormatting;
}


?>