<?php
$srcDir='Z:\a';
$destDir='X:\a';
$count=0;
$countMax=10000000;

//列出指定目录下所有的文件 
function procFiles($srcDir,$destDir){  
	global $count,$countMax;
	$srcList=scandir($srcDir);
	// if(count($srcList)<3 && is_dir($srcDir))
	// {
	// 	echo '空目录:' . $srcDir . "\n";  
	// 	rmdir($srcDir);
	// 	return;
	// }
	foreach($srcList as $afile) 
	{ 
		if($afile=='.'||$afile=='..') 
			continue;  
		if(is_dir($srcDir.'\\'.$afile))  
		{  
			procFiles($srcDir.'\\'.$afile,$destDir.'\\'.$afile);  
		}
		else 
		{  
			$fileSrc=$srcDir.'\\'.$afile;
			$fileDest=$destDir.'\\'.$afile;
			if(!file_exists($fileDest))
			{
				continue;
			}
			$sizeSrc=filesize($fileSrc);
			$sizeDest=filesize($fileDest);
			echo $fileSrc.':'. strval($sizeSrc) . "\n";  
			echo $fileDest.':'. strval($sizeDest) . "\n";  
			$count++;
			if($sizeSrc==$sizeDest)
			{
				unlink($fileDest);
			}
			if($count>$countMax)
			{
				die();
			}
		} 
	}  
}

procFiles($srcDir,$destDir); 
