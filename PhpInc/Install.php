<?PHP
require_once './ASP.php';
require_once './Conn.php';
require_once './MySqlClass.php';
require_once './sys_FSO.php';
require_once './Common.php';
require_once './Cai.php'; 
//更新网址          http://127.0.0.1/phpAccess.asp
?>
<?PHP


 	$conn=OpenConn(); 
	$mydbcharset = 'gbk';				//编码
 	$DB_PREFIX=@$_REQUEST['db_PREFIX'];						//表前面的前缀
	
	$char = ' ENGINE=MyISAM DEFAULT CHARSET='.$mydbcharset;
	$sqlTables = array(
	
	//access start
"{$DB_PREFIX}admin" => "CREATE TABLE `{$DB_PREFIX}admin` (
`id` int(5) unsigned NOT NULL auto_increment,
`username` varchar(255) NOT NULL default '',
`pwd` varchar(255) NOT NULL default '',
`pseudonym` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`regip` varchar(255) NOT NULL default '',
`upip` varchar(255) NOT NULL default '',
`quanxian` mediumtext,
`verificationmode` int(8) NOT NULL default '0',
`adminlevel` varchar(255) NOT NULL default '',
`channel` varchar(255) NOT NULL default '',
`mtest` varchar(250) NOT NULL default '',
`flags` varchar(255) NOT NULL default '',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}articledetail" => "CREATE TABLE `{$DB_PREFIX}articledetail` (
`id` int(5) unsigned NOT NULL auto_increment,
`parentid` int(8) NOT NULL default '0',
`sortrank` int(8) NOT NULL default '0',
`views` int(8) NOT NULL default '0',
`adminid` int(8) NOT NULL default '0',
`smallimage` varchar(255) NOT NULL default '',
`bigimage` varchar(255) NOT NULL default '',
`bannerimage` varchar(255) NOT NULL default '',
`downloadfile` varchar(255) NOT NULL default '',
`smallimagealt` varchar(255) NOT NULL default '',
`bigimagealt` varchar(255) NOT NULL default '',
`bannerimagealt` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`titlecolor` varchar(255) NOT NULL default '',
`titlealt` varchar(255) NOT NULL default '',
`labletitle` varchar(255) NOT NULL default '',
`isthrough` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`occasions` varchar(255) NOT NULL default '',
`hotline` varchar(255) NOT NULL default '',
`model` varchar(255) NOT NULL default '',
`author` varchar(255) NOT NULL default '',
`articlesource` varchar(255) NOT NULL default '',
`price` int(8) NOT NULL default '0',
`newprice` int(8) NOT NULL default '0',
`memberprice` int(8) NOT NULL default '0',
`sold` int(8) NOT NULL default '0',
`membertype` varchar(255) NOT NULL default '',
`memberuser` varchar(255) NOT NULL default '',
`hits` int(8) NOT NULL default '0',
`productabout` mediumtext,
`articledescription` mediumtext,
`httpurl` varchar(255) NOT NULL default '',
`recordurl` varchar(255) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`flags` varchar(255) NOT NULL default '',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`articleinfostyle` varchar(255) NOT NULL default '',
`articleinfophotowidth` varchar(255) NOT NULL default '',
`articleinfophotoheight` varchar(255) NOT NULL default '',
`relatedtags` varchar(255) NOT NULL default '',
`weight` int(8) NOT NULL default '0',
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}bidding" => "CREATE TABLE `{$DB_PREFIX}bidding` (
`id` int(5) unsigned NOT NULL auto_increment,
`searchwords` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`showreason` varchar(255) NOT NULL default '',
`ncomputersearch` int(8) NOT NULL default '0',
`nmobliesearch` int(8) NOT NULL default '0',
`ncountsearch` int(8) NOT NULL default '0',
`nwordprice` int(8) NOT NULL default '0',
`ndegree` int(8) NOT NULL default '0',
`sortrank` int(8) NOT NULL default '0',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}feedback" => "CREATE TABLE `{$DB_PREFIX}feedback` (
`id` int(5) unsigned NOT NULL auto_increment,
`columnid` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`feedbacktype` varchar(255) NOT NULL default '',
`guestname` varchar(255) NOT NULL default '',
`tel` varchar(255) NOT NULL default '',
`fax` varchar(255) NOT NULL default '',
`email` varchar(255) NOT NULL default '',
`mobile` varchar(255) NOT NULL default '',
`qq` varchar(255) NOT NULL default '',
`msn` varchar(255) NOT NULL default '',
`company` varchar(255) NOT NULL default '',
`address` varchar(255) NOT NULL default '',
`postcode` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
`reply` mediumtext,
`replyip` mediumtext,
`replydatetime` mediumtext,
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}friendlink" => "CREATE TABLE `{$DB_PREFIX}friendlink` (
`id` int(5) unsigned NOT NULL auto_increment,
`adminid` int(8) NOT NULL default '0',
`title` varchar(255) NOT NULL default '',
`titlecolor` varchar(255) NOT NULL default '',
`labletitle` varchar(255) NOT NULL default '',
`httpurl` varchar(255) NOT NULL default '',
`sortrank` int(8) NOT NULL default '0',
`titlealt` varchar(255) NOT NULL default '',
`smallimage` varchar(255) NOT NULL default '',
`smallimagealt` varchar(255) NOT NULL default '',
`isthrough` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`flags` varchar(255) NOT NULL default '',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`weight` int(8) NOT NULL default '0',
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}guestbook" => "CREATE TABLE `{$DB_PREFIX}guestbook` (
`id` int(5) unsigned NOT NULL auto_increment,
`columnid` varchar(255) NOT NULL default '',
`parentid` int(8) NOT NULL default '0',
`title` varchar(255) NOT NULL default '',
`guestname` varchar(255) NOT NULL default '',
`tel` varchar(255) NOT NULL default '',
`fax` varchar(255) NOT NULL default '',
`email` varchar(255) NOT NULL default '',
`mobile` varchar(255) NOT NULL default '',
`qq` varchar(255) NOT NULL default '',
`msn` varchar(255) NOT NULL default '',
`company` varchar(255) NOT NULL default '',
`address` varchar(255) NOT NULL default '',
`postcode` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
`reply` mediumtext,
`replyip` mediumtext,
`replydatetime` mediumtext,
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}job" => "CREATE TABLE `{$DB_PREFIX}job` (
`id` int(5) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`sex` varchar(255) NOT NULL default '',
`age` varchar(255) NOT NULL default '',
`education` varchar(255) NOT NULL default '',
`workarea` varchar(255) NOT NULL default '',
`monthly` varchar(255) NOT NULL default '',
`startdatetime` varchar(255) NOT NULL default '',
`enddatetime` varchar(255) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`flags` varchar(255) NOT NULL default '',
`sortrank` int(8) NOT NULL default '0',
`titlealt` varchar(255) NOT NULL default '',
`smallimage` varchar(255) NOT NULL default '',
`smallimagealt` varchar(255) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}lineqq" => "CREATE TABLE `{$DB_PREFIX}lineqq` (
`id` int(5) unsigned NOT NULL auto_increment,
`bigclassname` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`qq` varchar(255) NOT NULL default '',
`isonlinechat` varchar(250) NOT NULL default '',
`isaddfriend` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}linevote" => "CREATE TABLE `{$DB_PREFIX}linevote` (
`id` int(5) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`option1` varchar(255) NOT NULL default '',
`option2` varchar(255) NOT NULL default '',
`option3` varchar(255) NOT NULL default '',
`option4` varchar(255) NOT NULL default '',
`option5` varchar(255) NOT NULL default '',
`option6` varchar(255) NOT NULL default '',
`num1` int(8) NOT NULL default '0',
`num2` int(8) NOT NULL default '0',
`num3` int(8) NOT NULL default '0',
`num4` int(8) NOT NULL default '0',
`num5` int(8) NOT NULL default '0',
`num6` int(8) NOT NULL default '0',
`isdisplay` varchar(250) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`banner` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`fontb` varchar(250) NOT NULL default '',
`onhtml` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`votetype` varchar(250) NOT NULL default '',
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}listmenu" => "CREATE TABLE `{$DB_PREFIX}listmenu` (
`id` int(5) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`parentid` int(8) NOT NULL default '0',
`sortrank` int(8) NOT NULL default '0',
`lablename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isdisplay` varchar(250) NOT NULL default '',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}member" => "CREATE TABLE `{$DB_PREFIX}member` (
`id` int(5) unsigned NOT NULL auto_increment,
`usertype` varchar(255) NOT NULL default '',
`username` varchar(255) NOT NULL default '',
`pwd` varchar(255) NOT NULL default '',
`yunpwd` varchar(255) NOT NULL default '',
`sex` varchar(255) NOT NULL default '',
`age` int(8) NOT NULL default '0',
`tel` varchar(255) NOT NULL default '',
`phone` varchar(255) NOT NULL default '',
`fax` varchar(255) NOT NULL default '',
`email` varchar(255) NOT NULL default '',
`postcode` varchar(255) NOT NULL default '',
`address` varchar(255) NOT NULL default '',
`company` varchar(255) NOT NULL default '',
`regip` varchar(255) NOT NULL default '',
`loginip` varchar(255) NOT NULL default '',
`logincount` int(8) NOT NULL default '0',
`logintime` varchar(250) NOT NULL default '',
`lastlogintime` varchar(250) NOT NULL default '',
`openid` varchar(255) NOT NULL default '',
`accesstoken` varchar(255) NOT NULL default '',
`nickname` varchar(255) NOT NULL default '',
`qqphoto` varchar(255) NOT NULL default '',
`useryear` int(8) NOT NULL default '0',
`province` varchar(255) NOT NULL default '',
`city` varchar(255) NOT NULL default '',
`area` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}onepage" => "CREATE TABLE `{$DB_PREFIX}onepage` (
`id` int(5) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`displaytitle` varchar(255) NOT NULL default '',
`adminid` int(8) NOT NULL default '0',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`fontcolor` varchar(255) NOT NULL default '',
`fontb` varchar(250) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`sortrank` int(8) NOT NULL default '0',
`views` int(8) NOT NULL default '0',
`isrecommend` varchar(250) NOT NULL default '',
`labletitle` varchar(255) NOT NULL default '',
`banner` varchar(255) NOT NULL default '',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}payment" => "CREATE TABLE `{$DB_PREFIX}payment` (
`id` int(5) unsigned NOT NULL auto_increment,
`username` varchar(255) NOT NULL default '',
`memberid` varchar(255) NOT NULL default '',
`sex` varchar(255) NOT NULL default '',
`age` int(8) NOT NULL default '0',
`tel` varchar(255) NOT NULL default '',
`phone` varchar(255) NOT NULL default '',
`fax` varchar(255) NOT NULL default '',
`email` varchar(255) NOT NULL default '',
`postcode` varchar(255) NOT NULL default '',
`address` varchar(255) NOT NULL default '',
`company` varchar(255) NOT NULL default '',
`qqmsn` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}previeworder" => "CREATE TABLE `{$DB_PREFIX}previeworder` (
`id` int(5) unsigned NOT NULL auto_increment,
`memberid` varchar(255) NOT NULL default '',
`orderid` varchar(255) NOT NULL default '',
`productid` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`total` varchar(255) NOT NULL default '',
`price` int(8) NOT NULL default '0',
`productsum` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`through` varchar(250) NOT NULL default '',
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}productcomment" => "CREATE TABLE `{$DB_PREFIX}productcomment` (
`id` int(5) unsigned NOT NULL auto_increment,
`username` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`pid` int(8) NOT NULL default '0',
`ptitle` varchar(255) NOT NULL default '',
`bodycontent` mediumtext,
`sort` int(8) NOT NULL default '0',
`ip` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`through` varchar(250) NOT NULL default '',
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}searchstat" => "CREATE TABLE `{$DB_PREFIX}searchstat` (
`id` int(5) unsigned NOT NULL auto_increment,
`title` varchar(255) NOT NULL default '',
`isthrough` varchar(250) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`views` int(8) NOT NULL default '0',
`author` varchar(255) NOT NULL default '',
`sortrank` int(8) NOT NULL default '0',
`fontcolor` varchar(255) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`flags` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}systemlog" => "CREATE TABLE `{$DB_PREFIX}systemlog` (
`id` int(5) unsigned NOT NULL auto_increment,
`msgstr` varchar(255) NOT NULL default '',
`tablename` varchar(255) NOT NULL default '',
`url` varchar(255) NOT NULL default '',
`adminid` int(8) NOT NULL default '0',
`adminname` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}tablecomment" => "CREATE TABLE `{$DB_PREFIX}tablecomment` (
`id` int(5) unsigned NOT NULL auto_increment,
`userid` int(8) NOT NULL default '0',
`itemid` int(8) NOT NULL default '0',
`tablename` varchar(255) NOT NULL default '',
`username` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`email` varchar(255) NOT NULL default '',
`tel` varchar(255) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`reply` mediumtext,
`notebody` mediumtext,
`isthrough` int(8) NOT NULL default '0',
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}webcolumn" => "CREATE TABLE `{$DB_PREFIX}webcolumn` (
`id` int(5) unsigned NOT NULL auto_increment,
`columnname` varchar(255) NOT NULL default '',
`columnenname` varchar(255) NOT NULL default '',
`columntype` varchar(255) NOT NULL default '',
`parentid` int(8) NOT NULL default '0',
`sortrank` int(8) NOT NULL default '0',
`views` int(8) NOT NULL default '0',
`adminid` int(8) NOT NULL default '0',
`isdisplay` varchar(250) NOT NULL default '',
`smallimage` varchar(255) NOT NULL default '',
`bigimage` varchar(255) NOT NULL default '',
`bannerimage` varchar(255) NOT NULL default '',
`flags` varchar(255) NOT NULL default '',
`displaytitle` varchar(255) NOT NULL default '',
`labletitle` varchar(255) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`foldername` varchar(255) NOT NULL default '',
`filename` varchar(255) NOT NULL default '',
`customaurl` varchar(255) NOT NULL default '',
`templatepath` varchar(255) NOT NULL default '',
`target` varchar(255) NOT NULL default '',
`nofollow` int(8) NOT NULL default '0',
`fontcolor` varchar(255) NOT NULL default '',
`fontb` varchar(250) NOT NULL default '',
`ismakehtml` varchar(250) NOT NULL default '',
`npagesize` int(8) NOT NULL default '0',
`sortsql` varchar(255) NOT NULL default '',
`ishtml` varchar(250) NOT NULL default '',
`isonhtml` varchar(250) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`notebody` mediumtext,
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}weblayout" => "CREATE TABLE `{$DB_PREFIX}weblayout` (
`id` int(5) unsigned NOT NULL auto_increment,
`layoutname` varchar(255) NOT NULL default '',
`layoutlist` varchar(255) NOT NULL default '',
`sourcestr` varchar(255) NOT NULL default '',
`replacestr` varchar(255) NOT NULL default '',
`actioncontent` mediumtext,
`sortrank` int(8) NOT NULL default '0',
`isdisplay` varchar(250) NOT NULL default '',
`author` varchar(255) NOT NULL default '',
`views` int(8) NOT NULL default '0',
`adminid` int(8) NOT NULL default '0',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}webmodule" => "CREATE TABLE `{$DB_PREFIX}webmodule` (
`id` int(5) unsigned NOT NULL auto_increment,
`moduletype` varchar(255) NOT NULL default '',
`modulename` varchar(255) NOT NULL default '',
`title` varchar(255) NOT NULL default '',
`sortrank` int(8) NOT NULL default '0',
`isdisplay` varchar(250) NOT NULL default '',
`author` varchar(255) NOT NULL default '',
`views` int(8) NOT NULL default '0',
`adminid` int(8) NOT NULL default '0',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`aboutcontent` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}website" => "CREATE TABLE `{$DB_PREFIX}website` (
`id` int(5) unsigned NOT NULL auto_increment,
`websiteurl` varchar(255) NOT NULL default '',
`websitebottom` mediumtext,
`websiteflow` int(8) NOT NULL default '0',
`websiteflowstyle` int(8) NOT NULL default '0',
`websiteflowmedian` int(8) NOT NULL default '0',
`productlist` varchar(255) NOT NULL default '',
`newslist` varchar(255) NOT NULL default '',
`newsdid` varchar(255) NOT NULL default '',
`tz51la` varchar(255) NOT NULL default '',
`useremail` varchar(255) NOT NULL default '',
`productdid` varchar(255) NOT NULL default '',
`templateindex` mediumtext,
`templatehome` mediumtext,
`templatemain` mediumtext,
`templatemain2` mediumtext,
`templatemain3` mediumtext,
`usenumb` mediumtext,
`webrecord` varchar(255) NOT NULL default '',
`contentwebrecord` mediumtext,
`usehttpurl` varchar(255) NOT NULL default '',
`tempusehttpurl` mediumtext,
`webdate` varchar(250) NOT NULL default '',
`webtitle` varchar(255) NOT NULL default '',
`webkeywords` varchar(255) NOT NULL default '',
`webdescription` varchar(255) NOT NULL default '',
`webtemplate` varchar(255) NOT NULL default '',
`webskins` varchar(255) NOT NULL default '',
`webfoldername` varchar(255) NOT NULL default '',
`webimages` varchar(255) NOT NULL default '',
`webcss` varchar(255) NOT NULL default '',
`webjs` varchar(255) NOT NULL default '',
`addwebsite` varchar(250) NOT NULL default '',
`updatehtml` varchar(250) NOT NULL default '',
`ishtmlformatting` varchar(250) NOT NULL default '',
`isweblabelclose` varchar(250) NOT NULL default '',
`iscntoen` varchar(250) NOT NULL default '',
`flags` varchar(255) NOT NULL default '',
`moduleskins` varchar(255) NOT NULL default '',
`findtpl` varchar(255) NOT NULL default '',
`replacetpl` varchar(255) NOT NULL default '',
`webcodefindtpl` varchar(255) NOT NULL default '',
`webcodereplacetpl` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`webhtml` varchar(255) NOT NULL default '',
PRIMARY KEY  (`Id`)
){$char};",
"{$DB_PREFIX}websitestat" => "CREATE TABLE `{$DB_PREFIX}websitestat` (
`id` int(5) unsigned NOT NULL auto_increment,
`visiturl` mediumtext,
`viewurl` mediumtext,
`browser` varchar(255) NOT NULL default '',
`operatingsystem` varchar(255) NOT NULL default '',
`screenwh` varchar(255) NOT NULL default '',
`moreinfo` mediumtext,
`viewdatetime` varchar(250) NOT NULL default '',
`ip` varchar(255) NOT NULL default '',
`dateclass` varchar(255) NOT NULL default '',
`adddatetime` varchar(250) NOT NULL default '',
`updatetime` varchar(250) NOT NULL default '',
`isthrough` int(8) NOT NULL default '0',
`noteinfo` mediumtext,
`bodycontent` mediumtext,
PRIMARY KEY  (`Id`)
){$char};",
//access end

	);

