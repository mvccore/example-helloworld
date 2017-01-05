<?php
error_reporting(5);
class Packager_Php_Wrapper{const FS_MODE='PHP_STRICT_PACKAGE';public static$BasePath;public static$BasePathLength;public static$Context=NULL;public static$NewContextContents=array();public static$Contents=array();public static$Info=array(
'/Libs/MvcCore/Controller.php'=>array('index'=>-1,'mtime'=>1483402982,'size'=>8247,'lines'=>array(0,1)),
'/App/Views/Helpers/Assets.php'=>array('index'=>-1,'mtime'=>1483406506,'size'=>11155,'lines'=>array(1,1)),
'/Libs/MvcCore/View.php'=>array('index'=>-1,'mtime'=>1483057713,'size'=>4763,'lines'=>array(2,1)),
'/Libs/MvcCore.php'=>array('index'=>-1,'mtime'=>1483404287,'size'=>18545,'lines'=>array(3,1)),
'/App/Views/Helpers/JsonAttr.php'=>array('index'=>-1,'mtime'=>1466032964,'size'=>610,'lines'=>array(4,1)),
'/App/Controllers/Base.php'=>array('index'=>-1,'mtime'=>1483408091,'size'=>1084,'lines'=>array(5,1)),
'/App/Views/Helpers/Js.php'=>array('index'=>-1,'mtime'=>1483405312,'size'=>17874,'lines'=>array(6,1)),
'/App/Views/Helpers/Css.php'=>array('index'=>-1,'mtime'=>1483406517,'size'=>19295,'lines'=>array(7,1)),
'/App/Controllers/Default.php'=>array('index'=>-1,'mtime'=>1482502081,'size'=>347,'lines'=>array(8,1)),
'/App/Controllers/System.php'=>array('index'=>-1,'mtime'=>1482442340,'size'=>839,'lines'=>array(9,1)),
'/index.php'=>array('index'=>-1,'mtime'=>1483222886,'size'=>139,'lines'=>array(10,1)),
'/App/Views/Layouts/front.phtml'=>array('index'=>0,'mtime'=>1483407740,'size'=>895,'store'=>'template'),
'/App/Views/Scripts/default/default.phtml'=>array('index'=>1,'mtime'=>1482502099,'size'=>36,'store'=>'template'),
'/App/Views/Scripts/default/not-found.phtml'=>array('index'=>2,'mtime'=>1456749696,'size'=>61,'store'=>'template'),
'/static/css/all.css'=>array('index'=>3,'mtime'=>1483222651,'size'=>1038,'store'=>'gzip'),
'/static/fonts/myriadwebpro/myriadwebpro-bold-webfont.eot'=>array('index'=>4,'mtime'=>1456749696,'size'=>24703,'store'=>'binary'),
'/static/fonts/myriadwebpro/myriadwebpro-bold-webfont.svg'=>array('index'=>5,'mtime'=>1456749696,'size'=>60744,'store'=>'gzip'),
'/static/fonts/myriadwebpro/myriadwebpro-bold-webfont.ttf'=>array('index'=>6,'mtime'=>1456749696,'size'=>51776,'store'=>'binary'),
'/static/fonts/myriadwebpro/myriadwebpro-bold-webfont.woff'=>array('index'=>7,'mtime'=>1456749696,'size'=>28792,'store'=>'binary'),
'/static/img/favicon.ico'=>array('index'=>8,'mtime'=>1459332216,'size'=>7886,'store'=>'binary'),
'/static/js/Front.js'=>array('index'=>9,'mtime'=>1482441664,'size'=>298,'store'=>'gzip'),
'/static/js/libs/ajax.min.js'=>array('index'=>10,'mtime'=>1482441194,'size'=>8024,'store'=>'gzip'),
'/static/js/libs/class.min.js'=>array('index'=>11,'mtime'=>1482440465,'size'=>6859,'store'=>'gzip'),
'/static/js/libs/Module.js'=>array('index'=>12,'mtime'=>1482441253,'size'=>1559,'store'=>'gzip'),
'/Var/Tmp/minified_css_63b60bfe886ccadd11024843203a4c70.css'=>array('index'=>13,'mtime'=>1483408109,'size'=>1130,'store'=>'gzip'),
'/Var/Tmp/minified_js_a4f59e9f4ad294ab8ac1c45817c33813.js'=>array('index'=>14,'mtime'=>1483408109,'size'=>195,'store'=>'gzip'),
'/Var/Tmp/minified_js_c2ba6266b78d554e1f1d5bd8285a58a4.js'=>array('index'=>15,'mtime'=>1483408109,'size'=>14903,'store'=>'gzip'),
);private static$_baseLinesCount=880;private static$_minifiedPhp=TRUE;private static$_contexts=array();private static$_closureRendering=TRUE;private static$_currentFileSource=array();public static function PrintBacktrace(){echo '<pre>';var_dump(debug_backtrace());echo '</pre>';}public static function Init(){self::$BasePath=str_replace('\\','/',__DIR__);self::$BasePathLength=mb_strlen(self::$BasePath);if(version_compare(PHP_VERSION,'5.4.0',"<")){self::$_closureRendering=FALSE;}}private static function _includeFile($path,&$context,$onceOnly,$fn=''){$path=self::NormalizePath($path);if($onceOnly&&self::_getIsFileIncluded($path))return;if(!isset(self::$Info[$path])){self::Warning('',$path,$fn);return FALSE;}else{return self::_includeFileWithRendering($path,$context,$onceOnly);}}private static function _getIsFileIncluded($path){return(isset(self::$Info[$path])&&self::$Info[$path]['included'])?TRUE:FALSE;}private static function _includeFileWithRendering($path,&$context,$onceOnly){$store=self::$Info[$path]['store'];$closureRendering=$store=='template'&&self::$_closureRendering;$result=self::_renderFile($path,$context,$onceOnly,$closureRendering,$store);if($closureRendering){return$result;}else{echo $result;return 1;}}private static function _renderFile($path,&$context,$onceOnly,$closureRendering,$store){if($closureRendering){$result=self::_callTemplateClosure($path,$context);}else{$result=self::_evalFile($path,$context,$store);}if($onceOnly)self::_setFileIsIncluded($path);return$result;}private function _callTemplateClosure($path,&$context){$templateClosure=&self::_getFileContent($path,FALSE);if(!is_null($context)){$templateClosure=$templateClosure->bindTo($context,$context);}return$templateClosure();}private function _evalFile($path,&$context,$store){if($store=='template'){$content=&self::_getStaticWithContext($path,$context,$store);}else{$content=&self::_getFileContent($path,TRUE);}self::_addContext($context);ob_start();try{eval(' ?'.'>'.$content.'<'.'?php ');}catch(Exception$e){throw$e;}self::_removeContext();return trim(ob_get_clean());}private static function _getStaticWithContext($path,$context){if(is_null($context)){$templateClosure=&self::_getFileContent($path,TRUE);$content=self::_getTemplateClosureBody($templateClosure);}else{$content=&self::_getStaticWithContextAlreadyProcessed($path);if(mb_strlen($content)===0){$templateClosure=&self::_getFileContent($path,TRUE);$content=self::_getTemplateClosureBody($templateClosure);$content=preg_replace("#([^\\\])(\\\$this)([^a-zA-Z0-9_\x7f-\xff])#im","$1".__CLASS__."::\$Context$3",$content);$index=self::$Info[$path]['index'];self::$NewContextContents[$index]=$content;}}return$content;}private static function _getTemplateClosureBody(Closure$templateClosure){$reflection=new ReflectionFunction($templateClosure);$startLine=$reflection->getStartLine()-1;$endLine=$reflection->getEndLine();$length=$endLine-$startLine;self::_setUpCurrentFileSource();$functionSource=implode('',array_slice(self::$_currentFileSource,$startLine,$length));$firstCloseTagPos=mb_strpos($functionSource,'?>')+2;$lastOpenTagPos=mb_strrpos($functionSource,'<?php');$functionBodyLength=$lastOpenTagPos-$firstCloseTagPos;$functionSource=mb_substr($functionSource,$firstCloseTagPos,$functionBodyLength);return$functionSource;}private function _setUpCurrentFileSource(){if(count(self::$_currentFileSource)===0){self::$_currentFileSource=file(__FILE__);}}private static function _getStaticWithContextAlreadyProcessed($path){$content='';if(isset(self::$Info[$path])){$index=self::$Info[$path]['index'];if(isset(self::$NewContextContents[$index])){$content=&self::$NewContextContents[$index];}}return$content;}private static function _addContext($context){self::$_contexts[]=$context;self::$Context=$context;}private static function _removeContext(){$contextsCount=count(self::$_contexts);$newContext=NULL;if($contextsCount>0){$contextsCount-=1;unset(self::$_contexts[$contextsCount]);self::$_contexts=array_values(self::$_contexts);if($contextsCount>0){$newContext=self::$_contexts[$contextsCount-1];}}self::$Context=$newContext;}private static function _setFileIsIncluded($path){if(isset(self::$Info[$path])){self::$Info[$path]['included']=1;}else{self::$Info[$path]=array('included'=>1);}}private static function _getFileContent($path,$decodeGzip=TRUE){if(!isset(self::$Info[$path]))return FALSE;$record=self::$Info[$path];$index=$record['index'];if($index==-1){return self::_getScript($record['lines']);}else{return self::_getStatic($record['store'],$index,$decodeGzip);}}private static function _getScript($lines){self::_setUpCurrentFileSource();$begin=self::$_baseLinesCount+$lines[0]-1;$end=$begin+$lines[1];$r="<?php\n";$g=self::$_minifiedPhp?"\n":"";for($i=$begin,$l=$end;$i<$l;$i+=1){$r.=$g.self::$_currentFileSource[$i];}$r.="\n?>";return$r;}private static function _getStatic($store,$index,$decodeGzip=TRUE){if($store=='template'){return self::$Contents[$index];}else if($store=='gzip'){return$decodeGzip?gzdecode(self::$Contents[$index]):self::$Contents[$index];}else if($store=='base64'){return base64_decode(self::$Contents[$index]);}else{return self::$Contents[$index];}}public static function NormalizePath($path){$path=str_replace('\\','/',$path);if(mb_strpos($path,'/./')!==FALSE){$path=str_replace('/./','/',$path);}if(mb_strpos($path,'/..')!==FALSE){while(true){$doubleDotPos=mb_strpos($path,"/..");if($doubleDotPos===FALSE){break;}else{$path1=mb_substr($path,0,$doubleDotPos);$path2=mb_substr($path,$doubleDotPos+3);$lastSlashPos=mb_strrpos($path1,'/');$path1=mb_substr($path1,0,$lastSlashPos);$path=$path1.$path2;}}}if(mb_strpos($path,self::$BasePath)===0){$path=mb_substr($path,self::$BasePathLength);}return$path;}public static function _isProtocolPath($path){return preg_match("#^([a-z]*)\://(.*)#",$path)?TRUE:FALSE;}public static function Warning($msg='',$path='',$fn=''){if(!$msg)$msg="$fn($path): failed to open stream: No such file or directory";trigger_error($msg,E_USER_WARNING);}public static function Readfile($filename,$use_include_path=FALSE,$context=NULL){if(self::_isProtocolPath($filename))return call_user_func_array('readfile',func_get_args());$path=self::NormalizePath($filename);$content=&self::_getFileContent($path,FALSE);if($content===FALSE){self::Warning('',$filename,'readfile');return FALSE;}else{return self::_readfile($content,$path);}}private static function _readfile(&$content,$path){$store=self::$Info[$path]['store'];if($store=='gzip'){if(strpos($_SERVER['HTTP_ACCEPT_ENCODING'],'gzip')!==FALSE){header('Content-Encoding: gzip');}else{$content=gzdecode($content);}}echo $content;return self::$Info[$path]['size'];}public static function FileGetContents($filename,$use_include_path=FALSE,$context=NULL,$offset=0){if(self::_isProtocolPath($filename))return call_user_func_array('file_get_contents',func_get_args());$path=self::NormalizePath($filename);$content=self::_getFileContent($path,TRUE);if($content===FALSE){self::Warning('',$filename,'file_get_contents');return FALSE;}else{return$content;}}public static function FileExists($filename){$path=self::NormalizePath($filename);return isset(self::$Info[$path]);}public static function Filemtime($filename){$path=self::NormalizePath($filename);if(!isset(self::$Info[$path])){self::Warning("filemtime(): stat failed for $filename");return FALSE;}else{return self::$Info[$path]['mtime'];}}public static function IncludeStandard($path,$context=NULL){return self::_includeFile($path,$context,FALSE,'include');}}Packager_Php_Wrapper::Init();
Packager_Php_Wrapper::$Contents[0]=function(){ ?>
<!DOCTYPE HTML><html
lang="en-US"><head><meta
charset="UTF-8" /><title><?php echo $this->Title;?> | MvcCore</title><meta
name="author" content="Tom FlÃ­dr <tomflidr(at)gmail(dot)com>" /><link
rel="shortcut icon" href="<?php echo $this->AssetUrl('/static/img/favicon.ico');?>" /><meta
name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" /><meta
name="apple-mobile-web-app-capable" content="yes" /> <?php echo $this->Css('fixedHead')->Render();?> <?php echo $this->Js('fixedHead')->Render();?></head><body> <!--[if lt IE 9]><div
class="filters"><![endif]--> <!--[if (gt IE 8)|!(IE)]><!--><div
class="no-filters"> <!--<![endif]--><div
class="master-container"> <?php echo $this->GetContent();?></div></div></body> <?php echo $this->Js('varFoot')->Render();?></html>
<?php return 1;};
Packager_Php_Wrapper::$Contents[1]=function(){ ?>
<h1><?php echo $this->Title;?></h1>
<?php return 1;};
Packager_Php_Wrapper::$Contents[2]=function(){ ?>
<h1>Oooops!</h1><p>Error 404 - requested page not found.</p>
<?php return 1;};
Packager_Php_Wrapper::$Contents[3]=<<<'PACKAGER_GZIP'
‹      ½SÍnã ¾û),e%'’Iì¶Y)P5mO½ôØÀf0h±±`\ÇòîÅv»ÍªÝc‚¾ŸAÃ­´ÉK8FqoÇZ›&ƒÓ\Ü[#6e½+içÌ2¹Þ·ª¡T6þ…J{rsç=àÓ˜Ûxä¨ËÍHå7õÄÑCÑ:ûÏ—„ýxo“‹÷7aý)©ýBƒÔ‡dªv5ÇeuB€ ¶…‡’U:¹Ç÷¸é­”ï•ÿõ1¿[ñ³2º~¦pÿ\Íê‹³6û02§?z²])¤#ÅYÔã`€6#Æ°èE
k“VÇš»J74cç-}”Lú æ‚ažzÞxâÁiÉŒn€¨Y%_o¡ž^¿ Í¯Ú+xù§r¶k]ìv;vŠÖ¥îŽÓœ¡c5÷Ž”Ì¥;žã¤”¬×½Ê²ÀÙr!tSÑ<ìßoC<æZVX'“ãBwž^ŽìxÅ…íigq¾W]Uðe–Nsý{õ•…XåïÏq ìŸüô
qûÝ  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[4]=<<<'PACKAGER_BIN'
`  Ÿ_        ¼   LP/  €J  P        “       M¢~§                   M y r i a d   W e b   P r o    B o l d    V e r s i o n   0 0 1 . 0 1 4   & M y r i a d   W e b   P r o   B o l d     BSGP                 €8 ;ú ;þ 2ÍéŠÈxZWÉh[qJx"cºr,g,E÷&÷C‚ÜÄ¾Šöôü”¯@ž)Ø¨ÀY‹º‹PjlP¬6k]Mµ17 þ¸2žk=ùães<\Ü‹Q‰¡ÑVðÍ†–“3¨£€üqŽbÍØñUòLõ
îk•Hž£FŽ"Æ„Ùh×%Úæ» ë…*à”WjÐ0´¹$¹×nšä¨¾¤8ýÉ×Ì„ñÈ›	XoÒ©÷S4÷½†s¾´ù—øÞ{þ²Ô‹SU¼löl“¼“I½l—¡ü?&b‹n:ÀùŠ-ü7#Kð&ÏõTû4}ç¼ÌÂ‚âl%;`â[CÑX{Sé¹ƒ\²È(—5°’BóÉà[È9+±J
„ `ÙBüiq`+EZˆ`ìVÕå¥ãÍbæÛ	”‘@t“¤U2ÆŽÆ¯BÔ1G˜žH/òÁcþ^Gãš0|òíŠé‹ÓâÀ–"iîÔ²ÏT¢íPÊ­	<w$ec¡ŽÉ©´xöéíþ"km,¥‘u…k;ùMxZú¤¾ÞÕ BôË Ï&oäNF» õ {ë-Uo/¿¹GáÍ1ÇŽó›N.x»ÚîýÎ—ÙCíg•˜$"Hd˜d¨'"N—5Íþ‡C:QÃ…Kh@³L:Žl4ùß0*NWó9+Í29Å)m:MÎ›”¬IÌ©,\£8¥´+h{¥åkˆ‡ˆÊ¾-\IFª"½ÐGæ<[Ä±¯ZÑŸ[*‘‚YûòX!ó³7Îè}çµ0HÓRFRf
Ï!®;Ff¨ªš¢¶EýKà·áî°‘ž+“ÆkpSlX$ÜEÇi)Å¤žD ŠL¹oÉõ‚€}rÂ0­0’Þ9ØJrf Ë_Ë_S”^£(ýF\áãë1Xe¥ÿ!‘åañ%³NLÜ’ 96‘KäÑFø´Ù´žÜª=åEK<^ð4bŠOÔ–w),=AB[4À’˜,4À$?„.
`,aÌÉzwËÑ›’W&<ÌOÈe­9a± 	zºþÜŒcÇ`_8É‰Æ/žã,Î™Ü´ÎüEäÑŸ>n¸Øe×çFªì€ßÉtlF®EMÇ‡èå°ýÖ‰Õ/ËÇtðÓ˜œxÜä‰…Æüfã
À¤S¥
`Uä…¡‡ÐËÙž‰šM*äÌ%¤{°ŒŽ]t2>Vs” Ö”24Í$™\N\mœËAÄ§_¢$ 1íÓ<•’Eª&!LX	ƒ`MT ¶5J†‚HÜ	Ã˜×ŽÞ¿½	PHtÁ!@ ë¡éÛÌ@o¹ë;-ÏVÝû´¿SÃD¼)¦
¹xÒ`)•ÄÒ…Žw±…UœºÕ…yòµ^+y YíómO@N52ÖÑ~¸`Uå+Ð)j¯=CM`¯"’|c]ñ‹ž Ùâ%¯s"$@3€taÉÌiZ¤û 0zã>‰0"”2_†XÌ2Û¡Žàáô+ÁÍN| á†
ÐCm¡”1œ…Ýð“ü°Ô•
²T¡yÖ¢ÿØ£hƒ—&#,Q3 p{ÞY9¡ýóqk1&G›HÆ—ÔŠØ3ÎdÏ¥ÊsDÝõÍ'œ¯òn´‹UÖ:ÁU©²m‰.=Œ,Ã&YÀ®:’f)ÛQÃ÷c¼y2ÌJ¬ß1ËC¢a°„±1»•i?72"d–|Ò4”õb‹ØcX*¤à±Ø“ÖÓ'ê»ÜPIÕTìT²…’Á‹ ”ßÑ0:Ç„7áC~$™	w&ŽßÕš•*U/p§£w{$Â9„ð‹¤
täŽ3‘À+ëŸUÍUGN
œ^-2
ApŸI;ËL˜Må‡"PC@gÒJY§Yà–Û\pë²î†¤”Œ1Èä²Š”cšòD-F¦ÙUHz>|ÄŠ„Ô:âj¸­¤üºoš)&@‚2§zTz(´åHBµ‹p«Œ÷\n1iÅ³j æÙ
l’µaz®ÏÖ~ô©t=·R%1ÙTÃÇ‹U-p¡kEª#0$Æá)gió;íDv"½Å/{ÀQ5¤´À£Ô¦È§‰Ã>5§É-*´ŸÇ®iA]N@òÈ±DV)UÇËZ¬•²„j}²UlC0÷aXæ©Rš¨Ç;2Xùg”µÞÍþÎ€Ø‚JÐFhÐHA5Ë3_UÐÐÚÎò‹`pÚñ†Ši¤3ZCÒ
6ÙZÂû/hþ´ÐM´dÊŒ/¤6*]›ßfJR«ÄÿlMHÿ'¤X	Ÿ0Ì!%÷$fOãbÐt‰©OL´Ç)¤/u=”“öæTt8Žn$@rC»R+•‰–‘Æe£ð`C
!EB0Œ.$ÇàÞ9“c
 jYwQ€iòÅ(ñ¡.Lh@c€ªê©”LÀ<ãI@cšŽ 'W­G‹æ ±ÅÊl¤ãþæ.Ÿ_}$Šxx#£5{¸R½?Ús÷8P÷ s(y$­$(ÜîÕQšÅ€Šw7„z£#Û›.¶›&ÅÐïknMíÝ+oÊb.i±ì´õõuêZ¨†”µH9Ý­º¥€hƒ<9%¸`KªÝã™^ºL¥¼zF:™/šYž”oíÛû>Êƒ'%Ñ€¸¦ý"Ý©g~±ÕW¶ˆR	0l²;7ßŒ,*:=ñ°ùÏ“»‘}N;×í8æf#FyLÇXö/3¾¾ŸlT' ÉÀÛjlåô0Æd’iWýqC%Ùû¨¼b¹‹>ø²4°šŒ+Q=ë‹nÙjê9ÔXîú	øä&›lMJ¶è>‚¬@—¡æµ‚¬]C.êçbÛð¤:BK-¢ŒÎXº4Acnd;a?´â4ôpfš7ã#½îÉbBD'Ó;VS(j· Õ]%É/ü±ñ`èþXLqLãƒs…9D@ˆ‰…	Ã!O2#\zíô"FÚ$†€bÍœ"cèA0ÈÄ‘TÑƒaSø$
ŸmèTú˜}—û}ûð¾³í?;à_Ô`–UÀ^u\é¿ƒ½»C F½2d£&ì2ÜŸnªTHê>©„*‚êEÈ3ÄÒ€¬l‚åumŠ•˜%Î`C‚Êˆ@µÁdEV´^•ÐdB¢ˆÕpþp|5K ÊûQ3Gèâ£½Í(§ÿ†®VÿHrl‚;™Ôu;	Â(c¶ h„ÂH•Fv„hJn¢¤2eM¦¨YøE
©¥j …ê‘„ÿ©h„©Ý+ÅIÃ™Ê”ˆæÍÁÒ“_C:i?ùC8Šd1õ¡‘Ñõ{ô5OÎÖ§ßÑMªBè½O‡ä+òz‡5gJ±F©4»2™tù©šRü(ÍYˆ0	ê1N1óªøªj— ÜÍ£éøÿV‡-!øjj:®®¬õòŠÔ&µmN°§Œs`ÚSÔÆ}‡Vj6ÁKã
˜k›ë”Ú³&ž¨©NíöÃ&U¶	v+Cç¥¸W ¡së!fßj‹`{ÿ‚-[pR°¶­cŒ'Ö@‘ÙèŒëZú“kè‰5TÇ±ùTÖ8ò‰ÍM !¿¾Iœï(ûJêÜ{”ÉÙÈŠø1Ð1½äk®‡Œ)®ðìÕ7›™cÓ™A~´BËP?9ª~Š.{ä!†€ûÅçˆ[E4›'NJK„hA‘#•L·pÀ)ETBŸqå¶3e3#¤ˆ£K¤sæšbôv(p~âSÓelì&JÒ›Œ†;}gµ,Œ\t`-S–ƒ¶PÎÒ™9ÝF	˜ÉÉ0ÞRöËÜ	É%gªö0ÿD™UQ@»¦ìÊCCK4ùpÂÑ¥0^£VFÙm„‰HRÅe>îÏº³B­¯MÚò¨‰´˜JO:MŠPÙwëšQ¢_.ø´az1e’æÐöa@Ã`–ÃT‚æ›ðU´Úµòª`Õ­eÚNmz2¶$»é³©<4ÕÆ”êÊ¶•°zZ$ºÿO•K¦ðjÇ’á±2AàÂÒ }}`Ó¬Œ8¢,ºï¸H#° ¶õ¡B£NM4Á»~UäJâ–“W½bÁ€¶)è˜”¤±ŒÐ×õ/˜®*á£Ô>Lný£©‰qVQÃ‘çF¾Ma_æ”¶-ƒh5'HÅYp÷4Â)!Æ÷[?Þäçðwà·¬CŠåè/<×Âr+#Éj7 ÷@4²¹ÃQÞžAä(*	­X3bÊ`oTßÑxU£Ad}q½0‡+lk6N…
Ôœ)§Àã'¾Ç“ÚØ‡Â™åÄHfˆÊõhfû!6Ò|²ÖÄ›éä.(¿½Ÿ°îæ‡©¶ËØ¬IÁŸN–²uÀv ‰D‰
”_*"u@!öÏl#3ó%/e'ÕC8g›YH,2S;*HKºk“ªHY ä³î©¨5$uÁDÉešîêVäH#Ó‘X5Ði\! m’=«‰¢ŠŠRBÎÚ›‘!¹j„ %GÜl»XuâÒ©°AdÀ&^ Q(cE™Áp‡‘aQKà@!÷"‘3'„;qEEááÇ¸Ua”öR­”2§1=_N°0E*ò6t8ET` ¯ÅÌ7¸5/p‹…¡–a(u 6¡üÏ2áâêÐR‘‘soMaƒ X>o‘¬‘ÉÀ
3ÈÜ'Ô¤A¸fn²?I?°-c‘4AÄ~¨“¤Ô	¶NFì,Áñªš‚9ŽÀtëR¼=†”VŽ;˜)š,n¢©tS¦-ºxê]NU›]z´ÒUÊz¶¤;
ÊZë)TyÐR½LîFõ(ºÆíIÃJÊ¾4ŽQZQQdHù)ß;µåLž‡€â•hÜý ÙRÀm3Ò˜õ²_Ff5ÙHù>ª2«ÉðÖ¡õì÷xÊÇ ÝSµ9ùú?m›jÅ¶Ÿv—MþB»e@¦”º­ß¢þ&¾¦¸[*#OFÑ¤zÎGTr§	4CƒSÙ½ï}R5©O.§¡0¤.Ú ¹·cÅlUÁR£7N±ÈƒÊD©­åÒ–R„Êe;5¶ˆÉeã½Ê›NYÒ$B…—1àÄ›¼'ú®Õhm'lyT>ªÇxÃgð$¡¥HË‰·•Z oCÊ@–HºaOÈê‚ÔäÊ™°ûTÆžË¢„ÍµxÕ¸LÃÇoz¨ª‘f¯È,ñˆ¤I•±E2!Ù&|p„P,ÝÚo5ö$µi“ÊÇóéŽÄ#ŽœVÉ=•ßÉbéý@¦¸º&WÚ‰Åohmø€=u<}>óÛ·ÓsCI…Ô î²¼Ù ¼VÎ”õds”ƒžžë«ïlajEj»XP³÷]Uvj‰CÒ5.ô1Ð¨@—!pàÖØMò#«‡MŽ#ŒA†tÀÎÃ©ÖYÂÌS?P¾Þ|á)ëT`rP:nÑÀÀ\/©þÏë}bÕÝ#rzvÓ´Ä#ãá“„WÀûAäáRs¨âÆ±ŽbŽÓöØ¾Åmd.¬[ è%Ìh¿â½¢™÷gÖày @3Méy\3çí8BÞ§V–§…¼²l=çpqâúÜíž 0-CŠ›-Ý£‡Ä>¯Á¬ÔÈÃøL)b @Û<)4wÌlÄ?VD3>‘{ÌW´cN–æÉÊnQG€4"¬õÂ	ƒ³)ePB®Ñ”ÛN:"Ú¬JÆd1ä6¿ïÇO™§#P¤÷ÄlLÞk½E;ã"9kª½Ls@ütt^R+1Že|¹™¤Åì_pg§èëî*¬¤<<¡íMa/³2µ’ÎÎ!3—þ¦›Hë¥YÙ¾Å& lüXvüd)_®Ø:BÄ½äVUÕPâÛËX²mñà‹g{ºôöu„¢ÇÎsœ©òùŸ‘êz¥Z¾œÔ[6“ôo¤ ˆ=r-Èñn~+HÂ×§'‘j£lÔýNVp¬†>¯ÆKá¾îí§Ó-Ì4ƒ’t<w@Ôpl®÷Ô«ù›‡¯kO{Íî!Þ)*„"…hË &z›…6	Ôç‹æhËò\Jî¯LÙÅ‡Åa®8“Uõ EŸz¢ %ÀÄ†à«%s’X³˜‚c‚ÆdûßVj^57ì?o˜‰×Æ§ }4é,Kz>“ûpªŒ°¢ˆ
Üê¤ã«%Šõ;ëÂ†§ùK•ˆ ~2
@˜Ç[@>8äl xhe¬Pµa!

·êv§^ÙÒU%Î&]îH6þ@Ç
ãJŽp´HTì!Ï@vê¨—(vË7zÊê¦7L$@[ïÕ#ñ9Š“ð’Ð ¥™¶#Ó>×?B
›ùªú}íP(#¾z¿;V_ë–Ñ£Ä¹þÌ>ÄnU$#«™_ÑN&Ñ€mGG¿äH làZO¥ÕK <þÚÍ-ºî\˜#|\¡0uÈ%ÛÍí‹ø¥Ì‰qº!	HÀX86p[›ÜPv”~œÅ@¥ÂË‹°¸ýè3c+¿m(ƒë'¸ðIw  g!Ú]LAjfÖ®E'ñ|s» ›ÉàÃ¬ââOb¨x1`¿—kn‡î À…%i±ÐéP}ž•Î}ò™oÏ‹F9l¡œ£,ÌßA‡74¦-p!sìÝoÂ>Ãd÷ES²µbQS· gŸÞ2iB`WW•úv¹#À‘>KT•¤œ€a)"¥ê ºY¹phn•$ÜPÀ<7<©´Áž$Ý,GöåŒÃ¾œß¡D4è„$T
`}úB‡/fí¡áÁ¸MËE\€kÇRoH+C$~Ð(Ž›‚ûÝÀñ#IOÐì¢–ôeÜ5È{Ð«ðD¸wt×1M|äêÀ™\¶‹5ÊXŽŠÉQƒô|ºdÅM¡
»q(gá%Ñ—t0:;[Wv½qZ’Ú‚q]Áé8VF]4CjFAyŠPš#ì7½:Àmm>„H±¢P·ïc‚Uv©®ÈØž8\Ò‹a£BŸ”—aúì?™òˆc QàF£á“, ûMMŽá~ë)õJÝÿ+ß$k·dƒu#Äýú>n83ºÙQµ·“†JUKl5ø£È¿nË OpÕ!m06°Žn3\’ë:°[zË–ë=.òLTÄ‘!b.³ôæçXK¢ “Â`“L+cþæº.õ@NîÐ e&T*=Ÿ¡´YiŒÐ^b;Q¥Æ%' <.zÒMË¥‰íùþÝÚíq	rŠ«Kéã=ˆuŠD·\€B»£HÒI½þPÇˆ1qX@ªgÓ’¤ßGü¤<b÷ˆÓÁH(ð·*Êf&Á@k‘Ù	Êî·¨â¼D¾)Ö´²×éSèóx¤áƒ1WîàB2ÂY6ÏÐU¥ÉÞt«<’öÆG¾&’	,è×`GX
g)R?D~¢Ü<-Óv,TSˆ‚·!›†1ÂuëF4ºpc!8¯;[S†’™œfµÛölˆöC°ÄVp>AºZ£	eøïYæñ‘NÎÔïáÕ-·Ú¦Nü30’æ¬bP!`á‡‰66c	æÆj¯Cšãàc¥¼œôÐÄÉ×@ÿÿ—l‰1ºSâ &phW6¶À[¼SuY+±0¤’u£Ó˜¾+ÛÈq\¢åóèƒzœ„ñpÏUbÄ `×¥PÏŒ(°3'míìËæÖ*þPzh›—tÕ5Ö©&²Ñö–Ž¢´JÁ°Hª»ß?ô•µ&:H‰¹äKhªò˜öZ¦œ:[cïöÿZç¦Š(d]¼¿æÞãûê^Ì½/ô²ÜóôåÁ¢Ÿ#N(n	E›ø„`š#«IKEû5±‹Ð£¿^8¹a"~€Ü…( ëä‚ôšÁ®fï”æÄ/œÏç¾PÌ.;å{`£T­ è
¨8]žÀž‹–PÂ¢ÀD;U+6$U -Á°s°8!X#àŠè·j¯ðz¸&®=¡é%qYþdò«h:wæ[’Ò¤bÑ Š =â&dÏùÃœåáð¡k	Õò'jR‹Ôˆ' +ÊÖÖä{Â´©”!~ÆÜ´Cdz¤µ	Öjˆ±Â„ÅCiYqÅ~î3‚hÖÐr#h\$zPË)¥áñ¨[ïù¾RñÚQ¸H Ž¢>ÞÜ[žQÿõDr¾éºðÆ¦H/Bu
k€&Š·5êŒ¡»*,•šÉ÷EZ«µÃƒµÝ|
µEÇ‹’M†%ÖwÝ–c8íÕäEÆ2t¢(c‚ÄëS]á"Ô6|Æ?½ÔJ‚†ÁCCB`ê‡H¾áNÖ&Wöù>}tJÿ*]ñÂ rqI†äaÈê&ð›ÄiLûÅíúd‘¢ªNä_³Y:š(&]È­t‹T£è'0B§ª_N9¨Wµ*±—¡Ô/<4„3»v“DöVÕiuÞÐÛãT)s%÷ÅñeCÈ½º©›öâ
0
ü°¹†°êE«ÆÊH÷Ú¾E@½R)obÔ‚}–ZwìÔdžÉmJòö“üE]Á7£…
ÓP@…è! m‚Ž~öJ°Ý£lÎ±¢_mu‡/s{Sd[‰óClèÔ@pÜ-™èC±s[Kh%‰åh¹òè+­(nA<AÚ²|Ïhxò5L]ä	ƒKûy`IÍ?—éÙ¤‡PfÌà Âfåú[ÏÂÛ¬öêjoÄïŸ×Ð\~·¸/¸l–‘H[»»g%ÚNé¬‡†íoT}ÃNQ¹­G²-˜²î¼vs‚ý±}ìgoü^Blrqò¸rš–ëm“6mš„Î-f7ß&èÜŽ›}jÉ¯ÛüV¢QþVòu’X<Œàe- 0”1FmÅãdÖ³tðow3Ë:6˜Øñr¶tÑ-È-¬SüZv÷ïDYÛ‚KžçÐ«çP!¡øz¿v'q0Æ‰ Q{qdÁùÇvç
MTÂ-d‘~£er½ÉŽ_‹ûaPAàç×ônðÇeòßoóÒt·C'ù×˜»QÇ8Ì^²œÏé+Í¤cµ5°÷EàÄï•W0®ÑˆFq¬m(!’mv…j„pØ‡Dœ&¹Š†”¢X‘:Ñ®ee6QýÇ¿¤CTCbj&Zq«dšÏD9¼h“G0½ôÈb€úCóY"îh"öJ °ãýcù¸Žä¡kéº&~®•’`S–ó¶Ò¥LhŠ¦=ÀyÈoÖ¸ÔL˜‡¿b¥˜…ÝžË¼ûCôŠÊ/¢Y Â€çZ¥>ªñm¹Mñœ,­P}¡
ž"úé}¿Ž‚­ ÁŸ†µZ	A­ùÌapä?¿+ ½\8w[eÐŠÆl!¸uÛ"-†CÝ¹ÃÂ>^Gàþ¶f:Á‹ÕsS¯ÑèmT—óý.ÆÄ•ywóux¡H3‡´–·¸ƒù3ÒVEã»¤­“º”â¡*"œ©÷!@þK±øä·xBñsò€
xòpÆ×RÒ{g~!9÷,êmžhÛn ‚"pqÇâ;¼†ÌUÌ’qâx\A™0ŠžU÷ Yàö± &yËŒ' Ñ%e¯¢T;ú•OÐåâT<:&0,¼|€YN¤A œaÈdŽBŸâo-eA¾ D ¯À)eMxUv{1^Ø3ÉÛß`tH(í,‡í7­ÿô]Þ6¸ô‚]-+‚ÂM³Li »¡;w¡qÕä	ƒ7¥'æÁ=dJMNmG„B`§¤¶}µÌ”±$ê0Ür`÷&w(Éïs¥÷Gâ§€f-Sé¹ÒS°nž¢-)jÐH N-°¿}žõ•8¯>CÍº‰³’Y*ž¡ÌÀGs¾4©Yæ…†qó?@Å[@°þ@åü=Š>Y\_[äÆº×¯2Š)³Qû^{^­K¶ok®S¯<|	<I°ðiËÁÊ}¾Èà#ê¬ŒC6ÁYÞw®^H‰L8‹HôO#6¥·•gPÙÆ H±)B}¼'–Î»£K8µC™²eƒd}5lgf¹¤œÑbIß¸?3Éà†é*Æ3Ï2§Ò0ÇßÝæ—‰œÇ¥nÑˆn…§|ÔqqNƒ”Cƒ¦ù!?û.0ÿ½º¬Ñ…+¨–`GlxËàóz†€ø0)¼Võú€½™ãW¤]Œ°ˆÈˆ‹‹…¢F	4xÞ0»#ÙP¥áo‚4È†n¤EÚZÅšóXPƒ€/z±d"ÅXÈHT4talÁó* 4ù‚E14l—†Á±}R‘DAá5°e p”•,Ä¿çÃQwYîXÚ¯èç¹0 ˆ b°ê ÎÊÆI‰÷ôè©WbÛù	CÌuZÐ%eàVú`¢¨ ÄAbH ;XÄzXù2b£àë€ëŠŒö\Â}S:€ý"ÿÅ4à1xBáÒZ£2±.,O>K›ñ_ü§’á5Û²V
b<ÅT7ßéYî(¥¤|½äJWˆ@uTþï‘UqÑ®ÒÁ–œ“iäµj›v
Â ò:jýˆJÏêól>Ñ"íÆÁ`¶­Ï)KÅë¥«VœÇ¬ª¯C&$r+˜;ˆÁID»¶7"op*bZDºØó¢¹b]Ž!Ñ!éás·’£LQ²L%‚€ÅØ+ŽCL)BŠ°¡¢ø¦O=”-eŸ:FS0Ô
Ÿ!€‡	Ýx¦iìÜeµÚo‹ÑãÞäJ¨ï˜§n!ˆOT{*×	ÿXcª§…Ö# ùŠi¾$ÉO0´c­3ëþþ/ãŸ§aN¬yµf„…Üˆâ` x|éA¥_ÃZç„Ä§DªÀøu˜Ñ'¿=²W0óTõ"GÙØ„D9ˆÚÐù¬Ý	n-L×QâÑ—ã/Éóì•‡O*~Çi‚W-iX´S¿†š±þO¨¸*ð§`m—dn®M˜$YœŒ%„å±¡¡ ôáNÏœHé¨œ]Da Mƒ;-vK‚`sŸ=›dí…i‘;§óÔ8ðs–‡r±Ã_t§lp¦©E¤§Õô~ÛMR‚€p^qò@[­	ejFç-ixöLi€VNnÏ#¥b2ËõTWÈ CC"<Ö ñŒa8&€ˆO„^7†„êÉÝË‚0`Õ@|C˜)Êª/†
žC•aï”©6TÆ™l$Óƒ•Ëz º0““3Öö„µ™«€jpo, N¸jþ-µ8ñÝø´þ,!<BgQ¤ÅñJ¶r‚ñ<J&´îÚ¸lrY±ª4Á„9vj
E!É-ã´&Tp!Ú‰ÌÊ®Î¤tmfætòJ	Q$C^1dølÖj0(ÊÛ^ožmœ^ìU—š·ªÕøõÖ„öy¢1ÚÜÔÀ›Ô°	%j†E†·îu¿T¡*À:&eš=H¢áI¦†ÎcœIH¢–MFað¥)%L iÎ§‘I6ÆÃ‡‚Up_2ƒLÀ¾™¥F',šBÓh‹ÅOU}«Ä÷ðÇí@®E§¢ÐHš²Y7Ãhæ‹à¿aÖ×`Ná)O±3´ëO[‚oi0ŠœÐvú5úu$~£
®®¥XÏ8š«)¡lš•›B°`„HhìZ„DFZ¬uh†8*m†ÆÌoâØfJÒltŸ-l¹|XÂfqyÅkµ¢×¯Q›–jNOR´rB–”éeh€…IŠH¸°²óÍ˜RƒÍ&ºb@¡sV²º9"â¼J…3X}Ú¸´qÜ©nlVXÁ2>€’'º¿`	Ø˜b`ÅfØbÈK™?M(±AlÅ¬î„fŸ jª±@šåp’)‰ä L5XœtÛ\Æýs×  –OÁ©|aËãÀ{NäG@M8›ä¤Ñ6)—
¾€™Ê8è½¹Õ"°ØKEKÅH®o‹:5]hrÙ¯&Þà|hÉ$Czë^Qµªfì,+TÄnõ€Ó«åUN4ôôÃº XÜâ F‹qí>ÂÓ`[*Ÿ×áÐfÖjKkª|Õ=•ÍA2ÙBi€ïÍx8zóÄÍFËÄ-|}e1µRð$­´¨ïX9Ãx#yXRåpý š¯©!-1qÀûuXš¬¢ØðÄZÒ´[/œÒ¥,X·ú kŠ^Àe…ÌîjÆ{öÌVþV1`ºÃ™Ù’úO.¼ÝÒþößeWÍ³jÂ0 äÜ³#v€ä`ÀÓCñû&µâ¬¢¢™¢ŸV»k°î ž ª,>ÑJ~‚0Ê…òˆ)…ü€›ŽÎÔdÞœ›´@µT.€ ›m.Á@.è¾bc†¼š	Ñ™GÒ8æ[vƒ:1ÇR¨ Jqˆ±íX:D#&(à›Ùqœ8?‡Êt+mCíó­›fõ|4¤q¶å\¢ûw;íà +Z“\Ú™ó)ŠTîpÅ @'gS2ph›>ä¾ì©™¼¸¼¥’QÀÀ0²0ÎÉBÉé]‚Â-D'¿bå /í¤3?üˆ‰æKÊƒ°MmœODDH˜¹¬$>S4NYèôÆé‰×£Äry	‹Ìßê?Ð£¸5Û7ŸLZFŒ`Œ˜Pükª2c&ÝŒ¹R¢ÂºÕ»2£ú€¯Ö`L3«W7£Ò=tÆÃQùŽv#P¶ßi£Ñl†°¯ÿ‹y~þíÅòÀéâ–Ò¨"Ò™²'¿`J:ÃÉ¤Õ5gtêº}tð¸7†gêÿB±N.%`üˆ–Ç(]Zzã˜5tÝÝbO³øÙ£éîÇ(ýþ+aŠÿÔÖ®>š¨Œ°„ÕnÌp'uc^tj¦’À©=æuãë+¼Md±†v{1'Š¤©)ˆkúî¼ÊÛXX
ºéåXçÈØÑH¡½©›#Âz’
=ùñ€ÈýjA G8A@Q|C xØ"­:=µYu_NƒâÂÄ¡´GiãSÃÌ©Å°Ñn¦Ç‰ØèÑjJJ§Wðük»‰:[GãM$‹ÈúìÍ»~Ô‘&Ôë'É(¯G k‘?ºPà–yîIÛ£³Á§VƒÝ$y¥†ÙccÚ¥\rcØÓFyR²ì˜¿Ž^¥’ßÆéŒj·kÈ›ÿ½¶ÂqPì/íê
Ûáz9'ipÅµr-¨Ãã!|vf%¬1C*3‡¯À-[ƒ4À&¿èÆ«Ý	uÇ¦X.áE)•¡xJ[žmˆiôœ}†‚•p¯r•ÿ_ô½n“öQ|ßöñJ©°‹	¹¨JÜ9šw4G;ê*/¬ü÷b‰:éHµŽt7Þ¡™ô=Œ²Y 1 Ûù±uÍ¡Ê/ÛéP‚mÕ“Ô&Þ”ÿx±
u”îŸIçG>˜a‰Û›X Ö¢‚d’o³Î4I¢ãùï¤àC+KæÃ¶šøÌ‚õ0m˜Ô2~,idˆ¥ Î ²ìÈ˜Õ¢š²%me³¶Fb©Ç“E¬ˆyM‰ÃKØ——4Ðix¡<Â'õÚËvÅé07£)¢,œKPFü®-Xdhô0	Ž)‡4P³Ž,VOsqBIh,UØ­Ö\éôŒ©õ=“6u´€$Ûl°í%AE†”sC9·Å`-!£Ò#Ö	“©?˜¤~[.›pa"ýi)@Ù²Ã/õ®Êtb”ÉWfÊ!ûx>Ò]:7¯¾›ßžÐC¸o"7#Í0Ã®Y'=Õ¡³‡£ªÙ'Â³SCl‚—€{ µúKÆ)ˆ¼½ÚãFÖb•ÑËAQ’Â~Šk	h°K
3+*b£°¨öa¦!¤›Ÿja:Ò8QÕü"óæ4IµÖäÙ•4JçŽ^G²0-ê5¾÷Ýk6ªäkºˆ€þ7RøÆ·zjÇrÊ ,˜iö£Ô
'J„B©k^TèòÞË ˆ3Õ$0ý‚gHÐø$.z]O<R89P¢÷p³núô%BÒ…¡”HÔ<9õñà;~ûƒ¢‹Ià<¢tø3”­î¬Ø  	·‚ºço”Þ É--Ó\O¥ ·ûË®oD&0TúÆ]@¯­@OŸÓ²PòAT‚Ì­8ø	†ÅÉ®7ntëKo–þÕúxIÒ×tÑû×’ÄnKè¢â€–ÁçFìœô%=óñ•j\ü*úcÀTÃ¬ÝÂ„"'5°gdÑá©|EÀÛàdyô‚{ëëK&ÐùšŸ¬Ý¸&’ôÜ½fò^ÄBRç	¾„A/M\ÿäë˜z1DhBØœ¾´ã9³‰-ãÏ&z)ø[J~¤ªr2‚˜Â–ž”øú‹ KŽbN!hšY]ádxÌ 3 šÖ_%j^ð7Ãý_zÏE·€)î³‚â ~ç
3a6>:ˆpœÏŠ@þôN«Ÿ#@÷GC-¸(j‰«ŸÏDØç¦tð;£r¸ÿ……Zq’!€H ðG ¯¯ÄàSµJšnÈ~Újj¾DÜÙ¯Šnš¢¼Ê”»êâPv3PÖÚWdµ¯t1\fÊã° Ö¶êò”äki×pýM¢/%Ü]…;ÕÂ@UfPí´65é:ý‰Â ŸpË´ÈÀí°ÝQ*CÝð rŠ9­é}ŸŽ}ä~kÁæ²¯C)aBáÜŠ\D»É6ýC–b?:ñ?³ ~;•Ú&‡¢H_IÎ<ªXbËä–I¹$`‰EÈÑA#ô†(ÊÅB”¥GßËuSÚXJ/´^ð¨‚ Ã4 ‡Wò89üg#îU—²DG²i)s‹TàubNë‹íÅ/ŒTÊfñž(È“ÆïS8câ‡Âîš;6/*a®ì¸Ëÿí €H˜pÉˆ†£)ÚÇüRÀH]…ïbòfÈ¡‰
ø+tuÍé‘¶j±x&ëÃ\9nÖIí#Aå@ˆNáË¿…",zÁ8Ö=ÿW*ws	ð>®ªÈ'ê9’Ø$Ø%¤S›Žæiý3œ@š |ûÖeb¸JBžXŽvkŠˆ±Ç´¤ôþ²¥;¯!¨›Ò-2{h”k“fN{Ézß’_NW©”£7,^m`¡È@Fë´ZÑë_uMPê·‰,AöÈ	QR‘B&T	Nø©%RCl#ãÔûÚ Ý‘e,´Â-†º¿Ò¤É,GR-Ñ2‚`¼µÑY<Íï¦/ì;¹-CòB»b!×\Ov|ƒbÒ$€íµH
Eæ1¥ž ËÍ“<-l¢#ÿ `Ó93¿ãkÈ¬ïp¤xÓE@¢÷Ñü¿²-ë±¯`$UòÎ• ˜DÒ},àhCJÖŒYË+£ž•À
\«šÕfù¯4!Os@"¹(±{pöºŒ*0Z¬‘àvS€$ÃNÐá-Ñ‘öõZ²UjŽ&X&™¯—°,{m‚*Ë:Ûì'<„HUjôÌ
mô1ÿ8²RŸgYï©ký½©Ò` ¦Î ]š£­()ðE79ñŠgÌàüXÑóø_œ…ßcH¤‘o¹¤…Ý k¨y° Œ)á×ˆõ¹Àðñ =àYX™R°†©ÀêÜP‹œ]ÀðÀžžQêÅcgE²–;O¡Á¿‹<ý?š–úfãßÀpR‡w·iÐ¶DAhjÝ&ëEØùÈo‡¢„rþŠê¢©Å†¹Ð@¯×ËwE°2sèQóÿ¢$eÊ;0%Úa‚yæ«4¼LâiþUæUÕÁªÕžŸ5~¼êÒð¶{{÷„t¨ÐU,…*³eÿŽÇI¡©Èñº åÞœCÞfÞ{bã&Š]Å&ãJÿx‹‹m^§Á²—ön~šõƒ™KrG@£¥›É·Õþß_3è³½¯.öë0Â 1Ñ’åÏijx< Ì¦hbÉÌGqì+ŒéþL˜‰§Cm’'&×
ç	óf™s¹†÷ÀqiÄnŠ|rsàF(x‹èL(m¤Iüšæ–5Èšßv˜8¨ãgìLÍñäÂ,Òý$	Ði•**…åZ4šFÐ'PÖ6ÎiRálK'jŸÛJ]q„ÈWÖø+1É|ƒ	°¥æ!w<°ž)†4×Å0°œÊÃE@*ç/+©¢œô±è–ÅüŸÔËˆ§85…«u¯õ¤&æÆ›ßkH÷2¤2—äÌd=õ³kH- s8ß(ê WZ åh{`T—D–} RúF—ð’î@XÂŸèžº‘L'i#¡`>¢ú ã‚Ð!_ýyÙ$¼Åò¯^á ÁaÚíƒ?˜ŸJM¯ ƒT†9œ7AS?H_#‹À‡Ò"sK
ˆïN!d8ÁžÒ#¹ó¸òãPIÀ¡@ð¬*¨
$Æ ˜‘FE«˜NIBþöq3¶Qd`á¹”V„ê”„2/±B¯kÀ­ýÅ±&—1²’bâ4ÍUt: ÌI4¤ðåúýV-Íø‚
ö=6¨Fjà"ÌiQÇ­òqNMtn@”ÐºÃ+¨_ 
ùÉ÷’‹£æ$Ü–qÙzö7¬j¢[þ­Ù9ý›Âðÿ4î)´+lœSá4M“óˆÍUæŸÝ)WÅ#Žh6¢•SË&Ía™–jßß<\FmoŸ#ÍÜáÞáC.0D…
qß_•ÒVa·˜¤	‡sÄ9msyF*VâNn0/dC/gmÑˆd8¬¦F¤é„Š”K,mƒHËi@ñ	)üQ»µ<™A°Â‹Tq4ÔBHa`ñhË±m 
o”ŠBœ	*Ä~J»h¡LPt0Êì¶8•–±9Ê3½˜SâÑÀXR­éôh2N¢%.›Ñí¯"ø(ÈoÃ]/%›…âŽLÑ\äLìaIŸœÒ"±am)k2JnFW©)Lü	fãâÜG({zµ2LúHn„5©•Hå
ø \Ñsêu*äD^X™EÍ¬ áM)X”Ç)U~áÇÌ“d2H$¶¹ò«¡Ð“#¥>0K}`%©:sæþ:Â*•<›¨eùªs“˜áeÊ˜ñåå±rDÓë…ÉXö¤€Ô)ù,¦ ~­!YÝE@tÀ6Ý´Tåc`c¨ ÈÈç¤£œÄ;ål7‘ÈÉÍi'+QQRH›Fà›åD!]ªbúŠ÷t”û˜xÏ	iVJ8&_A9°J?,ú::åºF¢"³ìP¨ŸÃó‡xšÔBÔæV®‘­%¿h¶Ê6f„PC$î+Í¿!ð›1²Aâî­ ¿1¸¨¡#È2?û¡Ä)ÊÂÄÌP86usX¯}.„ëð>±=æ]`á'¡8RÆ²eÌ÷‰%^c¢–¨…ŽxÖ!jµŒ†úÍNÎó@Ësƒ@…táÇ!z“¾„c¨Ä&ÐWÇ"‘Q#@«gŒ£ž˜¸‚ú·•ìô¼|¹Þ6¤ö
q[üä¦ÒPÐ‡c	÷Oõ€¯y?:‰#[ïÙ’º™Š<cüÞK)˜ôä ¡/¸zzÅD ViçX7dªWæ¦;ð¥~‹ÉäöBDu$ˆ³&pú65é<ê ãâJËÒy9ÏÒáqQ¶ª•ã5lSS¾ž),ÎóýP<CjîëÇöuÆ8‰8 ½ç’ÎÚ©v‹sìÐÅ>w5Èõ‡#DÅGì2kôV¶¦K…©›sZ©yìË¯ÖïÅýZ‚\î$ã+ã€Ð±D1~2Ü†6ÂbH”¢‘‰¡ám§ÕŽ,ýYÂ¼úü½€uâºUVˆ;]¶{*½ù²·4“ã}RfáÈ6Ú•ŠÎÑ(¤L5Þ\Y¶,N*¼×kÑÌýÎðmRØ¶3Ð%ŠºTjÍrƒA”å7ÆS,¥ –i _B™Á&W»JxØ•ãV	6™ÂBK<!Ôxæ?ÁÇ'´c„x‡4	÷ÒË¸‘Ã˜Ï@4\h36„êéëy·P¢ƒ<K½Ö_âŠgØšâx´hŽ<R¢Kµ•	“ á®¢¸0‰-¡†Ã	³\Æ% óÍ[‡!bµáwHîd½ú·G‡b(` ºÕ§B‡ÓÑËLyí4Ø?¹Ú«‹ƒüD‡¢‘ÿk Å£Åw¬8¯ÂÆiºÃÕáêtlŒ´®ó¬”¦è·Öò@ +ÐÍ"°bÉ(¼1*ƒ®b6	 ¬½<­:¢¥ˆßÙKAE7³+²CÀ}þjý™ˆdõýVƒ‹vÐ¾Ur<èœ‹úxÔ á€£à`F@$sþƒ¬d/OÿóZìËh +ÓÊî¢ãW7éRÂz˜èed¯¸:	ŒhÃr§^\VpÄºqØyRgH ÿÇ•3šÑÅ
iÂH¶°÷ ¨eØrqŽK,0T? §ž¢`¢"ìåv:©tÃªG:³éQ$’³ïÅÎã“‡6ñ2(jÁ%åP‰8œ% )€¡ŸŠÈÿM¸Amìt½L²šL{Ä¤Š††%V¿ÆZ<ÂƒÑÞÁëŽV’­XyÔËLîšúYA
ÝÈ#:šG¸p3Ôpv-©kT„\$€h–zeËMcl J´Q¤aØî‘‚Ñ¦ŠÍNv;€Z2ÙçÉßM¹Î<_€Ù´}O…¹#Á¦ÔY£Fä´ºM ÝÆí.Öµ­…uÆQ7º%Ði	N¨9FÀö WÅŽlÀ·XÈc›]ÕÊ± bÄÊÎÅVôá¶1|@ð¼6U€}jÑ‹;@ÑÙèCoaòÓÑ!˜Ÿ<nQ5&	_™Â8v3Bp¡€§¿ñU¡‹í3±&€0á'4R2SÇHaÀ¿7D„Àñþ6bŽC¤^!Ã™«•k6pS;ø™0.±‰âJ°B9û(o‘ÕAäàÚtN2¹'py.„oŽO2ÊýJQrËJ^É•¹/Öâ›
ŒEO·£Ö`M°CÚ zÝNþvÈFðÐ„
PúàŠ×S¢:ä ¨	NÑÌ]ÀºŸÝÏBÄUGº™Üè0H¦·!\"oÀ+e‡7Ìæ]QP»š…Ê¢V¡GhÐB.h¥LËw0rØ	†”q“†ìd„,ÉPÉzÀGr¹bhè%sç²Qà"JÂ ó 6ÜÅM.mp, «Žå-5ÜÑŠÔlCC7²nb¥6½Át¸=©	!çg?£HŒ’»a‹ˆe” Z«B²x·F_è,ôJg )Uz^›t–"QÙ.vìÐ„B¨ð—í×/ÙÂ A.Wr/ù"hG­ü³~€“ðÙ­8Ú{DJ‚º‘A¦ ÇÜ š.Ùd’ÿÆ=lxAªvój˜ÆO(õÄÔÒÖ7*šäZÚáìÑØÁE|œÊÌÃM«÷aßdc2'è¥„f;‹+2X¥Ÿ‹0ÁÊø¿ëšý:ÈUR«šÂMª€¨÷jâ×V†È†5kW?T%
8YHRUG Ä‡ãˆ–­¤5/–©a²æ•bY‹ôµÐŸ4—m\÷f2ž7d©ô¤MBéõs{”ÊDÖ…í³JÂ]UÒK¬˜hx˜Ö¹ f™A3ÏÒ™DCåOÇ¬>À±,J(ƒÔédáóÒýÊuÃÃÓ âiÃÀ)ÃH±á÷Ðã pú4&$û’lda÷ÎGbŸ\òdCSÕWx¾â<;Ü*Ž.‡\)È¡D!Pï¿-fVüˆtv¶Wë‰X¿¯^‰:7è²ßhglyˆW2C5'¸)UÂe¡è/)å¬`Ý°j~ÓØ³ËþSîTê g…ù{ù9Å^~ûN]OŸ¾s¢ðŽáyaê[óf%oMÔ~˜ ËÜ+)%g|$SùyÕ: òyéœ–Ós€U<¹¬Ã«XùL»)ŽyáÁ€èe5ªÍÞ€ózdÛÒÆ$×	ƒŒí0UIZ…Ê–èujGT¶0»"kÈ ¯õ¿Y È©€)Nfh _Æ«)yÕ%jr¶y±œ‰^p¥+ã¦3–|‡Ú+ÇF¢F8­J0ðO§ÇMb’Hg;à›D´7ÅêOlf}^dCEµêó}–^Ø¥;Å‘QÊôŒ¸íÈ÷ÀB?ïãpÖk7 8©"„8Ü@ˆV|?25Â6€
¤`ÝF‹%àh0`¨|X½v IðÊ¿m&‰_ø«ŸÂ.âmUÆ’‰\Œ,Ëižè     (
÷KFç+o•eRªIñáT¦©@³olÄ–Œ~T*°Ud`FñM=ô&‚ÅÉŠ]hÜš±YPÇÎUZs†»¸ˆÄ(ºoYV•Ùí¥9ð¨-C=@V=¿,¸qÙTòÚ×§3¢rbÛÛðÓ¼¨kÈ¹U•_	`§L‹¦…r5b`âBpùo°þmù’åž<qÇ-v8åû»U”J¥2á˜ê*ÂÁfaæÁ÷5AÈ/žå$ÙNC:…^Ž©Py›­LEûCENà¥d…_ð›@‡õ€¹ #µ	Ž…’Â°oŠS=lç‰+µRÉÀ£¿Ìð-Ÿþ,HŒpþ}ìÆPKÂGËŠFºvháó_¹h°P:4d!eÇ(‘txèTŒ{ŠR[Ú,™á,O‹pÜV	¹RV¢{ÖöÉß¹ñyª§{ô52ex2^^y˜­	µK¾z 
Ç"*2V1oÑ:À%ÂPñG ÃC)ÈQlñÓuh¨¬ÈèÅGá*˜X‘‹HHØ\|úXS’lžd¯.Z÷Õ#MsJI«d„Ô:ä´s"(–?ÓÞÒfM ë¯RÕäB…½–Öõ$oJ]ŠfûOaa§–¥¢G3ç/I• >gp>ÕpS¤.T)ën…Ü²ÌÚƒP¥¤¢¬G6þw6Ì¤È·Æ–osÕY¹ìáÑkk6Ê1tçÔ´òÇÕ¹²_þúz§Ù|’(_vÔó.×-‚|hMœ«².³(‡›‹ùm%Šqô¾;^tpÙ°tÛñlÝ>€„K†6È…5½Cóeg÷w;×b	£†!è¡Z,xh88Ø§nžï˜¿ð^1< ñŠ?·cdæTOABkP		I\%ti™Çƒ¸ÖøžØG®)7øï~Å}€xIä#¤ÁÄ¼°@`$·ƒK"m£1xïûo@š)]°lYìÐ€|²3Z__dZÈ<Õ›1eÇÔŠÚÜÎMŒ£Ï=¸ž€ù3³­m.ce¤Úèì#ÕÞAè7D‘-{^èµGYƒ2¹„g§råïîí1¬-nE†fÁæã é™–¯)Y-`[·\¢FòÃÉÖ’c!ÃÑðxA¼Pè&³ýÍ¥|úPLÐèÀ¸pE¤8£Ô²Ð¤T™|Š¶!mý¶€rcL~	˜£D{ƒ—¿$«\ ÒB $;¸¶ž­‡Š +®›IÂˆ‰\p¹ÕÜá–|p÷ HoE{Ø®â:{„ó¡~4á7/¨…£ždB¦Ó)‰J‰€S›¢!9ˆÝ6B	ÁqrN>,€Ø2XDÂ¡C;ÄvÇ5•ƒÃ­ÌBO‚dO©s'o,SÒEyï†w¤X‚¥2-ª!fè¼bàãœ$T%Jlë>¢ÂÒîU Ú«Â˜
‰QèD©ˆÀ+R•˜1}†b"æ?V6Q/‚®Ò6)alÑ
6í4¢t[!‡üv:Ú=ú¡[€ëŠ±ncpÕl"\UÑ+MB§	†¥È¡*f!}AF˜­JÊcãm–"Cà%W('ž3x’œ3mdJFHìŸv­>HÏ¢UG³]ŠâYÚT—á„½Ê°­Gf‡Ç_9uèZ$Jû5lq*@r‹mg0,è¨°$Û”H±Þ<4.Ë·²“ôÝõ‚²9ãµ`š¾N±°8zäœn 3ƒh­þ`øHöæñ{b±ø(y=æRZ´c
·×ž…50Ú‹JðÇ–Ôö8
.QPåk²d¯þµ¨|âc`rÓ’ÿ'ÖŠ{tâŽü µÞ§]”Ú²`r
 ý	"DjJ|±Í×æ‡ûv*d‘ð¨{«úøœ3.Ót’·O’5AÜ"e‹~¡–Â£¯GŽø ­ùN‡€]ÜÃ#·Ò£ÇPX8²á V˜öÏ­·ïj5 3Á*N`óÒÄ«º£sË6‘Öà¢=lç–CQPà kj×¨`¨¦áÀpE4ÅDŠâ–ÓtšqPºYÇ€ý–âö\–ûH3íâTÊ‘Æò•RM—úƒAHûïÃ0Õb€=LVÐæõ`–pìïñå$Ò45bNBÇq¢nËa“5‡·LWçÄz&Sh«À0Ô-ã·ð/eQo€LÊf½ "útžÏ²iâŸ"£Ð?fÜqWŸ’<F©É ] Fq®1©ü¤†2ÝR«…‘€yªŽ§GØaâ@^8BGC‚µêøç+c$\ÏMŒ±ŽÚ\B=´Ë`toopð‚4àf-h™µCâkW…â¼.NˆWRP‘0
‚ä2.tü™4<æ„d–yÒˆ)®ûÆÒçaB!³˜°Ò¦ÑªwdØ‹Ò…Ÿ:1ÉšŠ üFGœ€áD8Ibäà¦µâvX€b²!’ ‰š®ùæg€ßA¼è[àÞKØ^9MäR?bUìâIÞNvI0ÂF*sIYFãù93k„NàÿÓ5&èF¨KºÔ!,Ý“Þ¦kuü?ð€¿¨¼-¨+e'ý%;*•)ƒ&•@‡@Z8‹áˆ]ž·&ÑÑc›ÕáE.#…uáˆD8Al5€Á	uuÈð`=
)2'›1Äw£ RþT`o›€HÇ!‹W`áÀ‘Ò„9[ó7Ïbø•³*Ù^úð[²È˜§huÂ&©Šð5¡â'Ìíˆ¢Gü ¿t;IƒN¾"¯úªÎ†u¶ÔÐœ>irÒ—ÏâÛû:äCÈLGkÄ‹r°×Rat iIjvêŠ³q¬ïà€Ê}ÕÝUm$ihó<J"èé"}ÍÄ|ðS´mé~eþÅ™vGËo¤Hb*ÔØdñç‚WX1‡¬:òÏ ˜$x¹lÁœ@4{ˆ”Ú>àÔòåf]g‚ó“ö9bõ•£ö-cóµ ¯óÛå^©àäÿ'òtÿ¡PNî J¡(|¹èXH‡ÐI¡‚yµ0ü¯æ7ñ$H_áîº‚Ã cõ¿ÀBÉòsÛâ³(›ÂÇÚHn,Ñ¤èÈÔ‚“n3EŒ¡²Ž˜Q¸jÀ3£B†P¶¹CbÇ8Êg¬•íŽÇ²øcùiå³ÄDX"¡(4¸Ìô
eùÅÜæOW@6Y–	Ì:bW……»&Ã˜>|´—ù¸ujLÉzÖê)¬Ý¢6ÿ¼N6ƒM@üî"Ï¥o0¸9¢ü&ì£?kBƒ%àåéT+¹„nU)”qk]üà¬'*ãòüâŽWÇÈx~E	Ó#Œ)È¿ƒnìê&Ë£Ò¼Ã1â}ò¯j‘”Y½5´üßô Ö‰}9à§¡zS
‚£‘+œ	…Ž»®ÿk·ŽœBäýÜ@[ŸÉôÐ›™Ì?ŽÌDIJìµìîÓ6¹í­
±HTK÷OñÇ’O¨Ðpñå"FUP´¤¢ <LYžÿ#yFÎoÐ‘.£ó€ùÔ~:è¦JL—c®¥®kb0ˆ¤ÔÁ²sR_¶â|b’ ¾%ÑF¶ñ ™ãjzFbë”m˜dZ	]à×©Ž‚…ž`dËfˆèaAfd(øE%€€2$NÂ'7ºÑºÆQú¦û²ÅhLrûïð^èJM…²v--Ä@2Ï9ÀD ÜÀÍuà¡$%i:É+’P­ÈðË@_Å· câ}ÅðNeyÕHl•ñj^nmPI’`$…qž7¶å«É>*”Û,^J5¨IÖdûn9-Wú C¥¿¼,: ”ÔËÝK<~m’§øqiB¤óS“ n°ø!jV!Žä7ÖCß/=¥`—LäCÈŠîO—(a&¤FÑ»£Ç¤Ä´oƒVø}ˆáH4ˆàæ…D*¿â‡ÎŸÚ@Œ¥Ïn"UûmÌ…Nòüb ¸N´,gRHom†ƒ¦$3hõÑ¥–¤ÜØÏÊrËçòÛêÈyéÐ$sñ§ãý4fÒácR£G+9“ôqVÿ¾äÈÏ"BWåé§hsZÐEæÊìp§e§’iú4KÄl<Š‰°È!`¯—©×KW%x?Àä:J£«—Ñè_Úw-Sçèe‚}[Hl ‚AÎk¼ ß?Ó¡¼íFæ:s™Ð¸[gnÔn‘R[¼p 0Rn°
n`x¨’æÏ“y) FCén~‘b@·|ª Ž‰DL2¬ÔxôD¬z x”¹Qèt§Ðô–n²$¨åó 9yÅÍ§d<81®Ž¬øâdàð_ú$ø4­Œw(œ_xûj 0ÔÃ‹žÀl°%E«BÒY!S9¬P	¹bu‰‡'Ëž_HKÊ	ÙkÄææ°¶mGJdüâý†1qj`óÜé´™‘
)äF]tNŽ–&c_/Rë†y0ÒÄø¸IJs£‘ùéþ‘`µôœ)m†×²÷ë¼ÑüˆëBÝò]<¯@$$D¬5îL¢@‚tÎƒYVˆ4ÏMßÐiè|¿¯ ŽMB8kæÙ#nÏ£ Ö2“T×+C”	ètÿ.ÿó£ËªòÈ—àö„÷uœŽ•Ðˆ×lå®¶àVb9%ë1x¦½µCy1}1‹Ìvæ™ê$Â,kÛb5ñÃ7`Ž~– ó	HÃˆEƒ¦*ÔÜRŒ¼‚r§s…
¢?„¼†0]ˆòu8‚ÈòùÐ€G'ÕŠ–ÇQ%(´%íÛOLØYyQ?±m3jÑëƒ@ëXpÒçà_Ä€²ÏÑ -{äñKè µ:¤¢#¦>	ó¦QðÏ]°¬ª·V. ÃŽíÈûJ¹¼éIo·x^ñúà”=BB²¬À!ÇÌM!Ù‡âÔ¹´1‰‚OsM¢„ÔDsBþ;öä^á€øvÇCòÃ…x_Bïþ+)—A•• aÓŽ–†!)	P=Ý Ý´µEõë,ÈÈv`#7›ãÁÞˆ&Ùó$"¬P¹
À™dG"mÖ£"”•(7Ô–]_Òø`KVƒÀ¹bË8™³NÂ»à¦]¸V%bÌ„Ì3uY™ŽÒáß†b3ÿïLr¾ÂâÜZ¿£/–@0Ín›Š#6!Õ²”Ôàž!-ÝžÐR‡A“oÝ’ÃùÅ6Þ	ËÛžV¼A¨­ñ ­Òd“ ÇE+ð"dÉ‹6"WBH R.¤€Œ2@±	?¼ký Ü¤›NŠÎÂ;vå7D9€g›¡%á„Ñ£kû«WOx}Ðì=kó÷µYŽ./ÝÙë¥°-&ÉJHãÓF“¼Dp¥ñ YÐOˆµáu2ØÀHÖÂQ˜¶ëFˆÃÊMºq\ÙÎÖÚ´ð8¶ƒüaŽQÑzS^¹•§}tmþ®ù[Á7 Nœ]„—H{ª³•s¬
¹ÝcÔ€:ÏÖ9y0Æ–ì2áéª}!Ÿ¾wVÝšñå‘×ž«Ò*x1m£Ç'ÐÇÇ1ònøB¾ o«Á¬ÃÕ!ÐWRn€HðX9llÎ“3$ù¤RCoÌÔà>×Aß”âíüä’<bà€ÚÁp"EÓ8#£’àŽâà¹íôB{‚kPsãøÑå‘3„v«´êgT¬	˜<
Öy°ïK84k3—+.”Æ’G8¤¤Ç®ˆnã¬tý[”ÑÃÀ0)Á:34Uep†ŸýƒÑpkb4ƒX_¾&räT.‰„SÜ­¡¥Â	û¿"îHz„¬Ï¼Ô¸ÃIÜaÜñŽô0`ÇÜœ€ÂÄCÅ¶A…âk‡0 òðEŒ„'Pl¡RÀX­ÈeKUøù­bG;V;’<9@,³Ý&Ÿ¾³ùa@ÀþŒÏŸå3˜ƒ<á*äÌßå©RmÂ[Ñ¡•Ìÿÿ`÷ ú!ž<QÁ~:öÁÖ£^@åf)íVŽH³tÆ]ë2SáQø€ò’$ÿ4Ås„ãøÇ#'gÇûCoYaƒ½c4ÎýQ‹LÂ¢ó†ÙE\›2Ö¦8j¼€õbŒ.Ö$h õÍ¡]^ÍŒaw÷ò"c	UŒo=÷¹•—SDÜäÿ¼º›!ÙèS<ï/uî	vûè¦Ã/@	6gŸÄ(-šb€ÛœJÛÁ/–óLÕè:ðN çR A¡H¢qt‰"ÐÕF]îõ|Hn~áC Hðž?,
À¸Œ¬È,mÕŒýæQrÍ§ÊÄÉäÌ£ÙPRX=–aÊ
z<MQ`ˆý0÷ø‹™j¹[~“sçg?7‘^ƒ3l„ÚFêC‘ªhô‡Ìä'{0È:ØØáÅÚuƒ™#ºw0ÂØP"Ãeí“¨¦­™d.Z,~‘Ý£WäœBÈt´0Ø ÛSáü¶{5´eÝv
}§-"$6ñËhäq¶ŽÇ:ÿä\ÄîF©Æ«°L¤
™xþ%j˜˜	’ß­.3')âêx~¦ïGÛ?
@"U£`P½DÿRV¦ìXŸ$%
¤xñŸv” h×]kó #H†§j.ù¢¼…ÄÄÐ‚CÌÔÂÃW³ÃãèS.‰”ÔArîy´ÓØ;°›eŸH,’SÅš ýˆäG3©‰ójNf:&æäú3ƒÈà•!<àîBãh28XÓ€vcþô1¥Ò„ÂF&$|œùáo¸p¦÷`ý‘òrìT£ÛürdÞ‚l!ÆÕ¾•ºfn‘?NYÚ°0r=_L
'Œ;86‡r,
ø°‹•d€#áÅNPí<H0õ±^`·b›[Ž²!‰f¿/½Ê´ä–¤Y§qÄwO}CàÑ«8Ò”ÓrE+[2ôO@”§9ovK'$‡Õì{–È)‡€e}8Ý'vÆ¹-Á££DçaÉZ7m*`FJ¨ºíy—Ý£3, [aHïR¶X#—8é³Ô ‡·$Ò"ŒjdÑq^Fî	oøÉxÛ„‡í.b”`âf1„®W€Ã³n `L{€ö7&Ö|Ba'ÖIòÊYO|~4 pr^~~®ê="u!ï¤BÞÄRâ–§g£Hó=í”¨c³Í^´†cýº7ã‘ˆ)¶°GSÇaY’Á P	bjp(ÞÆÐ%Þˆ¼RRc¸8çC®Â¦l¹MX—l›9:ìïÉ+ð 44ÿ=:µ®!˜ã'ðs‡™ŒA_0Ï&?°Cßîá¤Í(4˜¸ˆ:ãO=N  K([wr=€8Òt D“´­oL-Ô¡§Ž,"\ù¹=ýÑ³„`vÀÂÌ yð, 1€ß¥Éö3)Þ£ˆòð‡eM°©Ô€©\
ˆGµW¾™š± Xu#ˆS	4dÕ€Ü’[G¬ÅÐ‡®ÐV6+S…:èëÄ*îq`ù»d´¨˜Ö‚µì$Zæ#…@DŽ@@X©`’l>0¨ö³¾ï">òßÛ¸h"	Þ¿saÍ¡|²ç¡‹bßKmÐ2K</ý6m¹åÇc³îöíïËXi"Úóñó¤`@V]Æñªjw"3
½ç“ní)&'åTC=P)ÜÙÞÝÕ£Ò˜Hƒ7µpW¸WG”°Îß2iÓN"iþ¦Ñd¹	ÞF~ÉÓÃ”A‘dÄðîÍÐˆ?
ÙcPLº¬—“ÀÛkó·Ü$Ý›?b=Ê;‡h#Ê¡}.hpÂÀ‘ÅÇuº¤aG\Mÿ@6CR4 ~nZø¡z8m	ˆ¶Rˆý¥÷™†5" ÛN3„|!Òä#ÏÆ²¢ùì¼ÜP(öÄPÇ¼ë„(¥óÙo­¨‡“€9‡8=ÁÒ«ð|†VDDà"Ùî–KÏ€ÝáT§|ÛPgÑd1sF€Þc2<ŒíhO­|r3ÓÃ™‡£<5 Å˜ÀP"•‘ŸT‰tÌÌm r–K¤r™ÈvŽ¥P!G*žÞYãƒ§š”€Æ‘ Î[/â¬éñXv=ßaeÊ76ã4ªà3’‚ä$èß¿€3€íâ°ÙQ°·Âø‘@x‰I‚é-T¥‰±péªØ-`ˆJâÏÄ œXèñ$eˆèâåÙ¨'»2Šéö'iS/Çís:)NÄC²û €–J=ù8Ø`#kéW1ä`‰d´Ç&ÙËŠv1	ÐØ~H6ÅÑEŒÌ“²9Ø„&}ïï^€š#4
–pl$	³<d¡˜ù@€`CôHžgìªäºxÔÜ†!äÎ7ÌÒ²'Œ°aîåcuÁÐ³ŒbJ1Œ\ç±ó£ƒK–­Å²2UB®É-’~Ó(ÌÎ |Ð-h9›(ÛVµØ+”€2yÑLÒ¸ÕÎ^¸¨àb±ŸU|nÌoc.MöbÉ0Ú‡Á#YµÊLž(Ñ>²I³Þ^,Í^ñ“%º™aò˜&ûÄ®ã#3LaX* YÓòŸˆP6ˆ{íoé‚ a¦ L(uÔ/D?™ž³&H›çòÊn’eZyh4dÝ£K,¼)ZyˆTÈ^$yZ‡:hêÙ–¹1ÇˆÞ"¹âå=â("8olŠ¥Ý¦)WìbávØ?¨¼\¹ÁQ…²;
®ƒ%àâÄ¨bUoæ¶7ÀõÓÏ1˜ÝYöÕxâSPYƒâíí {ÙAV”ßh}—.é¹B t·-SÝš‰#PaÑ/°O´xÜÖ´duÆ¡¬©ÀüØÐÝÔ/Ûk»^*¦Æôk-ù†ðp–BY5x’µïDÑ¹€5˜H:"ÈœjÈ©™?å[¨‹^±¦’ lÍY5
9`›ò^nçPÐNC·Ü¾‘þ@ÿûjûù^¦%…sSSã[G‹l~ÐÆ²F2îÔ³-å)Øý5Eá‡W#H7¾¼ù«ä®ý€P9ÙòM¡£|%ò†@*~(‚9³(9CÊ‚þ~í·èªüïïC‡ˆ—zÁšf
„¬\²hÔ ¾$@-!ch¿* $S@¿t‚ãÖ¢ÁáË1ÇÆ%ÒMZ{ñ¨Áè>&qH8ï\µâÞ^ Ü¿ðEÿ—Êc|W)™òå“ºïéÈ€ 0ªâØzÇÜ³Hºn“Ób§QÁ bË	}ÛzÐt6q\®(”½û<¦Tàˆ-å'»v<tF%Z2õÊžÚÈÀZŸ¶¿¢ýÂ/Æä[ð†&ŒSX®j'Õ0Ø¿!“uà£Õ†©#Æ<!ÁÈÍå…©¬aÈâ Óiäšmê¸«e_ù4¯
ôg¡èEƒq©ÜgrŒÙœô8f×ò „­AWó›Î$$üBAN‹‚ý‚šfI[5ic¢	¡FÎEq¿yj¦ 
'›Øèç73È·Úó8þÊ\”Š¿r®È‹ÒDRP°r89äA…IäN ZQ Ê‹0ð2ŽË\¸˜Ì^bùZlô¸´fæeë,A›p:,Þ\çhyX([¬£Ð÷£ýYqZcËæ1è”[G¿:–~í…ÀöÑåó¨¿ *NÏBXxËùˆçý(Q?0´Ì-šUâ5 Pí•à‰u),2‚Od0)c¸ÖÃX÷{à_ˆé–ËfõîP£óã¸¾²)Þœýñùx#Ïö‚'bƒ|œ·t‡'ÿ¥Ð}¡ƒÙÓ8¥±&Å‹­ûKÆ/`Ø%\³Zs¨—~KÑ ÀÜ´hk“ÅA¹<‹‹{BýÝG‰L)ª[baM1-1ˆœßä€Üñ³è]Ž€"ƒ²39¤&À²3Ž]û¹hÏã³âÚ´¨ÅIJ'p„Wf0bú¼J¡-ÈÇ‰zxåÔ™*{…ê#è!GÛg×z'Ì´ôÌ–K3q3]8Cé 1—)ÎæMÄc´sic¾'÷#¿•
‰†?ÿÞêxš€x¢˜çß#âs¯› bµ×?yî§ü",Ì ‚ûi 6_Ea¦H˜
¹Àb>Öâ¢e0_(Fš]ï€£}t¶^zW èÕ|fÞßÀJoY®£oË%4>wæµ7òâöyŠsÛ8°möõFËˆ7…V:Æ,Ú,ÏaÞ+¨Ô ”öÀˆ›¼€$³ó¬ïîx‹°j	RÀ1–¥Ø+ø@d‘1«ãÎR°+
@ä6²8Màï¤M»U×ÕÅå]×¿j,ObiúŸLÎh™86’¡ŽRŠ«`‘Í´ìŒ»{	ù ”ôØO°Ì“mu™Ñƒx{»Í	)‚mD½@ä	Çí“ßº­Ì!gµî‹\wÜs¦£ŽŒË„R¸i(­-ö.íÞœÑ‹X»`¶ÈˆŠJ9ÅúËÜ%DL1ýÉñ«P(ñó¶01nÿEšéŠ0wŒÎ 4Õñ{€Tsœ9LÀWØ{;A
‘aÅ»fÚC©x-N$2æX·Ó¯Qfpç½yÅ›{ÖÖr[lË‰™•ŽÅ˜k;`Æ„1L&ë%Xy"3±ü†J®Áöð*ÐÍv>ô™Gø¨Xæø8OÂmyù&ÓýrgŒ¬ÿÏˆZSëŽ4KÜµbE*øŒJ«v,æ¥éÉwŸíÍV9G LØ¡Dçþá _4[H”7I{,sH¾4b3€o@¥hgÉÄ}ëwRe–1O¨îÃæÕÜ3Nx(f²zivçD(qž¤z‚1HÇ©
¯¨6¤q‘)ï´
)l‰$EM Á3»J¬TB‘—4“! È¶º‚›J i,2é€2W¡q­*ó¤×HîèÝUKhÍ`«¬á20T|]Hå,Ø,nô†1#9™Ær‰‘FiFÏÆØúqâlDöþgG ?´œÔT—‘lN."ì¿¹„ãZŠ5£Ã¹ 3ß²Šlò³LŽÃXð«£eÈlhiÆòbC¬5„g„øVuG•g<Á")v	®H(8þÂ^M®ô€ß?»!c?‰dðtÑš=‡gÞ,ÏNè' hø†G„lýFÜ¬˜,e°TSøŸ¢®6Æ¸3í>×ý$nhyªuøM™+’\Q¿Ó[Jô,”I*b¸{ŽÓ‚{Tw±õ—ŒÎ7x¿?×çu@¬y›-)ÔzZÇúŸ/90©J,9ào	‡ý‘Bpz‚¼te#¡‘Ô¢Léq¼’ˆ42¬¬ÑUèƒ7Ôû¢ˆ™ æ:C6»]2¯‚W^Rb‹5Ÿ¢Ò‹+PNEæzOÉ¢qejì˜l‡Cï´
NdþQª393á…LóR@áÝ—>ÛjAP64J@5G¬³Ùì3ôYƒéåÙ¶Õÿª…®rÙñÑö6á5˜ÿãp/(6"Ú>ûòÙYòÁØ4ÙÍ0Õ<³ïª,Ü®Yå1AcRÞ85Þê*H)L<ÑD6‘5(è„èq*$r.†mp8_£ã@i)&@ô•@QMcÑä›¡xƒ:w ¾\ÍªŒ&?F"?ËÐ1 q8#IÄêeR4êfÂV©äó¹`Wõ™N#pKs®—hXJ±÷°õ£-BEuí¬|=DpÎ‡ªz5öÑ^S€
¶(”àˆÚ”÷á4Íëp¼³³ýƒæË›&®¨jØ)“ýøÎ:š2à÷^2}'OgQÒ‰!.ˆã]Óó°…tH¤½õÍ­¸àUŽ7{gvÃ«D‘§a'ÑXµê·	À4pÔigä¶0údÛ˜ $_¶ÕÞòöò58ðUÃŽ‚V"´«££–y2ÆÆL«O'X:*y?Lƒ–@Öï$gG•ƒ¸;h]³¿Œ¬ö{Y‹Á`*Š»úÁÜ~Lç$ÕÇx-SFäIÊÃ÷h[$,c¸ñPˆƒÑl·*‘S’çÍ:¥qRLªÂ\‡>VÕ¢„/Ç×rÀ@
PACKAGER_BIN;
Packager_Php_Wrapper::$Contents[5]=<<<'PACKAGER_GZIP'
‹      í}i›äÈqÞwý
hhË'fò>$6Ó²ÕmQ¢å{¸3»µ6¸Kì@ 9>~»ã}#ª. 5Ý3½Üñ>ü°;¨jñÆ™ßýÁo5tóë¯Þ|þåß{fŸ›gÝ›éå¯^_~ñú{Ï¾øòÙ¾ÿGßýãÿÕ~þw?ûI÷fþ¬ûÙßüð/þüGÝ³þÅ‹_ø½xñãŸÿ¸ûë¿ýigŸÛ/~ò—Ïºg§iúõŸ¾xñ›ßüæùoüó/¿úìÅO¿zùëÓçŸ¼y!7¾Àò£ò0kŸ¿š^=ëäx´æ‹7ßÛù½3Æàþgrã¯^O/_½œ^~ÿ»/ÖË?úî«×Ÿ¾‘>ýò‹©ûüÕ÷žÝýî«Ï_¾úÅë_þì«/øå ï8}ùÕçoû—¯æþ·2Sç3_‹ôŸ¾üäu÷÷_|>½éýú«þõ¯¾÷Ì™Pžu/ß|òú‹In1=ë^½nûPÝ³îóù›7ŸñYÿÙð»_Ÿî¿"à¸gçoæð/úÞóeTŸ|ùJ–¢{ÖÝ|þzãŸ|ç·¦þÙ³ßüÒ<ôæ?¾º/¹´®±³9¦+¥‹©³Á?“®‹±]ô¼’¿õúGùŒË0á³ü5}ÉÁwîy”‡è=rÉûßÞYçä2ù“aèCîúZü©w¡¾=š˜s×+¹8—ÎFN®Ö¡^5§ÞÖüö.«óÆÈ‹êú·ƒ}gÃY.éKJì|	³Ã{l|è\!Ûå»(ß•!†Îçx²5¤>ÈýCÌÛï…ÂsÊÿÊÐ{ùÏ³Åàë _ËKzyb/oÅMvˆ¥k×^þ’Ú_dšƒ|ÐëbÞÞ…š;YKy³ä±¥\ïÏ÷èä¬3µfH¹s±Ž2)Y;c0l^ŒµÈrZ,dç±š±ÈU•ÿ	›$Yè°¸Æ	\7ÊB—0L+?M~êkêd£Ê/dé»Zå6­<Ìƒ_{y\£eže^VÆQº^fíä)Ù½<2ö2’NV½Ç_rûê”ÛðœÞË«Æ×—2bl¶K«›œÉzÕBRyªé\á½6…©ð.`Œò´‚¹{~ËÔ»ÊkaaY"ç°DYÆ+Ìî\òqAº÷)ý¯9«¦ÆYB¿ZÈRƒ<ÆuÞVPŸœl!ƒí0NŽÎZÙƒ&q¢ä—a8|rx³w;JeüV¾ÂØ­Íø»¼ëh
¶¢·²µrÆ2/[Äb=&á‡®Ox–«·\5Š7zÅâiÂ²&ú"ý•PK„‹M‡b!Kb>a:C_l-å³²­ü0vÁ¤30F[H	\[¶´Ï/¨ž7zXÒCyÁ‚‘w;sIPƒ´·àý>Ö.X§„2Œßòù2•”Iˆ¬„À6±$„o„ çË{	qÀléZ°‰ÀZ$›lÁŠ¹,´î
ÎÎeä¨­Ê \›[¾èAù&lá“Ñfl[!Ÿp<4`!¸'œÇ¢TŒ>‹T’ip˜Ëvù6¤—Ín :Ç>˜	?ŠØRI6gÛÉ³þæ V1VYò‹ˆ‹Ía3¨áåŒêåiNot¿Ÿ
é„H®&áÆ"¿–q`Œ"Çh—¡€œÜ29™”É]òtùWäVZ¤lmD–õmt¥¢0ë-×ÖÈÊPÂÔ.ë.“/¡Ô|æ%÷	ÖÿTÐ]H@!C¹Õ‘1^yP^°»´ÿèZG­®²Èqs¡®vŸó¯ž“j“Vfœœ—IEáP¬^Éùä¼‡èÍX.n¹’ï)eÚí3ôo”_ùT(ôäç\úOŽ† ›±‡HÀS½ð=þÕ—Eõåx—pÛHîò)p Ž(é«1Dé@MýÓëbŒ[wHny,*ÙA Ï‚(œ‡Œ0ƒ­Xì: o€CNA.e¨>ËŸÈ7ƒ xƒ(L×eCù¥,
ÌÎ}œÇ8“ÜŒ'bûÉ•ð¡÷é$¿’k(j/;É¨'¿íå»þøg¨Qƒ`äB¨¢›Cö€2<¹Ñ6€À+¹Paæ…Ü½ÿ®~õ²ÑWCb­-+Ld“ˆ0’RèçF
B!å‚¬§pÛþóû«çgÛ¦"¢!Ä$ËcOQÐS‹^®öóüh˜Ÿ¥˜k;6PðØ$Á6¨ ôœ‹pŸFj¼ð7(Ä{À4¯°ô€ó_\OÌ[D\ÉCˆØÌY6³P°ãøÝb›QŸAÙxik»è ê‚…hƒ"sò,#ZˆÈÅV…Þü]UEç1+š!ŒÞ)»Ztä­ÈEý%qyô
_t¬¼:©‘›¬q™Þ—q)Rr˜6êû— U¹È¼ªæÀ¢w”Ü²cögÝ¨Æý(pð"Î-È,ó®ðÎÏ¢B7”£rqeÿimï”ÎåÇ Ì,(ýèËD¨&›X†-j¤'þ³J:c¾ÈH¦"B…[l÷*BÔWÁ…¸Õrº²ÍCWùl”8TFž€Â»†8Èz
#	e-•C°BÒ¹'Ñ@Âüƒq‚~Ùý"3í Ñ‰gÑa"<ß Ÿm9½”€MÍ@Ñµ	¶…¬í	0vvÁž„È#ôè.Kè§Ý‹-ŒÎ¥WØ7˜¯ð1r»@6Èë`‡É pBÄC¬È0œ‡}%¢y¢¶w1(*@Þ	¬ˆ"ŠÕi®v“4]/ h}àik1‰Þ0 €ýµ°iƒ¬ëeòbHEÙ`%–S°eî‹ƒùåf`!¡®ä>a@[g^¤ xÐË
Ä’NÞÅY02DÌUvgEÕ ˜LC¥þH«W£:–ê/úÑFYMáY:e@OH)“dÊ…€¢	Ø²ïäBä—š:¤öƒì§Ì)×ö’åŽI”F%(x”×ÁJëÒ(o¥4!iXš–Á7ÈÌ?—dä	¡ª­#Kö«J“*fÝþ$KF,ÏŠ­Á\õÓQM=ByG~MjöÂÉ d©P‹#ümDŒ†IB!­n7•d0Ûð\à25ÐDø´Ý)N¢Î`jÈ¾¦åiÃ±I«²Ôqþ®Ù«Ñ m	çùD³E¾2]!ø †„(Hõm'U&kƒµÙšâ“Xù´CãYIaeaLLj2g}?mè’L_‰áO‹c±lUJ'y3Ð0yn%ò…Â€8ƒ)Dä@úÀÏ«n%D‡XV¼Ÿ…sÒ/¶ˆl§;ÑÉvp96ñÜ@§ bT	CO×“ç E`@¯9p“×	Éï&«r@ž¸r"‰Í?÷Iö¸?A‘aÚ \V£·É^Jx}<ž5VëW¬4Š¯ªÖ/ÙC“I¡,–ÜŒ‡ˆ”*|5ËE“Õ«éÔ[ÂD¥¨ëaZÊL‘µ°uŠÇ¿–=x¯ú+0¨ÌíÎqµMœº8Ð8Á²ˆÌ!šŽs¤+ØE‘ß¦ª8“&jOø!˜‘v÷ÐOhÒ5í/j]wlu <œ80ù°d•>Ì[„G¦ð€¢äXè‘.™i
¤ç²bw¨<§,ƒäPÚ'õ¢Ð±Ðc¿QðCÍØû]¾KNcHPWQ È$AWSØÑ«ýVieÂäöù £Ø“ð¡ ê8±hûˆÔAA±ˆHâ.Jt¦Œ „oa¬MTu…ÞïÕá)4j³¹ái\Mêö,S£ƒlë}²ÿé1ÂM^WÅ¤Šqê¥ !ÎÕ¸p”-_„…Ëâˆ•=[rX^Û)^&ZÌí‚Sj¨:éŠÃº^ÞÖ„²×÷möåå‹}ª\;@Vª)Ô­yâEÚÕ<I«yâÔµ¼7#Ç]qÃ×S»œØfZë¤nMéO¾ó[ÿÉÆ±³šxÀq¡8A¯vÖ0ÉbÑ+#6­ààvÃéÈ4þÞ±	/•£)`eñ+ãò-þ&6ÀE°üÍ·¿Nçõ­é$âbuE¶¦	F¸^ùºÍÖê|ì{ÿÁÕãëút(3_EŒqïsêà®ðöt+"
šúsDem2XH…çÆtš©ÃT]bYyWáµ&vYÈfO?› ß.BY—}ÌV>©'Žþ7úŸ=Œi)½½sÀÈW;ÛŸw6¡A"Sªu‡;¦&«Ztåñ{—Àÿâzý²Yà‚ Ÿ”6§6”u®RîÁç5G%nÊè*´*ýºŠm¢±m!×à: ”úÑŒkÎy¡NÒa-lŠbëA¤ÓËªÂPÜfÞ&ºN¤*ÜôDÐ*l<Øä35;aš¥ƒŽ¦FöÃ¿Ëdè¨Ð¨üg¤3Y¥wÅP1 IÔ´#|"Ì¤P+€°)Ù¢vQ;˜¼ÑA¦Jó8ØÅ´W(+æ“#ç
XLC0Í)
f#ÛÁd@+º•º¿r¢m©ì‰’pNŠœ•…·’žoÁ¤ÁhR¼d1§AÆŠ"n*àÎ®¨•¤ ÐZØ>ýËk
¹mRåfÉk\O€Í2é—ˆ5á$“ñª–5÷p¤,ðÑG­Ö›“÷ÀÿÞu›J, Ä²à êË^Ë‡E±YîY–±ˆ1×ŸØ¾2?z]rÃcº%5Ú“Ú
ÂY wá
73#Òõ˜,Õù^lj2NH0ÇIx`ÓÂZš‹…ÅYÅ-ˆºYA+&žl/,p4Úhi|yÐU3e:¨Û^ðì5zç†šÔÑHë&›>¶ˆ!+âq„©ª›(”Ih+„ÆS§òB–c$ž¥l¡¹óø EþhKö³“;3˜*Ü±‘fU…æ`Õ.ºU[Ã„>èi ËBt]ñ/bk
á±ÑlÎµ+ÜT‘)¬æ+¡º_|Y…‚³s1ŠÉ%‘ àzg|vd¶ó™ÓŽ"üþ$E L¼	Ú$·á8µà¸[_ð,Ö2elRìßÉa£ÇÅ’ñØÿ,GJ=«0Ú€Wœo–ŒòJqŒÅ¹J^q°‰Gµv<Q²²­%˜Â,‘qñ‰W—˜èµ¾*†¥ïÒÏ"œ¼?¹ž±]4Â93·zõañDT1ç½±'!¾‚ãWòúSr¥¹Ãj: ï¿Ú¼m	÷_¾Í¥åm¥‚Oåm¡â+Ù¼‚žÿý—üt³ˆ‹—ü §< 1æ)ÁmHñ`™æH§XãÝPÔtù5.ÌÞâª&¼šJPïÌz§ßUò®ÚK°å‡ŸˆRçfÏÄ Xõ©‘5gmg4¸*¦È‹iw[z^ÔE¢¡ïˆAìã_o‰Q7RÎXÇSÌqÆ¿ü¢Iy¹LÖååo=¯)ÿç×!¥%Ïâú]ë£÷Ÿóo®A£kr¿‡tW”­]¹é;:”\:Á«€­¨ò<ÓÏ­c‘'sµ˜•0Vµ+%*a Óø€$H •ó>ö‡÷o72ÛyÊ¶KbÈÁ¯ÜÍVøÊ‹Ùœ‚EÞìÞä ¿ dÔá+ÂKz“!( ¨˜ZLHž¹?¢¿Øì«°7"PÞ{J;jº†ƒ'Þ]?±”z†•>JÅ†j‚BÌ¹ú)ÑÕ“N`q'h¼hÊ€[eÖ%Ò€ÈCcW¾d*…ŽƒÙGW‚ƒ©N{ÐZ$¸e&ÏM>ÓÅ‡ÕfL¿'VóY6ƒbPX'ˆÔó%/„9E‚À-|ÉùËÍ~	[yŒ<ÝU 9ÒÛ"è1œà^MÔø7™0‹Ú8ykVÆÔ÷Â·I}.`Óœáê¡‡Ö#r"†šÈ€›=x ®ÿÃ‘ÿÕõÈ“Mg±ç'÷Hp¢÷)F#»ÃÒÿ‘Fï -(Eèñ#ú'
Ž‹+•a ú?aÍ(îÑX¹£û
‘êY=‹©À9#ã.îË®ªT„­Áå¤¯8+²…Dd~…ƒeæiÚ'yÚöÀIØ›†kËðˆPEs‹²&ÃPÁã·ò°2õíñm·K§ŸmÞ«½ÒH·§Uo…>´RZEøDDKÎáÔiª2’•biw+§ïO-ÒŒ°•‰âdÝG¢áÚEÈ|´„°Ž0!	ú¤o={CÆÂ	1Õ²ø‘@ n‰Zá-áHVü»›|b3ù$kÀRø„ +Í­&´ˆäwÁ)à“…ÂHòAÆ!Ênez	"fu„ öAÇ,†b‡®1ÍÔÓ"Éâ1ý
ÞaæjE­‘þëSLDÔ4Ë]®?ŸyL5/¹Åµ Ÿgž	™ÅeZ½øMgÝg¶•ÕR=3šfÑBl¶1ÚŒþ÷-a¯4oLÊ–dXK¬Gë¥yyÍÊe-¢O:8?˜ëàH‰cI†<ÒhôL6cŽL ¤»wÐÂ7@Œ¢í„Ç-¼³Èœ¢³[PMZÂ¶é‚Q‹Èsy]KÕi¬GÏ½ÆµZ´2kFOGQ†E¢¸Á-#Ý3´—‹š á(ƒñ¯7{tIžã9›!3yJS	+ò$á
Hœ5ý;0¦ÝÔi‡j´¤‹]¥«7§  !¼×D58ÍåpRÿù’¨æÜ<<#È°ÊL m+Ê 3ZQåßófŒj½-aÚF™€\ÄZ&7úà'yŒSÙkÉSj¾ºÅ1ÏÐˆºõâ.P±ÁLµ]=pXÿ|›ÛÈë‘AWüìŠÛ2!)R®À@„mbñJ³ÿø¿ÙèP/¬¨çbŠÂ‘¢Š¾¦¬!6æs¦Fªéq†Irb$Írwû™¦ôyRŽ¾!‘›5¾8RŠ *‹)–ò×ão7^×gÎ¶<ælFot$2 Gc”<ÒüEŠ‡XŸ®ÈmLV~êèR=”7ú‹MÞh®çà»E(2 &ú¡þ´@<IØœÈo¼ð!p÷­rg™,7Š6±tB`IåÙÿ‚,ëyptÉ‰˜ÍŽ–bÉ`˜GÛK@ŒB§¨fHy@`B¨ Mòù±Wš	-3CÁíA6Þ,¥ÓÌ,ãgÖ˜P†à—Cœ\’|!•ß0´níH*a(YH<d˜DW8z}]OyWÛE+.@¦•ÓßmÛÆ€¡Áu) MÀ[Hà”w˜1ºv hèï*¾ûŒ¦Üì(s “ÿã“Ô5ßATE‘ç˜Ò;ËðS¬³{@–RS8˜Å(ÓI¨
ciöˆùÿÓaþ!])ÁÏ"Ee`m[
"€g`5$¿ãŠà(³ÿ?_'XÅtÁÝ%Ÿ„{es·æUÐå¿“ŒŒ¥ÎTÏ+hˆ 	ÆÞãRÆ¹ÿäÿzö@,¢`xÈq™ÉþÑ#|s¤"#pÍS%sGÁûÿ¶Is,qÍÓ{Â3\§P»r)ÿÛÒ¿¦Flfq€§Pì[ÙôÚ‹ÎÆ€ÄóË­æœØç™¿Lg©Æ=ÐÑòšL+ôfüÔiŒÎÆ^}qðÁq9ôÈˆ‘Ûàš•œU´Ý”ž1G[&º·<à‹& 0†ì"ì3#àÐ1ÙXŒÔ%œà4×zL‹¥^‘8G«}+bî9æÄÚiR—(•ÚRCÆ÷\ôóOÈÏ€‘²TàFõ8bûüåFJøp2+Ó®žQk¢Ž( È^´ SÌ"kˆŽ:CÈÎ˜uòÒ ¼JªýëŒX’PdÚœY†øÓàÐ£…û-Š¬clIé˜­ŸaÊõ~g‚!›4yË8c3pI3qýÊ&O@ÜÀ†bã³Æ¨èiÝD!+¸âá@|²ÙvñÈA^;æŸ vTºÀt5n¾¸dç#þãh´v¥=ý
m <ø˜žÃ
Gæ>Ó˜É¬ÀþHôêiTMÌ
*ôÃ1JÐìã€$‡Ô($nõ-÷–ÍH#†0+[˜L'xä`—nêØ¼_ÒCÃ2Ù%Ì,Ó­“‡ª‹arµ¥2ÙSœc±Ê6Àfœƒüš^èÔ=!·#Áÿª5õxz÷á-Ä^˜"jØÛ#AðLôš˜çá† “[Âùžñ®ÜRp‰ô'…õˆo3?P›'Yú-:ºeZ„ù˜=œ2àöôCåë­@º`2"0²F{}­S`¸LØet´˜¼Æc„%×°˜~“YÂ˜ÁILç({fuÉPf }FKÿ¯7°Æ†@+3BÝR•#1Ý†LÕi©Èj/hüå)ÂKT–¬@Eì Ù32è5Ê«ù4f›‘s>ÝèÔ°êÔbÃ,»æÙì™«…`8Õ€…V“s\È8òõ–Æ`ehaÅr2„rT§ÅLlYXjIæ¿FM`Ç‹±Ñ€ÊƒÚ¼8”Ÿm6ˆñ„‰K1oÙnB¬IdÁè¸Y½š?–Iÿã'‡ú”JO<ãÁb,#BÀMÃ<‚–ÈP­RK[‚KÁ—®-l‰Z%çµÂÅ’£[x­Ò«<Q¥¢{…Óð`U;µy2­F¶:Ÿý²ïš1oYd§¡ß‰Â¾ž‘
…i2°æ'f¨¨ /|&²¸Œ:cë¦60„—J¸Þ:m×`q‚!69CÇKµ…ýÛ¨è˜ ‚êxhLus“¸|(ø]TÐ™&b÷¶CûL¼@e§œE|¥|•xàUùü]f;ÈØñ®†ðFšwDê²&ÿ™i	8¦‰~Þ  _Ï¹³gÀFnx»Ä¤E$ãêxˆÿãzˆ¡ÙØ÷¬PÑ™5_¶Vó¤eøHNs©Î%„ªà^èYÃ,Ö@Ç"±	ÓÅ”9Þ4-SÓàtîœ]‹A¹–Ó‘]""Ô»î{:ìI%Ð`w¢ÿsƒ¡íŸ÷ñUÁã¦+'$¬XaÁ ©R5ˆ	M„¼£¯a Û-x¹`˜Æ èèÍš‡lqÅÎ¼:~Î¯6†¹]ÀÂ¬\x'¶¤Â«Ì¬dÙ‰¯àB—GÍr^²Fèµšé'b'¶ Ñ·ið„	èM÷OµE¼mvIömR‘î¹áT1ò¼%-²ÔIËt€tkY"Êx‘0ÞÁóÚ*Ý’‚Ø7.	™›¿Ó‡h ™/(\80-¾8++ù—–‘>ñ8œèäFiÄ	ia´Ä°*Z<23ªk@/HÎU­ÜÔ¿ ©%i3â‡&«bzØ,¾ÜðuIp5ÁyM¿Aúý´Ö0Ä!«Ö5-3µ¬YÏZ`ä(4\/š`jµ“D˜Ñ,éøV%"RÏ<Ðu>Z”²Ô=,¥AQò¨…;¬ªìJRáX‰*LbÔfÀÁ‹Ÿ”‹!ä‰0¡»§:÷Éòë›fO[\¯‹‘–b	2aé¬¥þ¦³)Ô‰¦…@%%‹olK_õÔ3	k²<ªf¡,ÒEóŠŽoa–=È¼><P>/.Šn|2S¦Z
íu£@<‹Û˜"buV#¬Á¦k‰Â2F˜×<á–vÌl=Åº4g
é]JŽ7M:¬-]I4À•#Ë«NŽŒyÖšhÔN
äô‰‘Tz¥!ßi.Àq›0‹©6ÐÂœ<O2¯Ffï1áÚ®,ˆZáRÏƒ94´&ŒR¨9èÖOPJ	Xk‚x„ºáQl¯H	@×†Â…™p ™¿ºnâF0×Áª‡üdÍè+0(Fà	té2£.SÑ¨ÄJÿ*#–TÁšša01äÂ8x.5IbÔ,©Êr^¦7×‰©^ ÝAH8Yåß­ùÖS«qžUúZ¬PÝ
8°•†VàµpHcå¿ž<K½ÍªÂDO*Tþ|ydê%ÿx¹£;…±jÍƒ^€·Å4§KÑpa}
C&(1ˆË]³*óY@ÞŠ[!!¸%b=4X…sÖ¨Ç-|º^ð%äóÙà	~vÆ WHXàä‚]Œ\ù¬. D¼ls²ÆGZ™ ê)íÀ¤thUXt#`QèeÒ|AÀ•»BP>©9¸íQÅßºt™)–ZrnÉ¼Ñ*™¨¹É¸¹Hšý¦!Xj`9ù]ÒßeÛ<‰Ÿž=AD»Âùc‘*P–¬hvÕ ŠÌøN«Í´[Ã˜ð¥x/çm¾x/!'‰eôûy«ô¾äP Ú±ÿ
*Æà2Eä šª!Ô½­(úÀJüÍ&L]ÂÙÏ£f‘	Ù­¸³ÏÅ#HËñâT@Ñ(Pq:&ª$Ø–âîˆ,Ëœ^d‘xÐ¡Å•t|6kIB ^c)N(v³KPœþ'ÇúË„sÊÐ*jâSögùÛy—€’l :#Ü^žŽrØW½/ìõ™Y`ƒ9ÈÂâ³O?ñ‹ÈDEÊÂôÕ"vÊ˜¢ÞNÇ^uØŒ)óËÃøÎï6#NÔŽm]²à À¶-+ Á¨'Y	á\ùß.2_Ý²f&ö^ðF+åà‹S}Ûò(˜í¦eFH{¦^/ž•§®´x˜a™eGP)Haw¡»qK††ó‚!ÛÑ£fØ!ÿp™Þƒ©YÁžX+ÅÍ.…S©loÃ<¦¢ÑWYzLˆy=ÚÍ%Ì}8E¦I"fQãÿ×QØCÖ-ŠPC6=poSnSÚýÀ@CP³çv½)#ûâ°@‚²0xdÀ;›Ù§˜y ¬´ÌYw¨H•.!æUiˆÚ®uB(	#KX‹Öíç4±˜U=SâmuËcõÂj  ¶i¹8yž„HÅ µÝ7‡
2~Yª‡D@X2Þcà„eƒ3$KÝmÚ&üïM’â’‚Z™&E¦…–sÏ+d í?êÿ®R€…Ó‘™¡F8Ó»‘Zãt5,ƒý“†¦L´ÔÁU˜—Þ\¨·ˆ£î‚BÏÄê¤¹ÍZÔ€ºB§áW€üß6K'èšÊ’bÿÏXoÁkž9¬¬Tv
ÁõF®èØŸKièÚç	*–_\}€O¸ÛÍh… ·êRÄÒÖëq½³C„,CåBÏ‡uþïÍ¶ÌŽ	èsd §íÈ|+Û2øe´š Oc`&3‚³‰Ö&*@r:¡¶š¤r0sSß’¸œj~¸(6v/Ønæ3j9–ºe©¤-Ìš³¢®æ‚Ñ
›Óq=:¾ÙMùÜÚÉÅ} .ÒŸZMá´¶¾ÐNn¹•öqã•º[Fx]Ô7e„NíÔA¤a-²#ÄÊÐ”èÅ£æ<ººqG‰¼Ò‚¤¶°TD|àA$¢u^cÂ1È†\ò(—`ÆéµsS ½ˆô`rf"fs­ÉÁ!>²Ò	wdoÑ¯@IÞ"=²v ?hÄs¨³è/À†;‰˜‘õäÊ:v :ìˆÉû?;;$…¥¡±Å	E¨}Br¬% FN«×k³áh ÄÙiùs§[½+<ßËÔCv´.b‰É‚)jyVÈL
¬Hõe/úze…‰™µZ·d¨úéTŒh©íËZ;P¡¢ªwºñµbª%×Yd5±F=wÁ°GI— Lü³¥þ“½A|-¸Ž^½îLéöÌ^ñ•K}ôý@·²i#ÑjJ6 °P‚¹ì`Ïø¿ÐÄÅ®4ïCÈ¬ATùÿõuù"ãAÇ+[®÷ä€ï™ Â€Z‚w“£Î+»åãÈ¶/ZHNÉ­…ß=[RqlóÍÁN™–uFjdªRáôÀZ½¼3t¬9ÏÍa¦¥ˆFý)~jéa´X·¯Jë«ÔÑÂŸAP¨Š9êÇ‚lzXŠ¡ZW¤’=Mäµ_M²›‚&"€N "×º$Qõü»æçsÃÓéMÏJ`Û°ª)nY›W,›úå(Í”“5Æ‚¢Emê ¬’dãhYX¬rÉzšÈBG:pˆðÖšDèß‹FZôô´	¡ÔZ¬.5?æšÂ…ö¶c‡‘ì>¡ˆ¹s\5­è}+Ô²£+ë%JÃê€ÖÍË‘~/F†Išôë!ƒ¼·æ~¥SŠ­Ak6©¢˜RMäB‘úl×<?¬º=Ï´L±cß8òëÄ {¯ü/7+o•€Që€w°l6¨ƒO>í¢µ»"Ÿôfßnö7 0ŒåÕõXÞ³Qžµ-‡–rîªPUÛ¥\•{Òë~ç¦cKÄz©‡}h)›I=·­ŽméñäÈT*š—‡„OûE£>¹&ÍñÚPD˜b=,› °ß‘k™®‚=½ìÖF?óòEúå®xvj´h¨ÕE§Ï)×·wtËˆµ"`¸¢·ìi‚¨0RµˆlmËd ª	ÿ,ª·ÂÈ£¡Ó*Á¥Žý9YþéãIùÜ†Î.®/þ‹.ì¨« #;r²¸=ªC—	Xƒ 8ï³{7‚anŠ¶aÎ9¤ÿá'+ýËp(Ìi‡ «™ÀH¥òÖj¢¶Äª³=ÖØ¾(¤vnd2bÔülßR-D¬Å%[®Õ\T§£Î3³Ï¨ã!îkëo!dšBk»¢qeÓ"{KjehÔEh¬u¼Ÿ~yco#-Gö36fÓ-ûÖN«¢Eµ«¬9hL×_¹åWîâWiýUºøÕáè>½ÝÚQ€¹¯¦J‚µ%‘–jp&yXRÄCµÉì‘?àFø‚KÇT>õ¨Ñú¥ÿéaáoøQ“‹¼ÒÆGC±Â‹¥‹¥C-úµþvÔe¦åaY­ M´VWÃÒ¼U°.ö^¸Ä÷ºoØž+ž×NH¿Z ½¿èØq¿±Ekkq¼äŸlúK?Y	8ºzÚ5ÀcšœÈ2NÑ>\ŽoÌ¤o vý.öB\Hžö:Oÿt²‡3ØtÀ~:ÒSrË° ƒ0øaf¡£‚bæ~€‡ÑjHÛk"ëS,ÿÚ&tÏù]²$6˜)ˆ'`ezàÂ¨u5Hˆ‚&B7Œ,(ídCË<¥/V£Ì&.­#—5û/·ºym‹ŽY•%Np›1<£( Õb|éº‡Ñn£œžŽ) g3S
!…aMä1DÚ¢€…rl3I-"HMþ•*Wöƒ:hÏf;
S[X=X >€6Ë£¶Ta^€Ó·avcÀO´“‰éx!äÀ8Ž“¾ÏŒî‚«}£7,#c½´¶
Úúä0-¸#0GP/ºú¾@Aº®µ»–6{`
Ë¼3ý¢G…_ë.Õ:–uÂnW6·•ó05BWÖº¹Q·åKû¨ÎWP·‘6ù·w	¤MÚ•1T:8X=·	*ÖGBJd¨hàP½Y†&	>9Ñ9ø«cy.\0j Ù¥Ú¶ØŸlÛb×Ø2D„(c3˜¯ˆ#Ûš $QñÆè§˜ËÒu@¤›³|+T*I»ñÎ‘@²¤°&¾ðUŽKò{oDøex½¼zú¨‡ž7LW¶pØéŠQ[WŒ¢]1ZòùÒ÷ð¡]1ÂzûÚÃ³+F]ºbÖ™¯]1z½„á–XAKòSsëkzOå@@mG¯ÑDCø˜Dú…³¦Ung…³˜I.8[X”4²{–¶Ìi`f
ÚÝÚpýdÝ*î˜ÐCœøŸqÊáp¶î'NHLzï)^~dÊyÁ¥aŠò@Lq8Ü­½ñtÃ…£ù¬í¢j;õ–Ys¡íìŽy¸¶3ªíTOò-AÛ8]¨0¯ïö—Ì]j°{š¶ƒûM7"÷ª~XTYó	¦G©²Mãºµ;fÙx¿\ñþc;wàEÌÚ€Ü!þ~…¡­¦>€á7^›óÔ¼¹â×`¶ü~+¿¦÷šúÆ8=ÎpÂ~ñ»‡s¢»àÄÅM–ÐfÕê„¦«øÝY#¾áÒ†³òg©vÁYvaRwI»÷\¯¶Ýï£GXÛo¼»ùÆÂ?ÔüÈj~°O3“
é™Ià»¾o€ä}¤;[ þAÈ!m·¦æa‹4aÅb`‚µîµ	IšÅÎÆh”Ñ:@MV×>!0æ‘±OÔE¤Œ!Æz¯Sˆ…•{Ì`Ëh?$sì8²yºv"^;<tì&²ßK¤jÓjMo/:Öc¯¶ïÇJÞ§%á-
v»$¼Ki•öéÞ<HÚ¿ÚÇ óŒ<V4*Ý¢þÒàÚ«­Iüò‘Ÿ¸ÇkŠEO¤¦%¢¹¥%ÒÜTôãvU7–wk¡ÿay–÷¾uñNLw;1Ý%¢{ž+%>´ù[Î±KËÂßw’aðAko¦¼Úšå÷Y¦2ï­,­Ç‚Ÿ¢Ó†Rèš«™hH…ãƒýüŠê|¤{hU§-fÔÖF0-™¦·0R\IÓZ¿h§äiY¼Ãq×‘+"¯Ý…yj”ÕC½rdDà%7¹-ÐÜ…Ì0Dù{Fê^Aþ>Æ|=“m=“N¸xjÈm#EßÉ3\	#k
™å¿kñdP¾›°xìKŒÚe¶Xˆ¨J½±[·.ˆöÚéØ[ý?zðÚ#ûí(¢owÈ²÷{îÜ¡ÕÌžG%÷^m=Ítè6}Ï Ï«­‹ã£™ò<±GçÕ¶GþÇ3]$"~¸N™ÝhXhØÊíîJpÇ¯ÅÚ~_c{ã©ùúÝEíåq½qÎXÿ–@Ø8TD*.éÚ¬ì­ìôâm«›ì4[ŒÍÙ[‘Ö7€´³~ÒƒjËd-ó9·ÿ¬´šFé/„U8jSñ5½z¬I5©
˜ÛC…eTˆU8Å2#íÔ…4êXšš-†í£uá˜ÝÉ¿¬õSàé\™Ó>2Nf™/Žrc&+3ÅýÁX9ÛŽtŒ#±”%C	=;Ç¶ÔYK°4÷5…åÐ²¯·¹Gý‚?¦òØ×Ìz°_ö¥v¢GÆ¾½CÒ_k¡d®Z(]÷JLdšj¹l&„Öëp%œ•…ŠÑGt·^¯o÷è¸CÆît$öo)Z¶¥hÙv¾àíÞW öÖöí#¶‹@ˆ)‚$80×>H¸b+*ß‹å_P“`ÝƒWêC~ë+û®üÄŽ¡T(NLMK)¨~ç1+š`°íZž
¢ÈÌSyž4O%/–U?)m+Ó«¹ ª SpîOécÛF¬Ç2ÓCŒs¡þ^Vxë¥û®°u—iÿçðbP0)jû1™ÿÍ	Ðrÿ/Ý UŒ|GOØŸrïR
—µ®U/dÖ.°¡‰aŸÅÃ¡ááºëÃH:øneJ;YNpÓ‹ðzëWüö1k[_ØÅ‰¡k#o8$Xb`­ž`ÀFØÝ¤•tEegý®_z¹¡ V% j‰Wß!×#k[)¤KÇ'•åw‘uðXq=á1»©0jG†¢pªq7néx$8sëä•Æ8ô]¬Qè«½æ|ë´ÍçåËë­s2/­YÈ#ìY¿»(í\‰T¬çqf÷
p*6Š’‘‰´<ó×\6dú¢],Ä5˜RTÈÃi[”>iµ7;o³.ŸáŠlþ,¶!7i%Z…²â§Ñâ4HD–¥M—Z²£ÙäÅ2€.èÑ½ìh‹ê\Œ½&Ä×[+T¿"ÿY; °r®0Jµü=÷f]„ÎCy¾JÖhÖTZs&2=¬®ÈC1Ã„CQX½£g°fZÝ·Ú3YgbYœFvÒN8OmÇ!Òa¶=f°guNßzûa‘Žc›žu¿Å${ö­‰`÷À) Ë_752kèÎ-&…JYX½žþéµf‚©Ú};p‚cs¶¸‹vcÚg2·.“vi¬‰“8Y¼k=&!-èËÏ,ÓoYŽ€@3²Z¥žº–3©±
¹%·ô~ÍØ&øwx›•™G=ÑŠ½>VÀ‰Ô,(5Ì›­ŠÑ–;þF\ùõNZÖQGŸG•p@!MÊWMÑhiâo6qÔäÈ‘§;Â«ùºïã4¦û_Ë²"[9ÀÕ£ÆºïlòØ]tyD-8`GÖJúcrî¤•}+Èùˆ¾˜zPï†dw!§k»ïª4ç†Ý·“÷­ +ã´õPÞ|ÓÖ»oêyÔ+>nQÁÆ;i}ßr³3ý>è×LÀkÌß½è/k}lY…k.»¿^w	Aé«ºaú }÷aˆÿ\AœiúÐ^	Ý;ÿ61qiÞR\¸å.½;mÊ‰m¯ºDî<ìŽfÆûºš¶‰‰ëÔÐ$E4¥mÚô MëÞkêÛÄÄ3ë#Ùù	¹ùÝ=ÚS]±é¾Iª&©JË€ºû\úP&ýtë¡ýZ[¶Æ–´
o¶µ¼C†Å£|Or=uà{:¤ðÖ-{ØvM7GÚåx)}÷­75vcc«ãçN1ÝÚ“Ü`5¯Â¶ŽÐÌ»¸ß‡S{¸°µ˜¶ã,BYã.A¡¹”IO×¨³;ìÔ‰þŽFÏ†oý:Iºõ²~”$ý=ô7E
Ï5ÙîBõï&?Ýú7?JÚ22z?°£gì¢gâ8|üºtï±0`ç­‡ðã$9Jž/eoQÙ«‡)ÄCÙë){í‘ì%ñWÇ?kÝ¥>»’¿Aåoº'£ýýì¶G,êÖ¥÷Q.ª»“Ô=ß`’&‚´Ìºë\¿5ñî^þÆU›Ÿî“‚Â¤ofÉ„þv`Óµ¥n±mSêîõJ±>Ý:›Îü‚¤<š•A›2=¼È¶ýFËev<®¶X+ù~`ÙOaA-	Ùªš=RxZ{BÐ)kòýÕí”:6/êèÖ†:DY8S£‹Y¥+ü¶ZŠ]ò€û@ý0…·¢°	¥2€eMëà•Ý€wèËÐ:1uK:ºéF
m:ýè†¯fí¤ìòÛ;fåF]ú #}€–GI#{Å½$ËGõTÏ ËÐÇ¯ÃÖKõ>nQ-Æˆôa6»0ûuµ·½CïËÇœ“…Yn}Fû,#½Ç—ÝkL}0¨Ùúl>öé"Âðnç×.¾9¤Â6}ñc§º¥]öŸ[³C×z1<ÈˆßŠjéçPn¹ˆnê)û{z"Üó(%¾Ý]ê‰}Ò6)}ÑadUa}÷ánSŸ²O±RÑLË	¯Ú¥ÒèI™»‹úã|ôÂ3y-;2œ;ßá¤ã÷mCõé6oòÿ·é³tûÃýRí°ãKÈuª»ç˜bñöÖû”žô<óJ|¯~0<Ê€m I4+ç¢t½]"–8è;¬±Ö¤F›€h‹5`©Áñ¤$Ã#Áx(,X„]£«B4É^žmÛIàÂ½(>C»}8ÌQUkë5]Ò.·úæœDònyoU”aíøa]™Ô9®Ë”Øµ­ˆ)\‘¸¬HZV$·Q®Ö\èBW ·,KTóÁêÙD<“}Óq`›ù½œ¹ù>Gnrq·¦âÍ,#þeE;±¸'cï÷aI­KÒ>,N[2.‡…=´KZo_û°öaq]ëÃÂ33ÓÚ‡5è4<£ÈAgÐAG´5«Ûˆ´í‡pQnrk¼+âþ‰›zÜÇíÜÍãS7Q,§‹˜™‹ÒT€ëŽÞ¸ëÖÌˆ<}S¾§ÿÎš-ÊûörS„c£„Â–‹V`‚áŠß=ÏpQÞºÑÛÛš-²ú6òÊ8h,Â_Ê®FÃò/®­»q€5)¶m*ÓrªÊ¡f|5Ø¡#’HÌÀº¤§éàðKú	©÷±>ÑàÐ2A=D”]+˜,Äžælƒ[[ß·€’çV þ,ê:àÙ 5šŒƒVqT;t#ò¶ ,ñ¯l„qéžì†ð:ˆH[PÀÂ	_µ—1Ëlü, âá¶(6¦²–.NÒô†oÐ«ZûšÏÔÛÉ
¾kGë†íÁºQË™y¸'ïáßå\]¹5#N6GÚ?Y—á{=À¨Ïgùs±L;`÷qIÀ-‡·`;`ƒ÷ƒ¦¿i7SG Â†Û7¢Æò®í»œ9ždqô‰< ð>{v¹‹V½R€çZòíTZal\0(€‘
ÄH”0rVww¾ÇÊ¨0Ÿq )-¯‡éŒ˜;W Bñ•=ò=ËèÙ¾Ÿí¼É¡yáÐ¨ý½ifñ ÕÆ›Vy“GéàèIÇ)B)Z÷°Á½}«RvÎ~FÊþ“‚ÂžGƒè‰XŽ…ÏäV‡ƒ*E‰è		Î®±¯\8ÃqhŒ«RÝ‡3ôó÷:$ºh7žì)Äû,2#ÁÎÝøÐ“¢pP4‰üu4»ÀäÑœy~´¥äŠË¯aùÖZÊõ†h´H|þ{?4›gýÒÝ±/d;Š@KôÕQÞšëkðâÒÜ!q;9qaòÄC“§{'m©…
†³1/(LL÷;Ë›+øµvé‹Êž†•½¿TöB{ö[›Å©â;vU|.ðÝÙ‹ŒàÌ+tO›*iýÎnvÃÚ»Í
ŠI&á°C'ë\7½	ÌývJ7ŒE¿aÄžÌaÙ„ƒýøJ¯‚¿ÝÁúïìcæ›c~lˆŸçó	Ðç©x¦Äqü; Žß€óóÁ¢Ç³´<Ÿc…Úß¸6f„12dxF¡ ’ìÚh¢qƒ+Qâœ±@ñ	ÑYø²
ÉâJ2;‹Åpc›Ô«ä×SÅÈ˜Ñ'ŠØÚ¦¹0òQù(ì:¯81ç¶Ó>ç>Í[æPŽ»%Ê?þfz¶$·VÙ÷ÃÜàó°õÛ~ÔYƒ0ùÞ7×UpËÇ¿šÚXpkßSŒþÂ
>ží†~ÔK«2V}·ñg¤³?CõÝáÌãÖ(üC‡°Ãp0¬p(ºÌ¤º¡8u”“ò¬…‚s§yS4û7Ý hq«>>Êü)Í(@ÏãõŽG¶­	ù)õCòœºJtJðg½cpÇ+°ÑžÂŽ—Žd¶?ÃúÿFZ–MÊ´x·5:5æïµ7 §\ËƒÀ^ÚßãPG=ÚI»ñè?¢ëNÏöÅ±†^ÛöÇˆCq²¦29ìý>®{Æ©íVž<Ÿ'›“!?0‡KsEIjÒ3¦áß‘œh÷1ŒÎñŽGÝ"áT/˜X“º²¦qYÅše‹§A‘„Z>Ì
X»X¦ƒ†©{Ÿü;ÂÿÇ¾]ÌŽ-ib–½(ÐÅY—¾ÓK—Ñ·Úñ”ÌÑj!°	çÝ¤É_ôS{­#	Ã—½Áâ[ŠÀªG†1aŒ²:<UF;¶D½¿%–WxnS-8m€AƒèVkˆ‘Ô…Gá²ä³Ïvü–¶‰ÖÒ Àp`m…¸¨<Ô15+];ðÐk´7˜µ4×6À¥Ý@¶ÞG!Œ–õŒÐwÈ„Xƒ!<¬–è‡ßœÿðVÓîˆ ÌOK²q˜vL¢a¸‘QÇíèë‡’DÌÀÌæà,qveâq@Õž;‰MþDnàHlÙI‚z3Žô^£OÅ¦úëÁOT<yÄ¡Ý=ÕZZˆwTî³	"¼Çzœ žeg”t·œô÷ìŒ+»áØ˜Y1	àv·9¾2U’–™NêYó•ž~@?APÞjÒ*	meé0#/Ñ@Ÿ¸2d!OƒõTbTž!jüÞð2î ®o#Ñaÿ.oÍ”Æ•õºGñÞ»Xï˜òïÄ™«¬{h”LƒdOt'ÛÓ,§.Û.›|ÓHé]Ñ‰õ‰|axD¢pCb;?¼–
{(¨‡œTîûœ™A•q³ÇËæNX¢Eá!›y°#ttŠøµœGx ã¼è„|¡.¸,ÎÙCv	°ÁïÌ£øL§6‚Ñ¶¹ã1Îå`ø££þ6I£ŒlÁ6s¹õØ»Dß¯KÜ/Î4\‡£^±c^`²” BãL|²ƒba·uæƒ: Ú¸ñ@ÖõŒYÄTQBÎíràõüw1aU!5ze,„Àÿénf:´˜—ˆ™ã v†Žæ¹äè‚`yŒfdv7<IæDäÆ,Oƒ#ÉlðzÇš­8ËÚó°jUºžéq„…§Y5-eƒÃ•Š—ÉqxŽ¼Nã¿ÐíUÍÁ¢a4í~[a1MQÂ±,Ü7ã’9(Œó‡MðulØùOãzH“ï;â;B^ê©°çí¸÷#íÔý-I=#É~vÅœ„ïq~mÁ9dVÝØ^õ‘^	K£¨(½;)ãRók‹ü–M+ ¦Ø0‹ùt»rvð¿‰†ŸXtðÉ´pì*®|VP(Ãñ”ÑÛ–¡ª-qµÿª`íàèæ‘yÓÓeÇ3ÌÔLuÙ\UÖmè™ƒË(öz›à… ôÜèðàCU,ü´:Ðox‘ÓNzÍÇÒm8b{gJ™¼GbJ#ŸÌe¯/áô¤±"öãagíøEÏžÕŽ_^Í®±×êíø…&Zàm¸ªy´£,ÌHpÚA!-û°vÔ¶µõèB7rüÁ!)»ãi³¸ƒgâ,ÌEÃu—-ºnnÓ6içc¯žLõ]»²iF†öeã¡—Ù<V—«…ÎW7ú³YíÏvQ µ4h3Ú Íhƒ6ø‚öºªi]Õ¢®ºªÑÕ"ÿ?wU+ÚU-ßïª¦›+ne~Ì`ÞIóùXvPéÚ9ŠÐ&Ûü/ÎÑ»²Þtìf=žýŽõ#gX‚&õW†}%œšußãj–›êÔw¬í§oîq÷7t<_Î{­ØŽçë®Îç{òãùl¾QP‰Yg[zß×*üx’ÉÕÙå"@Ã 6†ò¶Œµ­U>¦Sv€Eß–û¨¼v›·†±	-È€²öY¤Á—*`<’CCr£àŽ ~€AqŽÙ‚žlpÀ™EáqïyL3XžÄ¤ç‹lãÜ‡SdrKŠ§¾ÆVkÐ¬³oÝÜšÉ
Ç' r„³9Ó]»aè{§ìõ÷'C›¥·R¤[©Wn¿ß\oWåm†û7·jáF«ÜVÎe®\Š¹ºÝR®Åó<ü \–sLžmÊS²‚wæ‰°}ÞÜony·Çï^ÞÔá´*âfÌ1Ñ¡8ÎY´9íq¸ò5cM­t(£g'Ž<@â—GJ®ejŠ9‰1ŽC«
¸¬îÄÌùgäœÞ\òJ‡c|’ždŒ=™ªåØ;Õ!O‡eÉ£®{ð0.[Ëj¬QgÃ9NÔ3Å,: Ç@Ìçc«ÞmÆN±å›½.e­p®pvÛƒvÊ’XÐqÝ¢xB0"¡—)CüÓ#µÞµûØœ;7 ¬XzjØ—ù•È…¸@¿E±¯½@¾^ÏÅ mòüÜMXÞœŒu|K§M‹oÖŠBé[…Ýö¨š•ê¶>¸‹K¼ìâò|=½C´<åóÝ}\ÛÆåpFÆlÐ|r;¼}+Ò9ïß„»o?~'´{óñÿ
sÑoßø=B®7nßl2Æoß¤4Ý¾}šE”Ü¸}ƒø,ß¸}„Ý ä¶v#Ûs%lˆiv(3(réåXVËÓ6\òAOÛðÐ=mËb¦ÄóãBf	E©ULÈÕ­Çm8Ð‰á¶yœügÛópyë¶ˆÅ¬ª¯Ô82çHTœK(/tiœñH„ã‘ÔŒ¹cd+¯Ù°Óù5¦½& +:SäYƒ·ª¡{Ïs‘Ò»_³aÃõ5±¡K¹¾‡Wyå{¹¯yQ®®ï¹¹ª;èue’e>¾‘Í¿‹lwA„4c©¿I›ß¸wÒ`¯òzl´¶,ÀI´>mý»ZŸ´®Ï»Ç¶ƒ—CÈÏ¾¹@ 8ž>øeî!ÑS­ªÛîüÊœ´X¯!$DnòmdƒDfNÂ½„>Mqb Ã ’Dë…L˜ú–˜Sô²+ÌQ+ÈA¼eÈx6
á¼Ù-*ÃØº¿h{úÖ®^k="»ÞÃ‰ibªwXš+´:»ÜëjßE¤Ý°§x¦ƒç»öü±(Úðïÿ›U_ß÷gqïÝ£Þpƒ¶OðMý¶-‚ˆµ¬{*À¶rlÆˆÑìG/2Ï*¼1œmÃú|Ä³ä™x’<HŸ­/2£v^åÛ.áÌÍ¼ob’—Ÿ,vPM˜mL'ëÜ¬ÁPáqþwbj=ÿ|a–9Î²QjBˆR~Qæi
\Î,Ç5ªi-LŽCüF
;YèI8”ŸaåÓ¤©s”‹eE¥½ÓÓ%lÓè-°yñÀ%«}Ðº…uN1EMÀt6"'`å›«[{êÕ¿‘ÃØè­÷¢’”Éà‰¸¿Õjyf6Æ¨Õ„í¯ÌÙmåxðxˆ
¡L‹Ú¨9¢¶NÌ™kÍ¹V×2ë¯uâ@¢3ú¬Ä ”QOµÍS»§±!vsaa[YúgÐ/³4Ò:«ží¥Õ†Æ½¹Ànã9ýØd=g±}OV9.p¾ÌÜ§RØäjÖ][4NbíJbåè¨JìBý‘ë‰Ýsòó
~aªR+w3@gâ—ÌÎîÑvÎð4P1fÍT7K™éLN¦8ÃðQÿÌü)áe;`eú#8²kFàA¶Þ:tpkÅûÅfÏèpÂÿØ4še°iQ</>ýò‹	ÿ¾zýé›ï÷Å›ù³ïÿ?‡xmGí  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[6]=<<<'PACKAGER_BIN'
       0FFTMTÅ®  <   GDEFJ   X   ,GPOSµ‘  „  |GSUBShz3     `OS/2ŠÞ=Ÿ  `   `cmap¶÷¬`  À  ¢cvt Q  d   2fpgmS´/§  ˜  egasp         glyfÛ'Æ¿    ¤DheadÿÉ·  ¸L   6hheabˆ  ¸„   $hmtxpIÞ  ¸¨  ølocaXt¦  ¼   þmaxp¨  ¾     name³4ÌŠ  ¾À  ¼postFÓù   Å|  çprep÷Ì6  Éd   ÓwebffOÐ  Ê8          É‰o1    ¾Ÿ˜    Ëö=ä       $             	 ý           
 0 > DFLT latn      ÿÿ        ÿÿ    kern              
ò    : ~ ” ž ¨6\žÈHbhz¨îôúHŠ¤ê ¢Ì"Ê<f|–´ÚäPbx‚bbÀædv ²ð	.	`	¢	À	Ö
L
v
è  -  7 \ 9 T : T < R  ð  ó   ðÿ‡ ó  # &ÿË *ÿË 2ÿË 4ÿË 7ÿ= 8ÿ´ 9ÿX :ÿ} <ÿ' Eÿö Fÿá Gÿá Hÿá Iÿã Jÿá Kÿò Lÿò Mÿò Nÿò Oÿò Pÿò Qÿò Rÿã Sÿò Tÿã Uÿò Vÿö WÿÓ XÿÝ Yÿž Zÿ¸ \ÿ¼ ]  ðÿq óÿq 	 ÿß ÿÍ $ÿö 7ÿ× 9ÿå :ÿã H  R  \ÿô  $  &ÿ¾ *ÿ¾ 2ÿ¾ 4ÿ¾ Dÿç HÿÕ Lÿô Oÿô RÿÑ Uÿö XÿÓ \ÿ¸ ]  ð  ó  
 ÿª ÿ¦ 9ÿá :ÿò <ÿª H 
 R 
 \  ð 
 ó 
  ÿå ÿð :  Fÿì Gÿî Hÿî Iÿö Jÿð Mÿö N 
 O 
 V 
 Wÿò Xÿé Yÿá Zÿç \ÿÝ ]   ÿ9 ÿD ÿÝ ÿÓ $ÿo Dÿ¬ HÿÇ LÿÕ Oÿß RÿÍ UÿÍ XÿÃ \ÿÕ  D  H  R  \ÿô ðÿÛ óÿÛ  W    % @ % Dÿô ` %  $  &ÿ¢ *ÿ¢ 2ÿ¢ 4ÿ¢ HÿÙ RÿÓ XÿÕ Yÿ‘ Zÿ¢ \ÿ¢  $ 
 &ÿ® *ÿ® 2ÿ® 4ÿ® 7ÿ 8ÿ¾ 9ÿL :ÿu <ÿ Hÿç Rÿî Xÿç Zÿ² \ÿ´ ðÿN óÿN  L   \ÿö  ÿ® ÿ¸ $ÿË 7ÿº 9ÿÙ :ÿð ;ÿ¤ <ÿ¬ F 
 G 
 H 
 I  J 
 R  W  Y  Z  [ÿå \   þ× þÓ ÿð ÿã $ÿq DÿÛ HÿÏ Qÿì RÿÍ Uÿì VÿÙ W  Xÿé \  ð 5 ó 5  $ÿç 7ÿÁ 9ÿÙ :ÿð ;ÿÏ <ÿ¤  $  &ÿö *ÿö 2ÿö 4ÿö 7ÿð 8ÿô 9ÿô ;  <ÿÕ D  K  L  W  \ 
 ð 
 ó 
  D  H  Kÿô Mÿé Nÿô Oÿö T  Wÿô YÿÓ Zÿ× \ÿß ðÿá óÿá    \ ÿZ ÿP ÿ¦ ÿš $ÿd &ÿÁ *ÿÁ 2ÿÁ 4ÿÁ 6ÿì 7 / 9 ? : ; ; % < = @ ` Dÿu HÿX Kÿå Lÿð Pÿ RÿX Uÿ Vÿd Xÿ Zÿ \ÿ‹ ]ÿ ` Z ð ! ó ! 
 $ÿ¾ Dÿò I  Sÿö Uÿò Vÿã Yÿö [ÿå \ÿö ]ÿð   X ÿ= ÿ9 ÿÁ ÿ¶ $ÿZ &ÿÕ *ÿÕ 2ÿÕ 4ÿÕ 6ÿð @ \ Dÿ– Hÿ‹ Rÿƒ Uÿ¶ Xÿ² \ÿÓ ` V ð  ó    X ÿ` ÿm ÿÏ ÿÅ $ÿ‰ &ÿî *ÿî 2ÿî 4ÿî 6ÿî 7 - @ \ Dÿ¢ Gÿ¤ Hÿœ Kÿî Lÿå PÿÅ Rÿ– UÿÅ Wÿî Xÿ¾ \ÿá ` V ð  ó   $  &ÿž *ÿž 2ÿž 4ÿž 7 
 9  :  <  Dÿç HÿÓ Lÿî Xÿå \ÿ°   ^ ÿ ÿ ÿ“ ÿ‰ $ÿ) &ÿ– *ÿ– 2ÿ– 4ÿ– 6ÿ¾ 7 7 9 ) : # ;  < ; @ b Dÿ3 Gÿ Hÿ LÿÍ OÿÙ Rÿ Tÿ Wÿš Xÿ^ Yÿ‹ ` \ 
 $  &ÿÏ *ÿÏ 2ÿÏ 4ÿÏ Hÿé Rÿì Xÿå ZÿÉ \ÿÙ  -  7 ` 9 Z : Z < Z  Wÿð YÿÙ Zÿé \ÿ× ðÿÇ óÿÇ  ÿ¢ ÿ¬ Yÿç Zÿò \ÿé ðÿÇ óÿÇ 	 ÿá ÿì Gÿç Hÿç Rÿç W ! \  ð  ó   ÿ¶ ÿÁ  ÿÓ ÿÝ Yÿç Zÿô [ÿå \ÿã ðÿÏ óÿÏ   % 
 %  ¨ ÿ¦ ÿ°  9  9 @ ¨ Fÿð Gÿð Hÿð Jÿð Rÿð Vÿò W ! ` ¨ ð  ó   ÿ¸ ÿÁ ðÿÑ óÿÑ  Wÿô Yÿ× \ÿ× ðÿÇ óÿÇ  ÿá ÿì  E  Hÿç Jÿã K  L  O  P  Q  Rÿã S  U  Z 
 \  ð  ó  	 ÿ´ ÿ° Yÿå Zÿî [ÿÍ \ÿã ]ÿé ðÿÇ óÿÇ  ÿ´ ÿ° Zÿð \ÿç ]ÿî ðÿÇ óÿÇ  ÿð ÿÁ ðÿÓ óÿÓ  ÿw ÿw ÿö Dÿç Fÿò Gÿò Hÿò I 7 Jÿð Rÿò TÿÛ W - Y % Z + [  \ ! ]  ð  ó   ÿá ÿì ðÿá óÿá 
 ÿç ÿò Fÿö Gÿö Hÿö Jÿö Rÿö \  ð  ó   ÿá ÿì ðÿÑ óÿÑ  ÿƒ ÿ     DÿÛ Fÿ× Gÿ× Hÿ× Rÿ× TÿÛ VÿÛ Z ! \ # ð ' ó '  ÿ‘ ÿž     Dÿò Fÿé Gÿé Hÿé Rÿå Tÿé Vÿî Y % \ ' ð ) ó )  FÿÑ GÿÑ HÿÑ RÿÑ TÿÑ Vÿð W  Y # Z ' \ ' ð  ó   ÿ‘ ÿœ     Dÿô Fÿá Gÿá Hÿá Jÿá Rÿá Tÿá Vÿé Y % Z % ð ' ó '  Fÿò Gÿò Hÿò Rÿò \  ð ! ó !  -  7 Z 9 R : R < R  $ÿo &ÿî *ÿî -ÿd 0ÿò 2ÿî 4ÿî 6ÿò 7 % 9  :  ; 
 <  Dÿª Fÿ{ Gÿ{ Hÿ{ IÿÕ Jÿ{ PÿË QÿË Rÿ SÿÇ Tÿ{ UÿÕ Vÿª Xÿ¼ ]ÿò ïÿu 
 þ` þ= Gÿ? Oÿò Pÿ– Uÿ– Vÿ= WÿÓ YÿÕ ðÿu  $ÿm &ÿî *ÿî -ÿd 0ÿò 2ÿî 4ÿî 6ÿò 7 % 9  :  ; 
 <  Dÿª Fÿ{ Gÿ{ Hÿ{ IÿÕ Jÿ{ PÿË QÿË Rÿ SÿÇ Tÿ{ UÿÕ Vÿª XÿÁ ]ÿò  ýb ýX  
           $ *  , > 
 D K  M N % P ^ ' ï ð 6 ò ó 8    
 B \ DFLT latn      ÿÿ    AZE  CRT  TRK    ÿÿ     aalt frac                          $ N t – ¸     Ê   å           $                                                                                                                 Ü¼  š3   ›š3   fV€  /P  J        ADBE    à þ  |F   “    %·                   œ      €   \ @   ~ £ ¥ © « ® ´ ¸ » Ï Ö Ý ï ö ý ÿ:>DHU[aeq~’ÆÚÜ 
    " & / : _ ¬!"à ÿÿ       ¥ ¨ « ­ ´ ¸ » ¿ Ñ Ø ß ñ ø ÿ9=AGPX`dnx’ÆÚÜ      " & / 9 _ ¬!"à ÿÿÿãÿÂÿÁÿ¿ÿ¾ÿ½ÿ¸ÿµÿ³ÿ°ÿ¯ÿ®ÿ­ÿ¬ÿ«ÿªÿ¦ÿ¢ÿœÿÿ}ÿ{ÿyÿrÿpÿlÿjÿbÿ\ÿIþþþàßàÚà×àÖàÓàÐàÈà¿à›àOßÚ ý                                                                                                                            	
 !"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`a tuwy€…ŠŽ‘’”–•—˜š™›œŸž ¢¡¥¤¦§  de õ Œkhülg v†    f         “£oc  Û  inöbps„ÄÅíîòóïð  ©Ô ûøù    ñô rzq{x}~|‚ƒ ˆ‰‡ ÜÞ   Ým       %· ë ï ø 	 æPP Ä Á Ö É[<9C ¨ }  ° ,° K°LPX°JvY° #?°+X=YK°LPX}Y Ô°.-°, Ú°+-°,KRXE#Y!-°,i °@PX!°@Y-°,°+X!#!zXÝÍYKRXXýíY#!°+X°FvYXÝÍYYY-°,\Z-°,±"ˆPX° ˆ\\° Y-°,±$ˆPX°@ˆ\\° Y-°, 9/-°	, }°+XÄÍY °%I# °&J° PXŠeŠa ° PX8!!YŠŠa ° RX8!!YY-°
,°+X!!Y-°, Ò°+-°, /°+\X  G#Faj X db8!!Y!Y-°,  9/ Š GŠFa#Š Š#J° PX#° RX°@8!Y#° PX°@e8!YY-°,°+X=Ö!! ÖŠKRX Š#I ° UX8!!Y!!YY-°,# Ö /°+\X# XKS!°YXŠ°&I#Š# ŠIŠ#a8!!!!Y!!!!!Y-°, Ú°+-°, Ò°+-°, /°+\X  G#FajŠ G#F#aj` X db8!!Y!!Y-°, Š Š‡ °%Jd#Š° PX<ÀY-°,³ @@BBK¸ c K¸ c Š ŠUX Š ŠRX#b ° #Bb °#BY °@RX²   CcB² CcB° c°e!Y!!Y-°,°Cc#° Cc#-     ÿÿ   _ÿèë·   k ²	  +´ +² +°/° Ö´ +´ +³ +´ +°/´ +°³+±é°/±é±+±±	99 ±°90174632#"&!#_pVVpnXWoX/ù°XooXXpq^ü)     N’!à   E °/°3´  +°2´ +°/°Ö´ 
+°±+´ 
+±	+±±99 01!#!#N+4Åu,1Çàý²Ný²  U  tƒ  b ²  +²333° /³$3´ +³$2°/³$3´ +³	
$2°/²333° /°Ö´ 
+°±+´ 
+²
+³@	+³+´ 
+°/´ 
+²
+³@	+°±+´ 
+±!+°6º?b÷" +
º?Sö¶ +
°³+³+³+°³	+°³
+°³+³+³+³+°³+°³+°³+°³+°³+³+°³+@	
................°@ 01537#533333#3####737#U×"¹Ú6Ä7Ì9Ä7°Ð#´×6É:Ë8Å8èÊ#Ê€ÌóÍwþ‰wþ‰ÍóÌþ€€þ€€Ìó  xÿA^/ '  °&/±é²&
+³@&%	+°/°/±é°2²
+³@	+°(/°Ö±é°±%+°2´$ +°2°$±+± é±)+±±
99±$%±	99°°9° ²999 ±&± #99°³ $9±°901732654&'.546753&"#5&xC¹¾bum‚ÖÀÇµÙ¼ŠCœª\a{’É¯Ï¾ÙåndI><T(BÂŒ’Ó!Í¿@ùNB73R3F¼™”Ü!ÞÎ   <ÿèp›    & 1 ± ²$  +°3´* +°//´ +³/+´	 +°/´ +°2°2/° Ö´ +°±+´ +°±+´' +°'±,+´! +±3+±²	999°°9±'°9°,²$999 ±	*³!',$9±³ $9014632#"&%354&#"3	4632#"&7354&#"<à¶µÕì¨«á ÿNG’HJGN§0µüÏ»á´µÕí§«àþPE“HKGNÞÂûæ¾ÔïëÈo‹ýpŠˆû±úO®Âùå¾ÓðêÇr‡üqŠˆ   FÿèØÏ  & 1 ‹ ²  +²  +±!é² +±/é°2/° Ö±é³ +±'é°±,+´ +°±+´ "+±3+±'±%99°,´!$9°²#999°°9 ±!°9°/µ %)$901%5&'463267!!&'#"$%327&>54&#"FpöË²äþÛ÷^',A¹¬]þy13ªòõþê?Šo~QkæxhXKH:>K‡‘€–Ÿæ¾™èþñ‘×þ–ÇÀb.<‚îéaƒJf V6gj9a;;TV  N’wà    °/´  +°/°Ö´ 
+±+ 01!#N)2Åàý²   ‰ÿiÜ 	   °
/° Ö´ +±+± ±99 013#‰÷éÙÙé÷oýpþ˜ýûþþp   Qÿ0Ü 	   °
/°Ö´ +±+±±	99 013QÙÙè÷÷üsúùrþ”þþþ   Fg¨Ï   ² +°3°/±+ 015573%%#''FVæÁz¾ê`þžìÁ~|½ë®ÞFmþ¯QmþèFÞ=þópPþ°p   Y  ·ƒ  R ²
  +° /°3´ +°2² 
+³@	+°/°
Ö°2´	 +°2²	

+³@		+²
	
+³@
 	+±+ 015!3!!#YÄ×Ãþ=×ÞÌÙþ'Ìþ"Þ      þÿõƒ    ° /´ +°/° Ö´ 	+±+ 01%l5Tr¡þÿ59þ›þö     AÈ‰¥  " ° /±é±é°/± +´ +±+ 015!AHÈÝÝ   lÿèú{  5 ²	  +´ +²	  +´ +°/° Ö´ +´ +±+ 0174632#"&lrVXnpXWo²XqpYYqr  .ÿ©×Ï  O ² +°3°/° Ö´ +°±+´ +±+°6º=tî +
°° À°°À± ..°@ 013.Êßþ4W&ùÚ  HÿèŽ›   D ²	  +±é°/±é°/° Ö±é°±+±é±+±±	99 ±² 99901 !   !  265"HþàþûþýþâNmÌlÐep¾D™þyþ²þ¨þz‡SêøõíÞö     Á  Qƒ  # ²  +°/°/°Ö±é±	+±°9 01%!!#Á|þ½þðÕ®ú}Z€   b  e›  Q ²   +±é°/±é°/°Ö±é²
+³@	+²
+³@ 	+±+ ± °9°²	999°°
90135 654&#"'6%2!bÛ»{qšŸcÍë±þ­!ÇŸöcanzï—õÊþÓþöþï    WÿèX› $ h ²#  +±
é°
/±é°/°3°/±
é°%/°Ö± é° Ö±é²
+³@
	+±&+±±99 ±
± 99±#°9±°901?32654&+532654&#"'6%2!$WE³¤|‹¢|”h”qd˜G»ÛþúŽ«þ¾þöþ÷QùYeS\lñVKBOYñnÈšë\¼€¿ñ   6  ¡ƒ 
  Z ²	  +° /°3±é°2°/°/°	Ö°2±é°2²	
+³@	+²	
+³@	 	+±+±	°9 ± °9°°9015!3#!%!47#6¢¬¬þÁþ»E
pR×ZüÇøþ®Rø;T·ç$     _ÿècƒ  F ²  +±	é°/±é°/±é°/°Ö±é±+±±99 ±° 9°²
99901?32654!"!!672 !"_@™±{¥þhRu]ýÊ@"ý4þ­þèí:ýKsbëäþîÓëâÏþà    Cÿè™—  % _ ²  +±é°#/±é°/±é°&/° Ö±é°± +±é±'+± ²999°±99 ±#± 99°°9°°
90146$763"3672 #  %32654&#"CtË Ÿ=gŠ¥uGtÂÁþÎåþôþÍM{sXmtf\}S´5Ðsþÿ
7^qCqÿÏØþÙXÂw«‡km‡|     l  mƒ    ²  +° /±é°/±	+ ± °901!!5lý«þ˜WqÐûMm     JÿèŽ›  $ / w ²  +±é°-/±é°0/° Ö±é°°% Ö±é°/±%é°±+±é°* Ö±é±1+±%±99°*´!'$9°±99 ±-µ !'$9014%5&74$32#"$%32654.#">54&#"J ÑÛã ÿÑ}ŒþÐüûþãYsYZp9d;ÏAS]SS_qònjË²ÝÔ–Ïh.·y¿ïæÆOtaL;^H1_I=c<KbZ    CÿíŠ›  $ \ ²  +±é°/±é°"/±é°%/° Ö±é°±+°2±é±&+± ±99°±99 ±±99°"± 99014 3  #3 '#"$%32>54&#"C7ë$qÆþ÷¡5­!Ð[eÃÁþþOoaAc,ohXqžÔ)þ¯þïÈþËÎm_höÙb~3B5…£ˆ   jÿèø5   E ²	  +´ +² +´ +°/° Ö°2´ +°2´ +±+± ±99 0174632#"&4632#"&joWXmmXWonXXnmYWo°XqpYXpqXsqZVqq  þý5   . ²	 +´ +°/°Ö´ +±+±²999 01%4632#"&l5Rr¡hnWXmlYWnþý59þœþöXXsqZVqq  |  ƒ   ²  +°/±	+ 015|üçâ¿âéþªþ¨è    W ü·     ° /´ +°/´ +°/±	+ 0175!5!W`û `üÌÌÆËË    ~  ’ƒ   ²   +°/±	+ 013555~$üÜæZXçþ"Ç  lÿè‹Ï  # s ²!  +´ +² +±
é°$/°Ö´ +³
+´ "+°/´
 "+³+±é±%+±³!$9±°9 ±²999°° 901632!&547>54#"4632#"&l¢ÖÇàOmqþÜ€T.Ÿ~dFoWVomXWot[»˜L¨wv™$B­‘`]%€Bü*XooXXpq   tÿèMÏ / : Õ ²-  +´( +² +´" +´2-+´ +°
2°´ +´8-+´ +°;/° Ö´% 
+°%±+´0 +°0±+´ 
+±<+°6º?j÷Z +
°5°6À±ù°À ³56....³56....°@±0·
"(+-$9 ±(°*9±2±99°8µ %$9014$3  #"'#'"&54 3232654 #   327#  326?&#"tÔ{é#~ð¶§m²nŒæ¢d>	DQþâôþ÷þ“:ý¶‰(­çþÝþo:o>r#kš™ßØþ™þëãþç¥¦œƒÎ'6þm4$_Ã£àþþÛþõþÑB‚L)ˆ…^Æ°   )  ·   ‡ ²   +±33² +°3´ +°	3±é°2°/° Ö±é°±+±é±+°6ºÂåì÷ +
°°
À°°À°
³
+³	
+²	...°@±±99 ±°9013!!!!'#)Ï»Úþ”wþIlžQ„(F·úI~þ‚v¬ þê  ‘ÿñëÅ   &  ²  +±é² +±$é´+±é°'/° Ö±é°2°±+±é°  Ö±é±(+± ²999±±	
99 ±° 9°±99°±	
99°$°9°°90176! !"732654&+532654#"#"‘±P}vŠþ¿þVÕ³k‰›¡“wp†ðd/ž!Ï¥g¤+%ÀƒÀýýmfdhï`T§     Nÿè Ï  = ²  +±é² +±é°/° Ö±é±+ ±°9°² 999°°901 !2&#"  327  NÌkô‡Dˆ Ýþùã¤‚4–ôþŽþZÈ`§Dþø;þÿâÜþÿ2þûB’     ‘ÿñÍÅ 
  N ²	  +±	é² +±	é°/° Ö±é°±+±é±+±±	99 ±	° 9°°9°°901763   !"2 54&#"‘Ú÷Ó˜þ1þß§\ûûìb>ž!þwþÄþ‹þf÷âì  ‘  V·  J ²   +±	é² +±é´ +±é°/° Ö±	é°2²	 
+³@		+³@		+³@		+±+ 013!!!!!‘¦ý«2ýÎt·þîþÓþñþ¨þï   ‘  /· 	 @ ²   +² +±é´ +±é°
/° Ö±	é°2²	 
+³@		+³@		+±+ 013!!!!‘žý³%ýÛ·þîþµþðý¶   Nÿñ‡Ç  v ²  +±é² +±é´+±	é°/° Ö±é°±+±é²
+³@	+±+±±99°±99 ±°9±± 99°°9°°901 ! &'" 327#!#  NÚ„	 G”Ôåþï	Û|2í2þöôþdþaÊ] Kþø@ûÜÛþû0üýU—     ‘  r·  ? ²   +°3² +°3´
 +±é°/° Ö±é°2°±+°2±é±+ 013!!!!!‘Q?Qþ¯ýÁ·ýÎ2úIbýž  ‘  â·  ! ²   +² +°/° Ö±é±é±+ 013!‘Q·úI   ÿþÿè·  / ²  +±é²	 +°/°Ö±é±+ ±° 9°	°901'323265! !"'\PkPþüþïŽ‘˜üjþáþæ    ‘  b·  0 ²   +°	3² +°3°/° Ö±é°2±+ ± ±99013!67!	!‘MC6O þþxþ…·ý{cLÖý”üµzœþ"   ‘  @·  , ²   +±é² +°/° Ö±é² 
+³@	+±+ 013!!‘Q^·ûcþæ   t  í·  N ²   +°3² +°	3°/° Ö±é°±+±é±+± °9°±	99°°
9 ± ±99013!37!!#!
'#t]È¨D#Q8¨¾Nþ·#5þÑþùµG/
·ýÐþö·T¨õúIf7éüd}!çþIÁýÛ   ‘  v·  W ²   +°3² +°	3°/° Ö±é´ "+°±+±
é±+±°9°±99°
±99 ± ±99013!3&!! '#‘aeo6þœþŒN·ýª¯þóæv¶úI†
²þëþ™þ:     NÿèÏ   D ²	  +±
é² +±
é°/° Ö±é°±+±é±+±±	99 ±± 9901 !   !  3254#"NEH‹þgþ³þ½þtbÎ¨«ÌÍ¨ªÎÑN°þ_þºþ£þ]¢O×þïÞÕþì  ‘  ÆÅ   R ²   +² +±é´	 +±		é°/° Ö±é°2°±+±é±+±±	99 ±°9°°90136!   !"'32654&#"‘ÐA#þ³þÜ9>$QˆŸ€f)¦þûÉóþü
ýö~nfq
  NÿÏ   W ² +±
é°/±	é° /° Ö±é°±+±é°2±!+±´
	$9°°9 ±°9°² 99901 !  $%&'$ 3254#"N™MEŠÂ¦„ä]þôþ±.;þâþŠeÍ¨ªÍÌ§«ÎÍQ±þ_þ½ßþ¡K	&+þüJ„N×þñÞÕþê  ‘  þÅ    m ²   +°3² +±é´ +±é°!/° Ö±é°2°±+±é±"+±±99°²	999 ± °9°±
	99°°9°°90136! !&.+32654&#"‘¹L#’u‰>o	þª+>hrh‹~‘ƒyv(¤!ÜÌzÄ)3ÚþvRƒhýÀ0s`ai   [ÿècÏ   g ²  +±é² +±é°!/°Ö±é°±+±é±"+±°9°´	$9°²999 ±° 9°³
$9°°901732654&'$4$!2&#"!&[F¼Âo}p‹þ]5 à§L™¦fs`·Ë½þÃþäôF`TJBY/Š*ÀùLþõHO>9RBHÓÉý    !  ¬·  : ²  +² +± é°2°/°Ö±é²
+³@	+²
+³@ 	+±	+ 01!!!!‹þ_þ°ŸþèûaŸ     ‘ÿèe·  7 ²  +±
é² +°	3°/° Ö±é°±+±é±+±°9 01!3 ! ! ‘Q‡Qþ¼þÌý¥(üÃ¿Ê‰=üÔþµþ¨      …· 
 ( ²
  +²  +°3°/°Ö±é±+ ± 
°901! 36!!r14\Âdþþu·ü
€ê'eúI     !  Ÿ·  * ²  +°3²  +±33°/±+ ± ²	99901!36!36!!&'#!!h˜6Ão¬ÄVþzþ“’$'.‘þ·üõþ°ÓˆüˆÛ§¬úIÐÈ®õÊýy   '  >·  & ²   +°3² +°3°/±+ ± ±99013	!36!	! '#'¹þV‡Ã4/½„þRÄþwþø:¤äÓþ|z‚|ý9ýÿ?wþ¦     >· 
 0 ²	  +²  +°3°/°	Ö±é±+±	°9 ± 	°901! 6!!‚

2Ýþþ¯·ý¤‡ïü²ý—[     6  Ñ·  4 ²   +±	é² +±é°/±+ ±	 °9°±99°°901355!!!6ÕýmLý:Ó´ç½ü"þê     ˜ÿYÏ  @ ² +´ +°/´ +°/° Ö´ +°2´ +´ +°2±	+ 01!#3˜ÁÐÐóÂ¶ú«·    !ÿ©ÊÏ  O ²  +°3°/° Ö´ +°±+´ +±+°6ºÂŠî( +
° °À°°À±..°@ 013#!àÉßÏùÚ    _ÿ!Ï  I ² +´ +°/´  +°/°Ö°2´ +°´ +°/°´ +°/±	+ 013#5!!_ÑÑÂþ><U¶ù>  [€³ƒ   °/°/±+ 013#	[ÆÌÆïþÃþ¾€ûýüú      þñ=ÿ]   °/´  +´  +°/±+ 01!!=ûÃ£l     ¥úò    °/´ +°/° Ö´ 	+±+ 01!#7¿æòþ³   Aÿè!=  ! u ²  +²  +±é² +±é´ +±é°"/° Ö±é°±+°2±é±#+± ±	99°²999°±99 ±±99°°9°°	9014$!54#"'632!'##"&%326= AK6È¤‰@±öêòþÓ	mÉœÄMG?EtþÁ.ÅÓ„PÕaìÝþ¡bj‚¾ª;B_Wl     ~ÿèð	    Y ²   +²  +±	é°/°!/°Ö±é°2´ +°±+±é±"+±°9°±99 ± °9°±9901365!3632 #"'#32654&#"~	PnàÆ ëŠâj=„Qn€~pW~°Êý›™þØð¤þù’­•Ìks Š… €f    Hÿè½=  = ²  +±	é² +±
é°/° Ö±é±+ ±°9°
² 999°°9014 !2&#"#"327  HP“t6Qjƒ¢¨„k\){»þùþÈ
ø;+÷"¤ƒ‡¡#ô4(    Jÿèµ	   q ²  +²  +±
é² +±é°/°/° Ö±é°±+°2±é°±é°/± +± °9°°9°°9 ±±99°° 9°±9901  3!!'#" %326=4&#"J™WP	þÔníÅþòTlNƒt[n
 ÿ4yEû4®¡¸1û„r}{b~£  HÿèV=   [ ²  +±é² +±é´	+±é°/°Ö±é²
+³@ 	+±+±²999 ±°9°	°9°° 9014 32 !327#  !4&#"H)üèý?	¬‚¥Š+¥æþðþË=˜XjWqçPþÔêM3^i-ßF#‚Kˆu   !  "  X ²  +² +°3± é°2°/±
é°/°Ö°2±é°2²
+³@	+²
+³@ 	+±+ ±°
9°°	9015354>32&#"3#!!‹jÏxWY
1<KQ×Õþ°.÷'†ânþþeX7÷üÒ.  Jþ8™=  + v ² +² +±)é°/±é°/±"é°,/° Ö±é°±%+°2±
é±-+± ±99°%³$9°
²999 ±°9±)²
 999°°9014 3237! !"'732326=##" %326=4&#"JÑÏ^#	þßþÃîC“¨†—iÀÈþúTxhF{jW`€õ:—}½ý´þÉþÐUýQˆD"ìyŸe]u¢   ‰  ’	  E ²   +°3² +±é°/°/° Ö±é°2°±+±é±+±°9 ±°9013!3>32!4#"‰P1¥]±Ðþ¯²Jl	ý›CVôâý™@îeXý    t  í   L ²  +² +°	/´ +°/° Ö´ !+´ !+³ +±é°/±é±+±±	99 014632#"&!thTTihUUgP`LddLLcdúë%ûÛ  ÿ©þ+ 
  M ² +°
/± 	é°/´ +°/°Ö±é°³!+´ !+°/´ !+±+±±99 01>5! !4632#"&Wb,PþÎþö×iTUgfVUhÑD¤»Lübþªþú5LdcMKdd  ‡  Ü	  0 ²   +°	3² +°/°/° Ö±é°2±+ ± ±99013!36!	!‡P–þuÆþ_þóW	ü^8†þSýˆµkþ¶    ‰  Ù	   ²   +°/°/° Ö±é±é±+ 013!‰P	ù÷  €  ò= # q ²!  +±33²  +² +°3±é°2°$/°!Ö± é´ +° ±+±é°±+±é±%+± °9±!°	9°°9 ± ³	$901!36323632!4#"!4&#"!4€q×gŸ#†Ø¨Çþº¢Iaþ»SLGgþ»%“«aYºòàý•;õoZý™Jnxp[ý›Ñ  €  ’=  N ²  +°	3²  +² +±é°/°Ö±é°±
+±	é±+±±99°
°9 ± ±9901!3632!4#"!4€#wÙ³Ôþ¯¯Hqþ°%•­ñÝý‘Dìleý¡Ñ   HÿèÀ=   D ²	  +±é² +±é°/° Ö±é°±+±é±+±±	99 ±± 99014 !2  #" %32654&#"HA	÷7þ¸øúþÂY{fe{uikxý4þÐîþûþÎ-ý®¬‘‹°±    ~þRí=    h ²
  +±é²  +² +±	é°/°!/°Ö±é°2´ +°±+±é±"+±°9°±
99 ±
±99°°9° °901!632  #"&'#!432654&#"~%ƒò»
þÝÐ\œ&þ°P.g>m|lX%˜°þÖðþùþÌB:ýîn£þkE]D¡‰†¡…c   JþR³=   T ² +² +±é°/° /° Ö±é°±+±22±é±!+±±99°°9 ±± 99°°90146327!!##" %326=4&#"JãÕbIþ°kÜ¼þöT€kYz}Rn«‹•}þü9ûj9£-ý„ ~fcv¢  €  #=  B ²  +²  +² +´ !+°/°Ö±é´ +±+±°9 ± ±9901!3>32&#"!4€!

'£\3*1]’þ°%ÉmtþÅi†ýèÄï   Jÿèƒ=  h ²  +±é² +±é° /°Ö±é°±+±é±!+±±	99°³$9°²999 ±° 9°³$9°°901?3254&'$54632&#"#"J=:«B’G[þÈõÆ®†:~r‚Pb˜øÝÌ4î!.W+0`Ý˜Ç>æ<U&40y¼   %ÿèíF  X ²  +±é² +°3± é°2°/°Ö°2±	é°2²	
+³@		+°2²	
+³@ 	+±+ ±°9° °901535%3#327#"&5%Hññ>FA%O‹˜Â.÷ÈYþß÷þ‹iVÿµæ«    „ÿè”%  Y ²  +²  +±é² +°	3°/° Ö±é°±+±é°´ +°/±+±°9°°9 ±±9901!3265!!'##"&„Q­JoQþÝqå¶Ê·nýÊúkSrý2ª­š²î     Ž% 
 ! ²
  +²  +°3°/±+ ± 
°901!367!!nÒ'‘dþhþ­%ýR>lƒýûÛ    }%  n ²  +°3²  +±33°/±+°6ºÁ^òØ +
°.°
À±ù°À³+² Š Š#9 ³
....´
.....°@ ± °901!367!36!!&'#!U~)‡¨ŒIþµþÃr!&rþÃ%ý£²nžý{Š§hûÛ ‘­‡þt       ~%  & ²   +°3² +°3°/±+ ± ±99013	!36!	!'#uþ”x˜/—oþ•oþ‚ #¡î^C	þ	ýÒR?þß    þ Š%   ²  +°3°/±+ 01!3!
>54'vÎºiöc  ÅiEŽ¤%ýuCÎýaþñþÂ«c¥'*   0  ç%  2 ²   +±
é² +±
é°/±+ ± °9°°9°°90135 67!! !0_I_þþšRG¿¤SgÇþQ`Bþ÷     FÿoÏ ) ‘ ²
 +´ +°"/´ +° /´ +°*/°(Ö°2´ +°2²(
+³@!	+°2°° Ö´$ +°$/±&33´ +±22±++±(±99 ± ±$99°±99°±99015>54'&5%3#";# 47656FK[
JP'‡WdcX‡'Pþ¶
¥BTHav5 ¸›yl-rrtt(rlœ¹'4vaF     Çýá°\   °/° Ö´ +´ +±+ 013Çéýá{÷…   JÿtÏ * ƒ ² +´ +°*/´  +°!/´  +°+/°Ö°2´# +°2²#
+³@*	+°2°° Ö°3´' +°2±,+±#±
99 ±! ±&99° ±
99°±99013254'&54675.547654'#53 %#J&‡
XbcW‡&PICg§
þ¶P:œ WMMtssqAXL-š¸þß6uv3@T¥ˆbHþØ  Yµ9  Q °/±é³+±é°/° Ö´ +°±	+´
 +±+±	±99 ±° 9±±	
9901!23273#"&'&#"Y09w 3OÓ$QnB=€v -Xž› FW°Žc*'AY³   bþbí1   T ² +´	 +°/° Ö´ +´ +³ +´ +°/´ +³+±é±+±±	99 014632#"&3boWWnmXWo0ù0hWrrWYnoûRÕü+  ªÿæ(·  q °/´ 	+°±é°2°/±é²
+³@	+°/° Ö±é°±+°2´ +°2±+±±99 ±°9°² 	999°±99014753&#"327#5&ªî×Újj6Ssƒž¢we)Y†ÚØíÈË-+ÌÃ(õ( „‰›&ñ)ÎÕ     t  k› ! Ÿ ²   +±é°/°3±é°2°/±
é°"/°Ö±é²
+³@ 	+³@	+°° Ö´ "+°/´ "+²
+³@!	+³@	+±#+±°	9°±99°°9 ± °9°°9±±99°°90135>54'#53&54$32&#"!!!tmŠ×°Þ¦c7Lsej4þê/OS°0°a8æ[NÍû6ü)ma?[æ_‡Hþï      Ñƒ  r ²  +°/°3´ +°2°/°3´ +°2° /°	3°/°Ö°2±é°2²
+³@	+°2²
+³@	+°2±+±±99 ± °901!3>7!!!!!!!5!5!5!mž%79Ÿdþ€	þ¢^þ¢þÅþ§Yþ§	ƒþ©Qœ š8Rýš‹›þ¦Z›‹    ÿÎŸ»Ë   < ² +°3±	é°2² +±	é°/° Ö´ "+°±+´ "+±+ 014632#"&%4632#"&2YA<SS>@XÄV??USA>W4?XW@=XY<@WVA=XX  F Ax   - Œ °	/´ +°+/´& +° /´ +°/´ +°./° Ö´ 
+°±+´# 
+°#±+´ 
+±/+±#°9°¶	)+$9 ±&+°)9° ¶ ($9°°901 !   !     54 #" 4632&#"327#"&F‡„þ~þìþëþy‘3°1þÎ×ÚþÏš÷¬JŽ!Ww€Œ•u‡T!k¢¸ÚâŠþwþìþèþwŠãþÂ?äâAþ¿í°ä#u2Ž€v™6pFÛ    < „ÑÄ    3	#3	#< ÿèþùè°ýéþùé%Ÿþaþ_¡Ÿþaþ_     AÈ‰¥   5!AHÈÝÝ     CüÏ   , 4 » ² +´ +°	/´ +°+/´- +²+-
+³@+	+°%2°2/´ +°5/° Ö´ 
+°±+´, 
+°-2°,±0+´ 
+°±+´ 
+±6+±0,µ	($9°² $&999°°%9 ±+°#9°-µ  !$9°2°9°°9014 32  #" 732654&#"632#&'&+32'4#"CÉÉþæËÉþáuÚ™šÙÙš˜Û¬cKzphKuZ57xn3çÉþâÊÎþã È£ää£¤ææþBJV_w\+{Sà9NP  œ¥’ò    ° /´ +°/° Ö´ 	+±+ 01!œÀ6þñ¥Mþ³    bþE   2 °/´ +°/°Ö´ 
+±+±±	
99 ±° 901732'4'73#"b+@8N«`²;FY–veþpz#8Bºg	X<d[   6 „ÄÄ    7	3	3	3	6þùæþÿÂþúæ ÿ „¡Ÿþaþ_¡Ÿþaþ_     bþI1  # n ² +´! +°/±
é°$/°Ö´ +³+± é° /±é³+´	 "+±%+± °9±	³!$9 ±°9°!² 99901467675!327#"&4632#"&bOmq$T.ž~cM¢ÕÇá nWWomYWndM§wz—%D	«“_^%€Dð[¼cWrrWWpp   )  :    ‘ ²   +±33² +°3´ +°3±é°2°/° Ö±é°±+±é±+°6ºÂåì÷ +
°°À°°À°³+³+²...°@± °9°´	
$9 ±°9013!!!!!!'#)Ï»Úþ”wþIl5^¿þó=Q„(F·úI~þ‚:þðüL¬ þê    )  8    ‘ ²   +±33² +°3´ +°	3±é°2°/° Ö±é°±+±é±+°6ºÂåì÷ +
°°
À°°À°
³
+³	
+²	...°@±´$9°°9 ±°9013!!!!'#!)Ï»Úþ”wþIlžQ„(F5»`þò·úI~þ‚v¬ þêzþî  )  8    ‘ ²   +±33² +°3´ +°3±é°2°/° Ö±é°±+±é±+°6ºÂåì÷ +
°°À°°À°³+³+²...°@±´
$9°°9 ±°9013!!!3#'!'#)Ï»Úþ”wþIlãïäèqsTQ„(F·úI~þ‚&þîüP¬ þê    )  K   # Í ²   +±33² +°3´ +°3±é°2°/´
 +° Ö´ +°$/° Ö±é°±+´ 
+°±+´ 
+°±+±é±%+°6ºÂåì÷ +
°° À°°À° ³ +³ +²...°@±²999°²
"999 ±°!9°±99013!!!32327673#"'&#"!'#)Ï»Úþ”wþIl%ª<SW •.0OFJJ."Q„(F·úI~þ‚/+,1¥45*'_üG¬ þê     )  V    + ½ ²   +±33² +°3´ +°3±é°2°/°)3±é°!2°,/°Ö´ "+³+± é° /±é°±+´% "+³%+±é±-+°6ºÂåì÷ +
°°À°°À°³+³+²...°@±²999°°9 ±°9013!!!47632#"'&!'#47672#"&)Ï»Úþ”wþIl,-B;)+S<A.,µQ„(F³,*@=+***>AU·úI~þ‚À>-++->=W,+ûó¬ þê?,*+->>++U     )  <   ! ¶ ²   +±33°/°3±é°2° /´ +°"/° Ö±é°±+´ 
+°±+´	 
+°	±+±é±#+°6ºÂÎíB +
°°À°°À°³+³+ °.²...°@±²999°±99 ± ´	$9013&54632!!!'32654&#")Ï?ˆŠ™NÚþ”uþGjšSmAF>26@@65·1gd‰~lm.úI~þ‚vbêþùÑ61A?52@       a·    ²  +° 3±	é² +±é´+°3±é°2´+±é°/±+°6ºÀ„÷â +
°.°.°±	ù°±ù°³	+³	+°³+ °.¶	.......°@ 013!!!!!!!!#…ý'Býì/Büž7þD¨.KJ·þîþÏþñþ¬þïþpŸ+Ç     NþE Ï & „ ²  +±é²$  +² +±é°/´ +°'/° Ö±é°±!+´ 
+±(+±!´#$$9°´$9 ±°9°²#999°°9°² 999°°901 !2&#"  327#"'732'4'7$ NÌkñŠD‹ŸÛþùá¤;ý)HW”ujF,<9O«WþÒþºÈ`§Dþø;þÿâÜþÿ2þû>G
X=cZ+z#8B§/ƒ     ‘  V:   R ²   +±	é² +±é´ +±é°/° Ö±	é°2²	 
+³@		+³@		+³@		+±+±	 °9 013!!!!!!!‘¦ý«2ýÎtü§]Àþó·þîþÓþñþ¨þï:þð  ‘  V9   R ²   +±	é² +±é´ +±é°/° Ö±	é°2²	 
+³@		+³@		+³@		+±+±	 °9 013!!!!!!‘¦ý«2ýÎtýx»`þò·þîþÓþñþ¨þï'þî    ‘  V8   R ²   +±	é² +±é´ +±é°/° Ö±	é°2²	 
+³@		+³@		+³@		+±+±	 °9 013!!!!!3#'‘¦ý«2ýÎtü¿äîäèqs·þîþÓþñþ¨þï&þî  ‘  VV   ) ˆ ²   +±	é² +±é´ +±é°/°'3±é°2°*/° Ö±	é°2²	 
+³@		+³@		+³@		+°	° Ö´ "+°/´ "+°	±+´# "+±++±	±99 013!!!!!47632#"'&%47672#"&‘¦ý«2ýÎtü”-,B;**S<A--Ä++?>*++)?@U·þîþÓþñþ¨þïÀ>-++->=W,+=?,*+->>++U    ÿÃ  â:   * ²  +² +°/°Ö±é°2±	+±±99 01!!!=\ÀþóAQ:þðùÖ·úI     ‘  µ8   ) ²   +² +°/° Ö±é±	+± ²999 013!!‘Qþ¹»_þó·úI&þî    ÿâ  š8  
 * ²  +² +°/°Ö±
é±+±
³$9 013#'!äðäèrr=Q&þîùÚ·úI    ÿÇ  ±V     ` ²  +² +°/°3±é°2°!/°Ö±é³+´  "+° /´ "+³+´ "+±"+± ±99±°9 0147632#"&!47672#"&9,-@<**S=@YÊQX+*A=+))*>AUÀ>-++->=WWù}·úIÀ?,*+->>++U   ‘  vK  ) • ²   +°3² +°	3°'/´ +°# Ö´ +°*/° Ö±é´ "+°±+´) 
+°)±+´ 
+°±+±
é±++±°9°)°9°±#99°°9 ± ±99°#±)99013!3&!! '&'#3232673#"'&#"‘aeo6þœþŒHHMª<SW
!•/0OFIJ.·ýª¯þóæv¶úI†……²þëþ™þ:/+,/1¥45*'_     Nÿè:     M ²  +±
é² +±
é°!/° Ö±é°±+±é±"+± °9°³$9 ±± 990176!  '&!!3254#"NÎÏEHÆÅÌÍþ³þ½ÆÆZ^¿þòþùÎ¨«ÌÎ§ªggÑNØØÑÐþºþ£ÐÒÒÐ°þðü¯×þïÞÕ‹‰     Nÿè8     M ²  +±
é² +±
é°!/° Ö±é°±+±é±"+±³ $9°°9 ±± 990176!  '&3254#"!NÎÏEHÆÅÌÍþ³þ½ÆÆbÎ¨«ÌÎ§ªggéº`þóÑNØØÑÐþºþ£ÐÒÒÐO×þïÞÕ‹‰tþî    Nÿè8   # F ²  +±
é² +±
é°$/° Ö±é°±+±é±%+±² 999 ±± 990176!  '&3254#"3#'NÎÏEHÆÅÌÍþ³þ½ÆÆbÎ¨«ÌÎ§ªggäðäêptÑNØØÑÐþºþ£ÐÒÒÐO×þïÞÕ‹‰tþî     NÿèK   1 „ ²  +±
é² +±
é°//´ +°+ Ö´# +°2/° Ö±é°±+´1 
+°1±&+´' 
+°'±+±é±3+±&1´+$9 ±± 99±+±1990176!  '&3254#"3232673#"'&#"NÎÏEHÆÅÌÍþ³þ½ÆÆbÎ¨«ÌÎ§ªggCª<SW
!–/0NFJJ/ÑNØØÑÐþºþ£ÐÒÒÐO×þïÞÕ‹‰}+,/1¥45*'_   NÿèV   * : u ²  +±
é² +±
é°(/°73±!é°/2°;/° Ö±é°±+´% "+°%±++´3 "+°3±+±é±<+±+%²999°3°79 ±± 990176!  '&3254#"47632#"&%47672#"'&NÎÏEHÆÅÌÍþ³þ½ÆÆbÎ¨«ÌÎ§ªgg,-@<*)R=@YÃ+*A=***)>A,*ÑNØØÑÐþºþ£ÐÒÒÐO×þïÞÕ‹‰>-++->=WW=?,*+->>+++*   Nÿm3   # r ²  +±é²  +² +±é°$/° Ö±é°±!+±
é±%+± ²999°!µ$9°
°9 ±±99°²
#999°²99901 !27 !"''7&&#"325&'NA½“~¿}Çþhþ¿°“‹¹ÕT= T`²×ãBd±Ö8ÙH®N²…´Õþ¿þ§þ]JÅ“¶ÕPÏ4þìýc2á„z  ‘ÿèe:   B ²  +±
é² +°
3°/° Ö±é°±	+±é±+± °9°	³$9 01! !  !!‘QGH‡Qþ¼þÌý¥ô]Àþò(üÃ¿ed‰=üÔþµþ©Rþð    ‘ÿèe8   B ²  +±
é² +°
3°/° Ö±é°±	+±é±+±	³$9°°9 01! !  !‘QGH‡Qþ¼þÌý¥Ù»`þò(üÃ¿ed‰=üÔþµþ©>þî     ‘ÿèe8   I ²  +±
é² +°
3°/° Ö±é°±	+±é±+± °9°	´$9°°9 01! !  3#'‘QGH‡Qþ¼þÌý¥'äîäèqs(üÃ¿ed‰=üÔþµþ©>þî    ‘ÿèeV   . h ²  +±
é² +°
3°/°,3±é°$2°//° Ö±é³ +´ "+°±	+±é³(	+´  "+° /´( "+±0+± °9 01! !  47632#"&%47672#"&‘QGH‡Qþ¼þÌý¥,-@<**))>@YÃ+*A=+))*>AU(üÃ¿ed‰=üÔþµþ©Ø>-++->=+,W=?,*+->>++U    >8 
  5 ²	  +²  +°3°/°	Ö±é±+±	³$9 ± 	°901! 6!!!‚

2Ýþþ¯2»`þó·ý¤‡ïü²ý—[Ëþî  ‰ÿèã" ( v ²   +²  +±é°%/±é°)/° Ö±(é°(±+±é³"+±é° Ö±é±*+±(±99°´%$9±"°9 ± °9°%²999013 !2#"'732654'&747654&#"‰-Ï6~J°ðÍ”Y)=]CQO¬³`NÓ¨?;â´s?<[ANºš«Í%ö=1>R±†°a"%Ocþ¡ü<   Aÿè!ò   ( { ²  +²  +±"é² +±é´'+±é°)/° Ö±é°±&+°2±é±*+± ²	
999°&´$9°²999 ±±99°°	9°°
901476%54#"'632!'##"&!#3276= A¦¥6È¤‰@±öêyyþÓ	mÉœÃ 6¿æcH>E9;þÁ.Åii„PÕavvÝþ¡bj‚¾Lþ³ü«;B0/Wl   Aÿè!ò  $ ( z ²  +²  +±é² +±é´#+±é°)/° Ö±é°±"+°2±é±*+± ±	
99°"µ%&($9°²'999 ±±99°°	9°°
901476%54#"'632!'##"&%3276= !A¦¥6È¤‰@±öêyyþÓ	mÉœÃLH>E9;þÁ"¿7þð.Åii„PÕavvÝþ¡bj‚¾ª;B0/Wl°Mþ³     Aÿè!ò  ! + } ²  +²  +±%é² +±é´*+±é°,/° Ö±"é°"±)+°2±é±-+±" ²	
999°)¶!$9°²999 ±±99°°	9°°
901476%54#"'632!'##"&3#'3276= A¦¥6È¤‰@±öêyyþÓ	mÉœÃºÛ×Û×ntBH>E9;þÁ.Åii„PÕavvÝþ¡bj‚¾ÿMþ³½½ü«;B0/Wl    Aÿè!Ó  / 9 ¹ ²  +²  +±3é² +´- +°-°) Ö´! +²)!
+³@)	+² +±é´8+±é°:/° Ö±0é°/2°0´ 
+°/°0±7+°2±é³%7+´& 
+±;+±% ³
)$9°&±99 ±8²999°°9°°	9°°
901476%54#"'632!'##"&32327673#"'&#"3276= A¦¥6È¤‰@±öêyyþÓ	mÉœÃÂ¦1aG 
“TY?[:-H>E9;þÁ.Åii„PÕavvÝþ¡bj‚¾,)0}0!bü›;B0/Wl    Aÿè!Ë  ( 2 A ¬ ²  +²  +±,é² +°73±%é°>2² +±é´1+±é°B/°Ö´" "+°"°) Ö± é° /±)é°"±0+°2±é°3 Ö´; "+±C+±"±99°3±,99°;±99 ±1²999°°9°°	9°°
901476%54#"'632!'##"&47632"'&3276= 47672"'&A¦¥6È¤‰@±öêyyþÓ	mÉœÃ’-,A<SS>@-+ºH>E9;þÁ
**A?**RA?++.Åii„PÕavvÝþ¡bj‚¾Ž?,,W@=W,-üX;B0/Wl?@++*,A=W,,  Aÿè!@  ( 2 @ ´ ²  +²  +±,é² +±é´1+±é°%/´6 +°>/´ +°A/° Ö±)é³) +´3 
+°)±0+°2±é°: Ö´" 
+±B+±3°9°:´,%>$9°"±99 ±1²999°°9°°	9°°
9±>6±"9901476%54#"'632!'##"&462#"'&3276= 327654'&#"A¦¥6È¤‰@±öêyyþÓ	mÉœÃŠtuCCŠqrEG=H>E9;þÁ^7*.--7.Åii„PÕavvÝþ¡bj‚¾¿a{<<c\y=<üG;B0/Wlp)>,.=   Aÿè¹= & 0 7 – ²$  +°3±*é°2² +°3±é°52´1$+±1é°1° Ö´/ +°8/° Ö±'é°'±2+±é±9+±' ±	
99°2@
".1$9°²999 ±*² '999°1°9±°	9014$!54&#"'63 632!327#"&'#"&%32>= %!4&#"AX/ig›ŒBÂ¿j‰ê×òýN¡}¨.õ‰Ü8ŒþöªÎML>A]þ½o†bYWo4¾É)SRÕe­­þÐâ`bs:àRcZ¼½§8ADA-jªXqw    HþEÁ= & ‹ ²  +±é²$  +² +±é°/´ +°'/° Ö±é°±!+´ 
+±(+± ±99°!³#$$9°´$9 ±°9°²#999°°9°² 999°°9014 !2&"327#"'732'4'7&HH$•t6Ns„¡¨„nY-n£)GX—ueJ-:<N«TÔèðA+ù%£„ˆ¢%ô/H
Y<d[+|%8B§%  HÿèVò   # [ ²  +±é² +± é´
+±é°$/°Ö±é²
+³@ 	+±%+±²	999 ±°9°
°9°° 90147632 !327# '&!#!4'&#"H”•üèý?	UVƒ¥Š+¥æþðš›Å7¿æ˜˜,,jW89ç©§þÖìM3^45-ßF’‘çþ³ýèKDD:;  HÿèVò   # \ ²  +±é² +±é´
+±é°$/°Ö±é²
+³@ 	+±%+±³	"$9 ±°9°
°9°° 90147632 !327# '&!4'&#"!H”•üèý?	UVƒ¥Š+¥æþðš›=˜,,jW89I¿6þñç©§þÖìM3^45-ßF’‘‚KDD:;ºMþ³     HÿèVò   & \ ²  +±é² +±#é´
+±é°'/°Ö±é²
+³@ 	+±(+±³	$9 ±°9°
°9°° 90147632 !327# '&3#'!4'&#"H”•üèý?	UVƒ¥Š+¥æþðš›ÔÜ×Û×ntl˜,,jW89ç©§þÖìM3^45-ßF’‘šMþ³½½ýèKDD:;    HÿèVË  $ - < ˜ ²  +±é² +°23±!é°92² +±*é´%
+±%é°=/°Ö´ "+°±.+´6 "+°& Ö±é²&
+³@& 	+±>+±±
%99°.²*999°&°9±6²	999 ±
°9°%° 90147632 !327# '&47632"'&!4'&#"47672"'&H”•üèý?	UVƒ¥Š+¥æþðš›¯-,B<SS>@,,˜,,jW89(+*A?**RA>-+ç©§þÖìM3^45-ßF’‘)?,,W@=W,-ý•KDD:;I@++*,A=W,,    ÿÀ  Ùò   ) ²  +² +°/°Ö±é±	+±²999 01!#!@6ÀæGPòþ³û[%ûÛ   ‰  ›ò   ) ²   +² +°/° Ö±é±	+± ²999 013!!‰PþÌ¿7þð%ûÛ¥Mþ³    ÿî  {ò  
 * ²  +² +°/°Ö±
é±+±
³$9 013#'!ÚØÛ×nt9P¥Mþ³½½û[%ûÛ    ÿ»  ©Ë     Z ²  +² +°3±
é°2² +°!/°Ö±é³+´  "+° /´ "+³+´ "+±"+± ±
99 0147632"'&!47672"'&E-,B<SS>@,,ÍPZ++@?*+SA>-+4?,,W@=W,-û%ûÛ4@++*,A=W,,   €  ’Ó  ) œ ²  +°	3² +´' +°'°# Ö´ +²#
+³@#	+²  +² +±é°*/°Ö±é°°) Ö´ 
+°/´) 
+°±
+±	é° Ö´  
+±++±)±99°³#$9 ±°901!3632!4#"!432327673#"'&#"€#wÙ³Ôþ¯¯Hpþ°Ô¦1aG 
“TY?[:-%•­ñÝý‘Dìleý¡ÑG,)0}0!b    HÿèÀò    L ²  +±é² +±é° /° Ö±é°±+±é±!+± °9°´$9 ±°901476!2 "'&!#32654&#"H ¡	÷›œþ·÷úŸ ç7¾æœ{fe{uik<<ýšš—™îþûþÏ–—Ýþ³ým®¬‘‹°YX  HÿèÀò    L ²  +±é² +±é° /° Ö±é°±+±é±!+±´$9°°9 ±°901476!2 "'&%32654&#"!H ¡	÷›œþ·÷úŸ Z{fe{uik<<L¿6þñýšš—™îþûþÏ–—ý®¬‘‹°YXMþ³   HÿèÀò   " S ²  +±é² +±é°#/° Ö±é°±+±é±$+± °9°µ$9°°9 ±°901476!2 "'&3#'32654&#"H ¡	÷›œþ·÷úŸ øÛØÛ×oss{fe{uik<<ýšš—™îþûþÏ–—Mþ³½½ým®¬‘‹°YX  HÿèÀÓ  # 0 ’ ²  +±'é² +´! +°!° Ö´ +²
+³@	+² +±-é°1/° Ö±$é°$°# Ö´ 
+°/´# 
+°$±*+±é° Ö´ 
+±2+±#µ'-$9 ±-'°901476!2 "'&32327673#"'&#"32654&#"H ¡	÷›œþ·÷úŸ ¨0aG “UY>\:.H{fe{uik<<ýšš—™îþûþÏ–— ,)0}0!bý]®¬‘‹°YX  HÿèÀË   + ; m ²  +±"é² +°03±é°82² +±(é°</° Ö±é³ +´ "+°±%+±é°, Ö´4 "+±=+±,³"($9 ±("°901476!2 "'&47632"'&32654&#"47672"'&H ¡	÷›œþ·÷úŸ Æ-,A<+)**>@,,”{fe{uik<<0*+@?+++)A>,+ýšš—™îþûþÏ–—?,,,+@=,+,-ý®¬‘‹°YX–@++*,A=,+,,    Jÿ„À   & f ²  +± é² +±é°'/° Ö±é°±#+±
é±(+± °9°#³$9°
°9 ± ±99°³
 &$9°±99014 327#"''7&&#"32654/J<þ–vgrd»”þ÷œ•molaÁF)A2Hs„+Hpˆ%ø5:šQ‘˜þõ§ýŒ9W™jBÆ%´þa%©bD     „ÿè”ò   e ²  +²  +±é² +°
3°/° Ö±é°±	+±é°´ +°/±+± °9°	´$9°°9 ±±9901!3276'!!'##"'&!#„Q­J88QþÝqå¶eeœ7¿æ·nýÊú65Srý2ª­š²wwþ³     „ÿè”ò   e ²  +²  +±é² +°
3°/° Ö±é°±	+±é°´ +°/±+±	´$9°°9°°9 ±±9901!3276'!!'##"'&!„Q­J88QþÝqå¶eezÀ5þñ·nýÊú65Srý2ª­š²wwÏMþ³     „ÿè”ò   l ²  +²  +±é² +°
3°/° Ö±é°±	+±é°´ +°/±+± °9°	µ$9°°9°°9 ±±9901!3276'!!'##"'&3#'„Q­J88QþÝqå¶ee¿Ü×Û×os·nýÊú65Srý2ª­š²wwÏMþ³½½     „ÿè”Ë  % 5  ²  +²  +±é² +°*3±"é°22² +°
3°6/° Ö±é°° Ö´ "+°/´ "+°±	+±é°& Ö´. "+°´ +°/±7+±°9°&°9 ±±9901!3276'!!'##"'&47632"'&%47672"'&„Q­J88QþÝqå¶ee”,-B<S+)>?-+Â,*@>,**)A?+,·nýÊú65Srý2ª­š²ww^?,,W@=,+,-<@++*,A=,+,,    þ Šò    ²  +°3°/±+ 01!3!
67674'!vÎºiöc¡OPÅiEŽRQ;À6þñ%ýuCÎýaþñþÂVUd
RS'*JMþ³  þ ŠË  # 3 U ² +°(3± é°02²  +°3°4/°Ö´ "+°±$+´, "+±5+±²999°$±99°,°9 01!3!
67674'47632"'&%47672"'&vÎºiöc¡OPÅiEŽRQ´-,B<S**=@,,Ã++??+++)A>,+%ýuCÎýaþñþÂVUd
RS'*Ù?,,W@=,+,-<@++*,A=,+,,   )þI›·   ­ ²   +±33² +°3°/´	 +´ +°3±é°2°/° Ö±é°±+´ 
+±+°6ºÂåì÷ +
°.°.°±ù°±ù³+³+´.....°@±±99 ±	°9° ±99±°9013!327#"&5467#!!')Ï»Ú]p1&2<Ko_p|UÂwþIlžQ„(J·úI.}3%-x'aSI–$~þ‚v¬ þê    AþI/= ) 2 ­ ²'  +±-é²  +²#  +² +±é°/´ +´1'+±é°3/° Ö±*é°*±0+°2±é° Ö´ 
+±4+±* ±	99°³'-$9±0±#%99°²"999 ±'²999°-°$9°1± 99°°9°°9014$!54#"'632327#"&5467#'##"&%326= AK6È¤‰@±öêò]q2%2:Lo^q{V‚	mÉœÄMG?EtþÁ.ÅÓ„PÕaìÝþ¡b.}3$.x'aSK“%j‚¾ª;B_Wl   Nÿè 8   = ²  +±é² +±	é°/° Ö±é±+ ±°9°	² 999°°90176!2&#"  327  !Næækô‡Dˆ Ýþùã¤‚4–ôþŽþZD»_þòÈ`ÓÔDþø;þÿâÜþÿ2þûB’¬þî     HÿèÓò   = ²  +±	é² +±	é°/° Ö±é±+ ±°9°	² 999°°901476!2&"27  !H¨¨“t6SnƒQPTT„k\){»þùþÈ–¿6þñ
øž+÷#RRƒ‡PO#ô4(•Mþ³   Nÿè 8   = ²  +±é² +±	é°/° Ö±é±+ ±°9°	² 999°°90176!2&#"  327  373#Næækô‡Dˆ Ýþùã¤‚4–ôþŽþZ¯æxpéàõÈ`ÓÔDþø;þÿâÜþÿ2þûB’¾þî     HÿèÜò   E ²  +±	é² +±	é° /° Ö±é±!+± °9 ±°9°	² 999°°901476!2&"27  373#H¨¨“t6SnƒQPTT„k\){»þùþÈýØus×Üß
øž+÷#RRƒ‡PO#ô4(âÀÀþ³    ‘ÿñÍ8    W ²
  +±	é² +±	é° /° Ö±é°±+±é±!+± °9°³$9 ±
° 9°°9°°901763  %"373#27654'&#"‘Ú÷ÓÍËþ0þß5æxpèÞöp\û‰Š}}íb>ž!ÅÄþÄþ‹þeGþîúÖ„„÷âuw     Jÿèu  # ) Œ ²  +²  +±
é² +±!é°/°&3°*/° Ö±é°±+°2±	é°	±é°/°	±&+´' +±++±°9±&°$9°'°)9 ±±99°!° 9°±99°±$)990176 3!!'#"'&%3276=4'&#"6?JŽ™WP	þÔníÅ‡‡TA@lNBA:9\nuN"ðTn
 ÿššyEû4®¡¸˜™û„ON99}{b??£¾ØÙÿµ  ÿëàÉ   y ²  +±	é² +±	é´ +°3±
é°2°/°Ö°2±é°2²
+³@	+²
+³@ 	+°±+±	é± +±±99 ± ±	99±°901363  !"'3  54&#"!!ŸÚ÷Rk¯þ1þß©P` úîb?3þÍe;!»þÅÐþ‡þaeþýãíþ´þø    Jÿè	  ' ’ ²  +²  +±
é² +±%é°/°3´	 +°2°/°(/° Ö±é°±!+±
22±é°2²!
+³@	+²!
+³@!	+°±é°/±)+±!°9°°9 ±%² 999°±99014 3235!5!5!3#!'#" %326=4&#"JÏÌWþØ(Pmm	þÔníÅþòTlPt[n
û8yõÌ„„Ìü„®¡¸1û„uz{b~£    ‘þIc·  q ²   +±	é²  +² +±é°/´ +´ +±é°/° Ö±	é°2°	±+´ 
+²
+³@	+³@	+³@	+±+ ± ±99013!!!!!327#"&5467‘¦ý«2ýÎt]r1&2<Lo^q|U·þîþÓþñþ¨þï.}3%-x'aSI–$     HþRV= % , — ²#  +±é²  +² +±*é°/´ +´&	#+±&é°-/°Ö´ 
+²
+³@ 	+°±'+±é±.+±´!#*$9°'°9°µ$9 ±#²999°°9°	°9°&° 9014 32 !327327#"&547  !4&#"H)üèý?	¬‚¥Š+&hkF2%2:Lo^q™)þðþË=˜XjWqçPþÔêM3^i-ß M`'$/x'aS}h#‚Kˆu  ‘  V8   R ²   +±	é² +±é´ +±é°/° Ö±	é°2²	 
+³@		+³@		+³@		+±+±	 °9 013!!!!!373#‘¦ý«2ýÎtü½æwqèàõ·þîþÓþñþ¨þï8þî    HÿèVò   & \ ²  +±é² +±#é´
+±é°'/°Ö±é²
+³@ 	+±(+±³	$9 ±°9°
°9°° 90147632 !327# '&373#!4'&#"H”•üèý?	UVƒ¥Š+¥æþðš›Ð×vr×Ûàn˜,,jW89ç©§þÖìM3^45-ßF’‘çÀÀþ³ýèKDD:;  ‘  @8  	 8 ²   +±é² +°
/° Ö±é² 
+³@	+±+± ²	999 013!!!‘Q^ü_»^þó·ûcþæ&þî    ‰  ¬x   ' ²   +°/°/° Ö±é±	+± ²999 013!!‰Pþ¸»`þò	ù÷gþï   ‘  @`   R ²   +±é² +°/° Ö±é² 
+³@	+°±+´	 +±+±°9°	°9 ±±99013!!6?‘Q^þ@O#îSn·ûcþæŸØÛÿµ   ‰  ¢  	 D ²   +°/°3°
/° Ö±é°±+´ +±+±°9°°	9 ± ±	99013!6?‰PiN"ðTn	ù÷XØÙÿµ   ÿú  N·  M ²  +±	é² +°/°Ö°2±	é°2²	
+³@		+³@		+²	
+³@	+±+ ±	± 990157!%!!§Pþæ]üSŽãqÕþ
»ä½þ?þæ       „	  7 ²
  +°/°/°
Ö°2±	é°2²	

+³@		+²
	
+³@
	+±+ 0157!7!Rþ®uêt6ýÈ}î|ýç  ‘  v8   ] ²   +°3² +°	3°/° Ö±é´ "+°±+±
é±+±°9°´$9°
²999 ± ±99013!3&!! '&'#!‘aeo6þœþŒHHM•¼_þò·ýª¯þóæv¶úI†……²þëþ™þ:&þî   €  ’ò   Y ²  +°	3²  +² +±é°/°Ö±é°±
+±	é±+±±99°
³$9°	°9 ± ±9901!3632!4#"!4!€#wÙ³Ôþ¯¯Hpþ°Y¿7þð%•­ñÝý‘Dìleý¡Ñ7Mþ³    ‘  v8   d ²   +°3² +°	3°/° Ö±é´ "+°±+±
é±+± °9°°9°µ$9°
²999 ± ±99013!3&!! '&'#373#‘aeo6þœþŒHHM æxqèßö·ýª¯þóæv¶úI†……²þëþ™þ:8þî    €  ’ò   \ ²  +°	3²  +² +±é°/°Ö±é°±
+±	é±+±²999°
´$9°	°9 ± ±9901!3632!4#"!4373#€#wÙ³Ôþ¯¯Hpþ°¶×usØÜà%•­ñÝý‘Dìleý¡Ñ„ÀÀþ³  Nÿè<     $ \ ²  +±
é² +±
é° /°!3±	é°"2°%/° Ö±é°±+±é±&+±µ!"$$9°°#9 ±± 990176!  '&3254#"!3!NÎÏEHÆÅÌÍþ³þ½ÆÆbÎ¨«ÌÎ§ªgg<•7â¥–7âÑNØØÑÐþºþ£ÐÒÒÐO×þïÞÕ‹‰‡þýþý   HÿèÀò    # V ²  +±é² +±é°$/° Ö±é°±+±é±%+± °9°¶ !$9°±"#99 ±°901476!2 "'&!32654&#"!H ¡	÷›œþ·÷úŸ é‡	ÓL{fe{uik<<‡	Óýšš—™îþûþÏ–—™Dþ¼ýd®¬‘‹°YXDþ¼    NÿèãÏ  # ” ²  +±é²  +±
é² +±
é² +±!
é´+±é°$/° Ö±é°±+±é°
2²
+³@		+³@	+³@	+±%+±³$9°°9 ±°9±± 99±
°901 !2!!!!!!"  327&#"N¤Wr]qý«2ýÎsü©4WhVþŸþleúÖ_=Ep¿øÏ]£
þîþÓþñþ¨þïŸRÜþôœþô    HÿèO=  ( / – ²  +°3± é°2² +°3±-é² +±&é´)+±)é°0/° Ö±é°±#+´ +°±*é°*/±1+±#°9°*¶)$9°²999 ± °9±&² 999±-°9014 32632!327# '" %32654&#"!4&#"H5÷|Í:‡öãø	ýN©xŸ‘.•öþóŒ‰þïåþÐ[zeewsdnvéŠa`Un÷6c[¾þÖê#X]o:âR½¼2ø®ª“®®\rw  ‘  þ8  $ ( t ²   +°3² +±"é´ +±é°)/° Ö±é°2°±+±é±*+±´%&($9°³'$9 ± °9°±99°"±99°°90136! !&&'&+327654&"!‘¹L’‘IIu‰>o	þª+>34sh‹~HIƒyv(º`þó¤!omÌzbb)3ÚþvRƒ44ýÀ09:`ajdþî  €  #ò   J ²  +²  +² +´ !+°/°Ö±é´ +±+±°9°±99 ± ±9901!3>32&#"!47!€!

'£\3*1]’þ°u¿7þð%ÉmtþÅj…ýèÄïòMþ³  ‘  þ8    + { ²   +°3² +±)é´! +±é°,/° Ö±é°!2°±&+±é±-+± °9°&µ $9°³$9 ± °9°!±99°)±&99°°90136! !&&'&+373#327654&"‘¹L’‘IIu‰>o	þª+>34sh±æwqèßõ1‹~HIƒyv(¤!omÌzbb)3ÚþvRƒ44ýÀ8þîý
9:`aj  p  #ò   L ²  +² +² +´ !+°/°Ö±é´	 +±+±	±99°±
99 ±±	
9901373#!3>32&#"!4pØus×ÜßÌ!

'£\3*1]’þ°òÀÀþ³€ÉmtþÅj…ýèÄï    [ÿèc8 & * l ²%  +±é² +±é°+/°Ö±é°±+±!é±,+±±'99°¶
(*$9°!³)$9 ±%° 9°³!$9°°9017327654&'$476!2&#"!&![F¼Âo?>p‹þ]›š à§L™¦f:901¶Ë^_ŸŸþåô«»`þóF`**JBY/Š*À}|LþõH'(>9*(BHijÉ~=þî     Jÿèƒò " & m ²!  +±é² +±é°'/°Ö±é°±+±é±(+±²#999°´!$$9°´%&$9 ±!° 9°³$9°°901?3254'&'$54632&#"#"!J=:VUB’$#[þÈôÇ®†:~r‚((b˜øÝÌœ¿7þñ4î!W+`Ý˜Ç>æ<U&0y¼½Mþ³   [ÿèc8 & - o ²%  +±é² +±é°./°Ö±é°±+±!é±/+±±'99°@	
(*,-$9°!³+$9 ±%° 9°³!$9°°9017327654&'$476!2&#"!&373#[F¼Âo?>p‹þ]›š à§L™¦f:901¶Ë^_ŸŸþåôæxqèßöF`**JBY/Š*À}|LþõH'(>9*(BHijÉ~Oþî  Jÿèƒò " ) p ²!  +±é² +±é°*/°Ö±é°±+±é±++±´#$)$9°´!%$9°µ&'($9 ±!° 9°³$9°°901?3254'&'$54632&#"#"373#J=:VUB’$#[þÈôÇ®†:~r‚((b˜øÝÌAÖvrØÜà4î!W+`Ý˜Ç>æ<U&0y¼
ÀÀþ³    !  ¬8   G ²  +² +± é°2°/°Ö±é²
+³@	+²
+³@ 	+±+±³	$9 01!!!373#!‹þ_þ°±æxpèßõŸþèûaŸ™þî  %ÿèÓX   x ²  +±é² +°3± é°2°/°Ö°2±	é°2²	
+³@		+°2²	
+³@ 	+°	±+´ +±+±	²999°°9 ±°9° °901535%3#327#"'&56?%HññGA%O‹˜aaÀN"ïSo.÷ÈYþß÷þ‹i++ÿ[[å«hÙÚÿ µ   ‘ÿèe|   - s ²  +±
é² +°
3°/´# +°+/´ +°./° Ö±é°±+´ 
+°±'+´ 
+°±	+±é±/+±'²999 ±+#°901! !  4632#"'&7327654'&#"‘QGH‡Qþ¼þÌý¥oŒruCC†tpGG›)..*5(üÃ¿ed‰=üÔþµþ©¾^x:;a\w<<[)+,=   „ÿè”@  $ 2 ’ ²  +²  +±é² +°
3°!/´( +°0/´ +°3/° Ö±é³ +´% 
+°±	+±é°, Ö´ 
+°´ +°/±4+±%°9°,±!99 ±±99±0(±9901!3276'!!'##"'&462#"'&7327654'&"„Q­J88QþÝqå¶ee‰tuBCŠpsDF™7+-\·nýÊú65Srý2ª­š²wwa{<<c\y=<\)>,.     ‘ÿèe<    Y ²  +±
é² +°
3°/°3±	é°2°/° Ö±é°±	+±é±+± °9°	µ$9°±99 01! !  !3!‘QGH‡Qþ¼þÌý¥,–6á¥•7â(üÃ¿ed‰=üÔþµþ©Qþýþý    „ÿè”ò    q ²  +²  +±é² +°
3°/° Ö±é°±	+±é°´ +°/± +± ±99°	´$9°±99°±99 ±±9901!3276'!!'##"'&!3!„Q­J88QþÝqå¶ee³†	ÓÃ‡	Ò·nýÊú65Srý2ª­š²wwØDþ¼Dþ¼      >V 
  ( w ²	  +²  +°3°/°&3±é°2°)/°	Ö±é³	+´ "+°/´ "+³	+´" "+±*+±	²999±°9±"±&99 ± 	°901! 6!!47632#"'&%47672#"&‚

2Ýþþ¯¶-,B;**S<A--Ä++?>*++)?@U·ý¤‡ïü²ý—[e>-++->=W,+=?,*+->>++U   6  Ñ8   4 ²   +±	é² +±é°/±+ ±	 °9°±99°°901355!!!!6ÕýmLý:Óý»`þó´ç½ü"þê&þî  0  çò   2 ²   +±
é² +±
é°/±+ ± °9°°9°°	90135 767!! !!0_%%^þþš))Gý§¾7þñ¿¤*)gÇþQ/1Bþ÷¥Mþ³    6  ÑX   O ²   +±	é² +±é°/±é°/°Ö´ "+±+±±99 ±	 °9°±99°°901355!!!47632#"'&6ÕýmLý:ÓýF-,A<,))+=@--´ç½ü"þêÂ>-++-><----     0  çË   Q ²   +±
é² +±é² +±
é°/°Ö´ "+± +±²999 ± °9°°9°°	90135 767!! !47632"&0_%%^þþš))Gýµ-,B=R**>@W¿¤*)gÇþQ/1Bþ÷4?,,W@=,+Y    6  Ñ8   4 ²   +±	é² +±é°/±+ ±	 °9°±99°°901355!!!373#6ÕýmLý:Óüoæxpèßõ´ç½ü"þê8þî  0  çò   2 ²   +±
é² +±
é°/±+ ± °9°°9°°	90135 767!! !373#0_%%^þþš))GüãØus×Ûà¿¤*)gÇþQ/1Bþ÷òÀÀþ³    ?ÿ9g›  ³ °/±é°/±33±	é±
22°/±é°/±+°6º?ø~ +
°.°À±ù°À°³+³
+°³+º?r÷• +³+² Š Š#9 ²...¶
.......°@ ±° 9°°9±	°9°°9017267#53!2&#"3##"?/18`>+­É6°pG438Bdàû5[²{£ë–elæ#ì]Áæþd¼m      ¥ò  + ° /°3´ +°/° Ö´ +±+ ± °9013#'ÛØÚÖos¥Mþ³½½    ¶®@   L °	/´ +°/´ +°/° Ö´ 
+°±+´ 
+±+±±	99 ±± 99014632#"&732654&#"¶Šut…ŠosŒš8+-87,.7eazxc\yy\)>=,.<=   µzÓ  T ² +´ +°° Ö´ +²
+³@ 	+°/° Ö´ 
+°±	+´
 
+±+±	±99 013232673#"'&#"¨0aG “UY>\:.µ,)/0}0!b     AÈ‰¥   5!AHÈÝÝ     AÈ‰¥   5!AHÈÝÝ     AÈ‰¥   5!AHÈÝÝ     A¿ý‹   ° /´ +´ +°/±+ 015!A¼¿ÌÌ    A¿:‹   ° /´ +´ +°/±+ 015!Aù¿ÌÌ    ?à    ° /´ +°/° Ö´ 	+±+ 017?f Ïh1G	þÞþÔ     <à    ° /´ +°/° Ö´ 	+±+ 01%<h1=kœ",þ²ÿ     'ÿ üƒ    ° /´ +°/° Ö´ 	+±+ 01%'h0=g à#,þ·þ÷     <Äà   ! ° /°3´ +°/±+ ± °	9017?<g Ïh1vo˜Îh0G	þÞþÔSýþÞþÔ     <Äà   ! ° /°3´ +°/±+ ± °	901%%<h1=r•äh0=jœ",þ¦ô",þ²ÿ    %ÿ ¬ƒ   ! ° /°3´ +°/±+ ± °	901%%%h0=p—äh0=g à#,þ¬þ#,þ·þ÷    UÈ–
  . °	/´ +´ +°/° Ö´ +´ +±+ 014632#"&Uªvwª©xx¨èxªªxx¨§    £ÿèÖ{   # T ²	  +±!33´ +±22²	  +´ +°$/° Ö´ +°±+´ +°±+´ +±%+ 0174632#"&%4632#"&%4632#"&£qWWnpXWnÓqVXnpXWnÓoXXnpXWn²XqpYYqrXXqpYYqrXXqpYYqr   < „#Ä   °/° Ö´ 	+±+ 013	#< ÿèþùè%Ÿþaþ_   4 „Ä  ! °/° Ö°2´ 	+±+± °9 017	3	4þùæ ÿ „¡Ÿþaþ_  ÿè”› <  ²4  +±+é° /°$3´ +°"2°/°3´ +°2°/±	é°=/°<Ö°	2±%é°2²%<
+³@%$	+°2²<%
+³@< 	+°2±>+±%<²!"999 ± +°09±°901535465#53676$32.#"!!!!32>7#".'.'z|–*q_f°?@,…JR4!5ý¨\ýÅ%7—W'LD769¹nSžy0*=øœ$ œ±wju'ù";>E)œ "œ.G:7ñ#4"Aa>6‡Q    %W)·   ² +±
33´  +°2² 
+³@ 	+±22° /°Ö´ +²
+³@	+²
+³@ 	+°±+´ 
+°±+´ +±!+°6ºÂïê +
°
.°À±ù°Àº=ßï¢ +
°°À±ù°ÀºÂ)ï„ +°³+² Š Š#9 ·........@	
.........°@±°	9°°9°°9 ± ±99015!##!367!###/#%Ëý×;(r0<g5Ñ)©§z.°°ýP°ýP`þ‡Êç":ü ˜.¬ýö«JÁþßþ[       ((  ' ²   +² +°/° Ö´ +´ +±+ 011!((ûØ     •§~¢M_<õ      Ëö=ä    Ëö=äÿ©ýá:|            |ýº  zÿ©ÿU:                þ          À  L _n NÊ UÕ x® <ä FÅ N¸ ‰¸ Qê F Y:  É A: lÛ .Õ HÕ ÁÕ bÕ WÕ 6Õ _Õ CÕ lÕ JÕ C: j:  | W ~á l« tÁ )< ‘? N ‘© ‘š ‘û N ‘r ‘˜ÿþ[ ‘u ‘a t ‘P N ‘P N' ‘¸ [Ì !õ ‘“ » !f 'N  6¸ ˜ô !¸ _ [=  Š • A6 ~ó H2 J“ Hò ! J ‰_ tˆÿ©º ‡_ ‰x € € H6 ~2 JM €É J( % „¡ ” †   0¸ Ft Ç¸ J YÀ  L bÕ ªÕ tÕ ŠÿÎ½ F <É AR CŠ œŠ b 6á bÁ )Á )Á )Á )Á )Á )Ÿ ? N© ‘© ‘© ‘© ‘rÿÃr ‘rÿârÿÇ ‘P NP NP NP NP NP Nõ ‘õ ‘õ ‘õ ‘N 0 ‰• A• A• A• A• A• Aú Aó H“ H“ H“ H“ H_ÿÀ_ ‰_ÿî_ÿ» € H H H H H J „ „ „ „  Á )• A? Nó H? Nó H ‘  J- 2 J© ‘“ H© ‘“ Hu ‘_ ‰u ‘M ‰„ÿú~  ‘ € ‘ €P N H7 N H' ‘M €' ‘M p¸ [É J¸ [É JÌ !( %õ ‘ „õ ‘ „N  6 0 6 0 6 0Õ ?Š  d ¶Š ¾  |  ¾  |  ~  ß  ?  ?   ï     j  É AÉ AÉ A= Az AD ?D <D 'õ <õ < %ê Uz £  V <V 4ß  Õ  %'             T Œpú 6T|¤ÜB`Æ<ŒøJ˜,²f ¾âþ	n
6
š`°î$ÈæTzÔ(zÌ4 
<x¨ì(\Âø.Lh†öVž
h¸6z¾D`ÎfÐ.pÔ$tž@p¨.JÊ`ÆH´øŽ®¼jŠÂä R Ä!6!¬"R"ü#’$$Š$Ô% %n%ö&"&N&~&ä't'Ø(<( )2)Ê*D**Þ+2+²+ð,h,æ-f-ê.œ/T00®101š22x3$3N3z3ª44œ4ø5V5º6N6â7X7º88ˆ9"9^9Þ:j;
;^;²<<b<Æ=P=Ä>J>²?D?’@ @6@`@¤@ÞA"AVA¶BBvBÒCDC°D:DÐENEœF FrFðGdGäH\HžIIJ(JˆJøKxK´KøLPL®LìM2M¼MäN0N|N|N|N|N|N|N|N|N|N|N|N|NŠN˜N¦NÂNÞOO&OJOzOªOÚPPhPhP†PªPªQDRR"      þ B            b        Æ  	   ¼    	   ¼  	   Ø  	  < à  	  &  	  B  	  "`  	 ‚  	  4„  	 	 B¸  	 

ú  	  2  	  26  	  Hh  	 È °  	 É 0Æ C o p y r i g h t   1 9 9 2 - 2 0 0 3   A d o b e   S y s t e m s   I n c o r p o r a t e d .   A l l   R i g h t s   R e s e r v e d .   U . S .   P a t e n t   D e s .   4 5 4 , 5 8 2 . M y r i a d   W e b   P r o B o l d 0 0 1 . 0 1 4 ; A D B E ; M y r i a d W e b P r o - B o l d M y r i a d   W e b   P r o   B o l d V e r s i o n   0 0 1 . 0 1 4 M y r i a d W e b P r o - B o l d M y r i a d   i s   e i t h e r   a   r e g i s t e r e d   t r a d e m a r k   o r   a   t r a d e m a r k   o f   A d o b e   S y s t e m s   I n c o r p o r a t e d   i n   t h e   U n i t e d   S t a t e s   a n d / o r   o t h e r   c o u n t r i e s . A d o b e   S y s t e m s   I n c o r p o r a t e d R o b e r t   S l i m b a c h   a n d   C a r o l   T w o m b l y M y r i a d   i s   a n   A d o b e   O r i g i n a l s   t y p e f a c e   d e s i g n e d   b y   R o b e r t   S l i m b a c h   a n d   C a r o l   T w o m b l y   i n   1 9 9 2 .   M y r i a d   i s   a   s a n s   s e r i f   d e s i g n   t h a t   w o r k s   w e l l   a s   a   t e x t   f a c e   a s   w e l l   a s   p r o v i d i n g   f l e x i b i l i t y   f o r   f i l l i n g   d i s p l a y   n e e d s .   M y r i a d   W e b   h a s   b e e n   o p t i m i z e d   f o r   o n s c r e e n   u s e . h t t p : / / w w w . a d o b e . c o m / t y p e h t t p : / / w w w . a d o b e . c o m / t y p e h t t p : / / w w w . a d o b e . c o m / t y p e / l e g a l . h t m l W e b f o n t   1 . 0 T h u   J u n     7   0 7 : 1 5 : 4 9   2 0 1 2       ÿ4 f                     þ         	 
                        ! " # $ % & ' ( ) * + , - . / 0 1 2 3 4 5 6 7 8 9 : ; < = > ? @ A B C D E F G H I J K L M N O P Q R S T U V W X Y Z [ \ ] ^ _ ` a £ „ … – Ž ‹ © Š  Þ ª ¢ ­ É Ç ® b c  d Ë e È Ê Ï Ì Í Î f Ó Ð Ñ ¯ g ‘ Ö Ô Õ h ë ‰ j i k m l n   o q p r s u t v w x z y { } | ¡  ~ €  ì º ý þ ÿ 	
 â ã ° ± ä å !"#$ »%&'( æ ç ¦ Ø Ý Ù)*+,-./0123456 ² ³ ¶ · Ä ´ µ Å ‡ «7 ¾ ¿89 Œ:glyph1glyph2uni00A0uni00ADAogonekaogonekDcarondcaronDcroatEogonekeogonekEcaronecaronLacutelacuteLcaronlcaronNacutenacuteNcaronncaronOhungarumlautohungarumlautRacuteracuteRcaronrcaronSacutesacuteTcarontcaronUringuringUhungarumlautuhungarumlautZacutezacute
Zdotaccent
zdotaccentuni2000uni2001uni2002uni2003uni2004uni2005uni2006uni2007uni2008uni2009uni200Auni2010uni2011
figuredashuni202Funi205FEurouniE000 ¸ÿ…° K°PX±ŽY±F+X!°YK°RX!°€Y°+\X ° E°+D° Eº  +°+D° E²"+°+D° Eº  +°+D° E²[+°+D° E²8+°+D°	 Eº C +°+D°
 E²	'+°+D° Eº 
 +°+D° E²++°+D° E°+D° Eº ÿ +±Fv+DY°+  OÐe  
PACKAGER_BIN;
Packager_Php_Wrapper::$Contents[7]=<<<'PACKAGER_BIN'
wOFF     px     Ê@                       FFTM  ¨      TÅ®GDEF  Ä   (   ,J GPOS  ì  Ö  |µ‘GSUB  Ä   ¹  `Shz3OS/2  	€   [   `ŠÞ=Ÿcmap  	Ü    ¢¶÷¬`cvt   ð   2   2Qfpgm  $  ±  eS´/§gasp  Ø         glyf  à  X,  ¤DÛ'Æ¿head  f   4   6ÿÉ·hhea  f@       $bˆhmtx  f`  K  øpIÞloca  h¬  ó  þXt¦maxp  j         ¨name  jÀ    ¼³4ÌŠpost  mP  „  çFÓù prep  oÔ   š   Ó÷Ì6webf  pp      fOÐ       É‰o1    ¾Ÿ˜    Ëö=äxÚc`d``àb`b`f`d`b dbàdød³€e |axÚ½–ïkSgÇOÒ6IcMÒ®›8Tg«èÖMœZkÛé‹ÚF[ÛšÕ6¹¦Ò7›ÇÔ±n“ÍÃ‰8ÙÈ‹!a„"R¤ˆ‘1ŠaˆÛ\)¥dÒ‘Òu]‡ÄKòb`Ÿ}žÛ´kÿNžË½çùžïù>çœ{Å&"nÙ*¯‰½¶®±U<ï¾ñÁ	y^r¹/J‰~¾øÚöÎ›ïŸ—¾²,WìÖê›;eyî–Oå‰Ê5ÛN[Øµýd/²ûí]ö·íÙ¯Ù“ö´ýŸÎ—9=9ç®Ëåþš÷BÞWy¿8ªo9>vDýŽß8Îg—óCççüw9ï8ÿtåºžssv}çºé2ó_ÎïÌåßÉÿÍÝè>íþKò¤\VH…„¥RZáÐ*Õ€›)+eãJ}Á•G6ÈFu_¶`Û°íX…ª‘]ª_*UPv«O¤Zm’}*#uj\ê1?¶_MÈÖ•’Fì Ö„5c-Ø!,€Ïë¬­¬‡YÛÀhW#T%¤¢b¨ÛV?HLMuRf°|ñªGR¨¥ï
õ “°˜¿øÈÀÃŽ4W¥RïxÀ{ ÞR«¦à–€Oiâ7C¼vÝ&NùûÈÚÇ{U/q®‚?~Š,{‰á&†ÕJðtãé&Ž…ÊDE<Fƒ$q’hA“Ü3Ò„g3Ö†µƒTÓä8NŽSÄ~Hl,©¤ZYÃµ°*UïÁú:h÷`€õ#XÂz„Ù™‡Ôwqö¦C«1ª¬;¹dU&{±Zžu².CU¨CêÄP'FŒQ°µú	˜]†Y´˜âíÆ»ï>¼ûðîCùj` uQçêÀ\äd5ÔMv÷Ã¥	.Mpi„‹{y†<ûÈó6ùéjú”QPL©R= ]—:"ÖcZïýR,,Ý=ä³JBdjpïª‡Y}â} …³#¨f¢Ú¨'Éu>CÔÙã¬b©¯QVZÚ‡A3e'¸Ka\¡â‹xÁ£ÇÊ½˜Ü3äž!÷¹ëª3É=wZªˆ_bµø5PÔj;kÆó²œ§rñÐiªašNÐ˜¡ëÈ‰ëºÔr˜ó5©ŠlçF)¥ZÈí*¹}Ócð‰Ã'Ÿ8|â²“Ü*ä:y5XÅ¯Œn®áÌ;Ñá:‰<I™ôÞEô¢ÇEô8†‰|‰È¤ƒëN´5e=¼×Ã¼ÔêšgP@§f²]:ßÌœþ¬ >Ëó \kàZ	×8\o±Û€k®	¸&àš€«	¯0¨x]€Ë9PoÁC×ËñÛˆ_LübÎzµÔã zÔó &AM‚š5	jÊ³È1:°ô+d$ëI²¾K¤‘î¢·®Ð¢/‰æá¬@Ž‚9
rT7ºúÐµM‹³3dT¢¸!«ÙwžxÚáù5<ÏÃs3hÐ" E@‹Às Ä
7ƒ¸“ò€Zï._…wèTÛlõcÓ‘Šâäƒê(º_€³®­R8mD‘-Ø6l;æ§²Ô‚æe¨Ÿá6º0ç;‰iÓ žAÅ·s!žº¨<“	3ƒ9Éƒž§CV§x:½ðTOßqžê7•í÷)ê}=œÖ,(iÇë^qÞr^´*´æ¹FKg«fÄ!‡P5jucrï«xß «RÖb{¹WÓzÌéiÀÚà¥£vòÜ”³D=Ëœó2QtT“¹>ƒåe{ëÁ’í9xeÓ@gq F\ëîmfmÁaÖŠõ0<kî,d©µè·Ø†,½“ä6håÖ±H1ç‚—ï0±:ðœª9›YÎ#Ü±fãîœ¡†2VµÕ‘k=æ·ú°"«~kŽ¡A9ó°n/Êx†Ñ¤Ãšl%p,±ðçrŸ*ú½6Å¸p3àê·TÌÌ’üïÓÓËsÜ¹Äù”p>>kÊÖ¡m=æÇ˜æÕ†VUl ox›¬Ý—Ù]´[³˜f÷t¶v'Ù=Íî¤•U˜]&2ƒà9Œç0žÃÖ›»kC‹vðBÄ1ðžÛ1Çß—weQ¼ô’oý}ÀZ±6ý>¶”,[`ì\¢½Ö<LÌOÇùÎ2¨Ó °¾ ÖXïìùùTÎ„ÝÊ¾ÿæTŠeì(aÇ
:ßÍ®0ë%V7±º‰ÕÍ—CvÝÌ­û¼Áîû3æï=˜v3Ã°í¥Ëù2ï	žSeJÎÖ€°'û¥§]Ïë›*Ä.ÏÕð;þ?ñ‹[üè·§]Rø4È•›oe|óR|ò³3É¶HŽ¼Äµ›÷d
äk©Œ<Ê<Aï’Bñ]ÿnøCA  xÚ…Ž=
Â@…ßîÆ,BLbIáEüm!•Ø,‚U°œÅ³xïá9âc¢!`1o—7ß¼( },q„^o³~i«Æpè£®)	Ìâ°I‘¬ò‚Zä;ªô4»
ÚÚ²‚¾Úbq ª`à!@*ŽâëòíaŽ=*Üp—
–‹§L8ú!/˜‘ü$E¢aë	i¸qÂäf«î`*àÅÓoZÜ"F‰a'‘üd4Ë¡úï+_ÒÏV   xÚc`b¾Ã´‡•…u«1ÃlÍÄËÆÆÁÄÄÍÁÌÌÂÌÄÄÒÀÀ À àÅ Ž.N®

ØDþ‰00°×0¹)00LÉ±¨²nR
, c²; xÚµ‘yPÌaÇ¿Ï¯­H(’U+o‹Ür³K)¢r•#¢¥C9“ÊUÒá>Æ™[‹”"Ì`¦Ãƒñ†‰Ye3þ&9šíãMÍšñ¿wæý>ó÷™Ï÷™çà„ö«I™¥£?^C²šgéòPŠ2T 5¸ƒZÜÃsÔ¡hF+˜\É“|ÉHÁFCq”H)”AyT¨<U¬J½p^ÂGø	½Â(âE•¿^³L(–ôë’^ÝA·à%ÞÂ†&´Hº†ÜIK
¢P
§hŠ¥J¦4ÊrÐ!<„Vè:è†¿tþÀø![øßçZ¾Ë·ùßä®æ*®ä\Î%læ|ÎåÎæLNçT^ÇIlâH»·ÝÉ®¨6Õª¾QëÔWêõ™jQ‹Ô(›U´¶oìÿr#‚)Ê¿òë4Î.®:»uqïÚ­»‡gž^½¼{kûøøêúúõþúþ<dè°á#FŽ=fì¸ñ&N2'O	
ž:mzØŒ™á‘³fÏ™;/*zþ‚…‹b/‰]º,Î´|E|B"6oÙ–]°÷ÐÑ#ÇN/<uæôÙsÎ™/^¾T\r¥ìjù5 9ßqxýš_©«±u_ÛX«ž,Ý¸x¬MkNJß´çñ“Ÿ¾|müT¼ÆÏ–m=Mß¹=#'+7/Ç®ÝØyàà~Ô¿—¤üFEÄ"   %· ë ï ø 	 æPP Ä Á Ö É[<9C ¨ }  xÚ]Q»N[AÝÄØ 9Ú³™Æ{¡	ÄÕbd;…åi7r‘‹q@DÚ¯ ¡¤H›!H|B>!3kˆ¢4;;³sÎ™3KÊ‘ªwékÏSç$ÂÝÍ6ýNHµ³ ÷¤ëëŒ´ƒZlfôÊuûþ›Ñ”;j å=o)M;Z´§þÑü
†ûüó;´4ÓôÔ:	é!æ›qKƒïÍºËú‚Õáb00¤˜¦â.?¦Rþ·4çjË°µ‘Ñ¼ƒ3ùÉ4@SkmšþÔ!ÕóqKË¦±6˜˜²þ$Á…ÉtUSµÌøÚÁ]²³è`ƒ*ÍØÃVy&Ò·$Ê,öb«Ä“
9åÜÉþ¤@ùHÆ¼IJ;ã†µÆ‘×À 6O³ÿ<›MmoÂøYÁw¿K:øÈ†Úb;b)€	DBFUù†Ï½,äRûÏ@”€åñ´îØD<—µu1Vz~ÛÜòËŠ»V¹Î‹Bwoªj¨Ò)Íû^Î¾ÇžÃAcÁ›ÏûþJú<,®4hCz7zÿ¢µêˆ«¼>²'Ó¿±Z     ÿÿ xÚ¼}|TUöÿ»ï½éõMMO&“ÉL’™$Tšˆ4	HoŠH/bQPlØAëêZß›ø[ÁÞPtU°®.ºHìäñ?çÞ7“	dÿÿç¿nÂÌ$™¹ç{Ï=ýœËñÜä#ûÉ·º§8çàÎç&Ž‹$‘³ˆ‘„•ç"DvFenwRoã¼bDû§Å®çŒ‘¤ÃÆ9Åˆìˆ&íì‘ÝÙâ´ÛìÅjk•­QÅfkU$QìÉ¥˜„úzN±
’K¶×wïQW]ù¼}°¸Ô‚“Œ³`ÞØæù¹dlô <vþü±c,ÔMj+ãà<7L¸Iè¾àÎÀÆÉBTÖÇ“œÈàsÅXR¤ˆlŒÊÂî$oãÌð:ïT„.ž)&X‰‡•VÒ½~*¯a$Rý2YJ*z¼ªû¢=ÁkOÀçÅqâÝ*.—+$Ó¸Dà’ðú²ãñ¸ÌE[<þ¬Ü<I¬œðà¥¼üL£-‚³ ¢c?Ñ›Ì6ü‰!š0Z¬ð×D.ŠÊ9»“Ùl‰ÙNÅKôÒgðæHK_¯Ûi1z} ±ý–!š4²ß0ñ7¢)"{ŠþÔÊ¨ˆ\›ótÓ´Åœ7b~ºiÔ[ñœãlásîH‹@¿ëñ;|l‹)Û|Î³ÏâÆwk±y­ðNú]¢ß=øÇOþ*‹þ¼gnê}òRï“¿ÓRúÍB|]èëäÄÀ)!dyù…UGýOî›ƒ›Q¯ÖÄÝq~yƒø‚nüªƒµ§ø×¾T·³þ¥:ù`rOíë½ÞìùrÏýoß +wþúY¦^ƒ_oýºS]IVâ×Î_9Â]x¤Ÿ8IåÂÜ&N.*‚±5Q* ˆ¥!1*û£ŠÃÚ*»b	‡_wH&`¤nQÙº[ÉFÎq*! ×K–06—br‰SÑ;ƒ—Á¿9V`+3©¯WJB«ËzIÎ¯—‹\	· Y_(…qAø‘Wj!Öœ¢½âðÃyðàypûâ±ÚšêÒp©©®­«‰{}~C©¡XïõøüNŠÁ¬)½ð”<7méÜ+vïxuËGÏ®=å®G&L½ä¦×ŸÜõÜGÿ™G„ƒûŒîÖÿ…koz/ðÖvcßƒÃHÿºøÈø€g7Üòià_o[8NÇõ9²ß°@w'œy—Ã•r=8…K” ‡ËÀ¸å”qåh4YÀXØQN4±—=Ñ¤ÀeÅˆ£²ÁÊ`±:ñ°ãiÃgz§’ÏÂìYØ©TÀ³ }¦Ä2	 K˜=ƒ*§^	çYõr…”((É¦™Ê%WKn \Py
à	g•ôð&C~„<¾¸ ëÝ$n"?ªëøQŸ/¶nùà»‡ý7wdØÀ›8ì!¡û–¶]ä™'·|ðýC~¡?íæA§&üë…Ãûž{ÿÇo_›¿Ž´/X{õáëtÊ¡3É/üÏsïýôÍ«‹Ö¶…k¯æ@8²_÷¡n—Oq\Ç%ü()rá›Ð·&Œ C•¨µUÃJ)°µ¶è
@z*a`­‹ÅÆåH ËÆk …uÀ2|¨AIÚŒ¹;Ð.[\	Gv“$Ù0‰²ëå¨´…,žPCÈª)kXèîÚº oðù¥a ¦1‹Õ•
z·ÇßHBHÞòÇ›‰¯ÔOø“Â¤¢ß?›¨^Ô#þÈ/¿«ß¦µóWŒ8ß…›f=}P¯ÆÓÉâYo\yÛæ}ÏmØ£^ýyýõ¶WwL«êsÅ­SW9‡pcøÚsg×OíÝ{ô8‹ ÃÉ2*Ã‹P‚kâ›€ØìÚŠŽD4á<Œ”Å^F‘ÌÁß^sDäÏÓ}Ê™ào‰l¦Œ§³q>ø‚ŠŽC¤ŒL°;Ýq^rºƒü5Z?ú¨õ ?Ÿ´“êí‡U£zY€ï7Þ¯{æûñ»QÚ¦Þ*
‰¾Ÿß%9…8~ñÑGûh#‹É!r,RoQ‰ªW¯Ã÷ÀŸ+<|àç<\B».AÖgE•lFO®F¨sÇÝ~Á‚ÿÜ!(„ÝádÌ¾ç//{î2E½û»çWˆ—nûVžø× ‘dÍUŸ$#æªûÅÿj0¨¿. ÃUyqŠøyã@?=%®‚3<’K˜ñìrQÙÒH².– J3" 4³Feón™%Mì<Š±„ÉŒ?6L‘„Ù„Íœ)¢Ø´Õ¤¸ð¤ 4Ž¼´‡¼¨6ì!ÿÚI>RÃ;Õbò/ÔÉ„ãÔ#äw²
$
ì'E»î§žîŽ`ãL€¦¾£är‡xaN½è^ø«RïSïTÿ`ïÓ¼Æ_Ã?|QŒï£k+~!c(œx'CgÔ¼ýøAäµÏ>Ã¿öË!r	àPÓÙzÉxLé?ÚˆÑHÍ´Cæ,3vÞ°Ac.7ná"xÿª#ç÷À¾
Ü™\‚à¾òqÊ±ŒBSp*VÉ3á¦cŠ¸aÉ¨E™8enØ"²°ƒW8j<‚lEâ¤Š¼ñ¹ZÝ¬/=ø1ØƒŽì¯§rÙËÊ¨Q†VÙjË pø¨¡ÆŠô_¦Š€Üª¸ÁÖJè9	Äž.PÄIô;ñø@¿8A¡"9ÄFD’«~¡VÛÕ½dØÜsÞ™¹€ŽœJ6¨©	õaõb8Þ£¾ùó÷ïÉ¿ˆ¶OÏƒÀ6‘r	yŽD©É%îVX
ZX‚²ˆÐc
HÀ@ºçÉ¥Ä£nÕŸÄž8´\<{%¾×4àß™@«—ÁÁJÝB+:ŠÕÂ(…÷tØZ‘êd/°©èÀ‡"²)¤rô£dƒ”M”‡V—l²ã5\-•h†pm(&z=<VžF>yæ’…7O‹Hß‡¢>Î^%›ÿ˜>uÞÅ?ÞN~ãõ=õú#¥µöb,¬¯„›Å%‚¸>ÁÜ
rB±è[AÊ9qÙUüfXllÑÝhÈŽ¢ÝÚ	G]µ–ZŠöö'/÷Ç, Z¦‚'ËwÔ+ ^\²–ÝD4 BjØƒ
t^4Ä@Iói-\ºî¾Ko¹nÖ-glºcà3Äò	ÕC×?ª>§þ¡qpÜÌQæü<æôþgŽûyymã·tÙÏ®Üþ3A;ºp¿öÐÌ¹¸³¡äÐÇpš“yØRwT6í–­1ÅD	±„‘
£6ÁDPn‚(3š`ñN Ë¢m/MxJ	ˆo8 Ø º.¨7Ôòùä¾ÇSŸWŸ!§™|däáì¶WÿTŸ #ÿ$½G?õu	ã3ðIÄé°Æ,n Ó§ÀÛ­ÀgŠ°·Ã€z6EÝl—ëð ÂVµ³Prõ²QJ³‡žƒ²bƒ˜ÒP[‡˜râÉ}7(—<¨Î¹t¢PÐþFaßâvR­>®îÿ¾Wûé‹§}kã¿RxOG¾Ý»Ký‚ú!§ÀÚ6ènç²¹7Y[]> Œ*’ž.Ò`„Õ•Ò£ª™E¸@XhMÆ8Ÿ¿ÙÕ#)F.9˜¦¡‡it;,ñ±»ÚU[RW—Ší‚!®-:XÄQÝÍøCÊ’7	·¹aÓ¹k\:ÐaXòÂó„¨oÿGýM}‹œqÉâ±s—œ3a9?*IjÞY,Ô#æºIOYHŽìúPýˆŒ}aÙ£kÎŸ»æR†ûà¹ô|cœ¡È2á‘#¸Ë.´	š9"iT½ƒo×;‡ÏçŠø^7D“e>8AQn—ð R9ºV¹2ªQ¸w§ù"¿SáÉÑÁc]T	Ñ—”|lð°døzÀ!´ˆ*—’c 'Ì,"ÅfG +]´¤@X³Áª«.‰#tv†RÆ XE‚ÅvâÖ§- !„{—ÂO¾äŽ¼»üZõ¶Ãê—dÜâqg/¨¿¡@šÑ;‹ìê7jâ¨Q“ÉÂ_æég¿™øìýÛvÍÒW=uÑö÷½ræ’©C{OÔc2?øò÷ô>§O;[ã™ïÅµ€…°˜À%,ˆ„xÆUrgŠ5ñ¢€dÉYN¥Ôˆ+F%<J,´olN »PR/Òšë…—\nx©XRô•÷Õ\ä½‡×‹}PòÅ‹ÜÆ^ŠÆSHÝ·„’…¯¨î­y¼0@Þ/Î|ñyU%gÎŸÚozÅüYc
w¿OÊÔ'Õ_Sß|{®CGˆ@&ó³þøhÚŠxÿš+ï¿éšº÷O±ô•|òNÚ×Aà±WÓ¾YHˆMó])œJIsx©©Õ)*ñxöüæ±sç‚fæç;oî¸æù2ªè±
ÒØÅÏ³p!¬‡WÛyÖÆ WëÁ58´5¸P\ «‚ë†µ‚ÄHð:¡žÙŒhŸX2=Œ•‘‹î5>yÎ¸æyj;Z-^õ.õqlê3	GG¼QÄ3#q	ÇEÒ‡…
A/þw©èiûZÈ&{·“½­ê#¢úð~ÊÍ\›ø”pi0J³ÞÄ¨?Èx³:°{|5‹Sß#NiÛ¹“¼òæ›ôÜ®€5Ü”Z×yñ‚ÿyW%mŸŠž}äl‘ŒýZ-~>l'aµYƒÜb.ÀýËeûÇ£ßâEíV•³v'XàÇ\¾ z( ‰“fú¨Å/ãñEOYqÛÁQã½¹ôÚtàµÉF`W/¸w	…:| $8dWm¸¶Òšê:dQÐy™;?ç¾Ý¯~qæÜ…Dý”_9ºjóŠæ7™¼ [2þ™;†>¼ì‚%ý¯Ÿ21´²[¹9B|—Ù¯?è‹r½¸¸D%Ò×ÍÊY>èKÓÇIG¬R´Á?{sLv8“yìGÞžôG^m3zS³/Ä‚2!§â³¯;3»Ó#«l”>Z4fö³Ñ´Ë5N¹v‡’å:(ûwp-þ¬šZŒ}ô#´	•Âî’ë)Ñlów‹T– gçèè•×+±<<þV€®§´ÅàÊ)äBš|s•°,õáb@‘‹Çü‚Þë¡ÕØàêùõA4áÕ&‚b`Éûä’V$+~ÚúWœ›˜w-)ÜwßŒFÓ©#.S÷þ¦Po&½Ú·^Óíñ¯ÕÏÔù|¯ù‹l¹ÁÂó7ò>'—}¨nP¿ýRýúÁ¿‘»V½MÂµêÜê’É/Þÿñª×©Ÿ¨¿«ïö¿b(¹œ”]}å¤WŒ2îGÇé®Ó=|jãÖhVŸ Æã)»:©7rÄ‘MqEâQ#Àc( NEDû˜ÌÁÐ}á?ß`èŠNÙ¼C†¸ÌïÍÎYtGZLø]€3nb +¢m/tá; kA[´X@î 
edy†|¬Þ²L<çn2bu7q€î©CƒÉ
õ
þòØ=ê7pZ×ùYüV÷2œ¶\ðú/çN¤ÄelMxlJ­É¼\§`‹(yz8AaJƒhÈ‹É.'µØmð¬
ønh€˜p
h¯(z?‘Ì¸N—“3¹’bƒ£#ç±È%’¬¯—4¹@4Hµ"‘Fˆ˜•X\w”%,†cµ^!z2œ.¿`í&u»:æƒ–¼ó¯¹óÞ›—-¸êÆŸ?#ª×ÝØõà¹Dt¡«v´·ëçž3cÖSF?daöÁ°#ûuœ'/×À%ÜH³]Ôh6
iÿÄÂœN±»aí5Ä8½Ï=¬W§¹%À£À…4À›n½¡ˆFv’ó[sêÕ÷|¦$Â—\Q}ÛoêõêÙükd
yèTõÏÞê‘½ŸªGbêáþ„ÜÄâÂ°º·`/Ì°ªašÏd3i«r›2W…g†×ä´¤ÃÒ6ƒÙ}¬qæ=»}þÇòõ ï‘;ÔjÞçåO8LÜ‡¿›ÖˆÐ©ËÔ—Ôuê9Ä¢'Äx`ïw6Àl=Èæ14¾>Dãx“ÐJ^…Ö¤Žr¼¢C§‡:©ŠÉÖJÝsê½›,&ü.˜4W]sZÁ7Oÿ·^ø[û£|¬ým~‰î)õða~ïíGNûì(|¶‰ëË>»ãs:ú¹tÛÌ]|nÇ'ZŽúÄõÂÝí-|¨ýúi[ÔŸÚ·2ÞøY·F÷*ØÅhV±ÝÒÁI—ÛçÁ…’sô†xÁcrzñs.øÄÜÔÞ`tPöÂÑáÙýÔORÜpRÀÝ¨GÆÒv+ÅTEÀTáb‘1•„Î‡DÆú˜¬&¦{ÞòþÔ‰é“Kcßó1õßÔêTþ2‘Üsºúg_røÓOÔÃ>ÒèÚÚÏ"·3žu‹èþ51eƒ&¯tñ¤`¦(
bz÷*>†„	†YPtuµidßDF¨O¶?¯{
¶.vh0?­ýnöyd/|žÀ2öL‹8Pé‡_ºô;Â;¡€ÂµQAŸKð·Ðx	;“®­	S*cdgSÂ³)ØÃ›$ÊêaŒ>£¤€wD~çÃ†Âeç“áj›úãõ6bÉY‡pcÛlõßê¾4.Óà³l\w“†‹>žÛ6
Škæ9(‚­T\vm	˜@ô€€3N©%g’{T/©ªW^ˆ\2}(ÙÝ~KÛþâ»Ôâ/÷…ÏÓqiÍÑªa£Oa“(÷
:S*îOÃ=I÷Ôáé¸xÂ-á8ý÷ð^Ù(1èÚ-ÚÚMñ{fÃÚ³ŠxACžÌÖ\\«¤ð¦zô:ÀKÓ(ÓÙ)eî@ñÇ]uî è)¨'3	yƒ°d"yíáSƒÆ=&ÏSŸ
jÔwÕƒ[FE»9(~Gýã)2úaòû¡ÁÂ9¤®µm¿œ¾V?ßþI
ï`Ín°]³‡®ÙmkM:™mæ¦¨˜aé^4Éœ4Ö 'FáÑŠ0ÃŠõõéÅ;´m!>w¼4<÷ ÚÐ•MÖ“ÉÔ™óÅR†ïµ73:`­<©þº\@¶×^EÌ	õ[0ziy:°¹Ðè¤cXfMPƒ2+3ŠåÒä1:.kZ{1c¨ù4bX®xÌUSÖ?Œl"§‘Adz®Ú¢nS—io?üèÎ·~ämþ]2ŒÈêdõiõ~u"¹œ¹Î½ã_·úêà¥W@gXa#µSÆÖglMšJ*“©ÓRm±¿X-•Dì0ÅQs4¾Î&iWÝ°þp»ú‘ ,÷ÓúÆ’Wo¾nå9eº¿ª‡_ÿUm3·ÿ!XŒ+æ³ÐLq)Žn®wœ./ß‰*V\Z]š–æqÒˆaPÉñH.M—	c½$Û0ójƒEºêå|)¡çü™áAoðúüBI¨4\rÄÈ òÚþ¶ú«‰êoªRÕ[Ý«®%3å·v>ôèÛü[dQ émŸ«÷žn*¨mCV»D¹ŽÛ£þ¬aþ†¹
˜ûÀÓ™«q°=Îè* ƒÉë§°{Ñ`
PÚ|ˆÉ>šH¢°Ã¿¹>€]b	¶„Éê y"/žLk½ì—3žÌ‚c¶ƒYG>¿Ë(ªH„d“Ž}ù±‘¡$xÓÒkç›ÔG"…³ÍZ·býª‹.è¦{ ðéÎ‹_*3Æ?V/ð$ÂªYí;„î‹§L=Ï‚çr<UíªÎå…T.~·SëÃÂh±0Z|,g˜§â³0i¢—’‚ÉîÎÆ­ÊPÊaÙÂÂ”EÒBÌRþÔŽ‘¶ÌLa‰P]¢Ré,¡(?àÙæ/_°X<?î‹‡†nøÛ9‹§<õæ6õEõ«ßÏ”ÑCú‹®%å;UtfcýÈþƒÞÛôz;¡²Añ1j§÷â€YRv'b0|õ»ÑÛKèô(nu`,$ô:|¨Ç¸ æü¦”¸øC7“,uÿá©âfM¯‚-9“êª:MWéÍ­Í™é]7jBCÞFV@ }€Ç/By…ŒBþ†5$´ê³êÎöù„nm/nƒ\#4´½†ÊÃôs½ G¯„Ï5sÝXÞ“ý¨Ô‰l‰Ê†ÝòD©Ï)œ9ë
pþxm.:
^²ˆôpéª'¼@f¨¼ºT÷T›yå7$ÌÏ¤*˜agØïïçÊ™„\Ž¡è­ñŽŒÂ5“L.v.w¼¾ûñ;	ð¥àÌ„@€Ìº£VÌ‘Ì,G”^"cÔ‹Õ›o*q‰áªõ*xRm¿«ò{ÂÕmWòðãw^{â÷7Ú/Âu„ÎFX‡<”´¾àSy)w£·œÂgè.PÇìóáG??Lþ¡Ž!k^¬£ÛÈju$y	LÜ?bV¯ø¯ø÷ÔK/¾‚\Ú^ßî$G¤¦eêßðss´Ï5£]`Jã«cøšÒø²È± œÎ™2pFòa_sÈÄlŽ}F.S-ê“ rÈYC~lK´ßÎg8cû]j—U§ìj°tÔ¾eæ5»“¦´E‰¦eK6Ô³°H c˜^°EøÚçŠCÛ{ñï%…¯õÄ·­­XB‹~ÎGlü88ß´¡¿¤Èâ†Ì†Àõ·cÑIó’N1’zAˆi'ÂŸ”âÞ;Èóï¼ó«þ…­‡}ŠñÌ‘¿óo¤rL.’Î1^ NE8&ÇôÂÚº±‡Ù%Ì4ñ;x…ïÈ1¹ã$ø‚¼þ¹n×ÁµØºPzs,
"¤éá:è1ì†uc”ÎNsùéeDñ‰F˜!còÇ¥ ¢9ùÝwÉjcÝY[6¢l$+ÅÝ*N§œ¦Šà/ŒL8 AO^ÙI^ùÄÒsð«ÂávAßv(•[üYl820Ég¹baÿÐÌ ³½o@l8üâýsØß‰âƒäî—tŽ™ˆ\¶˜²Ÿ?SFŽÙIÝö}º_Ô´]ú,‡7ã²à/å.ä^²Vž®5a!ô·&…"Ÿ~ŒagÚŠ²…Ív ƒ5s¸œ†lz‹`‡Kqy¨xG5fw³â#µ%M4žS !°0€I N¢Vâ«m EýÈé¤öµ®é«üñÍ/’úžÇ4÷õ»^"gl:m‰ú<©zù=ÛêáLýî3õ†{§Í¾â¹Gz÷ŸÜ<‡Ùf+€¾Ÿô&°)Š¸qšÝã@úü&³Qª¬xfTˆ±¤›U%hæ…ES[Í©Ï‘£)ñsìAR,ùTP/"€Äë10epgd,¼+Ld¸nÞ¯îòo×î­s4¬1oåŠÍ+nÅ7ÚïÜ ~øÓêÁ›¿•ì<ñ=k¯¼gå9to³öÇñ/¢£§c6¦Í53Ð8Åé…•¹ÁØÅøƒ+3þPñC)FEPqÒè˜¡ˆD†“‚›—ÔŽ˜-«î{xõùÊ.yF=¨¾Æ›ÿ$½#ŠXµæÞàoÕ„t£xbŽcà)qÜB×gxzÍÚ²òŒ­à¹0r9•,‚ùyš[3:Sµr˜#r!”|½œ%<Äd&Úm^‹–Ù’ó0j
4(¢N³ÞŠüèß0&1s)&ÑRùdC³Ž7©ï[uó¾Yý…Œ¾|Î°UKÆÏ»œ7sGHõEüi‡«Ÿ¸áÞÿ!¤ÇáÕ›-¿dÚŠûµ<ôÀÙÒ|<—$«A#)Ž€Ç$¡±æÁ#•½»Ñ<Kx©5àE -6€?a´3Í*1ÄDó[‹ÿb¬’óê’ŽPèê‘²¶ý`.ÛÚ›L]ñàÚÈƒûÔŸÔ7I¹cììæ…¼þkpMßÿæŒø¤ó*?@‚äŠÓ¯^ªé_Á¦/;s,ã‘UËÎ¸Â°È±6 âÇu£{Šìîˆ%<4 áq-ãõ¤	ÉBF²	]=Ù ±CZ¯©n$qÍòÊ',ÏX7{×…ÍãÌ=úœ>bÏª,T_µwžOU3ÇÖhû§P…<£ö7 ¶\#%‚¾âZf ¹M7pL^T)Æ„PåšBX_!«AËŠQ®Ð-Déâ”€-BR‹Ý' …hv%tf?æ±sª”£vÖSáúu)Øýñº ì:ûá:æü75GsQÁ»»&‰VÖêçê‹?l:åæ‡yþªÛuçíxM=DF_8kÀ%³›§¬äí¿“^·_¶|[{R}]}ç¬ö7^}êu¤ø»‹6Ï¼ìº‰Kï£5<˜§ òç´›P–Vª Ò~,QÜî7ú°V¤È ¤šÁ€ÌÇ Iªñ0K×€léñàDåõÉÄ9zSû§Œùmoû¾ï3Ç¶ß@Ï-øÿä{½“Ö¼åVär‰‰Ö°¸ÄÌ²× «	`%–½¦¬C3Hi?°sQš§Kf}Þ¬³Î:×«š2tÆŒ¡C§Ï8ô­:>=äïj„Ïu˜[Ïà:\‚9
V$íÚJü´‚…À[ÉNÆX0MJô²©bQ¥xèB¼ÊÉ\Ró´Ë*àØ¼­þ±ç¼Ñg{Î˜³f½k8õg„¡mÓÔGÔC†š¡3¦ŸqúŒ°Wk`¯>…½êßÑ­æãØøŽ¾s|'^›Šï¬Òó‰‹Ü¦.%¯€'ðk³ÞÔ6©'¹JÕ~5Ùr¾º•Óxƒ|Ÿ'€¿Ë>?çxQ/Øe½éàø»•§ÿÎS%p€Füq°¸ñ\Q@-q%¸Ë£©¬ -Ô@su[ÆZš†"Z«ˆPSü	5³ì”dÚªy˜ÚŒ&–}	øQÍùØ÷„KSV’‡aážs7Å«>|øUõéûOUŸ5tà¹ê3bèæG§Ž{ú—/Úoå{ÿ>ÿlàÒ!ó.\0¾ýNþÝMŒ6ñ& Íƒq*—¶iÊú—Þ¨ìÚMóä’S1ÃÊM@Sç&{ðØÃÚmX"'Ôg,¼Ó’W’ Ó¸ì£–÷Õ'Ÿ´<¶Ð­ÿüYûzþÔïæÌl¿—¤é†°¦Nñ½¦¨÷~âø«RÊŒï 2æ¼N.-zj4Ð˜:õþ<¤¾@Æ]rÎÌK–žwþ…¼K4ÞùA=¬¾M*Û¯{â±õëd…Ù7êHñ{X›ì›YÌ»SüÆV™ˆÌ‡£åd†Ž“Ö_¤˜ÁÁƒfè8SÆ`èˆ4ã7K¬Ì@Î—@Éþ˜bIM$ Ü6D’x
H†¹CBÎU¿<CÌêgïL¸«T§ÊdxÕ¹s/¿tÎØËÅÐ²ºû'02vöïÕþƒ8ï~õüÓ&žzï5WÝ{åtjc M-”¦Bn´¦/)FC©@ŠLM^²c1*4šÐTD¬°`°œSòq8Óz­ÈÔ‡b¹Ö±à²//û`š‘ÖUÖÿé³êdôÊóÇ]¼|$Øâ£DXwërµ­þðl¾þ~ØÕ÷¬8çÆéÜÇøWÒµ÷g92¶(E’-5b;¶9l­*rð)ßÐÒ‰g©Ò•2ÎVÀlß?!î-ï1ñ&äØ×ç.Ñ«/[Î»ª}?ÿÍ€&¬‚5"G Gˆ`ÌÛA·•ÅÑ,»1õôŸÉÕ£v—‰P½E´»PÁæb€&‹*X± #@c‘r34M·ŸhjPúRK3]Å,ÒÐëÑþ7¯¾öû+O\ÕkÅ¢+†O»ãÆ??ÛYýC ª9Ò=oÊgw¼Ú¸¯ÏY¥Õ…Ý7]´éY¤#td?ÿ½n çE»†Yd˜G"Ô·¦¶!Fs]jÔ¤²9žT‘§l‡–qyÒt)£Œ“hKÚ5!Z´¥™ÄÀÐ5Rè2èçŸôñg®»ã°j^§~~@]wÞË‘‚-ûÈ£T~¯¹p‹Y5ŽÅs¨ÀÂÄ[$u¼]ud‹ë	òh=\4Âã4%ZX¦³cyˆ³¾^‹øhYŠ´g´šŒx|È|2Â¨~æ0.üÏÖ7ÈSü¼ö7?Š_Ô{äñ‰´¸x=¬ÏŒysŠµ¸Ï1„Ô¹iÀgÞ?y£;¼žÌPg©‹¡ö‘sV‘vPà4Ö¡_ï™ÅÍãY(ŸL>ƒm±žì(JôÔŸŸôË‡´ÃXe—Í;·þ ,íhq¹%7 å–ŠÖ­êÒz®ÅG–$©‡ÌW¸¬£xtÀ(‡œµ"[/•­!–‡=:Çµd°ºE}qQ [Ÿ]ºH}–bÞÝ¼Ð~ÉÚ‡øY‡?!÷Ü°þñ5êæ;ë£@Ô)fD´˜‘+Šu3ÇÄŒ|©˜Kôd©z¹ðŽ¨¡ðv2_½¾®¸'¨Ï¿—/äõ?L:…˜TSû?‰}d“ú9ýL‡Z$®…ÏtaÝ4G´P‘ŸÒ(u3±ƒ€õ!a¹àm«ñirÞÓï¹çåóN»þÐµôþíö©êÏêN·Ü¼Ãör|ÿî ƒ¾†÷·s1-NdçE¢C7ÀE½gA‹éPÑËz¬Ya…¤u&â°BEêN&ž¬—«GäÛÉ£Î%ÆWÕSú‹ê†á€#6~¾nWÆ­>ÃøŠÅWŠ£ÉBöˆÕùÐ0FyTî¶íl_qÅÙÝðfàÈZbr¶SÎ/Ú-¥ZOJ¢Š¾4Oæ³8#D}ÎL~7Ø¯åW³K@n‰¾$Û\ŠÑEÏO°´Æ‚S^ìõûÒ5ðƒ{o°Hª®«­©púx³^c±4Ï˜>ÖbY®nµ™	Ÿÿ ßô ©Ô"ò?w^4§rÑ"¯èZ²¤Û¢9–»þAÂÕLp#ÃâÕöY?Æp:×Lkÿ¤1R\zµµýßÆK\Éd¶_–s«¸„1d8 —£ž,Ò0ŒÐh•=–2Œrc	CvI•cƒOÌfY eW<ÕŽ’Ã¾%ˆµ¸f¢@¦6”ZE}Iö‚1‹¨ùQ–hØ”ƒ½9€Ou8X/rSÔ|~üî÷ù¡àÒ56óØiÓ›­–5¥ÃÉ`b³r®ðÃLÔ­Ã{ÝUÔ|ÆK»Eïâ…ýÆ­ÜHþGý¼véñ¾£Å7^=mú!ÁÚ~r£¸ÔŸÁ!ƒt­-ƒ|ÞÊ<W ÒÇHñ91‡…XNÍ0ah‰§±ƒê(…7h%5€ÁŠò=î±óh²`
dé^¿ì²{âgß+1¯ÃÊî©k'w“;‹4Ë—_?½<Üo‘MS§‘ïÅÔw{Í¾¤I«±;~« -Ö–jlqÚ¬öHÚ‡²Ûºö¡rIÜ=m~só<,÷Êé~°»0«yÑ¢æqóæ)|Ð¬9²Oì¦{ŠËûIJ"FøÐö”Cé®7À‰·Ðü„»!ò¨²ƒò±³hŒKúÙ
u1ZwêÏÂ	1”|´Cì§grÓv%°bÌtu¥ú´2IØ¦Å?òÃžgÏ®µxÕÝ÷]¾lfÙ¸«>þð{þµ7Iedç‹b·ß»Ý³úš;K.³¼ýA!ÉbçÄ°x¾îNÐP›5YUHkâåœ8–Ì‚û‚ÑnfG–VJXhÏ …Ã‚*zŸSÎE‘!²L°MæÒG‰\ZJŸÀßÌÍ# £”¢…98>I)(¬GGÎªÓµõ²X¯¸L)£`¤’Nœ‹ÍÄÁcð<TV.™»Ö°Gvï¿þ6½nèâ™³Ý`µ=“%w—§öÌÝ7~Ø[‡kÛÊæNm¿oòšA©º{žÆõWqyÜ"V3Œ6Oúéi—1ÌÏÛâÉ\öD$¥ÆE>5}²bÔcÇMM·q‚éã¦¦OâS
0%îÁ/R‘‰g"Õ«nZ™LõÓÿ0°SCÿãÉÜ»Cu¢­>w3+A“ÝG&©÷©/«‘qðeÒ­Rÿ>â®¢=ÉÈö›ÖÝ©þœ}çºM4özämq3ÿŒîMê7õaù\°0i"Š¥AMbÊ{ÂÃSÌšè¬a¬“HÈl|Ëx×¯Ï¨Q}Ç’—Æ455ª_c³®ºilsß†±ãúômÓ¯aìXìWãúé.Ô]F{ÿ*¹k9Œy8–‘h²”=*Š&sØ#ÖïGålUªÙÏÌšýÀ„D‘‹Ï‚éÖ?,~Œ¢hõÓ4,I[M‚''¿,BëK#ðr
Ù­zNò[º¡Ýœã’óÊô»=àÃaùb1ç§Dv>c@ï ²†x‰‹¬VW¨ß©ßª­Ç¤	é¡¾½çcu×Æ¹>;Ð¼låµ·.]3:pþ}ÿó1¿—¸ÉZuüú~uYKÜ_‚cÙôÕ^ÒOÝþ½üU0giìú•l¨]0àêOöáVï
/q:@‹£…Á\ú½wd¿zöËí­øo+"›Õ©êdr/û÷è¾&®S×°8w
iZDWÍ=Ãx5âÞiW*YÍj¤y8’<ŠÉ±¨vˆ\sÔÎ€HKV°g•1¹Â©t‡
Ø¬jUÛªZØªî’k‹ÉáÍíFcˆR¢¨¤åœË%‡`Ï"¨D‚õr¥´EÏ¹¬EXÖ+Ç\rV%ÊÙq\îV]†ï–{bâÝç‚ª‰¯…1Ãq
)|ýu’§î{óuõßK?Þ°ñ£6ÞñÉcÓO¿xÁ¬Ó­VçR»ÛrvMÝ…ü¼¸UøúuR¨î}ãmõKRôÚý_}uÿûö©ýùBÇ1“Eû²	×%£¾ õÃ†ó€û]âƒüM©wÂfuïÚAjÕŸÅÉ˜ÂÞ$õ4>Ÿ3‚ã@©¥O€+*ëv£.3k5ä6]ºPS`…š FSÃÕáº¸Aó÷¦EúöF’è=`ÜmÌT\ìÙßöô¹¦±}fŒg=9«…—R|VgBcÿ¯%õà>BÔ#/½zháŽp«S<–Ék¨——ƒ^ÆZnðFrQ/¨^Æ6ç1•ÜvZ²Í¬ä¢¨
[t´´ÛÄDMHk9À˜	Ë¹¬œ»#©H%UÀ@Ël£ î´`á1;¡™ÕôÓ°„›”ð—®º{Åô3îûàÕn^sóü¹ãšçÍ8ã¡eß:ÕôèÍ“'…VžúÓøgÅé¨è›,À^Z7lèÅ 	íê.*‡­´rØÖQ9ìêªrØÝEå°=]9lw¶èìX9l³k•Ã6­rØÀÑ*vY”’Äd¶X)ÄJÝçt±…ÀS9¶Ž¸†LÚ®þÚÐ¹šØÐKý©m(«(î ±'­>ÇTGŸ4'[$F»CÂ.0ï»ë:iÙU­tÍ3dŠúËQÓüÅÄ¥þÐ‰F;x{]Óè 4:;hôvE£¯¥4Ð(!NI£ÑÙ™F³Õ¡ÑˆA]â ‡Ñì†]l¥ñË¿Ú¿pñèÎ{©/Eo¸¡møÑûy:Ðš'ò­.i- ´¦h•s£I3soühÀÙµt|I&FÞùL”ç3QîfÏÜè„º@§(N S„èièjèä±w”Pá/%Ìþbé"é
Ðê*#Ëð¦xÁ	–*äZp&˜éE_¢ØBôÕl-²Xu·Vu?sÀ!þ*}ñQF‰;R‘åïñ`uMyxrÛÀ” +–c KØ…n[—hú)šYi4ÝQ¹,®XÁÀ
Äh.Í¸[«Žl18ÂuÒv3ììÀ‹¡|#C²²$³ÓHf’ÙˆdV¶†d–†¤“!I›]ò%9QD‹('SZ€'‰øQ.enx±Ž¾ˆx–vBÑ_QÙ¿wYdTŸ~U[z-å}"åååýÎJ#¹£±2©llh®ˆþ•Â(xš*Ê	¼Ö‰œÅeðgÎÉyÁßØšŠØâqð8e{\‘XºLA½¦þX±ƒ“Á…Õ(~Æy¬WU>39±ðãÿè_PôÞþ¾?CÏæ”Ý;ÀB‘-€¡ÛÙbwÛ =~8ÙRE»KƒÐÎyŽ&ƒPñÐrÕ"	+MÄ“C0qRZ£)CZ:	¼·Ã ›6]½vÃ0q©:pöF2jn¿þÆXmß¾µ5º§zœ;ãšsæV¥%Ö´oÔƒü»µ=ú5ÕÄú2Ýjä8ÃTZ«æán`ùB™‹w.ä·;­È~RëÞe[,©3ZÓ•ýÞhJbíX}`/Úªd±
 QLžƒÈVŠËsPÿ¶èD`bÄï²ËÙ"¹8®*²UÔM6-"˜œÇj]·öàDƒ‘¿R¼¬ý†0ß¿ý»(ß¿íî:õÔ‡‰“T®BËöw©?«©?’Õüf>òªÖß¡žFû;J¹Õý%éòX#x£94ŒEù!œYÇHómg	€[™ÌÉ+–  õKI£Ý-x¨Ú,Ìƒ‡ó„?ŸŽ±°Ÿt›ˆƒh6U8ee•°¾‘Ÿ×žºnó'Ø7òï.ï}]{Ù æ[–ÎPÑ§þLòh³úOõé.ºHuÍc¦Ÿ¡ÙCQ²Jë)Áž°70Æ1ò¯º6œ'Ñµ1«Q=ª M†ŒŽ¶‡ÈÄê¯™h(¤×TÿÿeM Ü3ÖÔ~¡¦Ô;Ö¤SÞUOX—ë¯×å>‰uyN°.ª–3áÚþÕ¨;­MSÆØ§E×6Ö–òîê¯Ãjá¸â}Q£‘Ù¿Z*ˆ:ÙƒŠÚÊ¼uk4éaLløMÓ 5aÚÍé¯?†¦ÎJ ÔYüg’zKeEÿÞåå ý++ÉK‘HScy$RÖÔ÷¬NÄgÈþ†£d>äEì-¾Æ~Ór6ÁVL¦f8X>ß”*& ,"' Ykm €7û‘È’wkm'Œø-Àø¾eºVŒéü=Ûšu†ú4”ÕÈõÏÉÈö‡³ícëÝß6Âûê93®»ké@T©®Y+%50+/œ„ëe|‚K.øê§¯ö/Z¶wŠ-~œZ·pÄ¯  Å]ÄMÑòV4(à
âXI*ûb4]l§Iö£d/‰cÛÌÑ±\h1¸èË9l¿1{lÇx²h©¯Wr0ÉV@×•¹×´>Dè¼Ýõ•}ûÀ7ô÷16RÞ¯!RV†º½c_›.§0íè´»<ë{Ó;pë1" «1‚†¦e96W3-ËS]XHRÌªý¼–H²Œéò2'†Ê’…ìYaGO	²´G¢£ä2	Óä.Å¤µŽxpµ¾Ì;%Å[vlI¸”6˜¤LÈNäQ]'ƒatˆhBš~ý­Q° £yt'Ê•Wj(Ì–Œj¦$³wh_
ð¾ƒV?žÁ´8Îï E°ØZ‘ê;Èè©0¦Š9FjŽÔ…‹ª±|lÒ4j-*uµ"¿Orôº¢p)
õŒ>
ƒ~ØÛ»°Wå•—w¾…½*¯¼BÎFŸðõ ¶¬¼ýÐ#çž‹=+~øî;Ø³òÎ?É?ßÑÉà >™n\YwM&=Ž¼:Ü):²;èÐ5_>'1¿ Ga÷\!Ð‘í>>™4`¤äX:¦¥	h}´Ä¯Ç‘Ñ{³î~‰v¸;ÓÄ9]ÐQÒ!Ž„˜_DÝ““'€Š…Ñ€ââ›KN†ˆnÈÜÓ)=Ðn:†¥¦eþ"xö‚ÚÙ‹eR‡tvÌz8qâ¦ªÌlrZŠrœVÚì*·X˜Íâ©iÚ•
ìü‰B—îD˜œÂ^–x[´û0tÝ¢ú¿ÀgyçÓ'j¡•s½°¶úX”ºEåº¸ ‰iöip,)×›îAö$ãìYÀ±0pú 8‘²…›Ö:Æ%¹î¿`w'ÙÜY‡KO„O…vÙHÚäEÙà•5ö«(?1J‚=-Ñ3u¤œñÔ\½ ƒ¤Ê…³±ˆKØ­c+-ü`¶x¶1}@4ÐdsHX	8$ˆD@Ú¢6«¥U@˜psÀålðó}Afu'tcº1,æ¯ó|¬@Ô®¸ü87€Çî#WMiûïúm»yÅöå¯ª³ÔíòÍëþqÙdtÏž’ØóeÿÊnÒ“ÿˆ"OK\™ü@Ý®>¤NòòÍ[? Ão¼œßU­~×>=FÜÿ^}1íãÞ¯›	òÙ	¬?ÇÊ¨©Ž óÑÅ#&ÍÃôiVú&©Åár{˜@KEü>¿Ö¤+ÂŽL°4Êhúí_´F¡™3HºUèïÄ0¬n.½®žÿ‹u™ÀmqH.\‘l•dw—ëÒ, Në"Q‹»Ë…éÓöQÆÚüØÍqìÚ²ºZ[v'Ì’€™×O—ˆiÎ®—Èìî£WfÆ÷	–I…¤ ­s¬³«Â:¬£WŠÉ»Š¸â…Ã_‡?šZv‹$`ö8›öZºYMðz{½(šìÆ,¯îX¹™M£²]’>ä†cOyé1ôfŽ••5¦Ž¶fuMñ‡ÚŽT4w2½yÖûdæì©)u]QŽtW”SëŠj,V;ï]µF¡îÜCnùµs“”ð&eœ›¸_üR_ÌuÃjs.]—å7´Ê¡¨"¢)£pw.éFí=té[Š-FZ)çà˜
ÌÔIJ-4ñÐzÂ¤èòçáÅP,±fÚâÁšô„GúP³…‰ÈJLRŽŽ6Ÿ"\ZGË)@®d“kH%±î"ÖÚCäŸÞºe\YÃÄSFœùi‘¦{Ox˜4‘Þ{“‹›úŒï7ìé¾ú£°¡GãHå*yjqèÌéê½m}×hîÀ¼ h¾„åiq–R¬kMX±ðÇ`mMŠá,+8~¢5€Vg_Êúö%`L„'Læ\”¥RÒ`ÍÊ£•€ðªÇ—Ï*±XÀé­×RSèP¥„ÒÍ<þÌnì<h*“¶ôüíÁtKÏE¥zz^¼‡Ônß7}Pãiõ½icÏyçÚÚsÁ©ÞÝPµ¥íÑÞý»G±Ã'“ö ýâLÚ:Ñ<šö\ =×‰6b&í¹œ–Þ’‹¥-@y¨´[šôðÿ’ôPšldäãN†jdo'uêO]ÿ£›—µ´]'ú\„[žI¨ýåô³‹b ¿Ø‰³|SôcEqÆÞ—I[qïói
þ—¤ÒÅ O²ç“=ó–ô?GümÛ:Ø Ã{€C”«çþ‘‰CpÈÇ<s%³H+r¥ú4QÀ@GY®)’VÏ´zQ´ºÛÐH“»;±²ÔÜ(Î?ªK£×’ê@>—²x`oœÛP¶˜­Y8šÎ‘â£]p== ¤ä¥­q"&œd-FmùW'(3õÎ<ü¢/ü­ÇÔÙEf«xóèqMã{åV,'BWtOE™?«ûË»¦µÝ™ÆXÔ0~0îÆÅ¸~Üc™(W Ê…(àÁ¢RkŒeÀÙ£ÎþQ9ww²˜©±b¶©´DcÉîiPå8nTo¦éNAöÌÅ
–,jì*Ö
ø··KñÐ"Àÿ{`©Ž¤…˜”H#JÒÊ’þà8 ßTYÁªP*#O§€5——÷k*/Ù¯)éåë›**šû64ƒÂmË0šúÂo—WôÃW+Rxëûjx÷å’GãÝÀ á’µ¬Š¢‘Ž³¦aë~”‡Þ–Ü2´.âéXGÖ½ëbÆ¿ýë¸6œºª€ŠP#²qñI¡­4ÖÂ6çÖŸwR]ëÏH¥q×¡®ë'/k—,=å”µ6°AÃ}R]yU~nn^ee]×¨oŸz	éÓgú„‹ú´ÔP_PÖXPXQUPÐ Éý?Ä®”ëÎÕq·i3ÂâJ¹Kë(ä˜ªÔåšX²‡¯ïÏz°’ËdTóu{RÌqä5ø³1¬¾[®Ó*&&õ5¬N!» ØWÕñu»ÞÜ<*d}å€0—‹JGî¦´b¤Ì–Y6*5^„½.°5Ò…Ø“¡×iz§‘ ¢!ÖaØŒ%ÑóÎ½óÚþ/l'Âìk¾Ùó‹±}˜þÞå_Wµé÷k>íi¼Výã‘·ÉCûMÌU·ñóÉUÓÆ5Ï'ÕÏ½^P6jä3\}g¯oÊ´Å½¾9ýìgÉ¶‡zö;µ_åìGÆ.\ÆúUÕÓ„ç)~ëRùc*ŸB«Ä'OÁñªt‚,¸s-9©´Š+)ØÝÆÿ6­¢u¿:Ê©ŽM«”òƒÀs+¹uIí°Å«ï}xõ¼q•óî/8öö¥3‡Töê3Œ<:úýý¼õ'Ò/r0Dî_}õ}¡ß¢Â ó¸>3ÆG.a:%D
€‡h/)èdœ4ÄnR†ƒ¡•u±ÁÍ5»Eà›\+óhóh :‘g@U”‡Í
èÑòPcÃc}Çd13=l¹©nÒºZ­”¸b?i˜ÙZz|úA·Üšn+=kÌ*­¯tã/cøäŽŠŠÙÍ=ëyý×HÝýÝñIÕ5•Ÿ¸i½øµÚÒ¾ÿôSOíÕ»M…@Ó„£iÊšüŒ&¿5UwCiÊ¢4e¥iÓ¡h*¦Ø™(ÿ	‰")‚Ðˆ:QØ,Ë¼+œŽ%‹\AI"OwØP´áDûchmŒ¶+›mWÈh+¤´"mÈ°†BF[N´œ¶tõÅ_ìÙûŸRóhÎñwMØÈŒ£ÔÎ¡Þfô½IçÒVr}¸;2(ÌE•cA¨ú#¸1‚CHpCTöÓ"ªbVLWç´–=+EíP”R(JŠFô™0RlÆ)þURÂ-–SW«#CmS›í,È’NÈÎõs
¤£Ôóñ0{²²¢?ÕÏ×¥p#Ý"š‚¶Ö/ëÐÎí·R ùÁ”3ÍÕìÀþMZsGs@,·D:å–Ò‰¥Á	¾Zj)ˆyš¾¤vÇ¾d8Nb8<^ëÅžPþÎŽ÷äRÝÜ'—Wº†WwRÿß/]Þký¾]ïÛ)¯Dþ›¼’ëã‘÷êÉpö¾Û¶¥Vy¥gàýÿ<ÆòJgky%ŒtÊ¾¸bîÊÑ	¹™™%ÃQ™%Ã	3KæúŽŒRš:e”èK§uì÷[døÙ‘Hß¦òÈ(Üh]uÇ¶6âÚuÕw•gý§àG`Né®ŽT?úaæ?„™	¥D09?ˆÓÚêS-ÏèSe.»óFöFSÙ¦ŽV¹¡ˆ©?Ì5•ySÍ¬…R‹ÎoR©¢³IéÌNý¬ØÉXÝ¥‹Ð©ÉuQå÷u	Žm|%3ý€´œÜ<d§™Cµ©Î>}Jè[jÍÌÖ¢ø¦¥“ë|MŠN‹K¢Ôäù$Öu„G<€{èäØ×‚Ú¸*ý {î%¦wÞ¥>uàÐæ{¾&uÏí»KëŽíÓ‡·¶oÜxûlÝEn»]ü×\Ö$;nl§uçf¬Û•ZwVÇº±;Öá¤­÷©ucÛnR´€¬%
`ÝY®®×Ê\3ÕSÖMÎN¯y(SOWÞžZ4o`'7sí^®˜¥­=;µöB\{0=;Ìç¤c(pí%˜3Ò0Ï“¶ˆNÉíµP°ðl§ì®IÈôÔ»FÿÏO@Ì_¼øxø7j*èØ=xè‚e}“FGèðh´'­õ‹õ>%òé|Š|‡Iëÿ­Dj{PjK€Úí :ØYrDSµù%NËÁi#Ùø9ìT¡ž”\[DÉ’fÓ†+Ã]Ã@Žëlw
±<Ü•Å¢»ù¬qzåTé¡{2ÏVûÄ4N¢†Ó›€NËèsã(RÅ€”¥i÷¸’Ò´§¦«»!$}RÁ¼G!ºw~&QÙ
CÂPÍ$j¼VáÇ¬¨¥¸¡[ñqŽaFð8í§è'¡dª;áñ
zÅ‘²òr”Ã·¤ ÝËAG"‘²~‘£n!ÈçŠHß†Š*Þœôi¸-%¥ñÚ¬ýÕâqÈi´ÙÎÑæ©¥ºòs;†k}ÎA-U„†šWËm¥Áž] %‰p`@vÞ:qFQ®Ôbæ²JiÍ¬KÑëÓSDhŽÈ£ƒ©$Q!¡Ó¥µuQ2„ôQo»àÜE3ž¹E=p×­sçÏ™ú<P&’~±A‹/_´àêŽwþIjzm±þõ÷‡Ú¯­ßÔ|Ý"ÍîÏ“WBIujèï7N;•g9Úg¬ù3Y&péNcL|äv‘ø­N<´Õ?JEÍ‚øiDçÎÊFSUv 
ªÅ¡WIw×Õ†3ÚŽ™X¦½Ç={’Žîã™3ïBWBëA®­I7!/[¦ËÓìÿ§4`–	VïÏb«—ÐÊ¶âmP'CšI]Ñ@.ÞAjÔŸ»¢BØ•¶£2èÈçæ—Ž‚¿¤£°Ó^lÁ½ÈÍOo†QrNŠM\wEÑvtæ/>>EÛ¶1ÿ‡Ñ„þAˆ«á®;š*ê"”Ç•b;±X‘µDÊ(`4¹ã¦œ…êÑSHViUc™HÔiîvX”²±'Á‰)+ÉžÐQ²¨+8n©¨»0RÖØT!/T”÷m¬(//ë×©è
!q³©(ês´üáY7ð‡ËêÔÅÍúß;uq°ÛEªÃhdôrß{æplæ9‚¸z³†œÌ¦î1gÍ0“Ü¼‘£ÂörqeAAûÜ7á3ƒ\œ;‹Kdãît‹+E°;Ýc©ÆYOÉ<xžílBPƒ#9qR•ä"õt°º"âtÑ
*³táÄˆwMU’Úâåå È‹‘HSZôŸÒN <Ï•©ƒuwêžÔó¹ÇS5ñÞŽšx¼¡ÁÄææù³iu|Nœfþ°¦­ ó¶‘Œî½ÂÎ%ï²·Jæ«Piîƒv¼R3×}P×âËõº#-9ø]Hò‚×—“ªIV$LˆlzŸÍeå$Ú=
¯Ò«ÇV¡Ž9ÕµuÁT·Võ>qAÒXßéó'/¸ô¬Ò]&C°þ­jy<T™uaxê¨Á·•dNç§süÔÁbTl ¯%†¸„—JV=w9¥‡ùÉyQ­³4)ô§ÇúÅ)6åxù‹
³±~Ì-ñ0œªqÊ3Füµè-ÔŒR<ÝáÅ ºû)áÏc=a÷éÉ.D«”ä’z¹‡KqàsNDÓ§lŽ£çÿ‹Ò	N\Åze?iá%c®8áp@€°¤ŠBxúÍ¡ŒI<›óoèIõSƒvsCÔjuLBkJ7a5AOpxØÈ“”à´b_t±á2NjC=êõÎ°}ûŽ3îÿT,ýëµß{ÿ˜©ÿâcõ8ð=;Y\®“Žj”Lš7`ÂÔv~z"`®3ÕËM×éÎ\'³õ0(
G‹´‘€¸ÒA?LÇŽš·jÄp2ztÇ\@ró\ÌÞ½)r HFŽ\µfø™<(ÜÊ4e&žùÇÁ³ gáÿ
Ï¸¿..)yrß…Z¿øý8˜êž»ñÆLL?¥˜â”¶.0-JcŠ.¡“˜µñßcëf«>>¼í.]¼çÓÏ»†WÜ»c5Dv„VƒN§eÓÉOÞÔ-ù¦®|qC¦/nE_¼Å&¸œÔðšÙl6è)ó:,ãBÅÚÒ¤EËÍ°‹!ÞzSí®æ^xïÿ×ò'¾fíòåß³"^~‰^1“"à‡vëÉêÕö.]fKß™¥_ªÏæÜ ÏÊ¸kµÉtôr‘,³¶#PÏ(ÞÅê/8‡²žÍýÁYÅG¥éKXi %ÏC[Ý•R€
KrúðÖÔl« 2)²ùð²ARJÊRÅs§M¢ƒï×²T,9Ej›ˆÞ0äú:Ï\³†Œî×wÎ°þýzÕO˜w™°tXñO£çáÊ;&PÞ±áðê3‡Õ×/¿dZSÓýä¹?rÙü(ùV÷…îuÎ>àEZÝ Ë¤MúÍ2µ&	gÕfË+ÄÜ*çÆè°M;‚„åƒ9±„ÓN¯–ÈÏÙîÄ‡v‡°ÐŽKÃÙ›^'ŽÙÔ¥gâ›¼ ¯té;Rw_tyi=œD|ñ"í>:âz3ìýHrþ“j5çó¿“áySèÛC?Lk"qõ-~&1ò½Ï¨/¿£®Q§zù™êbiÿò{›šTÿLÍÕeëM qÃÈ¨ÜHÍñz9ÙOÝÅkÃáô¦âŽ
äh½9Æ’˜ÖXB¢	}	£	Œ&i£ž`”Þ^È¥TÊ^Iöù!Ìfr,›)H”Ò3#Ù$/uœ©£¹»v6ëÔI72|îÜÎ³G‡_Îf&=/ú}çêÕ;ÛVwL]z1>JgƒƒþžvMÎôK÷lX2/0‘}Ñ¤ÄwfƒI~F×r?tœ8‚7gÛ³éÖÓ;íá°c»	Õœ;Žu£›3ŽÑ½ý¡qâGE{i§ŒN–‰&SÕ‘tžjˆ«àn×n“ÄyªR:XÞÉ)5q¼j)š"•˜`ÑlŽD¡'•cÁ#ÖfëUaÁg!¸V!,G¿	NuÚ[°›×ÏR0ÁÄ*ÑY¬tBC©Ôå,V»Ð‰ö:ªfŽ3›µtÖùÒfÇ{Ùñ'µ:ŠÎ˜.‰f#<Ëgñ$5¸õÿoÞ™Í5Ûö-[¸ÿ‹ß;õ]õÔ”âÿûœXîKé›¿Ê‰½³ç‚E{>ùbÞ‰2™¨6S1†{_À]Ç™¸žÇÜ¬bîêfK*å¢7˜ê3:š´RV~RÛägÈ$¬HÄWÒ=,Ÿó˜áBšÏ	gLù<ÙlÎÿÐ²Xü©?—H80F[¿~
0ò˜õ[»X¿6|N»
™6«Ò‘sz:˜6„ã\(½¥C0ÍFiSûžüaÔ<F›¸ùÃOì ¦mÂ} »ÀñÔ4mô2sf DÏ.‰sj÷LëªYí˜¦zDSê“Ýôsôó¨ÎDÊÅ±L3â}?‡€öaôžTˆI»‹NhµušhKMdg%a£Ã mÄa\†´áG5uxo«WG‰×?D†“u?±m¹þË…üªù™¯¶©MðRzn¿t—ïr wQã0ñÔÓésá4É¸p?±Î‹ÚT¹i“úYúÍ¡¶ýµå?\ÚžG¾N÷8õ¤q†‰]Ü‚“ÝE7Sªc)'£cÉ(%y«×—•™¬÷××gö,§W	]µ&Ýú,ú+ÇïFÒ@*ŸÆâ$ãŽ;Ñ5»«‰®9GMtmÑië7¹èð'îJ“ax„ŽÉ}‘qZzô˜|WäËÄ<—›Ñæy'ÀœÞàÊÑ[»d•rF×ÞêËÊ¡ã2Í@Ÿ}RÐšÈîý¢}.ÜÿùÇ…?-Ç3ñÏE)~üóºÂ?_ÃÔ5–5ÃÚ“º&æ ýÕh2ü˜]Øºgéâ?ýâØ]àWS'Õ?ÓGëù¢wÈÛ?N ®˜ZåâXê.Ù£Z§JµÖ©-b~a ¸DËáÿ»&0£a'jˆés+©Ûûàmðí/ú„ÖAmÇ/.ëIåSƒÜ˜.3ª%]eTC2ª[iF•M)2º”â`ý	r«@…tJä q“7­kˆé½¡I>?:‡µœª>Û>#¤qâóÔ}X†/u»àÄ¹[Ï)°kØ½°Ü@³ ùªskÒb÷¡ùg±¤	Ö.˜(`ªes,á( Œ›Pœ;lô»S«**È+Cç|ZB û}.Ú„ªX0¥ƒÃàº¸…é^Ÿ¿Ã>
 Ÿ®]¶U‡ÓvùaäÒ¼hâÂ¡@3™·ý½ºyÖu³:‡Ì<´{rÃi¶ÿÉï"Éýfé°¢,VB6“‘Ÿª¿åwª¿¥ì)Ã™`çqÝ¸(Öæp¬4¢H‡.Fk1d!®TZ[éc¥Tßš,³ç•²Ž«£óŠ|šÌÂèœçdA»(½+oÕF¿¦\Úª7J¾,{»+:as{XY´+¥x'·…Ã¹¾Š±RJ…-8;vt=aQX¯ë<¨Z—²Šk\úV¯5|ù§©}˜ñïn^_uëê¯×^£þøõ2þâ™3—-ž1ï¾•¬:å¬y¼ó ©>þ9u÷7Á±ç÷Ú;rÛ³„Äþ¼î‰Gn¾î‰'-ÓzØU¿Ù´¦‰&ÚÍYÅ†ÖdV½9‹fîËÒì’Ó®$¡ÚÉ­ƒ‚VÄoZ€ÂÔ¥“žìtÔµG_»ÀT­ï|–ÝN]¡EgyáZ´}ÃPl Ê‘^¤uÓúÁƒ;nÒŠW/žµnÅ Áx—–ƒ¶ˆêÌŸ»óâiÓ2îÔª®ÆKµê{M™:›XÈª0y6?d‚,ï!Ç í?z‚4Áä,‰â–šŸx’tU§I/Õ”£6Szö•t¦ô/Zî¡c_Š¸ö™tÚ—2Ü—@Ç¾T¤÷%@÷¥TÛ—ÊÔµ‚9èˆmq¹ù…´9×àÂí)è´=m{Ê´I¥µ=’¦5…Ž]:Þ)èÿ|þ{ÔNo˜2m7k;{´@Û#= 1”ÝxÅ†”ã…
I—¶G9X5‡Uhuãá•n&¬‹Ó£=ã“žNQ3¸:•²ÅŽÝ¬,,¸ó¨ýÒý‚êreçí¢2˜ÞÑ{UÊ•cž2”º¥ÍIïüC1‰ÊÖ´˜5`L6GÄfc`Œ„i(l«`vzó»Q;àjq¹Êèþ!-ôâ$p7U<N6PŠ^ÕV—º«-ºÕÆúØ¦Pzi[S#½µíÎ©[ÛzÁ›l}sÒäÍ›Õÿüö(íóÂëÛÊËS÷·-¿/pwk¬/ïÖÐy³7½~Ù
¢oèˆ‘Óùç°?Å@ý\í†h§óú5wÕ¶;uÒ^ Uøm(I]’Ô9½j3¸’.wn¨”Õ`:ˆ·±!éñM„z°í<ÝŸž„Ž„iè5æ¬þ7•Ç«¯ýö*›‡Þ­ˆ~ÁŸ«øýÍ‘¬¬ŽÁèÙ¹l2º¸-cïØãJn~—{\ÕÕGÚã¾&m“+*;¶9òÿf›5Ž>‰60›ö$¶Úp&µn3÷¹ÎdWû\ÞÕ>G´}NÂ>—”1Å@w:Ävzìti¸ÛÿýVk²èD»Ýo÷‹À>ÁvëÍZÌŸgwj³ävuK¡ã/n)ÄnK2›½£iÿÓÖªÝ\¨`,ÿóß;.0ä7h˜‡0ÿ¤Ëù¹|îBÍ¶³u1•¿ *û:yÂ¾ôT~G,á£Î°£eÐÑÃ®*'ËÄ*9à•'l.4MpÚf>ÞUíb^,'ÑáƒSûS#0lkhÌ‚7°éý…Ùøþ©SÉŽaÅ?ŽšŸ1Æ?±)?þ?äQ2ë£G¸-=»—rN® NÔâ.zvs£8Ê@QêÉ›ŠuHf‡„áY{–ÕÑŒ0\D:r™Q	Ò°X—í»´ ËÀJÐê´ìƒÖsL÷îük-=årÕ’Þ™“WV•ÿ«*¯éºy÷¹Iöê=uÂ²>}Æ—äçåG*´Z¢ïKëÅc™ï²Êç‘wc`tOÍÎM¥‘±ÙOû˜CŒúŒBZŠVÜšQ‚ÙåVR!ÁÑ«×ÒR¥;¶áøOTÚÓ©Ÿ¨®£‹ÄR—%?Ök–,íÊÚ‹O°¡.R™ŸŸ—;!'¯Ër::‡&¤†

¹Œ^ï>´_žF9ŽáOTöÆ1‡CË²»jQÏéÔ¢¾Ûú½>Ö£®ø³ê×HO]Óc¡â6RûïÑ)ízëGt¸¡éúV›Eou;NUSá_V5iDÐ³³l0p¸)†á•ü‚ú“,mbÔuµu-WGú"¸¥ÿì²¼éCôE5TÐzÑÇpf°×ºqË:w£ã¬íÒ8æ¦å‚õ&Xkz‹Ûˆýöá±Dqæ$§çÐ—Yÿ"õ1L:´sGJŽ›Í-ÆááºÒúãô³'œ€Õ¹Ó}ëñg`e6¿‹37‹g÷†Ò<ƒã87‡:£ìŠô“¸9£j·‡¶»©…–y‰¨üãÙ=ÀWx.R7QØÑý'ìêÛÔ@Žø³‹e›ÖIHo¢¨Ó®¢0ÐùêøÑÝÉäPh»¢¬l ïlè94˜¶“ÊËØÍÑx5Eºù!EÿX ?—Þ6z4ýxA­Sda0ënm yèõM<­ë9	h:ÍZ—fÂ4 ëa+ÊÊ"}++;¡õÛ¸>•ð?f¿2ÜÞ¤zhDn^\ož˜	 Ii7ª\1ž¾,	•§]Çœý“ƒ5³²«ôX€· 6ŒÄJÞæcPNµTTDÈ8®3¯¹ŽÃk©{xOPf”dàØ6ŸY&™jÑÎL~ó‡ßR7Ÿ$0ìãA¤íKôÆ>ùâX4~Ñl5Â5©ÏÕÝ	VR‡—
Ìd+<®˜¬­ŠÙ‹ÉRs¢h,¥JÐšnøs-AóTÙåìŠÅ{PÖïÐÉzg‹AoqGZÌø§°ú³=îÈÓM‹Ü
¿oiÉÂ§	øžq­NBŸ•—êlÕÌ?}Üq±ŽÇ,[#zÔŠdb±D+»É_çóÇjëÜÁš¸K»6To {‹Çë3š¢=zNi´G½–ÈVÇ{öŸáýâpMÎøÄu—Üÿ­›Ü6“ÌÙÇç¿sO|~Ÿ:cÓ³sµûmÅùë¨ßÁå²O)7¤.J1 ã}¹4<N{7%Ö‚ôÉ‡ïž¿8ÕzDym«x#ÿØ)8O~hæToÇüò¬£æÄg‚ïâFûôýlS¼3‡»o]»tÉ•kç/¾vcÏHeÏºŠª:ÝÌ©_VÁE`4TTõi@:ÝâþbÝ{œo¡÷'K¬zArÊ6´~ô¬½ÁFt‡÷sÐ[ 3ækœà:iÉ«y32ÆY¥:ÜØ}Uäïh>·`A4Ý¾sÂÙüÿ7?Û.´óëØÅì– Mû'ãÎbú‡Â³dûÎ©¿3ö:Ù¿3Lÿ]“pïÑ}Áé´9÷‚ˆ,Cd}ŠpÎ½ý©Ë]ÇMçÜ³kVá22˜$õ_êûlÝÿ§³ó‰"ˆãøÎìzüsÞŸÎ;ó.½[—Ó”ë<Ï;ÔÕŠ@z¨Äî¢ zI)POHÍz‰Ÿ‚^R¡+$!ÿäÃÞ%H>YÔKAõfBÒ‹IÝÙüföÎU
¤ogWæÇü†™ïÌof?2±cÝ³	órwj¹š †¼¨Ö–Im1;¾­
ôÝÞ‹µãë –®ÉÏHDµû2‹Œ¡„¡<ü+Zž2ÏƒÞ¡«ÏË‚½©>¤À©k+™îðr88Ð;ñ®; qÓ†:Ò9ÿÃ¾„õŽmÇûï¯A¹¯äüòÝ¦©˜Vðó´öbß¡±/á¾ñµõ2Ÿ±h+q¤Ž	ùÄºŸS™¥ØÁJ/jÐ:¶axB.ÌªéËsƒs³CC3x}hnŽ\§©>œÚZ×¯ ô="BŸ¥„G»§žzP B§èSõ¤P?f	Ü1Ü±
€ð)Eämz*öôÅ¢=øCüLLMõÆX*‹÷=ïíºÒ¶Ì`‘²J¸lËÃ;ZðN‚G–ÜyC$ï~š×“Í8w!—=)°±œ €†4h±§sˆ¤,·¸Tê¯¦ ¾é¡TÖ«ä/Å„×¼»~ÁÀîË‚ ÿLFvÂX^QŒÁ¤[º‚)I†7£Ti¬Q\Á”,Á«ú =^,ÉDåð°}Æ VI»Aý¦=…‡ÈàŽ„+)HÅ`3!½Çî1!7n 8ZqÄa"ÿõcŸùtÃøæØÁø$<¼¬n«½Ó~ú^¨ÔSˆÒ3<ÂçÓ¯¥ÒÈxÔwâhÄn|ÞÓñèîõÀÁú™¨4W˜ÉÁ+×|îÍoskÙ±êDq…Í›ðw7EŠ,vÃ71ä=r©5<zŠõÕWç-rz®é8¶”“o&­N~ñ°\çtF2*ZƒAº§S·²GWKþ¾Ê£ä±½Û«6Ö6a}Å£ît7m|¥2#ŸÈŒÂå¤Ë±IÔÆRËêÆãÜWË‹—“Nç¦R²¼ô²zcD†â2?+s•A~5:c±°¨¸ÄYZæR†µów?£²#Yn`è%[ÙÁ#	·»®Íc-"H}÷g1/êxB$%á·éXßŒªú‚\Ô…œïí:¡zvzØâgž^QÒ'1ùã/fFß|ñ¢¦ß“hùçÓ?ÐÓö™ÕÌ9¦Eˆ©ªHï÷í8e-h„HV°‘¨ŽLÜ Ë¯OÜm}r¡xÚc`d```džº¼n‘o<¿ÍWy8ýÍö	Œþ¿òïC+öF&( ûxÚc`d``¯ù»‹£êÿÊÿ¡V@ð ™”ûxÚm“AhA†ÿÌÎÌD<”(äd!zPŠH‰„`aÑE…¶H‹A<” R")5‡¢&—²T¡ˆ â©
¥X”‘Rož<ˆâ©µ—
®ÿÛnBÐ>þ™Ù™yóþ÷’Æî/MRk€:ƒÀ¹
_¿Å¸þ€÷Šæ+ª©7ðÕ
:ä¼³…ªÙ‹‹ê$÷o¢Lmª8Êý5²Nd’H@N“&ñdÌýSDñŽY2IæœÏhÚ§h™u6E„¦ßfêerŸóßœ;Õ4Bg)úcê\¿ŽÐ½„–uÚsðÍžDóü¶‚º~‡Q³Í³‹È¸«_AÞøÈš˜Ç’ú…QjÀøu}Š¹t¡õ=”Mïù‰š9Æ÷.¢¦~ðìx&Ãü´ÔhY¿ÀmŽ;îÚ\oËý<'gœ³h;›ÔCÈ1Ö¼~„Œ½‹¬¾«°OïÇãVUTO¼L¼ßžQª½7/QÕEñY_ w]< ®èY#ökîC¤ÅÃØ¿ÔtôZ<¤~!=ï†{7ˆx7†Žx4»ƒ²ø&ž¢‚hM¼¢~#«}¿þÇ¿‰ý"’S\æ×&Qé{ž=×Kò”¸=eHlQÖ¥£ç£5+yË;ú*ùòéðÝÞŸ÷·½&ý$5í+{+®¯ø"oíiÒ_Rã•5-±vp.ã9uÄy¸³œ'Êw!õ‰”vÁwêMêTò?K`¯–Ó78®ð¾
{£‚¼³¢ rjãüþXÎª	~ŸÀq¹—ñ-sËé<ðwÝÙS xÚc`€ƒ†ÆÆ_L˜Í˜C˜k˜—0ßa‘cqbI`™ÀrŒUŒÕ†µ‡õ›Ûv6vöMri8öq<âøÇ™ÇeÆ5‹[Œ;{÷;ž	<'xžñÊð†ðVñ^áÓà«â;ÃoÂ¿@€KÀF B`…ÀAÁÁ	‚‡é	ùeµ	}ž'Â%’!²CÔL´JtŸ˜‹X‚Ø9q	ñ4ñzW$U$K$çI±I9HH­Ö“ö’>%#„	2Çd=d·Èþë“['·G>K¾Kþü… …#ŠfŠk”‚”þ(ORaSéR¹¢ª š§úMMIÍO­Ní‰z‰úšFš§´\´&hÝÓ6ÒÞ¤ýA'Cç™nšî+½9ú!|ëgqU«ûW¯2á3™còÃ4Ìt—™ŸÙ#óó]r–J–q–÷¬²¬¹¬ã¬7ÙpØ$Ù³°=bçe·ÉÞÅ~’ƒƒ™C‚Ã‡{ŽJŽaŽÛœœÊœ.9»8op±r¹àêç:ÇMÁ­Èíƒ{Šûyž<ž¼4¼:¼~xWxoñþáà³Îç¯‘ïß'~~58`—ß¿e~‡üîù3ù«ù{ùWù¯ò¿À„m«Vº1) ß×¡„     þ B            b    xÚ½T½nAœslHBTTZQP;6&!$@B 8–³}¶O±ÏÖJÄQRPGð”<³³ëÃŠ,$"„Nw;·;ß~óÍþ ¸Ž3¬ (®øÂ×á üs¸€U|÷xñÃã"n—p3hx|	·‚·_
ÁWQ/|ôxÂg×ë…Ÿ_A­Tôø*ñ¶Ç×ð´Ô÷ø+n”>yü[¥3<Æcœ"EŒú˜À Š]>5lòÝâs—}Ð!³…ˆ¸I~Ff„![ƒgHÐæhÊ™ì7ÔXeÅøäógú‹ØFäžäÌ#~›B¯ü‰Ôì‹kûë¸Ç÷¿÷©¬Œ^wÈÞ×RtJ¾ö[ýUrí·ŽÔ³Ï±'D‹Ñ.ÖEnæ±šßä¬×ª##oDÅæ\Æ¿ÍËŸˆí„nÙ™GÛˆþÅÞ÷T®âTqv%Bâcöò˜å£Ý®¦Õ–hÖ¾âŽøçcM"ÇÌ”=aoÅk-ÔbgžjemÍne/¢æÀG¤Ú#M:3¢Åñ6sÍîïP~Û=xˆ‘e˜e™ï¡*\ÔóÒŸ[{È¸LœRMD'm6Ëê¨ËK¼-rÌ?P9w}~&í9X®Ü°µóeB‘ÝsÚÜê…R3“ŸÇâÏÈqç4Ìg³>¿ówáRöXÚO˜£#µ=Å³ŽXuOTM×ï‰®z9¿£:Æì	Å³>Z'³%ÏObßço‰›h§™Çzã½_‰n¾­7mÇžÊ§²n¥	#÷¸c+¬Î>eår«WÖrl¾òÿ#¢"{ÚuNãÈÕÞU5î®¶7Í!Ç§ü{®³eøìè&Úa¾*ïË=ÞD»ì©éVªý¿4 xÚmÐÇOTQÇñïQ˜‘ÑAAE@¤ÎÝŽ2ØÅ‚õ9:¼ÁÇ<ì‰ÆX£×–ÄD½%šèFco±Dº°.ô_Pî‹‘Ä»¸Ÿw÷ž“—C?zWWMüoýé'ýéO‘Ø°3€(dN¢LCˆ%Ž¡Ä“À0†“HÉŒ`$)Œ"•4ÒÍÆ’A&YŒ#›rÉ#Ÿ\¸ñPHÅ”PJåŒg™Äd¦0•
¦1J¼T1ƒ™Ìb6s¨f.5Ô2ùÔ±€…Ô³ˆÅ,a),c9+XÉ*V£I'ÙÅnŽrˆýœ–HöqœáçxÈ}Î³‡iä1~ðˆç<á)ÏºçòŠ¼äŽð–×¼¡™ìe--¬£• :Ç±ž6Ú1	³l¢“6³•-g;ÛØÁN~rSlbçW÷l» Qâ‘2Hœ-ƒ%F†H,Ÿø,q2Tâ%A†Ép.rI%I’e„Œ”¾ðUFIª¤IºŒ–1Ü’±’!™’Å7¾sŠw|à½Œ“lÉ‘\É“|)—¸Å#…R$ÅRÂe®pÜå*×¸ÇÎJ)·¹#eRÎo;ÚšÝ
ÝÔ[\®
—e¥½"éþuvMi«ôiFH·5**}FHÛ½Ö#¿õÈ«nýŠjÍg†ý¶ ¢Z…AE
uE
õ^œµÍ¦Ð³5¨™agèß“­NŠ:Ug(¨°]±P…á^"ë=iöìÎú>ýÍ>ýTqg/Ž†ÆPXóùüzØÑù÷³gD—Ëeé¶ôXZY[–X–Z–Y–[V(ÝV_·ÛÑÔ0£ÖÞ¬"O•²¸*Âk¡žƒ·û?þ ›óIxÚÛÁø¿uc/ƒ÷Ž€ˆŒŒ}‘ÝØ´#7Dzo	2"e7°iÇD0l`VpÝÀ¬í²EÁu3£“6˜Ïªàº‰E	ÊaI²2JÃ$Ù’lÑPÃnåp‚Tr0:ÃTr%9Õ¡n$£L’(É­á0nà…º„¤Š·þ?PÕFf·2m—È"Ú "Æ7Ó   OÐe  
PACKAGER_BIN;
Packager_Php_Wrapper::$Contents[8]=<<<'PACKAGER_BIN'
           ¨  6        ˆ	  Þ       h  f  (       @                                                                                                                                                                                                          Ý Ý TÝ «Ý ßÝ øÝ ùÝ áÝ ®Ý YÝ                                                                                     Ý RÝ ßÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ãÝ Y                                                                        Ý Ý ’Ý ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ›Ý                                                                 Ý “Ý ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ                                                             Ý TÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ _                                                    Ý Ý àÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ çÝ 	                                                Ý SÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ^                                                Ý ŸÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ©                                                Ý ÌÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ×                                                Ý ÞÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ è                                                Ý ÕÝÿÒÿÊ/ÿÊ.ÿÔÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÞ ÿàÿâÿã ÿáÿÞÿÝ ß                                             ñ:…ß’ÁÿŠÓÿ†ÖÿƒÚÿÞÿ‡Èÿ¥ÿÏ ÿÝ ÿÝ ÿàÿëWÿóˆÿö˜ÿö”ÿöÿöŒÿõ€ÿ	èxåÐþ?                                 ñ ñ« ñÿ@ßÿ“ÉÿÍÿŒÐÿˆÔÿ…Øÿ‚Ûÿ~ßÿ}ÞÿªzÿêRÿõ™ÿö™ÿö•ÿö‘ÿöÿ÷Šÿ÷†ÿ÷‚ÿâÃÿÐþÿÐþ²Ðþ                     ñ" ñÞ ñÿ ñÿîÿ“Äÿ•Æÿ’ÊÿŽÎÿ‹Ñÿ‡Õÿ„Ùÿ…ÞÿÙóÿ üâÿö›ÿö“ÿöÿö‹ÿö‡ÿöƒÿ÷ÿöÿÔðÿÐþÿÐþÿÐþâÐþ(             ñ ñÛ ñÿ ñÿ ñÿ ñÿR×ÿ›Àÿ—Äÿ”ÇÿËÿÏÿŠÓÿÖîÿ þûÿ þûÿ üÛÿ÷ÿ÷ˆÿ÷…ÿ÷ÿ÷}ÿ÷yÿæ²ÿÐþÿÐþÿÐþÿÐþÿÐþáÐþ         ñ  ñÿ ñÿ ñÿ ñÿ ñÿðÿÆÿ¾ÿšÁÿ–Åÿ“Éÿ¸Ýÿ þûÿ þûÿ þûÿ þûÿú¶ÿ÷‚ÿ÷~ÿ÷zÿ÷wÿñ‹ÿÑøÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþª     ñ* ñý ñÿ ñÿ ñÿ ñÿ ñÿ ñÿìÿ†ÂÿŸ»ÿœ¿ÿšÃÿ òôÿ þûÿ þûÿ þûÿ þûÿ þïÿ÷€ÿ÷xÿ÷tÿñ†ÿÔïÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþ3 ñ‹ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿîÿ
gÌÿ¡¹ÿºÎÿ þûÿ þûÿ þûÿ þûÿ þûÿ þûÿú¡ÿ÷rÿê ÿÒõÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþ– ñÎ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ"åÿ«èÿ úûÿ þûÿ þûÿ þûÿ þûÿ ùûÿáÙÿÙÞÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÙ ñô ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ€ûÿ ²þÿ¹ýÿ½ýÿ¹üÿ«üÿ—üÿ¡ýÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþü ñþ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿˆûÿ±þÿ¬ýÿ¦ýÿ¡ýÿ›üÿ–üÿžýÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿ ñî ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ{úÿ±þÿ¬ýÿ¦ýÿ¡ýÿ›üÿ–üÿ£ýÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþø ñÂ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ
[øÿ±þÿ¬ýÿ¦ýÿ¡ýÿ›üÿ–üÿ®ýÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÌ ñx ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ&ôÿ±þÿ¬ýÿ¦ýÿ¡ýÿ›üÿ–üÿÀþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþ‚ ñ ñõ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ òÿüÿ¬ýÿ¦ýÿ¡ýÿ›üÿ ýÿÏþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþùÐþ     ñ| ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ)ôÿ«ýÿ¦ýÿ¡ýÿœýÿÀþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþ†         ñ ñ¹ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿS÷ÿ¦ýÿ¡ýÿµýÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÁÐþ             ñ ñ¶ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ òÿ
Søÿ·þþÏþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþ½Ðþ                     ñ ñr ñð ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñß ñOÐþHÐþÛÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþÿÐþòÐþyÐþ                                 ñ ñk ñ· ñç ñý ñú ñß ñ© ñW ñ        ÐþÐþSÐþ¦ÐþÝÐþúÐþýÐþèÐþ¹ÐþoÐþ                                                                                                                                                    ÿÿÿÿÿàÿÿÀÿÿ  ÿÿ  ÿþ  ü  ?ü  ?ü  ?ü  ?ü  ?ü  ?ø  à  À  €  €                                      €  €  À  à  ø€ÿÿÿÿ(      0                                                                                                                                                              Ý Ý ‰Ý ÕÝ ÷Ý øÝ ÖÝ ŒÝ !                                                            Ý pÝ ÷Ý ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ øÝ vÝ                                                 Ý „Ý ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ Œ                                            Ý GÝ þÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ N                                        Ý ÍÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÔÝ                                 Ý 'Ý ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ /                                Ý XÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ `                                Ý fÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ ÿÝ n                                ¢Ve¶eÿ£‘ÿ	› ÿŸ’ÿ²dÿÓÿÝ ÿÝ ÿàÿèDÿ	ícÿïlÿ	îaÿêDÿàIl                         ñ ñŸíý’ÉÿŽÎÿŠÓÿ…ØÿÝÿÛÿ«wÿêQÿõ–ÿõ–ÿö‘ÿöŒÿ÷‡ÿö‚ÿÔîþÏþ¤Ïþ             ñ ñÒ ñÿ ñÿ	mÐÿ•Æÿ‘ËÿŒÐÿˆÕÿ…ÚÿÖòÿ üÞÿö–ÿöŽÿö‰ÿ÷„ÿ÷ÿíœÿÏþÿÏþÿÏþÖÏþ         ñ· ñÿ ñÿ ñÿèÿ˜¿ÿ˜Ãÿ”ÇÿÌÿÈçÿ þúÿ þúÿûÉÿ÷†ÿ÷ÿ÷|ÿ÷zÿ×ãÿÏþÿÏþÿÏþÿÏþ¾Ïþ ñK ñÿ ñÿ ñÿ ñÿ ñÿ8Þÿ»ÿ›¿ÿ£Ëÿ üúÿ þúÿ þúÿ þùÿøÿ÷xÿ÷uÿÞÊÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþS ñ® ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ*âÿŒÀÿÎÚÿ þúÿ þúÿ þúÿ þúÿûºÿó‚ÿÛ×ÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþ¶ ñè ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿðÿ¡õÿ àüÿ éûÿ çûÿØûÿÂóÿÑûÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþð ñþ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ’üÿ¯þÿ§ýÿ ýÿ™ýÿœýÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿ ññ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ‰ûÿ¯þÿ§ýÿ ýÿ™ýÿŸýÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþø ñÁ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ	fùÿ¯þÿ§ýÿ ýÿ™ýÿ«ýÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÉ ñi ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ'ôÿ¯þÿ§ýÿ ýÿ™ýÿÀþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþq ñ ñÛ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿzúÿ§ýÿ ýÿ¨ýÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþàÏþ     ñ2 ññ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿóÿüÿ¦ýÿÊþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþôÏþ7             ñ1 ñÚ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿ ñÿóÅÉþÁÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÿÏþÞÏþ6                     ñ ñg ñ¿ ñð ñþ ñë ñ³ ñU ñÏþÏþQÏþ±ÏþéÏþþÏþñÏþÁÏþjÏþ	            ÿÿÿAÿ ÿAþ ?Aü ?Aø Aø Að Að Að Að AÀ A€ A€  A   A   A   A   A   A   A   A   A€ AÀ Aà A(                                                         Þ @Þ ŸÞ ¿Þ ¿Þ ŸÞ @                                    Þ pÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ                             Þ PÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ P                        Þ ÏÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ Ï                        Þ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿÞ ÿ                        ÔÿÈ6ÿÇ7ÿÒÿÞ ÿÞ ÿáÿä&ÿä%ÿáÿ                 ò  ò¿‹ËÿŽÏÿ‡ÖÿÞÿ©ÿ
îiÿöšÿö’ÿ÷Šÿõ‹ÿÐÿ¿Ðÿ      ò òï òÿYÕÿ™Ãÿ’Êÿ“Ôÿèõÿ ýèÿ÷”ÿ÷†ÿø~ÿé«ÿÐÿÿÐÿïÐÿ òŸ òÿ òÿ
îÿ„Ãÿ¾ÿËàÿ ÿûÿ ÿûÿû½ÿøyÿñÿÓöÿÐÿÿÐÿÿÐÿŸ òÿ òÿ òÿ òÿ
îÿgÍÿóóÿ ÿûÿ ÿûÿþêÿî“ÿÓöÿÐÿÿÐÿÿÐÿÿÐÿÿ òÿ òÿ òÿ òÿ òÿ òÿ¿ÿÿÀýÿ¸ýÿ¢ýÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿ òÿ òÿ òÿ òÿ òÿ òÿ¶ÿÿ«þÿ þÿ•ýÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿ òß òÿ òÿ òÿ òÿ òÿ|ûÿ«þÿ þÿ©þÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿß òP òÿ òÿ òÿ òÿ òÿ-õÿ«þÿ þÿÂÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿ`     ò òÿ òÿ òÿ òÿ òÿ?÷ÿ¿ÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿÿÐÿ             ò@ òŸ ò¿ ò¿ òŸ ò0Ðÿ ÐÿŸÐÿ¿Ðÿ¿ÐÿŸÐÿ@        ø¬Að¬Aà¬Aà¬Aà¬Aà¬A€¬A  ¬A  ¬A  ¬A  ¬A  ¬A  ¬A  ¬A€¬AÀ¬A
PACKAGER_BIN;
Packager_Php_Wrapper::$Contents[9]=<<<'PACKAGER_GZIP'
‹      =PÁNÃ0=¯_aõ²TªR¸ÆQÄqÚq‰ÛeÎä¸”	íßI«‰“Ÿígûùí‚II?aç	Õú™#Éºþ-Ví ¹ì£ÖÅj)	V"o ÉŠª‚L^Éà“>FUÝå‚ÍìP‡Ø+íxÌÝ£´g˜ÏÓ¿™#ªr¸-«÷›í‰_û×eAÓÈÀqÂ	ZæÈªL8ãr¦\ŠKEÓ &phCÖààË|›dÙŸ$éî?£;?Ô×l&ãU	ä‰ÿÉbòäâ¤»ÙØ.×OòWƒÈÂª*  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[10]=<<<'PACKAGER_GZIP'
‹      ­kwÛ¶õsó+hœN!-ˆ’Ú­[È ªëØMS;É‰Ý6­¤ö€$(Ñ¡H¤ü˜Äÿ¾{ð%ËNÏÎ¾X pqßOxxxøÌ84ÞðžûYt]GWü·¾ãëb™fŽq™®ŒÓ8
2cké*Ä¥Ék±âQliaùéJÞXg±c,‹â:w†ÃET,×žgC¸%9à¶¯r	G¾H|ñ—.Ï~<>y{|"/Þˆ,ÒÄ1ÆöHn¼ 4_ÆÿŒGƒñXñ’ó…pžÝðÌ¸[f“rÙqÊsóìÉéó'(?§Ï¾X	P@ p×i^àâŽ±1xr_,£dáSR¤„$YÄãè?‚Ì óµï‹<wŒpøpk˜x™yÁ‹u~œ‚"_–±Aðâþ$x~•§	ÒY†Šoîf"¿N“\\Š»â1KÁÐŒ£¾x~ŸøŽQdkñ¬´Üg‡C©
T«ðšÖ¦t¥Z–<	b¸Ì6žÓL8Ó9­D€%÷Ò¬À…bl:××òu\¼V”Ù†||ÿ^‹¼ÁàWP*qÈÇUüÔ¬÷	%ÇiRˆ¤\‚ÌpÎ¯¯Á8ò3¼ÜÞÞ€Õ Þ"DCå\ó8ö¸ÿé=ÏøŠ_Â9#oÚ`zÿG6R%Ý8A£nm::Ð@öõ:_Â¡›‰b%Rsš“4¹Pºy‰ÖÞ“XŽP­OàjÃ	Úã	Ò^O`Xˆ¢íè!œ%âVÂTðÜVÀJ÷&§Ó¹càVÙb½cæ–e¯MKcÅpù?¢%ˆTÈã]ã)tf…Þ²s“Ûà>”Û2äxeXaœÁTüê•$Æmõµ,YZ¤xmŠô¢È0ê[¢)âdšzWÂW¹sNJš70œzÔ§tACkSÇô£²HŽ¼2¾ÝâÊOdšyÛ-Ä¦üö˜¿Ý.ÕZ2bÞ¤Q`ŒcÁ„'°ì"=KoEvÌsaZ€	2wª±IQ™¨1h‘Ù¢! egd@8G	cH'pr0rB)B„s0¦2nJ`ÁäOÈ’uWæÅ­’®¶©ìà H}i`›×ˆŒo¤]	:‘«Óräâ0Ø¼¤Î×Âsê±«Ÿ	(	'±À/“¨ÂF,ê3n¿5-—Ûóà¯ÏTzè÷á#f:‡ôá@
›óÆ×<kÃí÷ðSºÊµ¦ä¥¹’áÜ´úÄ&€.†¯LÑF,×³sQàJÞºÀ]æ*=»•ì-'¦gó¢àþòäFÊ& Sp©_øß—V¦eà¾AqÈŠ£àŠCQ-jÉU*;IB=ËrÌ]ÚÒô“Õ/ ²yHŠg$ñDd&‘¤‰Ñƒ‘¢q*’àxÅ(¤J-,«*ø¢ ¾®-ƒq;•Þ@¶(Kúþ¡(G·?)÷Âí \Ä×W£EÏ£rÇ§UPÑÚ“ôýï&]=ê>àMnZNj0ßÚøƒ·Q¤·¶@õ¸óÄÊóli™´ÌvËkþq}
—K§ëA§èA%=íHŽŒxÊmV•¸K ”ÙÏ8‚§C$â«ôFì· ‡ÖÛQiX)ò‡jG›„P­Tù‡V·G¨Û´­[ÍÑ5Ï€™·PÉ5sÊiÔi-©7¹†ˆSùÍ	D,
a´JzÙQo%C>‘æð|è¶tû
Ë ¥	}•À›J?WpXpu“ïˆ®
†vB^ßV‹_0ï[Ý\øs[;uà(ÇßÄTãF½žg€ý²ar'$å~ÿBn°	÷ œ÷–ôÃŽZùŽ»ç>hA2â6Ý'“»@Em¹ã/^6§½Þ×£Ñ·Í÷ÄTà¿BQ«×½4]H@vp4x“Æúø¬^-Ø‰òVì0‰Å@4ŽAúÒ6½’þÒ©Í*ô|e}îJB_ò!S&°¡ºØêõô„/}½?‹Ø¼“©¼‰ÉÙt7wÑJaO…Õ\-=Ý©(´h•Ç@=€Y&›f0ØÅªŸÅg©¨6q%ˆjZ¥ú×¶ÔªËhÕë^O.«bà#¦„*Jü‡õþwÔùÝ*nŸ@K³,º[
øK.@ö.æÃrÑÕÔn¡F{„Ñw•8²÷RÄÜÁø%Th˜îÞ…&¹ª‡gÝ×Î
iMZäŽÓ…’Òu äÎjÅª¤S`r«¤¿wov¿y  ÙŸV@D'&Ò×9®­Ëª¬ÞÒP	#š¿¬‹ô‚q¨a_>ÔŸS©ƒVQÕÕ} ‰ìÕ»sè” eq‘Ù ÃùèÃ]#ài–®T÷mú´;3¢d8 Ï>~nÄÇw²!7Éyägiž†…ýñüÈB“£»}L({Èa]P(Ü*AÔJ „w8Î™i©¦¢2ßš?0¨DBùÚË‹Ìôúãº2 ½={,`pXû ©&n³;KïsQT6‚IzQ,'¼[Bö°3¢^‡7ØiÛwJÎs0ÀW¨Ü×——ïíoì´“;›_ïÙÄ¶iäÞÜBèQñ³y2°*Ëv·]çÂ€öÖD®6¢j¨Õ^
7è³±…îµß3üi0·´A0Š5"{ü1PÝFTs£n"ºÏ 4p‘«ÀˆÃ³8vÜšemµ€zH»ò-ÜÀ~q¬â“¾ÚÓ.’	©b³z ç e}è=Ð¨ÝF¨.nf=hÚ²>jçôT‹yŽŽ€cÀLÅj­Æ8n’±êJÂü¾×‡V£¹ÙrãGÔˆtÑÐ$—ÝŒ›Üª.»ºùxsñîív+oýdvÚ)ÛçX^üÇl%­Ç¦s¾+‡RçuÎ-yÕÔÞb`*æ“@RµsQxoâ.ˆíê	 C[=«ˆ>a¤ï×¼yöUA‚íaZþ©Í\K$öh#¨±ŒGßB;;‚ÙÑáeÃŽPR.hH—ô“»`Ã)™Ífw£Ñ`v7gwÿañ"œ²ñÝü6B¯u¼ñÁŒJùŽ¦¸°ð:`aòœ<ïcÊ¾Ža–4Ð¿ó§\Eje/ÏÅÌýd†íÖQQ›
X[@Œs^,í0NAûÞpüÕ(>ú¦÷·Ý½ÒêŽäW®b:Y¯<‘ÕLGùi”D0ÈÛú.8#Á†è^šÆ‚CÁ­ÀQu½¾¢aµ;8 ÚAå‹ºk¥ð—Úa€i4h­³Ú~	Œ3•zªØnßS!Õëp|bº†áýþÇü EÆ½Fs ¥mó‰UàÒ}C6rÃ—ŸÜóÛBy!Ð†spè”$Ãµ¦¤¿Ð.I‰Õ'sRGÂBLŸ˜Ðˆié’	ÄÖÄgÅ6ðkÆ‰-‘ô"5ý%àvH?¶š¼¼Tqö?¢Ñüovø/IYb²jæ´ÂÛ1ÕÎó~¾<>¥ü&x†O2+³uvEt	ã=gH
LÙ'—;¯Óu–Ëg]”¬!–öž]?Muö;)]5{lÈÌÐü¥dVÈ%¾”Ï¹LpÊeˆËL.a —2›‘ç°9“›ðSVo1us<*{¨¹§N+>|*¶CºB‡…ÔßäÆÊjô™Xªˆ¶Œ°äù»Ûä½ve=Kü;ÖóÍøEÕÀ~ÀØ
p‹­šŽÃ“¼È¹7DN†LgsêlÊY>?ür¨“T†³™=\Pò±š=2ýU‘Ì²ù!Ùâ@¶!§Übdl“YÐ7'ÎÌž‡ÖVSq2Ÿögƒ9žXÄ7oã?¶Î–Zx+?œM­>Â@hVa2qÃc“˜`î>± @îKÞÄÇw•Ð’OªYzk`å½¸O
~§çXi'ôfà²,±Â½í¼èv‡7o^Ü»(hs‰¸‰Òu~y1X¿×«µ½çLö};»”`sCà$\þ–¯D·‹°Üv¿}ðâsU½:‚«>|Ò"§sGÍÄ›ï?×lµÚs·¢ _ô÷“ðêA äµ¦b$w³aùJùù=zzò¿ªŸÛöaÛyVSS: ÿÌ p%¿z<Š¡‰U­pç@X«u¯òÄ^åXúèªz#^.\%Ágô?·Ö^íã»Hëé _G~x¨#Ýi›úÝ¾µf„ª7&{A«ÿ)@eÒê…Õ·Öm0©·ar[˜ê- ƒåì; t•jÃ®Ê4žøŸðãü7í_ëŸXjnú­Šôà…U–îvõ*X  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[11]=<<<'PACKAGER_GZIP'
‹      ­XKsÛ8>G¿‚âÁ&„‘|Ø®'/O’É8S•ìI¥ÚAðñ¡")ÛZYÿ}»|€Tí…ÄÝº¿nàÕóç3ã¹ñ™ßñJ”É®6Þ¥¼ªŒ2ÝÉ»~ãû:.Jã{‘7i”ÆëºÈB,ýe<IQdÿ¤‘w²¬’"7®œ…sE-Õ>Ëxy0®Ë¼\^½¼RÍòg»TÎh/ç½“\Z—T»å™¼dÆqöìÃC-óÀ5þâ¥Ìkê„‘löì[ÍëD¸8æYEåiæá>5noÙÔõìÕ+Cð45v´€¡†™uã>©c£‚ÍŒ>8¼Ž“ÊQc-^Fû
•½ÒWâùÁ(êX–“kŽqh¤’þ[+æhåÓìÙ	4zWäU]îE]”º°Ï–Ì ÿÕJ©5ÒJŸ:û™0¯”a*EmŠ}iˆ"†ÀIÖ(Ré¤EdÑ•LCO‚}ýfŸ¦ù¨ÇT;.$nšòÄŒ$o†NÈÿÔeú<†kÎž<÷˜Ã•O³üž¿šÝñRy‚×ja¥ö±Óˆ[ö‡øw|}‰$´L8$LÏ«;Y„†¿^lìRÖû&:•…u¶|í;©Ì£:¾ö×Ë{„qµBu›´¹	mkîðçgšM[{Ð¤¯š=üJ±Ïò«Àœ·‚¤leiª«›F+gWuc?ÉƒÇGë‰ž®a &ÍÊ‘Ãw»ô@Æd$` <(€¸Æ—³H#¼¶¤ƒ©!hÛ§nE+’.m¨Òê‚Ùu\÷F.ïïÐú¡,‹Ò2ŸÚxiÜÇ¼6@¢º<Àuaøà …­yQ“Uq?• <™€ôÖ§J!YèeeK›E
²RfÖîwqa‰¾æ;íU õ¡ì¢=¸ l€;äÑÖ÷Ž¿KÅ{ÿJ×Ô*&ƒÊ§×¶S«›ìS¶žÔºº¢ÉJ5Õßd“šêo2LL­b24@×Ä¯*“1ª*š¬5G×lK&3?šn[`ÈPƒ¯É”[º¦ú›§VwÜÎï­Œù]Tåéd?…·E}ƒ§å.Ø-ì¡5,Ùû*1«{E5H}—hx-=S`Ëqq2¡WƒªÐÚ)™qGxG\‰«_â-à›Ò7¤oÔ»"î¥N"G cÔÒl4lþàßžøÅÅ\>ÿ~zqñrùš;ûJ–o"¤+°Yùð¬ß¹ýðÝ´/.Î¦ÐÆÁ~k×Oy¾…ŽÀ‰ä¡ùUß²ãuŒÇq=_¸óåÉ"ÛWÄ“ÿÈo‡¼æ½&¾R% .òAó\
[ø±áÛç¯Å†:ë`ãÍPâÐà­óÓùò–fÔ¸û7°äÉƒÖÅ@˜Í|Ÿù²Ô¨ôÚwƒ­Tò ÍdAGCD¶,@=lNòö€&;Ø¨ÕTsª]šÔ€¸i³™`ÒKÁíàäAÃÕ«ðu´
_xKû(¼`nðç#mûµ…ç‡75œ¤’ªKó…ÿÂ¼4‚BVùemÈ‡¤ªç&Ee3íœ ¶½òKÉ·§“ô$À{j’.ôÔòüÈ<MAhdb"65»€ÙmVÂ©â$¬Á0„³ÏU9°[”‘¡¬€(´aõ€	›ð¬F°w¶2DRzÀ†ÅÎ²LÓ4Sª[hnP_oW1¢zboXˆxF€"€üy‹d‘Sß(Ä‚2ÇSWÖÕº4ßlœo­ÜÇ CØ˜Àµ!ÅÛ€'‡ã0;Î"ÉIƒ¦·¸~N´†ZˆXc,ô ÖÙãèÄpÀ†GcŸT°Á]7³ÐkÝ±¨Ñ?À‡-È¢€"z`Ë¯–"Ä™Êä0éƒ§–ÈÍ:Ú\g^S²l×Ê`¡Î¨i:ÐÈN¶½JÕ°•˜“"Z‚ù,CW¿í‹o±Hä£
xÒž€ß´Øˆ˜b•aW[AãìÂf3Sk 5 $KàÂ¡FH%z38°ßc¸çØ-% ÛJû¤íNM#KI÷ @°nNE&Sˆu¼ïjâ<Ðï?šƒ¹Î»ÓR­F€ã !êC	bÔÊ;\j5AE”&d Mê³+ª*ÔÓ"•\W]ÏŒ¤¾„aRÈªÂûŽ!ê²;•¿_[\[y¸/Ê ²+`iˆÑŽèQ¨\6 ˜ÿŽ·SJøi™—Áo4¡È¢Ow¡á~j­‰0¶\ŠË¥/¼Ùp½?Ï¦sh‰Y)nzÊ”ÇnD°` žÞ.¶H-ß‹ÀÁFéŸ)ö–ÖÊ":ê…¢}Ñ{ˆuoŸ°eðûi„C›ŽCK"W{¾˜c,äwæ¿!µ–Nµ÷Á¬d¶ 7º‡Ç&ì-RþJlî&IXP…§UNI”Ê,íÊ¾ÉÎ ¡>nD(Y ’yJ²fë¹ç.ØAƒÄ™ð¼HWàÎßBa¢íârç‹j¡Š^è²Ì£Ñ©ì˜¶Ë:œ’‘µ…”ä#TÄ¾Æõè²ÑÛbüU3ÁëŽ¡Ogµ;  ].¿Âäù’²¼1ª´Ü¨{äçž±|< µ``º‰þéN\žŠ<m$l×¡±Uh¨ìhKñeî‰aFôW™Ü!4·d·K ¡¸—–EÖPÜkùPÓ¸-Ä Š\Ò&2îòz;‰8Áûe"ošuN#(ÝmRÝÎA:ÈT¥Žæ¶?×›!7&ß hŽ;¿%m¢Ô»½ì½7<‹L&”®s’yë$6ÁÈ¸'ÃK7†<Ú¶;ë¡H	†%²FŸ+°™&únR-à¢6J@«íépˆ4Áæ…xË˜Ð%ìÇ ¸M"ú~2n•Šê’©¤Òü{64Ø9e Ò‹‘àt–ßâÕïÚò§P‚ô	ó±˜~ÇZv
mµj¸±ÝQ÷yÞÀØRfÜš0=?Hõ
!K°¬‘…CÄ8­„7\Á–vg8øŠ¡E'{b4—	û¿G~Wß<uåú	6
M¼ €˜Öé\;ºÄýÂYSHôq¬kö{IpûkÝ¢¥²è‰¨‚!=>ª€Q ìGÐT*D?þD["îáü5›8ÿ”û»—Þ¨è@/[pÝRº o·›·Eû«å|ÈáEi ÄÜ1Ø?17Ü%€«A~w;°	u§Nõ‡ÃöMÏ>Û¨‰(n@Ë@žØpF¹Âv…o3m° h{FØ¸>¦Ì40îæ ³Ãó»Bp6«æý`œqÁ-û€=ë*‘u	üM^éÛ§ä‹î|¥dûº}¸l¥FwÜH†÷uðžûôSÕÔ“2o¼zÛûõ›²ä‡ùJuí¶½œ7»sØ}øíñÓðáºÝ&+‚}
›¨¿#vEYW×QZø<¥ho¯þèð_îË  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[12]=<<<'PACKAGER_GZIP'
‹      TKoÓ@>'ÿa¸Ô¶âºÊË!©BÚHHE\B[{moYïF»ëÆU•ÿÎìÃ¡4rñã›™oÞ³âDëìœVLÐ8ú"ËŽÓ(½®1¬È?GLhCDAsç)"¨ù´«N†IqâÔGŠšN	0Ó™¦¼Ê‚J·ãÑ)V1ÕFª}†}K˜;ºÙ d‚™¥¤ú,ëš‰:Nfž—Zðª¾*&ŒÆ,þØ`ßéÉ	øÀg€Ÿ…l[*Œó
«F‚näÐŒ˜¢¡%8_˜€k%7š*´ZrŠl&J¹É¤pJþ_w-ÕšÔ4…Šq|Zò-yê	Co‰‚ÇÉ„*dèæ–*se¬¿É´'%-XKøwÂ;[â&ýŠðéÕbëÇV	ûYAlîÖTV±£Û«ÙÇÈÏžÎ!êDé&¥ŒBC«+Âµëîh?ƒôPvÌ+Åq¸ÜKbâžhÄùaùí$õÆbr‰½Å&e¢Õ`n«y ½+|0³õÎ}w=€-îZ‘»V„pŽó]üÎ}«3÷g‡9{`’@QXÃ0² ·¬&¸†Y‡FË‡~È`Í‰©¤jqïwJæ4¶¾]ËÒg\’2¾2Tœc@gèÛ(É9Us}§mˆÛù>öËsÌe=ÄÝRÓÈíÖR›´c»aðÔ[?Â»£º0wö´d×¸un¦þ“üÃ#ÀÄº3~¬íø¹_´Ãûã\XECpïq!¦Ïž¿8}ùêõ›·Ë÷«ó‹Ë(+—A]«àÓèmˆX5ˆ5
¦3|½ÛyÉ8µiœLÂjõ¨µ[‡+YÒ¥‰™/@p1™ƒÆi 4îa±XÀiG0í§—ö
ü£Ð‚p‹‡Bz>{DÇXâ?0‡s  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[13]=<<<'PACKAGER_GZIP'
‹      Å”okÛ0ÆßöauRü·k‘	]÷bìM?ÄÙ:Ùb²d¤sm7ä»ONRj:ö:¬GòÝs?Ž³Òû u$«´r.¥¿÷é—Õa4Å*<^U+ÕÄÂ—ÉJà?âaálÅz«6¡ÔÇ¤kº§ÊÇZ£ÚÃ‡¼ƒŠ¤Ñpé®j_~]
{1û;¿¶gëËÎšOÛ¸ôc¯çØ…Û[VZKr·0¶Ú„Ø–È9òØt¨iê0ÜF«[ÐFˆ×e{¢%	ÙoÙ÷Z¯Ãûæ?øi:ù€²nˆÍy—G“B¦çHuj¨UQiøtlÁÖR³¬XþÏÞ[E¿Q½¢G„Èv±C+E¡¤Æ¸¹˜çÉÛ«»|C–?vcQBõ§¶¦×œ­÷ûý)©‚=žß‡šSÒ‚#´ñÜ ðvö¸ÌBƒäÔ°Ç,ó~p.uÍr¯¯°;¾‚žLQË½“.{Ç¾ÍåÍ»¸XdA¾ëÆÀÖ%l²èü$ß·ÿ¬šü½>¡øß5qú¡î,f  
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[14]=<<<'PACKAGER_GZIP'
‹      Ž±
Â0EwÁ(.&E]-.VÅÁ:¹‰CH_Û”ô=I^©Rüw«ÛåÞÃåè4Ñ‘;«Û¨OU“TÏg¹71ªTA,ÿÓr5_Xn*{«œ0rè-SØV=Zv„BŽÜ¸¨ž& ²™ ò <Õ¢$ÛwS­jà£‡_Œû÷ÍÔWÓX4›…¼¯Ê!B8ßŠ‹Ì>™KTõsØ!ÉßfºþÙÎ¿   
PACKAGER_GZIP;
Packager_Php_Wrapper::$Contents[15]=<<<'PACKAGER_GZIP'
‹      ­[ësÛ¶–ÿÞ™þ2¦k“LËm·÷–«ë8I“4¯iÒ6­¬ÛI¢M‰^’òceýï{ÎÀ—h7Ý¹_D ƒÎÐÑ£ÑQY‰*ÎË£,Ê£0eé,Ó•s^Ž}ùÅ•(F§XéÇëUX¥ùÊÊì)„eo°Kà'°D‘¬—rU•¶—Æ+«"]%Ì÷«ÛK™Ç£`6™Û…¬Ö|è”¾óãÇ“ÉUR-¦Áìxîn¶¶‡£åª™ÑäêfÂÎ[±”å¥åÜgL×=_gÙ
ê¡JuöôÁ©X¯"§+±=CHæPGC‹~õžëU9—E^åØ×	ÒUtwgÝÓÒ`"Z˜D€‰9qÄåevkU‹´¥+ {"ák\Ác'ÌW¡¨,é„"ËZÚö¶1„i-¦–bÖ‚ÙÕ¢È¯G+y=úµÏŠ"/,vÑ£ÃÑõBT# ¨*naƒFU>
ä(È)¬]åÕ‰A&xÜ^éÏæN™¥¡ä±ß'•Û<ñ‘šéö÷­°yó»¶µÚôÐì[, œÓœðªJó£¬h‡~I#—µ^‡——VÓØzgüåj!‹´’ÐTvSÉT©'ãH\¦žŒÓÔÅ:¬òÂe­Æ‘ÿ\†¿ªL¼¨*¨È¸áF—™ãLIsM—2‹á~¿Àè2õd[³vœ¶ï‰\ˆ«4_þ†6öeü6¯žãf¹þæhUó§9¼,`WÝ¯i ÔG¹¼ÌD%}F¾™l´¶ j:6Õ}Bƒ	õHý	üfôÓoÒRÂÏœPœ@ŒGð–åÀáÐAï/ËƒsV^ûû{ ð«× ¥ûû‡Ç…³.eq’ p¬¼y¼ï¼}ö‘Ùûû;ŸGP'€{+7ÈÄê"gQÈªššKQ-p7¦{wïxk‹­Ë*_¦ÿ+?Ü®*qÓ¬$PK‰@ww°ò
kBâQ`G~0çÐ™Eso%~dXXlw‡·Z<³ FÜç63[­—,ZŠt¸“ÎTOIÅµ¾äQ­„HÕò×ac_‘'·È±‰Ì
aiNy™¥ Îlrég ôñH+j/~œxñØ?¶7¡Íâ9jû=‹°‘¶½·‰ïƒµbÒ
‰˜qtÀÆÁ˜Œ¢\–«ƒj$oÒ²Úcd2ŽõgÐÀÙ^PHq±ÝJ_º[½IØBK%wwÌo­*y8`˜ô,Àu‘1‘:å"+à‹ÐY¯T9²È Ÿ¬ˆÔ§ÖèmB³ì^sJGéƒ*Ì/-°dÀÌø@½€jêâñ…·@Pc?œ-æ<F80>	 Ò‡J‹Ä‘SåÈ¼ÂZ6ÛúTn«©%™ZôfJxF´sŠ6&[qPÈqßÄ†Îyž®hº±±µ&™Á[ŒPä}(Úö«fÆhDSÀ»co•¡ÁY”^æ±oè¥c±¥ú=¬A
 ¢øÝ:ç"¼T‚œ$Ýlù"r>KæÓ¥¯K–íZKh	[¤«vñ-·¶íeª›÷É‹7VÈ¾D9ÛŸ`‘4*àFû!<.ð¡©ÅJÄ_96™dÍÚdê/[4€d…8pÜÒF!RtÒÙ`ßMxËÆ¢”DÀYYã®]©¯ˆOà›kX4Ó›Ò²#C€s<m¤i`;"XÞZâåFøÝUËÉÒl:®PcF"Cow(o@‘W˜j§ç2/ËœtˆÐÅ‰rd¦á£´:€n2”e)Š[êC:¨öëF×iµ€ª8]ÈÛë¼ˆÀ¯} GaoF(\Ü²o<ÑóíÛl§ð¥ÅÐ$ƒØ¤ÈA)¨ŠÆÑ…Šë¡±,üÎp—õ‡{³Ã.µ8KtGq†ØW, äuÎÁ* ÿ‚Þi¸’clyz	ˆWÏñ“@ÄÚjÕò„vzb#e¯Û-¤rßÞÃÉ õ•Ñ!Y:QêY’fµ÷&{hB’:ö'øÔÒ)×‚5ŸèF¡óQ¿ñvK”´’® a“D,,‰§‰•7Iúslo‘öuv5F#AÊ" ÌW”%ðuÛé¯¥¨s"@=ðý¤½€)l¿…Ä$sšÅÎO½ÅÊtýÔÓ×Êluu©¬Õlío8	¸=^‹É»G¤°{Zð(ÈÃí©{Oà×'ÐË€ÌHHíÄ{èw ²$#ÅH•Žç*~|Õè« ÷gr`‚6‡¿zp&²,÷™cÍx=4.Ê1º ã²ç‡]gè}‘^¡öXÊj‘G¤oÜÚ7BmùµŒFq‘/µX±’7õ»  ]Q“Fã.§ƒˆ¼¯]&-2!ù¹ÚÇ­Å#Dñ² Ô ƒü½v58Å$T‚…ãÄO™­-ô²!$Þ±J	Z%¤®‘=#"d2AˆµmKÝ‡äÙ¶kæ!+	?KÄŒh:?Ëª1Fxž.4Qg5…€LÛ5Òqi‚Í1¼XKÜôArµúôÁM¥¢
.U-ñ¸œœé/P»µUü†|S+	<'tÅÎÑï^´XÏEë5žÛn¯y×gÎÂRLl˜²R%dŒÕão0[/ô»##ÖÒ®ù“-Ód"ŒÜ2À^ õ¨ÜâÏïµÀF!Ó"/ †WŽúhwu¼ý­&{tŒ`ðCû˜Ðfm~–ŠŸ,V|tw§Œ-X,| ­/`¡Rúâs 5Z¸Aóïa¨mðâAÅot»VþdP@¹\€<´…!£À÷B)vö6)èÛî*ð¼!¤¶Àþ¤¶!Š Eô»–P±tÖÎšDž½3‘6HnDÃGh=î™Ü„32ÆP²:˜»:ËÔqÑdã ²óÛš«›¹§³}g‚ë¿K/•«(nSt(Ð-É›ôñþ¾pÞQÒØžšl¥^(UºýJâ»wîý	ª¡4²ÐB­&®>)
q;‡.ïè½•z5A¹ž]ÀìÝô³/¶Ýdµ™f™Gë&QOGÞ\æEUN“,DF–Þö¾üâË/ŽvÓùâ\Üô³ù'çíLxòÖ8±Š@ÒK£b€‹—ëÃ,Š &Å‚D÷
ú3 W¬³ê…}Ì>þ,ÿg-KðÑƒ€ˆ¹ìÓ2{QU—ºžqL©›T‡˜¬†vD$U)Â£›ÃëëëC `y¸.`cÃ<0ôdçe¾º<Ì^¼…€ ?Ô¯LuÂg¯ÚÝtýK¢
ju¯sÑÍÞw0ÐœËu¹€F³QØGS’¯>(lD£÷à('ëcìŽ@îä#Ð~=0B"«~à((*ÃÖÆç/ßòžµLˆ~l=*„ÒÿÉaŽÇÌàYóÔp–ÞvJ"­"ý‰JÀCï”Èò<Šq1[Þ®BœÂrR«õZê`uc„x×ä4 >™³-/›>‚ƒZCƒqmÜŠ£(}t*´úB=¦NPhx¦÷À‡0o¡ÊDˆu•§Ñ£ÄhÊ˜Ù ^^C´PœŠ¢sI¬«\FKõe=‚^²Ÿ4ÐÚý–öiÜ!Ì—ÇªW!KuPîÞ1GÝÍV ÎœX¥mõöbÕ–¯ÝöV)
ü½½(iƒQÀH¾qn³PŠ –MjÎù#8bË?ôÃOAŸðÀ¯GU¹™g™Ä7‹•a‘^VLåƒßRò?õ:ÞPêa<¦s­CÆÐ@›V)›w,pÞkÓÌîÑKsµ†7–=fƒá2J16<ËËYTÀJÁº’@]b"¸ 	»&òà÷8¢ªD¸xvEkÈW°¦èU¼A¾‰--Û†…‡8²¨N¢sB÷zåJ•=Ãc®À¶]«?7m=èdõÄäŒˆ"šñu
J|%!V%Ò“ñ½‰šäLýé"Í" Ä¨–,ÂUÂ—FPµåhmæ›q…W -¶[þ~—?£ÛïM{áí¡…äëëÉ„#çQbæ4BÅkNÒß?9ùò^ö®htÓbZwñ¤dð:]Eùµ#¡"K8´3ßIôrýX~oÝ.=GÚòç•«”Q¹4Ë](HÁÌþ#ZDR˜|™_Éáp÷zÆÈMT
Æ5¨ô#þÛÄ6oc«)RÞß[°äš8Å4ªµ^)‰•Aâ”~s#™ÉJŽÚM[þ±›h)C1%sEOz-lŸ¢TKiD_)AÕá•áS †V·DoéÊ`h&¦óµ)üŠzßîêÂ_Úè´.QÀ:¾õA¦6ÚßœŸÑKlHç˜. <Sx~†n°]ê·#ÎC]·üç¬¢Çîe˜ëC|¿]—§°¡>Õb(@UÞñ÷ß?nZ÷÷¿™L~hÞ§–êþ¨UzÚËÅ­kuR-Wx £Š:8ÖŸÏêRâë|z˜£4Ê‡qGlÜÚžoËíØf“´Q›ê!/… )W¡¼¨Úß×u ¾üÅ°qDGSSKø³¾îâ°‡Äj®Š&ª¤ÐæF<02)›ËtÿGySíŒ«Gò—³(7q`&jnÔ¬ú·öª•—Ñ²×ûûTüÝÈÀ'T	ŸîŠþ®½ÿ1¿YfípiU·Juþ
;cV´K‡µk.ºHõúû=„¾3Ë!ßKMæÑ5…úrÂ¹¸ÆÇ¸»ëµá"íikªq»½hu^TÓë…¨ØfuªUmùÅ[Ünv  ÿØäPbbc­ãÚèØ¶ÙõB[ÑÂEm¤X·ü«]Ì6[°¤Jup#U]ìñŽÁÓwoÀS—ÅCb#¤/âw‰ŸùRyßVÈ»1#"@â€#Î	Ðs%?©ÜboÒ°ÈË<®œOo^Ã´Ì6Þ>*”éÐ®CW0Ü÷‚ k$€ðîÆygÉ~kûŽÀùƒ`q"}XŒkÿiîíëûƒµŸ5*â¶º±to:—êO€ô;Ñµ‹.cäLxÐ!çÕ9íý±7%lÀ×î‹ß;ß9p'{•ßTbE{k¨ŽRG½6)Ûìl·Ú“Y)GÍÅ•	Ý²Ð×)¢ÇÒ‹ð:²×0gàå[oh¡X³ä@Ü·\»&nÔND7Â#:ªˆÔA
æÉ*M²Þµˆ8wÓ+´±ýÅ¾ŠNþtÀ]dSfdµzDq€Ú}¼gà÷6¼1nVh:úcDç)ø\/ó#Â£?òkT1ÜdûÌ®-‰Žƒ1¸Í—-Ö9½FœwðŠ¨¨ð=í|¼úðîíÝ}õ“Õq§œP y	ïÛ+2´?›cðmVzu¢ZØòî¤úè"Íê(âÒøÖ¢«.]*0) ‹Î±1­"ÇÌgã°¦-Ð·föQ-ÿÔ&®µ$ÿ^GÐ¤6'?€;;ØÑÍMPvt¶:á1_ð/ñfììììf29<»9ŽÏnþCáûx~”ã›yåuŠ<^c¼	ön}Wµ¦
¦ì`,êk0ÏÛ…3¡ÕlW@g®àNèmTõNeë	¬â¨Nœå ~ptüÝà/c+ø¯~ÝÖ.Ñ‚%hÖ7áÍiùoTH¤Z
¬ÈÐaêƒ Ï3)ÀÚêÏ¡Á|\ zjNp1umØPÔ»oÒä«÷²Á25à*Á¾Ì£æö^óÉXï	Ì.]BÜ~û²|e·n-¦:€UÛà‰š¹vàá¥Ëøñ…º~—(„yñSbÞ‡®ÁŸ±q¢¹‘3›n|Õb¾ÔóÎ èx#š†l ×Ê|œl“RÏ¿€±]6ÎìF%/”ˆý?‡ÑôozôoÙv‹zª“Wï‹S[E€ºûåã)+ü.EÙ˜C(«ÕöìçŽÚp*ØÊ1ûØkx‘¯‹’ZÜþpéjr4ØöA†ù*Rm°­§ÂŽ; ëürvVQ“äg+*®°S1ÆbAEˆåI:ÎÎØTžQ%<Ì¡Â¦Ö]nÀÉ}ê…<­»yÂœ[Ç|I¿ÚwlëCtâ™X¾ïn,Dùîzõ^³r}ñ
za·—~hÅÏÙm®bõ=ß_âUE<_6ÎF@´¨«EHÉÑ¿ggsîn¶gåüÑWGZAÕšéèìÌ9J8û³›:6û7B±:+æØ]U¬å],€)ïP2î§gÑØšºgÎYôÈžBi&ŸÍgã³Ã9¶ØSoÞºüûÎ½ã6~U>:›Ùcì¢iÄ>öå•È,fÁv™¶qHYÓS*±MÙTs]_ÝÖ!,ír3ÞÛnÑ¸½í$´§#š4gG·®ŒŽ«/‰7ˆËiÑeÐí6rùzµœ¡_Ãö ez•»„íµÍûõN²çÜ$Uw³¹3¤tîªpX Oóä¯ü¬–gî™t2xŠ NÂDA+ Æé®†¦ågÒ{òpÐ^gÚ†FëeÔT€ÃÿE	µ˜þü~)ÖWò"¿süƒvZ»)¤ïcÉî5où8ñ$š¼d5|	.Ä”H+k€‰‘w1ÒÎ—ÞÓ°ë²Ö„pý‘„›ãxþQ¦ÌñÔª±¦u5m‰¥ŽY`x×m·†3ÐÆ]Èajl	/0Åñæž=n<¿Öù•
™þÉ‘>üïÜsûFàêÃX:õÕ7÷­ÕvÀ7úÏ(sÀ%`[×Iî;}xï˜¯@tþÆÒçûNçÖŸwÐ"uô:OµØ­:óO+‘Å{@ *A%ó~ÏG7_Éîéä/Ï&’Çi&9(ÉÃ<SÃëKœ½™4Ãä«+0,
þùy‘Q˜.Eö«ÈÖÒÂáÀ]üó`¬w‡¦«þŠM­&ÅÕ^Å¬_3·÷üƒúì ¹ÀŒÄÛ¢o³ùÜ¡|½Vu=]ã~Öštg›¯‹ôó¾0³¡?¿Ø„ñç}HðÑv¸fOÖË•‹[ƒ§ë$®JRyúY£¶>°Ýƒ€Í+eñy$Õ jþ	ds¼¾Œ7Ü¦ÕTµN†-:‚:˜âeÉ"ÇÛK~y[Vr¹/ˆ	ýóòh+A5puØë`’÷@kâÏ¶‰5Á‡ q¢'aÐù0ý,¤«Ëu¥x›Šð…¯™T5qšJÿ`rüõ7ßþ÷wÿøç÷'ONŸ>{~Àóu|€î¦ÖÐøÿ«ô±É(êt<¶77~]ÝŠÃRÛSãŒ}šˆÚ Þºùá‡¾µ÷'7“çö¸Ót£*½í 5 @`{ÿÂÃ	Å3:  
PACKAGER_GZIP;
class MvcCore_Controller{protected$request;protected$controller='';protected$action='';protected$ajax=FALSE;protected$view;protected$layout='front';protected$viewEnabled=TRUE;protected$minifyHtml=FALSE;protected static$staticPath='/static';protected static$tmpPath='/Var/Tmp';private static$_assetsMimeTypes=array('js'=>'text/javascript','css'=>'text/css','ico'=>'image/x-icon','gif'=>'image/gif','png'=>'image/png','jpg'=>'image/jpg','jpeg'=>'image/jpeg','bmp'=>'image/bmp','svg'=>'image/svg+xml','eot'=>'application/vnd.ms-fontobject','ttf'=>'font/truetype','otf'=>'font/opentype','woff'=>'application/x-font-woff','woff2'=>'application/x-font-woff',);public function __construct(&$request=NULL){$this->request=$request;$this->controller=$this->request->params['controller'];$this->action=$this->request->params['action'];$this->Init();}public function Init(){MvcCore::SessionStart();if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){$this->ajax=TRUE;$this->DisableView();}if(get_class($this)=='MvcCore_Controller'){$this->DisableView();}}public function PreDispatch(){if(!$this->ajax)$this->view=new MvcCore_View($this);}public function GetParam($name="",$pregReplaceAllowedChars="a-zA-Z0-9_/\-\.\@"){$result='';$params=$this->request->params;if(isset($params[$name])){$rawValue=trim($params[$name]);if(mb_strlen($rawValue)>0){if(!$pregReplaceAllowedChars||$pregReplaceAllowedChars==".*"){$result=$rawValue;}else{$pattern="#[^".$pregReplaceAllowedChars."]#";$result=preg_replace($pattern,"",$rawValue);}}}return$result;}public function&GetRequest(){return$this->request;}public function&GetView(){return$this->view;}public function SetLayout($layout=''){$this->layout=$layout;}public function DisableView(){$this->viewEnabled=FALSE;}public function AssetAction(){$ext='';$path=$this->GetParam('path');$path='/'.ltrim(str_replace('..','',$path),'/');if(strpos($path,self::$staticPath)!==0&&strpos($path,self::$tmpPath)!==0){throw new Exception("[MvcCore_Controller] File path: '$path' is not allowed.");}$path=$this->request->appRoot.$path;if(!Packager_Php_Wrapper::FileExists($path)){throw new Exception("[MvcCore_Controller] File not found: '$path'.");}$lastDotPos=strrpos($path,'.');if($lastDotPos!==FALSE){$ext=substr($path,$lastDotPos+1);}if(isset(self::$_assetsMimeTypes[$ext])){header('Content-Type: '.self::$_assetsMimeTypes[$ext]);}Packager_Php_Wrapper::Readfile($path);}public function Render($controllerName='',$actionName=''){if($this->viewEnabled){if(!$controllerName)$controllerName=$this->request->params['controller'];if(!$actionName)$actionName=$this->request->params['action'];$controllerPath=str_replace('_',DIRECTORY_SEPARATOR,$controllerName);$viewScriptPath=implode(DIRECTORY_SEPARATOR,array($controllerPath,$actionName));$actionResult=$this->view->RenderScript($viewScriptPath);$layout=new MvcCore_View($this);$layout->SetUp($this->view);$outputResult=$layout->RenderLayout($this->layout,$actionResult);unset($layout,$this->view);if($this->minifyHtml&&class_exists('Minify_HTML'))$outputResult=Minify_HTML::minify($outputResult);$this->HtmlResponse($outputResult);}}public function HtmlResponse($output=""){header('Content-Type: text/html; charset=utf-8');if(class_exists('Debug')&&Debug::$productionMode)header('Content-Length: '.strlen($output));self::addTimeAndMemoryHeader();echo $output;$this->Terminate();}public function JsonResponse($data=array()){if(!defined('JSON_UNESCAPED_SLASHES'))define('JSON_UNESCAPED_SLASHES',64);if(!defined('JSON_UNESCAPED_UNICODE'))define('JSON_UNESCAPED_UNICODE',256);$output=json_encode($data,JSON_HEX_TAG|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);header('Content-Type: text/javascript; charset=utf-8');if(class_exists('Debug')&&Debug::$productionMode)header('Content-Length: '.strlen($output));self::addTimeAndMemoryHeader();echo $output;$this->Terminate();}public function Url($controllerAction='',$params=array()){return MvcCore::GetInstance()->Url($controllerAction,$params);}public function AssetUrl($path=''){return MvcCore::GetInstance()->Url('Controller::Asset',array('path'=>$path));}protected static function addTimeAndMemoryHeader(){$time=number_format((microtime(TRUE)-MvcCore::GetMicrotime())*1000,1,'.',' ');$ram=function_exists('memory_get_peak_usage')?number_format(memory_get_peak_usage()/1000000,2,'.',' '):'n/a';header("X-MvcCore-Cpu-Ram: $time ms, $ram MB");}public static function Redirect($location='',$code=303){$codes=array(301=>'Moved Permanently',303=>'See Other',404=>'Not Found',);$status=isset($codes[$code])?' '.$codes[$code]:'';header("HTTP/1.0 $code $status");header("Location: $location");MvcCore::Terminate();}public function Terminate(){MvcCore::Terminate();}protected function redirectToNotFound(){if($this->checkIfDefaultNotFoundControllerActionExists()){self::Redirect($this->url('Default::NotFound'),404);}else{$this->renderNotFoundPlainText();}}protected function renderNotFound(){if($this->checkIfDefaultNotFoundControllerActionExists()){if(!($this->view instanceof MvcCore_View))$this->view=new MvcCore_View($this);$this->Render('default','not-found');}else{$this->renderNotFoundPlainText();}}protected function checkIfDefaultNotFoundControllerActionExists(){$controllerName='App_Controllers_Default';return(bool)class_exists($controllerName)&&method_exists($controllerName,'NotFoundAction');}protected function renderNotFoundPlainText(){header('HTTP/1.0 404 Not Found');header('Content-Type: text/plain');echo 'Error 404 â€“ Page Not Found.';$this->Terminate();}}
class App_Views_Helpers_Assets{const GROUP_NAME_DEFAULT='default';const FILE_MODIFICATION_DATE_FORMAT='Y-m-d_H-i-s';protected$view;protected$actualGroupName='';protected$streamWrapper='';protected static$globalOptions=array('jsJoin'=>0,'jsMinify'=>0,'cssJoin'=>0,'cssMinify'=>0,'tmpDir'=>'/Var/Tmp','fileChecking'=>'filemtime',);protected static$appRoot='';protected static$tmpDir='';protected static$basePath=NULL;protected static$logingAndExceptions=TRUE;protected static$fileCheckingAndRendering=TRUE;protected static$assetUrlCompletion=FALSE;protected static$systemConfigHash='';public function __construct($view){$this->view=$view;$request=$this->view->GetController()->GetRequest();self::$appRoot=$request->appRoot;if(is_null(self::$basePath))self::$basePath=$request->basePath;self::$logingAndExceptions=MvcCore::GetEnvironment()=='development';$mvcCoreCompiledMode=MvcCore::GetCompiled();self::$fileCheckingAndRendering=substr($mvcCoreCompiledMode,0,3)!='PHP'&&$mvcCoreCompiledMode!='PHAR';self::$systemConfigHash=md5(json_encode(self::$globalOptions));if($mvcCoreCompiledMode&&substr($mvcCoreCompiledMode,0,12)!='PHP_PRESERVE'&&$mvcCoreCompiledMode!='PHP_STRICT_HDD'){self::$assetUrlCompletion=TRUE;}}public static function SetBasePath($basePath){self::$basePath=$basePath;}public static function SetGlobalOptions($options=array()){foreach($options as$key=>$value){self::$globalOptions[$key]=$value;}}protected static function getFileImprint($fullPath){$fileChecking=self::$globalOptions['fileChecking'];if($fileChecking=='filemtime'){return Packager_Php_Wrapper::Filemtime($fullPath);}else{return(string)call_user_func($fileChecking,$fullPath);}}public function AssetUrl($path=''){$result='';if(self::$assetUrlCompletion){$result=$this->view->AssetUrl($path);}else{$result=self::$basePath.$path;}return$result;}protected function filterItemsForNotPossibleMinifiedAndPossibleMinifiedItems($items){$itemsToRenderMinimized=array();$itemsToRenderSeparately=array();foreach($items as$item){$itemArr=array_merge((array)$item,array());unset($itemArr['path']);if(isset($itemArr['render']))unset($itemArr['render']);if(isset($itemArr['external']))unset($itemArr['external']);$renderArrayKey=md5(json_encode($itemArr));if($itemArr['doNotMinify']){if(isset($itemsToRenderSeparately[$renderArrayKey])){$itemsToRenderSeparately[$renderArrayKey][]=$item;}else{$itemsToRenderSeparately[$renderArrayKey]=array($item);}}else{if(isset($itemsToRenderMinimized[$renderArrayKey])){$itemsToRenderMinimized[$renderArrayKey][]=$item;}else{$itemsToRenderMinimized[$renderArrayKey]=array($item);}}}return array($itemsToRenderMinimized,$itemsToRenderSeparately,);}protected function addFileModificationTimeToHrefUrl($url,$path){$questionMarkPos=strpos($url,'?');$separator=($questionMarkPos===FALSE)?'?':'&';$strippedUrl=$questionMarkPos!==FALSE?substr($url,$questionMarkPos):$url;$srcPath=$this->getAppRoot().substr($strippedUrl,strlen(self::$basePath));$fileMTime=intval(Packager_Php_Wrapper::Filemtime($srcPath));$url.=$separator.'_fmt='.date(self::FILE_MODIFICATION_DATE_FORMAT,$fileMTime);return$url;}protected function getIndentString($indent=0){$indentStr='';if(is_numeric($indent)){$indInt=intval($indent);if($indInt>0){$i=0;while($i<$indInt){$indentStr.="\t";$i+=1;}}}else if(is_string($indent)){$indentStr=$indent;}return$indentStr;}protected function getAppRoot(){return self::$appRoot;}protected function getTmpDir(){if(!self::$tmpDir){$tmpDir=$this->getAppRoot().self::$globalOptions['tmpDir'];if(!MvcCore::GetCompiled()){if(!is_dir($tmpDir))mkdir($tmpDir,0777,TRUE);if(!is_writable($tmpDir)){try{@chmod($tmpDir,0777);}catch(Exception$e){throw new Exception('[App_Views_Helpers_Assets] '.$e->getMessage());}}}self::$tmpDir=$tmpDir;}return self::$tmpDir;}protected function saveFileContent($fullPath='',&$fileContent=''){$streamWrapper='';$netteSafeStreamClass='Nette_Utils_SafeStream';$netteSafeStreamExists=class_exists($netteSafeStreamClass);if(self::$fileCheckingAndRendering){if($netteSafeStreamExists){$netteSafeStreamProtocol=constant($netteSafeStreamClass.'::PROTOCOL');(new ReflectionMethod($netteSafeStreamClass,'register'))->invoke(NULL);$streamWrapper=$netteSafeStreamProtocol.'://';}}$fw=fopen($streamWrapper.$fullPath,'w');$index=0;$bufferLength=1048576;$buffer='';while($buffer=mb_substr($fileContent,$index,$bufferLength)){fwrite($fw,$buffer);$index+=$bufferLength;}fclose($fw);@chmod($fullPath,0766);if(self::$fileCheckingAndRendering){if($netteSafeStreamExists)stream_wrapper_unregister($netteSafeStreamProtocol);}}protected function log($msg='',$logType='debug'){if(self::$logingAndExceptions){if(class_exists('Debug')){Debug::log('['.get_class($this).'] '.$msg,$logType);}else{var_dump($msg);}}}protected function exception($msg){if(self::$logingAndExceptions){throw new Exception('['.get_class($this).'] '.$msg);}}protected function exceptionHandler($e){if(self::$logingAndExceptions){if(class_exists('Debug')){Debug::_exceptionHandler($e);}else{throw$e;}}}protected function getTmpFileFullPathByPartFilesInfo($filesGroupInfo=array(),$minify=FALSE,$extension=''){return implode('',array($this->getTmpDir(),'/'.($minify?'minified':'rendered').'_'.$extension.'_',md5(implode(',',$filesGroupInfo).'_'.$minify),'.'.$extension));}}
class MvcCore_View{const EXTENSION='.phtml';public$Controller;private$_content='';private$_renderedFullPaths=array();private static$_helpersClassBase='App_Views_Helpers_';private static$_originalyDeclaredProperties=array('Controller'=>1,'_content'=>1,'_renderedFullPaths'=>1,);private static$_helpers=array();public function __construct(MvcCore_Controller&$controller){$this->Controller=$controller;}public function SetUp(&$paramsInstance){$params=get_object_vars($paramsInstance);foreach($params as$key=>$value){$this->$key=$value;}}public function GetContent(){return$this->_content;}public function GetController(){return$this->Controller;}public function RenderLayout($relativePath='',$content=''){$this->_content=$content;return$this->Render('Layouts',$relativePath);}public function RenderScript($relativePath=''){return$this->Render('Scripts',$relativePath);}public function Render($typePath='Scripts',$relativePath=''){$result='';$appRoot=$this->Controller->GetRequest()->appRoot;$relativePath=$this->_correctRelativePath($appRoot,$typePath,$relativePath);$viewScriptFullPath=implode('/',array($appRoot,'App','Views',$typePath,$relativePath.MvcCore_View::EXTENSION));if(!Packager_Php_Wrapper::FileExists($viewScriptFullPath)){throw new Exception("[MvcCore_View] Template not found in path: '$viewScriptFullPath'.");}$this->_renderedFullPaths[]=$viewScriptFullPath;ob_start();Packager_Php_Wrapper::IncludeStandard(($viewScriptFullPath),$this);$result=ob_get_clean();array_pop($this->_renderedFullPaths);return$result;}public function Evaluate($content=''){ob_start();try{eval(' ?'.'>'.$content.'<'.'?php ');}catch(Exception$e){throw$e;}return ob_get_clean();}public function Url($controllerAction='',$params=array()){return$this->Controller->Url($controllerAction,$params);}public function AssetUrl($path=''){return$this->Controller->AssetUrl($path);}public function __set($name,$value){if(isset(self::$_originalyDeclaredProperties[$name])){throw new Exception("[MvcCore_View] It's not possible to change property: '$name' originaly declared in class MvcCore_View.");}$this->$name=$value;}public function __call($method,$arguments){$result='';$className=self::$_helpersClassBase.ucfirst($method);if(isset(self::$_helpers[$method])&&get_class(self::$_helpers[$method])==$className){$instance=self::$_helpers[$method];$result=call_user_func_array(array($instance,$method),$arguments);}else{$instance=new$className($this);$result=call_user_func_array(array($instance,$method),$arguments);}return$result;}private function _correctRelativePath($appRoot,$typePath,$relativePath){$result=str_replace('\\','/',$relativePath);if(substr($relativePath,0,2)=='./'){$typedViewDirFullPath=implode('/',array($appRoot,'App','Views',$typePath));$lastRenderedFullPath=$this->_renderedFullPaths[count($this->_renderedFullPaths)-1];$renderedRelPath=substr($lastRenderedFullPath,strlen($typedViewDirFullPath));$renderedRelPathLastSlashPos=strrpos($renderedRelPath,'/');if($renderedRelPathLastSlashPos!==FALSE){$result=substr($renderedRelPath,0,$renderedRelPathLastSlashPos+1).substr($relativePath,2);$result=ltrim($result,'/');}}return$result;}}
class MvcCore{private static$_compiled=null;private static$_instance;private static$_routes=array();private static$_currentRoute=array();private static$_preRequestHandler=array(NULL,NULL);private static$_environment='';private static$_microtime=0;private$_controller;private$_request;public static function Run($singleFileUrl=FALSE){self::$_microtime=microtime(TRUE);if($singleFileUrl)self::$_compiled='SFU';self::$_instance=new self();self::$_instance->_process();}public static function GetEnvironment(){if(!self::$_environment){$serverAddress=isset($_SERVER['SERVER_ADDR'])?$_SERVER['SERVER_ADDR']:$_SERVER['LOCAL_ADDR'];$remoteAddress=$_SERVER['REMOTE_ADDR'];if($serverAddress==$remoteAddress){self::$_environment='development';}else{self::$_environment='production';}}return self::$_environment;}public static function SetEnvironment($environment='production'){self::$_environment=$environment;}public static function SetRoutes($routes=array()){foreach($routes as$key=>$values){$route=(object)$values;$route->name=$key;if(strpos($key,'::')!==FALSE){$contAndAct=explode('::',$key);$route->controller=$contAndAct[0]?$contAndAct[0]:'Default';$route->action=$contAndAct[1]?$contAndAct[1]:'Default';if(!isset($route->params))$route->params=array();}self::$_routes[$key]=$route;}}public static function GetMicrotime(){return self::$_microtime;}public static function&GetCurrentRoute(){return self::$_currentRoute;}public static function SetPreRouteRequestHandler($handler=null){self::$_preRequestHandler[0]=$handler;}public static function SetPreDispatchRequestHandler($handler=null){self::$_preRequestHandler[1]=$handler;}public static function GetCompiled(){return self::$_compiled;}public static function&GetInstance(){return self::$_instance;}public static function&GetController(){return self::$_instance->_controller;}public static function&GetRequest(){return self::$_instance->_request;}public static function DecodeJson(&$jsonStr){$result=(object)array('success'=>TRUE,'data'=>null,);$jsonData=json_decode($jsonStr);if(json_last_error()==JSON_ERROR_NONE){$result->data=$jsonData;}else{$result->success=FALSE;}return$result;}public static function Init(){if(is_null(self::$_compiled)){$compiled='';if(strpos(str_replace('\\','/',__DIR__).'/Libs/MvcCore.php','phar://')===0){$compiled='PHAR';}else if(class_exists('Packager_Php_Wrapper')){$compiled=Packager_Php_Wrapper::FS_MODE;}self::$_compiled=$compiled;}}public static function SessionStart(){$sessionNotStarted=function_exists('session_status')?session_status()==PHP_SESSION_NONE:session_id()=='';if($sessionNotStarted){if(class_exists('Zend_Session')){Zend_Session::start();}else{session_start();}}}public static function Terminate(){if(class_exists('Zend_Session')){if(Zend_Session::isStarted())Zend_Session::writeClose();}else{@session_write_close();}exit;}private static function _completePostData(){$result=array();$rawPhpInput=Packager_Php_Wrapper::FileGetContents('php://input');$decodedJsonResult=self::DecodeJson($rawPhpInput);if($decodedJsonResult->success){$result=(array)$decodedJsonResult->data;}else{$rows=explode('&',$rawPhpInput);foreach($rows as$row){list($key,$value)=explode('=',$row);$result[$key]=$value;}}return$result;}public function Url($routeName='Default::Default',$params=array()){$result='';if($routeName=='self'){$routeName=self::GetCurrentRoute()->name;if(!$params){$params=array_merge(array(),$this->_request->params);unset($params['controller'],$params['action']);}}if(!isset(self::$_routes[$routeName])){list($contollerPascalCase,$actionPascalCase)=explode('::',$routeName);$controllerDashed=self::GetDashedFromPascalCase($contollerPascalCase);$actionDashed=self::GetDashedFromPascalCase($actionPascalCase);$scriptName=$this->_request->scriptName;$result=$scriptName."?controller=$controllerDashed&action=$actionDashed";if($params)$result.="&".http_build_query($params,"","&");}else{$route=(object)self::$_routes[$routeName];$result=$this->_request->basePath.rtrim($route->reverse,'?&');$allParams=array_merge($route->params,$params);foreach($allParams as$key=>$value){$paramKeyReplacement="{%$key}";if(mb_strpos($result,$paramKeyReplacement)===FALSE){$glue=(mb_strpos($result,'?')===FALSE)?'?':'&';$result.="$glue$key=$value";}else{$result=str_replace($paramKeyReplacement,$value,$result);}}}return$result;}private function _process(){$this->_setUpRequest();$this->_callPreRequestHandler(0);$this->_routeRequest();$this->_callPreRequestHandler(1);$this->_dispatchMvcRequest();}private function _setUpRequest(){$requestDefault=array('scheme'=>'','host'=>'','port'=>'','path'=>'','query'=>'','fragment'=>'','scriptName'=>'','appRoot'=>'','method'=>strtoupper($_SERVER['REQUEST_METHOD']),'params'=>array(),);$indexScriptName=str_replace('\\','/',$_SERVER['SCRIPT_NAME']);$lastSlashPos=mb_strrpos($indexScriptName,'/');if($lastSlashPos!==false){$basePath=mb_substr($indexScriptName,0,$lastSlashPos);}else{$basePath='';}$protocol=(isset($_SERVER['HTTPS'])&&strtolower($_SERVER['HTTPS'])=='on')?'https:':'http:';$requestUrl=$_SERVER['REQUEST_URI'];$absoluteUrl=$protocol.'//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];$parsedUrl=parse_url($absoluteUrl);$requestArr=array_merge($requestDefault,$parsedUrl);$params=array_merge($_GET);if(strtoupper($_SERVER['REQUEST_METHOD'])=='POST')$params=array_merge($params,count($_POST)>0?$_POST:self::_completePostData());$requestArr['params']=$params;$appRootRelativePath=mb_substr($indexScriptName,0,strrpos($indexScriptName,'/')+1);$indexFilePath=ucfirst(str_replace('\\','/',$_SERVER['SCRIPT_FILENAME']));if(strpos(str_replace('\\','/',__DIR__).'/Libs/MvcCore.php','phar://')===0){$appRootFullPath='phar://'.$indexFilePath;}else{$appRootFullPath=substr($indexFilePath,0,mb_strrpos($indexFilePath,'/'));}$requestArr['scriptName']=substr($indexScriptName,strrpos($indexScriptName,'/')+1);$requestArr['appRoot']=str_replace('\\','/',$appRootFullPath);$requestArr['basePath']=$basePath;$path='/'.mb_substr($requestUrl,mb_strlen($appRootRelativePath));if(mb_strpos($path,'?')!==FALSE)$path=mb_substr($path,0,mb_strpos($path,'?'));$requestArr['path']=$path;$this->_request=(object)$requestArr;}private function _routeRequest(){$chars="a-zA-Z0-9\-_";$controllerName=$this->_routeRequestCompleteParam('controller',$chars);$actionName=$this->_routeRequestCompleteParam('action',$chars);if($controllerName&&$actionName){$this->_routeRequestByControllerAndActionQueryString($controllerName,$actionName);}else{$this->_routeRequestByRewriteRoutes();}$requestParams=&$this->_request->params;foreach(array('controller','action')as$mvcProperty){if(!isset($requestParams[$mvcProperty])||(isset($requestParams[$mvcProperty])&&strlen($requestParams[$mvcProperty])===0)){$requestParams[$mvcProperty]='default';}}if(!self::$_currentRoute){self::$_currentRoute=(object)array('name'=>"Default::Default",'controller'=>"Default",'action'=>"Default",);}}private function _routeRequestCompleteParam($name="",$pregReplaceAllowedChars="a-zA-Z0-9\-"){$result='';$params=$this->_request->params;if(isset($params[$name])){$rawValue=trim($params[$name]);if(mb_strlen($rawValue)>0){$pattern="#[^".$pregReplaceAllowedChars."]#";$result=preg_replace($pattern,"",$rawValue);}}return$result;}private function _routeRequestByControllerAndActionQueryString($controllerName,$actionName){list($controllerDashed,$controllerPascalCase)=self::_completeControllerActionParam($controllerName);list($actionDashed,$actionPascalCase)=self::_completeControllerActionParam($actionName);self::$_currentRoute=(object)array('name'=>"$controllerPascalCase::$actionPascalCase",'controller'=>$controllerPascalCase,'action'=>$actionPascalCase,);$this->_request->params['controller']=$controllerDashed;$this->_request->params['action']=$actionDashed;}private function _routeRequestByRewriteRoutes(){$requestPath=$this->_request->path;foreach(self::$_routes as$routeName=>$route){preg_match_all($route->pattern,$requestPath,$patternMatches);if(count($patternMatches)>0&&count($patternMatches[0])>0){self::$_currentRoute=$route;$routeParams=array('controller'=>self::GetDashedFromPascalCase(isset($route->controller)?$route->controller:''),'action'=>self::GetDashedFromPascalCase(isset($route->action)?$route->action:''),);preg_match_all("#{%([a-zA-Z0-9]*)}#",$route->reverse,$reverseMatches);if(isset($reverseMatches[1])&&$reverseMatches[1]){$reverseMatchesNames=$reverseMatches[1];array_shift($patternMatches);foreach($reverseMatchesNames as$key=>$reverseKey){if(isset($patternMatches[$key])&&count($patternMatches[$key])){$routeParams[$reverseKey]=$patternMatches[$key][0];}else{break;}}}$routeDefaultParams=isset($route->params)?$route->params:array();$this->_request->params=array_merge($routeDefaultParams,$this->_request->params,$routeParams);break;}}}private function _dispatchMvcRequest(){list($controllerNamePascalCase,$actionNamePascalCase)=array(self::$_currentRoute->controller,self::$_currentRoute->action);$actionName=$actionNamePascalCase.'Action';if($controllerNamePascalCase=='Controller'){$controllerClass='MvcCore_Controller';}else{$controllerClass='App_Controllers_'.$controllerNamePascalCase;$controllerFullPath=implode('/',array($this->_request->appRoot,str_replace('_','/',$controllerClass).'.php'));if(!self::$_compiled&&!Packager_Php_Wrapper::FileExists($controllerFullPath)){return self::_dispatchException(new Exception("[MvcCore] Controller file '$controllerFullPath' not found."));}}try{$this->_controller=new$controllerClass($this->_request);}catch(Exception$e){return self::_dispatchException($e);}if(!method_exists($this->_controller,$actionName)){return self::_dispatchException(new Exception("[MvcCore] Controller '$controllerClass' has not method '$actionName'."));}list($controllerNameDashed,$actionNameDashed)=array($this->_request->params['controller'],$this->_request->params['action']);try{$this->_controller->PreDispatch();$this->_controller->$actionName();$this->_controller->Render($controllerNameDashed,$actionNameDashed);}catch(Exception$e){self::_dispatchException($e);}}public static function GetDashedFromPascalCase($pascalCase=''){return strtolower(preg_replace("#([A-Z])#","-$1",lcfirst($pascalCase)));}public static function GetPascalCaseFromDashed($dashed=''){return ucfirst(str_replace('-','',ucwords($dashed,'-')));}private function _callPreRequestHandler($index=0){$handler=MvcCore::$_preRequestHandler[$index];if($handler instanceof Closure){try{$handler($this->_request);}catch(exception$e){self::_dispatchException($e);}}}private static function _dispatchException($e){if(class_exists('Packager_Php'))return;$production=MvcCore::GetEnvironment()=='production';if(class_exists('Debug')){if($production){Debug::log($e);self::_renderError($e->getMessage());}else{Debug::_exceptionHandler($e);}}else{if($production){self::_renderError($e->getMessage());}else{throw$e;}}exit;}private static function _renderError($exceptionMessage=''){if(self::_checkIfDefaultErrorControllerActionExists()){$ctrl=new App_Controllers_Default(self::$_instance->_request);try{$ctrl->PreDispatch();$ctrl->ErrorAction();$ctrl->Render('default','error');}catch(Exception$e){if(class_exists('Debug')){Debug::_exceptionHandler($e);}self::_renderErrorPlainText($exceptionMessage.PHP_EOL.$e->getMessage());}}else{self::_renderErrorPlainText($exceptionMessage);}}private static function _checkIfDefaultErrorControllerActionExists(){$controllerName='App_Controllers_Default';return(bool)class_exists($controllerName)&&method_exists($controllerName,'ErrorAction');}private static function _renderErrorPlainText($text=''){header('HTTP/1.0 500 Internal Server Error');header('Content-Type: text/plain');if(!$text)$text='Internal Server Error.';echo "Error 500 - $text";self::Terminate();}private static function _completeControllerActionParam($dashed=''){$pascalCase='';$dashed=strlen($dashed)>0?strtolower($dashed):'default';$pascalCase=preg_replace_callback("#(\-[a-z])#",function($m){return strtoupper(substr($m[0],1));},$dashed);$pascalCase=preg_replace_callback("#(_[a-z])#",function($m){return strtoupper($m[0]);},$pascalCase);$pascalCase=ucfirst($pascalCase);return array($dashed,$pascalCase);}}MvcCore::Init();
class App_Views_Helpers_JsonAttr{public function __construct(){if(!defined('JSON_UNESCAPED_SLASHES'))define('JSON_UNESCAPED_SLASHES',64);if(!defined('JSON_UNESCAPED_UNICODE'))define('JSON_UNESCAPED_UNICODE',256);}public function JsonAttr($object=NULL){return rawurlencode(json_encode($object,JSON_HEX_TAG|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP));}}
class App_Controllers_Base extends MvcCore_Controller{protected static$staticPath='/static/';protected static$tmpPath='/Var/Tmp';public function PreDispatch(){parent::PreDispatch();if(!$this->ajax&&$this->request->params['controller']!=='assets'){App_Views_Helpers_Assets::SetGlobalOptions(array('cssMinify'=>1,'cssJoin'=>1,'jsMinify'=>1,'jsJoin'=>1,'tmpDir'=>self::$tmpPath,));$this->view->Css('fixedHead')->AppendRendered(self::$staticPath.'css/all.css');$this->view->Js('fixedHead')->Append(self::$staticPath.'js/libs/class.min.js')->Append(self::$staticPath.'js/libs/ajax.min.js')->Append(self::$staticPath.'js/libs/Module.js');$this->view->Js('varFoot')->Append(self::$staticPath.'js/Front.js');}}protected function redirectToNotFound(){self::Redirect($this->url('Default::NotFound'),404);}}
class App_Views_Helpers_Js extends App_Views_Helpers_Assets{const EXTERNAL_MIN_CACHE_TIME=86400;protected static$scriptsGroupContainer=array();public function Js($groupName=self::GROUP_NAME_DEFAULT){$this->actualGroupName=$groupName;if(!isset(self::$scriptsGroupContainer[$groupName])){self::$scriptsGroupContainer[$groupName]=array();}return$this;}public function Contains($path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE){$result=FALSE;if(!isset(self::$scriptsGroupContainer[$this->actualGroupName])){self::$scriptsGroupContainer[$this->actualGroupName]=array();}else{$linksGroup=self::$scriptsGroupContainer[$this->actualGroupName];foreach($linksGroup as$item){if($item->path==$path){if($item->async==$async&&$item->defer==$defer&&$item->doNotMinify==$doNotMinify){$result=TRUE;break;}}}}return$result;}public function AppendExternal($path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE){return$this->Append($path,$async,$defer,$doNotMinify,TRUE);}public function PrependExternal($path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE){return$this->Prepend($path,$async,$defer,$doNotMinify,TRUE);}public function OffsetExternal($index=0,$path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE){return$this->Offset($index,$path,$async,$defer,$doNotMinify,TRUE);}public function Append($path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE,$external=FALSE){$item=$this->_completeItem($path,$async,$defer,$doNotMinify,$external);self::$scriptsGroupContainer[$this->actualGroupName][]=$item;return$this;}public function Prepend($path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE,$external=FALSE){$item=$this->_completeItem($path,$async,$defer,$doNotMinify,$external);array_unshift(self::$scriptsGroupContainer[$this->actualGroupName],$item);return$this;}public function Offset($index=0,$path='',$async=FALSE,$defer=FALSE,$doNotMinify=FALSE,$external=FALSE){$item=$this->_completeItem($path,$async,$defer,$doNotMinify,$external);$groupItems=self::$scriptsGroupContainer[$this->actualGroupName];$newItems=array();$added=FALSE;foreach($groupItems as$key=>$groupItem){if($key==$index){$newItems[]=$item;$added=TRUE;}$newItems[]=$groupItem;}if(!$added)$newItems[]=$item;self::$scriptsGroupContainer[$this->actualGroupName]=$newItems;return$this;}private function _completeItem($path,$async,$defer,$doNotMinify,$external){if(self::$logingAndExceptions){if(!$path)$this->exception('Path to *.js can\'t be an empty string.');$duplication=$this->_isDuplicateScript($path);if($duplication)$this->exception("Script '$path' is already added in js group: '$duplication'.");}return(object)array('path'=>$path,'async'=>$async,'defer'=>$defer,'doNotMinify'=>$doNotMinify,'external'=>$external,);}private function _isDuplicateScript($path){$result='';foreach(self::$scriptsGroupContainer as$groupName=>$groupItems){foreach($groupItems as$item){if($item->path==$path){$result=$groupName;break;}}}return$result;}public function Render($indent=0){if(count(self::$scriptsGroupContainer[$this->actualGroupName])===0)return'';$minify=(bool)self::$globalOptions['jsMinify'];$joinTogether=(bool)self::$globalOptions['jsJoin'];if($joinTogether){$result=$this->_renderItemsTogether($this->actualGroupName,self::$scriptsGroupContainer[$this->actualGroupName],$indent,$minify);}else{$result=$this->_renderItemsSeparated($this->actualGroupName,self::$scriptsGroupContainer[$this->actualGroupName],$indent,$minify);}return$result;}private function _renderItemsSeparated($actualGroupName='',$items=array(),$indent=0,$minify=FALSE){$indentStr=$this->getIndentString($indent);$resultItems=array();if(self::$fileCheckingAndRendering)$resultItems[]='<!-- js group begin: '.$actualGroupName.' -->';$appCompilation=MvcCore::GetCompiled();foreach($items as$item){if($item->external){$item->src=$this->AssetUrl($this->_downloadFileToTmpAndGetNewHref($item,$minify));}else if($minify&&!$item->doNotMinify){$item->src=$this->AssetUrl($this->_renderFileToTmpAndGetNewHref($item,$minify));}else{$item->src=$this->AssetUrl($item->path);}if(!$appCompilation){if($item->external){$tmpOrSrcPath=substr($item->src,strlen(self::$basePath));}else{$tmpOrSrcPath=$item->src;}$item->src=$this->addFileModificationTimeToHrefUrl($item->src,$item->path);}$resultItems[]=$this->_renderItemSeparated($item);}if(self::$fileCheckingAndRendering)$resultItems[]='<!-- js group end: '.$actualGroupName.' -->';return$indentStr.implode(PHP_EOL.$indentStr,$resultItems);}private function _renderFileToTmpAndGetNewHref($item,$minify=FALSE){$path=$item->path;$tmpFileName='/rendered_js_'.self::$systemConfigHash.'_'.trim(str_replace('/','_',$path),"_");$srcFileFullPath=$this->getAppRoot().$path;$tmpFileFullPath=$this->getTmpDir().$tmpFileName;if(self::$fileCheckingAndRendering){if(Packager_Php_Wrapper::FileExists($srcFileFullPath)){$srcFileModDate=Packager_Php_Wrapper::Filemtime($srcFileFullPath);}else{$srcFileModDate=1;}if(Packager_Php_Wrapper::FileExists($tmpFileFullPath)){$tmpFileModDate=Packager_Php_Wrapper::Filemtime($tmpFileFullPath);}else{$tmpFileModDate=0;}if($srcFileModDate!==FALSE&&$tmpFileModDate!==FALSE){if($srcFileModDate>$tmpFileModDate){$fileContent=Packager_Php_Wrapper::FileGetContents($srcFileFullPath);if($minify){$fileContent=$this->_minify($fileContent,$path);}$this->saveFileContent($tmpFileFullPath,$fileContent);$this->log("Js file rendered ('$tmpFileFullPath').",'debug');}}}$tmpPath=substr($tmpFileFullPath,strlen($this->getAppRoot()));return$tmpPath;}private function _downloadFileToTmpAndGetNewHref($item,$minify=FALSE){$path=$item->path;$tmpFileFullPath=$this->getTmpDir().'/external_js_'.md5($path).'.js';if(self::$fileCheckingAndRendering){if(Packager_Php_Wrapper::FileExists($tmpFileFullPath)){$cacheFileTime=Packager_Php_Wrapper::Filemtime($tmpFileFullPath);}else{$cacheFileTime=0;}if(time()>$cacheFileTime+self::EXTERNAL_MIN_CACHE_TIME){while(TRUE){$newPath=$this->_getPossiblyRedirectedPath($path);if($newPath===$path){break;}else{$path=$newPath;}}$fr=fopen($path,'r');$fileContent='';$bufferLength=102400;$buffer='';while($buffer=fread($fr,$bufferLength)){$fileContent.=$buffer;}fclose($fr);if($minify){$fileContent=$this->_minify($fileContent,$path);}$this->saveFileContent($tmpFileFullPath,$fileContent);$this->log("External js file downloaded ('$tmpFileFullPath').",'debug');}}$tmpPath=substr($tmpFileFullPath,strlen($this->getAppRoot()));return$tmpPath;}private function _getPossiblyRedirectedPath($path=''){$fp=fopen($path,'r');$metaData=stream_get_meta_data($fp);foreach($metaData['wrapper_data']as$response){if(strtolower(substr($response,0,10))=='location: '){$path=substr($response,10);}}return$path;}private function _renderItemSeparated(stdClass$item){$result='<script type="text/javascript"';if($item->async)$result.=' async="async"';if($item->async)$result.=' defer="defer"';if(!$item->external&&self::$fileCheckingAndRendering){$fullPath=$this->getAppRoot().$item->path;if(!Packager_Php_Wrapper::FileExists($fullPath)){$this->log("File not found in CSS view rendering process ('$fullPath').",'error');}}$result.=' src="'.$item->src.'"></script>';return$result;}private function _minify(&$js,$path){$result='';if(!class_exists('JSMin')){$this->exception("Class 'JSMin' doesn't exist, place library from 'http://code.google.com/p/jsmin-php/' into '/Libs/JSMin.php'.");}try{$result=JSMin::minify($js);}catch(Exception$e){$this->exception("Unable to minify javascript ('$path').");}return$result;}private function _renderItemsTogether($actualGroupName='',$items=array(),$indent,$minify=FALSE){$appCompilation=MvcCore::GetCompiled();list($itemsToRenderMinimized,$itemsToRenderSeparately)=$this->filterItemsForNotPossibleMinifiedAndPossibleMinifiedItems($items);$indentStr=$this->getIndentString($indent);$resultItems=array();if(self::$fileCheckingAndRendering)$resultItems[]='<!-- js group begin: '.$actualGroupName.' -->';foreach($itemsToRenderSeparately as$attrHashKey=>$itemsToRender){foreach($itemsToRender as$item){if($item->external){$item->src=$this->AssetUrl($this->_downloadFileToTmpAndGetNewHref($item,$minify));}else if($minify&&!$item->doNotMinify){$item->src=$this->AssetUrl($this->_renderFileToTmpAndGetNewHref($item,$minify));}else{$item->src=$this->AssetUrl($item->path);}if(!$appCompilation){if($item->external){$tmpOrSrcPath=substr($item->src,strlen(self::$basePath));}else{$tmpOrSrcPath=$item->src;}$item->src=$this->addFileModificationTimeToHrefUrl($tmpOrSrcPath,$item->path);}$resultItems[]=$this->_renderItemSeparated($item);}}foreach($itemsToRenderMinimized as$attrHashKey=>$itemsToRender){$resultItems[]=$this->_renderItemsTogetherAsGroup($itemsToRender,$minify);}if(self::$fileCheckingAndRendering)$resultItems[]=$indentStr.'<!-- js group end: '.$actualGroupName.' -->';return$indentStr.implode(PHP_EOL,$resultItems);}private function _renderItemsTogetherAsGroup($itemsToRender=array(),$minify=FALSE){$filesGroupInfo=array();foreach($itemsToRender as$item){if($item->external){$srcFileFullPath=$this->_downloadFileToTmpAndGetNewHref($item,$minify);$filesGroupInfo[]=$item->path.'?_'.self::getFileImprint($this->getAppRoot().$srcFileFullPath);}else{$fullPath=$this->getAppRoot().$item->path;$filesGroupInfo[]=$item->path.'?_'.self::getFileImprint($fullPath);if(self::$fileCheckingAndRendering&&!MvcCore::GetCompiled()){if(!Packager_Php_Wrapper::FileExists($fullPath)){$this->exception("File not found in JS view rendering process ('$fullPath').");}}}}$tmpFileFullPath=$this->getTmpFileFullPathByPartFilesInfo($filesGroupInfo,$minify,'js');if(self::$fileCheckingAndRendering){if(!Packager_Php_Wrapper::FileExists($tmpFileFullPath)){$resultContent='';foreach($itemsToRender as$hashKey=>$item){$srcFileFullPath=$this->getAppRoot().$item->path;if($item->external){$srcFileFullPath=$this->_downloadFileToTmpAndGetNewHref($item,$minify);$fileContent=Packager_Php_Wrapper::FileGetContents($this->getAppRoot().$srcFileFullPath);}else if($minify){$fileContent=Packager_Php_Wrapper::FileGetContents($srcFileFullPath);if($minify)$fileContent=$this->_minify($fileContent,$item->path);}else{$fileContent=Packager_Php_Wrapper::FileGetContents($srcFileFullPath);}$resultContent.=PHP_EOL."/* ".$item->path." */".PHP_EOL.$fileContent.PHP_EOL;}$this->saveFileContent($tmpFileFullPath,$resultContent);$this->log("Js files group rendered ('$tmpFileFullPath').",'debug');}}$firstItem=array_merge((array)$itemsToRender[0],array());$pathToTmp=substr($tmpFileFullPath,strlen($this->getAppRoot()));$firstItem['src']=$this->AssetUrl($pathToTmp);return$this->_renderItemSeparated((object)$firstItem);}}
class App_Views_Helpers_Css extends App_Views_Helpers_Assets{private static$_allowedMediaTypes=array('all','aural','braille','handheld','projection','print','screen','tty','tv',);protected static$linksGroupContainer=array();public function Css($groupName=self::GROUP_NAME_DEFAULT){$this->actualGroupName=$groupName;if(!isset(self::$linksGroupContainer[$groupName])){self::$linksGroupContainer[$groupName]=array();}return$this;}public function Contains($path='',$media='all',$doNotMinify=FALSE){$result=FALSE;if(!isset(self::$linksGroupContainer[$this->actualGroupName])){self::$linksGroupContainer[$this->actualGroupName]=array();}else{$linksGroup=self::$linksGroupContainer[$this->actualGroupName];foreach($linksGroup as$item){if($item->path==$path){if($item->media==$media&&$item->doNotMinify==$doNotMinify){$result=TRUE;break;}}}}return$result;}public function AppendRendered($path='',$media='all',$doNotMinify=FALSE){return$this->Append($path,$media,TRUE,$doNotMinify);}public function PrependRendered($path='',$media='all',$doNotMinify=FALSE){return$this->Prepend($path,$media,TRUE,$doNotMinify);}public function OffsetSetRendered($index=0,$path='',$media='all',$doNotMinify=FALSE){return$this->OffsetSet($index,$path,$media,TRUE,$doNotMinify);}public function Append($path='',$media='all',$renderPhpTags=FALSE,$doNotMinify=FALSE){$item=$this->_completeItem($path,$media,$renderPhpTags,$doNotMinify);self::$linksGroupContainer[$this->actualGroupName][]=$item;return$this;}public function Prepend($path='',$media='all',$renderPhpTags=FALSE,$doNotMinify=FALSE){$item=$this->_completeItem($path,$media,$renderPhpTags,$doNotMinify);array_unshift(self::$linksGroupContainer[$this->actualGroupName],$item);return$this;}public function OffsetSet($index=0,$path='',$media='all',$renderPhpTags=FALSE,$doNotMinify=FALSE){$item=$this->_completeItem($path,$media,$renderPhpTags,$doNotMinify);$groupItems=self::$linksGroupContainer[$this->actualGroupName];$newItems=array();$added=FALSE;foreach($groupItems as$key=>$groupItem){if($key==$index){$newItems[]=$item;$added=TRUE;}$newItems[]=$groupItem;}if(!$added)$newItems[]=$item;self::$linksGroupContainer[$this->actualGroupName]=$newItems;return$this;}private function _completeItem($path,$media,$render,$doNotMinify){if(self::$fileCheckingAndRendering){if(!$path)$this->exception('Path to *.css can\'t be an empty string.');if(!in_array($media,self::$_allowedMediaTypes))$this->exception('Media could be only values: '.implode(', ',self::$_allowedMediaTypes).'.');$duplication=$this->_isDuplicateStylesheet($path);if($duplication)$this->exception("Stylesheet '$path' is already added in css group: '$duplication'.");}return(object)array('path'=>$path,'media'=>$media,'render'=>$render,'doNotMinify'=>$doNotMinify,);}private function _isDuplicateStylesheet($path){$result='';foreach(self::$linksGroupContainer as$groupName=>$groupItems){foreach($groupItems as$item){if($item->path==$path){$result=$groupName;break;}}}return$result;}public function Render($indent=0){if(count(self::$linksGroupContainer[$this->actualGroupName])===0)return'';$minify=(bool)self::$globalOptions['cssMinify'];$joinTogether=(bool)self::$globalOptions['cssJoin'];if($joinTogether){$result=$this->_renderItemsTogether($this->actualGroupName,self::$linksGroupContainer[$this->actualGroupName],$indent,$minify);}else{$result=$this->_renderItemsSeparated($this->actualGroupName,self::$linksGroupContainer[$this->actualGroupName],$indent,$minify);}return$result;}private function _minify(&$css,$path){$result='';if(!class_exists('Minify_CSS')){$this->exception("Class 'Minify_CSS' doesn't exist, place library from 'https://github.com/mrclay/minify' into '/Libs/Minify/Css.php'.");}try{$result=Minify_CSS::minify($css);}catch(Exception$e){$this->exception("Unable to minify stylesheet ('$path').");}return$result;}private function _renderItemsTogether($actualGroupName='',$items=array(),$indent=0,$minify=FALSE){$appCompilation=MvcCore::GetCompiled();list($itemsToRenderMinimized,$itemsToRenderSeparately)=$this->filterItemsForNotPossibleMinifiedAndPossibleMinifiedItems($items);$indentStr=$this->getIndentString($indent);$resultItems=array();if(self::$fileCheckingAndRendering)$resultItems[]='<!-- css group begin: '.$actualGroupName.' -->';foreach($itemsToRenderSeparately as$attrHashKey=>$itemsToRender){foreach($itemsToRender as$item){if($item->render||($minify&&!$item->doNotMinify)){$item->href=$this->AssetUrl($this->_renderFileToTmpAndGetNewHref($item,$minify));}else{$item->href=$this->AssetUrl($item->path);}if(!$appCompilation){$item->href=$this->addFileModificationTimeToHrefUrl($item->href,$item->path);}$resultItems[]=$this->_renderItemSeparated($item);}}foreach($itemsToRenderMinimized as$attrHashKey=>$itemsToRender){$resultItems[]=$this->_renderItemsTogetherAsGroup($itemsToRender,$minify);}if(self::$fileCheckingAndRendering)$resultItems[]='<!-- css group end: '.$actualGroupName.' -->';return$indentStr.implode(PHP_EOL.$indentStr,$resultItems);}private function _renderItemsTogetherAsGroup($itemsToRender=array(),$minify=FALSE){$filesGroupInfo=array();foreach($itemsToRender as$item){$fullPath=$this->getAppRoot().$item->path;$filesGroupInfo[]=$item->path.'?_'.self::getFileImprint($fullPath);if(self::$fileCheckingAndRendering&&!MvcCore::GetCompiled()){if(!Packager_Php_Wrapper::FileExists($fullPath)){$this->exception("File not found in CSS view rendering process ('$fullPath').");}}}$tmpFileFullPath=$this->getTmpFileFullPathByPartFilesInfo($filesGroupInfo,$minify,'css');if(self::$fileCheckingAndRendering){if(!Packager_Php_Wrapper::FileExists($tmpFileFullPath)){$resultContent='';foreach($itemsToRender as$hashKey=>$item){$srcFileFullPath=$this->getAppRoot().$item->path;if($item->render){$fileContent=$this->_renderFile($srcFileFullPath);}else if($minify){$fileContent=Packager_Php_Wrapper::FileGetContents($srcFileFullPath);}$fileContent=$this->_convertStylesheetPathsFromRelatives2TmpAbsolutes($fileContent,$item->path);if($minify)$fileContent=$this->_minify($fileContent,$item->path);$resultContent.=PHP_EOL."/* ".$item->path." */".PHP_EOL.$fileContent.PHP_EOL;}$this->saveFileContent($tmpFileFullPath,$resultContent);$this->log("Css files group rendered ('$tmpFileFullPath').",'debug');}}$firstItem=array_merge((array)$itemsToRender[0],array());$pathToTmp=substr($tmpFileFullPath,strlen($this->getAppRoot()));$firstItem['href']=$this->AssetUrl($pathToTmp);return$this->_renderItemSeparated((object)$firstItem);}private function _renderFile($absolutePath){ob_start();try{Packager_Php_Wrapper::IncludeStandard(($absolutePath),$this);}catch(Exception$e){$this->exceptionHandler($e);}return ob_get_clean();}private function _convertStylesheetPathsFromRelatives2TmpAbsolutes(&$fullPathContent,$href){$lastHrefSlashPos=mb_strrpos($href,'/');if($lastHrefSlashPos===FALSE)return$fullPathContent;$stylesheetDirectoryRelative=mb_substr($href,0,$lastHrefSlashPos+1);$position=0;while($position<mb_strlen($fullPathContent)){$doubleDotsPos=mb_strpos($fullPathContent,'../',$position);if($doubleDotsPos===FALSE)break;$lastUrlBeginStrPos=mb_strrpos(mb_substr($fullPathContent,0,$doubleDotsPos),'url(');if($lastUrlBeginStrPos===FALSE){$position=$doubleDotsPos+3;continue;}$beginOfUrlBlockChars=mb_substr($fullPathContent,$lastUrlBeginStrPos+4,$doubleDotsPos-($lastUrlBeginStrPos+4));$beginOfUrlBlockChars=preg_replace("#[\./ \"'_\-]#","",$beginOfUrlBlockChars);if(mb_strlen($beginOfUrlBlockChars)>0){$position=$lastUrlBeginStrPos+4;continue;}$firstUrlEndStrPos=mb_strpos($fullPathContent,')',$doubleDotsPos);if($firstUrlEndStrPos===FALSE){$position=$doubleDotsPos+3;continue;}$endOfUrlBlockChars=mb_substr($fullPathContent,$doubleDotsPos+3,$firstUrlEndStrPos-($doubleDotsPos+3));$endOfUrlBlockChars=preg_replace("#[a-zA-Z\./ \"'_\-\?\&]#","",$endOfUrlBlockChars);if(mb_strlen($endOfUrlBlockChars)>0){$position=$firstUrlEndStrPos+1;continue;}$lastUrlBeginStrPos+=4;$urlSubStr=mb_substr($fullPathContent,$lastUrlBeginStrPos,$firstUrlEndStrPos-$lastUrlBeginStrPos);$firstStr=mb_substr($urlSubStr,0,1);$lastStr=mb_substr($urlSubStr,mb_strlen($urlSubStr)-1,1);if($firstStr==='"'&&$lastStr==='"'){$urlSubStr=mb_substr($urlSubStr,1,mb_strlen($urlSubStr)-2);$quote='"';}else if($firstStr==="'"&&$lastStr==="'"){$urlSubStr=mb_substr($urlSubStr,1,mb_strlen($urlSubStr)-2);$quote="'";}else{$quote='"';}$trimmedUrlSubStr=ltrim($urlSubStr,'./');$trimmedPartLength=mb_strlen($urlSubStr)-mb_strlen($trimmedUrlSubStr);$trimmedPart=trim(mb_substr($urlSubStr,0,$trimmedPartLength),'/');$subjectRestPath=trim(mb_substr($urlSubStr,$trimmedPartLength),'/');$urlFullBasePath=str_replace('\\','/',realpath($this->getAppRoot().$stylesheetDirectoryRelative.$trimmedPart));$urlFullPath=$urlFullBasePath.'/'.$subjectRestPath;$webPath=mb_substr($urlFullPath,mb_strlen($this->getAppRoot()));$webPath=$this->AssetUrl($webPath);$fullPathContent=mb_substr($fullPathContent,0,$lastUrlBeginStrPos).$quote.$webPath.$quote.mb_substr($fullPathContent,$firstUrlEndStrPos);$position=$lastUrlBeginStrPos+mb_strlen($webPath)+3;}return$fullPathContent;}private function _renderFileToTmpAndGetNewHref($item,$minify=FALSE){$path=$item->path;$tmpFileName='/rendered_css_'.self::$systemConfigHash.'_'.trim(str_replace('/','_',$path),"_");$srcFileFullPath=$this->getAppRoot().$path;$tmpFileFullPath=$this->getTmpDir().$tmpFileName;if(self::$fileCheckingAndRendering){if(Packager_Php_Wrapper::FileExists($srcFileFullPath)){$srcFileModDate=Packager_Php_Wrapper::Filemtime($srcFileFullPath);}else{$srcFileModDate=1;}if(Packager_Php_Wrapper::FileExists($tmpFileFullPath)){$tmpFileModDate=Packager_Php_Wrapper::Filemtime($tmpFileFullPath);}else{$tmpFileModDate=0;}if($srcFileModDate!==FALSE&&$tmpFileModDate!==FALSE){if($srcFileModDate>$tmpFileModDate){if($item->render){$fileContent=$this->_renderFile($srcFileFullPath);}else if($minify){$fileContent=Packager_Php_Wrapper::FileGetContents($srcFileFullPath);}$fileContent=$this->_convertStylesheetPathsFromRelatives2TmpAbsolutes($fileContent,$path);if($minify)$fileContent=$this->_minify($fileContent,$item->path);$this->saveFileContent($tmpFileFullPath,$fileContent);$this->log("Css file rendered ('$tmpFileFullPath').",'debug');}}}$tmpPath=substr($tmpFileFullPath,strlen($this->getAppRoot()));return$tmpPath;}private function _renderItemSeparated(stdClass$item){$result='<link rel="stylesheet"';if($item->media!=='all')$result.=' media="'.$item->media.'"';if(!$item->render&&self::$fileCheckingAndRendering){$fullPath=$this->getAppRoot().$item->path;if(!Packager_Php_Wrapper::FileExists($fullPath)){$this->log("File not found in CSS view rendering process ('$fullPath').",'error');}}$result.=' href="'.$item->href.'" />';return$result;}private function _renderItemsSeparated($actualGroupName='',$items=array(),$indent=0,$minify=FALSE){$indentStr=$this->getIndentString($indent);$resultItems=array();if(self::$fileCheckingAndRendering)$resultItems[]='<!-- css group begin: '.$actualGroupName.' -->';$appCompilation=MvcCore::GetCompiled();foreach($items as$item){if($item->render||($minify&&!$item->doNotMinify)){$item->href=$this->AssetUrl($this->_renderFileToTmpAndGetNewHref($item,$minify));}else{$item->href=$this->AssetUrl($item->path);}if(!$appCompilation){$item->href=$this->addFileModificationTimeToHrefUrl($item->href,$item->path);}$resultItems[]=$this->_renderItemSeparated($item);}if(self::$fileCheckingAndRendering)$resultItems[]='<!-- css group end: '.$actualGroupName.' -->';return$indentStr.implode(PHP_EOL.$indentStr,$resultItems);}}
class App_Controllers_Default extends App_Controllers_Base{public function Init(){parent::Init();}public function PreDispatch(){parent::PreDispatch();}public function DefaultAction(){$this->view->Title='Hello world!';}public function NotFoundAction(){}}
class App_Controllers_System extends App_Controllers_Base{public function JsErrorsLogAction(){$this->DisableView();if(!class_exists('Debug')||Debug::$productionMode)return;$keys=array('message'=>1,'uri'=>1,'file'=>1,'line'=>0,'column'=>0,'callstack'=>1,'browser'=>1,'platform'=>0,);$data=array();foreach($keys as$key=>$hex){$param=$this->GetParam($key);if($hex)$param=self::_hexToStr($param);$param=preg_replace("#[^a-zA-Z0-9/\&\(\)\[\]\{\}\.\'\"%\#\$\?\t\r\n_ ]#","",$param);$data[$key]=$param;}$msg=json_encode($data);Debug::log($msg,'javascript');}private static function _hexToStr($hex){$string='';for($i=0;$i<strlen($hex)-1;$i+=2){$string.=chr(hexdec($hex[$i].$hex[$i+1]));}return$string;}}
MvcCore::Run();