<?php
	$start_time = explode(' ', microtime()); $start_time = $start_time[1] + $start_time[0];
	error_reporting(-1);
	print $spacer="##############################################################################\n";
	echo date('M d, Y H:i:s');
	print "\n".$spacer;

    include "settings.php";
/** If you do not have your own settings files, you can set them here. **/    
    if (!isset($rootPath))
	   echo $rootPath = "/directory/";
    if (!isset($processedFolder))
	   $processedFolder = "Orders\ Processed/";
	   
/** Ghost Script installed through MacPorts **/
	$command = "/opt/local/bin/gs -dPDFA -sDEVICE=pdfwrite -dPDFSETTINGS=/default -dNOPAUSE -dQUIET -dBATCH -sOutputFile=";
	
	checkVolume($rootPath);

 	$rootDirectory = dirToArray($rootPath);
	
	foreach ($rootDirectory as $key => $dirOrders) 
	{
		$folder = folderToArray($rootPath.$dirOrders);
		foreach ($folder as $num => $fileName)
		{
			if (substr($fileName, 0, 7) != "(PDF-A)")
			{
				print $runExec = $command.$rootPath.$dirOrders."/\"(PDF-A) ".$fileName."\" ".$rootPath.$dirOrders."/\"".$fileName."\" \n";
 				$runMove = "mv ".$rootPath.$dirOrders."/\"".$fileName."\" ".$rootPath.$processedFolder."PDF-A\ Processed/".$dirOrders."/\"".$fileName."\"\n";

/** I'm not activally running this, but if I wanted to, I just uncomment the following lines. **/ 			
//  				$outputConvert 	= shell_exec($runExec);  // ." 2>&1"
//  				$outputMove 	= shell_exec($runMove);  // ." 2>&1"
			}
		}
	}
	
	$end_time = explode(' ', microtime()); $total_time = $end_time[0] + $end_time[1] - $start_time; 
	print "\n".$spacer;
	printf('Runtime: %.3f seconds.', $total_time);
	print "\n".$spacer;
	
/******************************************************************************************************/
function checkVolume($vol)
{
    include "settings.php";
	if(!is_dir($vol))
	{
		echo "Mounting Orders Drive\n";
		echo "osascript -e 'mount volume \"smb://".$smbLogin.":".$smbPassword."@".$smbServer."/".$smbShare."\"' > /dev/null";
		$outputMount 	= shell_exec("osascript -e 'mount volume \"smb://".$smbLogin.":".$smbPassword."@".$smbServer."/".$smbShare."\"' > /dev/null");
	}
}
/******************************************************************************************************/
function dirToArray($dir, $orderDIR="") { 
    if(!is_dir($vol))
    {
        $result = array(); 
        $cdir = scandir($dir);

        foreach ($cdir as $key => $value) 
        { 	     
            if (preg_match("/^ORDERS/", $value)) {
         		if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         			$orderDIR[] = $value;
           } 
        } 
        sort($orderDIR);
        return $orderDIR;
   } else {return NULL;}
} 
/******************************************************************************************************/
/******************************************************************************************************/
function folderToArray($dir) { 
   $result = array(); 
   $cdir = scandir($dir);

   foreach ($cdir as $key => $file) 
   {
	   $ext = strtolower(strrchr( $file, '.' ));
	   if (strcasecmp($ext,'.pdf')== 0)
	   if (!in_array($file,array(".","..",".DS_Store","UdBinInfo.dat")))
	   {
			if (is_dir($dir . DIRECTORY_SEPARATOR . $file)) 
			{ $result[$file] = dirToArray($dir . DIRECTORY_SEPARATOR . $file); }
			else 
			{ $result[] = $file; } 
 		} 
   } 
   sort($result);
   return $result;
} 
/******************************************************************************************************/
?>