//表前缀不为空 则修改config.php配置文件
if($DB_PREFIX<>''){
	$configPath=handlePath("./config.php");
	if(checkfile($configPath)==true){
		require_once './Cai.php';
		$content=getFText($configPath);
		$s=strCut( $content, '; $db_PREFIX= \'', '\'', 1);
		$content=replace($content,$s,'; $db_PREFIX= \''.$DB_PREFIX.'\'');
		createFile($configPath, $content);
		echo('修改config.php配置文件完成');
	}
}

	foreach ($sqlTables as $tableName => $tableSql){
		$conn->query("DROP TABLE IF EXISTS {$tableName}");					//为删除表
		$conn->query($tableSql);											//为创建表
		echo("创建数据表 {$tableName} 成功>><br>");
	}
	echo('<a href="../admin/index.php" target="_blank">登录后台</a>');
	echo('&nbsp; | &nbsp;<a href="../admin/index.php?act=setAccess&webdataDir=/Data/WebData&login=out" target="_blank">导入默认数据</a>');
	if(@$_POST['loginname']<>'' && @$_POST['loginpwd']<>''){
			$conn->query('insert into '.$DB_PREFIX.'admin (username,pwd,flags) values(\''.@$_POST['loginname'].'\',\'' . myMD5(@$_POST['loginpwd']) . '\',\'|*|\')') ;
	}else{
		$splStr = aspSplit('admin|test|guest', '|');
		foreach( $splStr as $s){
			if($s=='admin'){
				$flags='|*|';
			}else{
				$flags='|显示站点配置|显示网站栏目|显示分类信息|显示评论|显示单页管理|显示后台管理员|显示搜索统计|显示网站统计|显示生成HTML|显示生成SiteMap|显示生成Robots|显示模板管理|';
			}
			$conn->query('insert into '.$DB_PREFIX.'admin (username,pwd,flags) values(\''.$s.'\',\'' . myMD5($s) . '\',\''.$flags.'\')') ;
		}
	}
	
	$conn->query('insert into '.$DB_PREFIX.'website (webtitle) values(\'默认\')') ;
	
	//给权限，要不然恢复数据不行20160301
	@$_SESSION['adminusername'] = 'ASPPHPCMS' ;
    @$_SESSION['adminflags'] = '|*|'		;
	 

$splstr='';$s='';
$conn=OpenConn();
$parentid=''; $title=''; $lableName=''; $content=''; $tempS=''; $url=''; $isdisplay=''; $nCount='';

//echo('path='.handlePath('./../admin/后台菜单配置.ini'));

$content = getftext(handlePath('./../admin/后台菜单配置.ini'));
$content = Replace($content, "\t", '    ');
$splStr = aspSplit($content, chr(10));		//不用vbCrlf()  是因为在上传到GitHut上去，下载下来它会把后台菜单配置.ini文件编码转成utf-8 20160409
$nCount = 0;
foreach( $splStr as $s){
    $tempS = $s ;
    $s = AspTrim($s) ;
    if( $s <> '' ){
        $nCount = $nCount + 1 ;//总数
        if( substr($tempS, 0 , 4) == '    ' ){
        }else{
            $parentid = '-1' ;
        }

        if( trim(LCase($tempS)) == 'end' ){
            break;
        }else if( trim($s) <> '' ){
            $title = mid($s . ' ', 1, instr($s . ' ', ' ') - 1) ;
            $lableName = getStrCut($s, 'lablename=\'', '\'', 2) ;
            $url = getStrCut($s, 'url=\'', '\'', 2) ;
            $isdisplay = getStrCut($s, 'isdisplay=\'', '\'', 2) ;
            if( $isdisplay == '' ){
                $isdisplay = 1 ;
            }
            //ASPEcho('lablename', $lableName) ;
			if($title<>''){
            connExecute('insert into ' . $DB_PREFIX . 'ListMenu (title,parentid,sortrank,lablename,isdisplay,customaurl) values(\'' . $title . '\',' . $parentid . ',' . $nCount . ',\'' . $lableName . '\',' . $isdisplay . ',\'' . $url . '\')') ;
            if( $parentid == '-1' ){
                $rsObj=$GLOBALS['conn']->query( 'select * from ' . $DB_PREFIX . 'ListMenu where title=\'' . $title . '\'');
                $rs=mysql_fetch_array($rsObj);
                if( @mysql_num_rows($rsObj)!=0 ){
                    $parentid = $rs['id'] ;
                }
            }
			}
            ASPEcho($title, $s) ;
            ASPEcho($url, $lableName) ;
        }
    }
}
	
	
?>
 













