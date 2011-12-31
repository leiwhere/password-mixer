<?php
/*
#-------------------------------------------------------------------------------------------------
# The apm_migration of the PHP binding
#                                                              Copyright (C) 2011 Antiy Labs
# This file is part of free software: you can redistribute it and/or modify it under the 
# terms of the GNU General Public License as published by the Free Software Foundation, 
# either version 3 of the License, or any later version.
# This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
# You should have received a copy of the GNU General Public License along with this program.
# If not, see <http://www.gnu.org/licenses/>.
# Antiy Password Mixer was written by Antiy Labs.  You can contact the author
# by e-mail to `apm@antiy.com' 
#-------------------------------------------------------------------------------------------------
*/
include_once("./apm.php");

function data_migration($filename, $logfile)
{
	global $g_apm_db_name;
	$fp  = fopen($filename, "r");
	$log = fopen($logfile, "w");
	if($fp == FALSE || $log == FALSE)
	{
		return -1;
	}
	
	for($i=1; ($data = fgets($fp)) != FALSE; $i++)
	{
		$fields = split("\t", $data, 2);
		if(count($fields) != 2)
		{
			fputs($log, "Error: [line=".$i."] data format error\n");
			continue;
		}
		
		$ret = apm_register_user($fields[0], $fields[1], "");
		if($ret == -1)
		{
			fputs($log, "Error: [line=".$i."] cann't open database ".$g_apm_db_name."\n");
		}
		if($ret == -2)
		{
			fputs($log, "Error: [line=".$i."] user or password is NULL\n");
		}
		if($ret == -3)
		{
			fputs($log, "Error: [line=".$i."] user already reigster\n");
		}
		if($ret == -4)
		{
			fputs($log, "Error: [line=".$i."] save original password error\n");
		}
		if($ret == -5)
		{
			fputs($log, "Error: [line=".$i."] save extend information error\n");
		}
		if($ret == -6)
		{
			fputs($log, "Error: [line".$i."] save user information error\n");
		}
	}
	fclose($fp);
	fclose($log);
}

$usage = "Usage:\n   apm_migration datafile logfile\n";
if($argc < 3)
{
	print $usage;
	exit(0);	
}
$ret = data_migration($argv[1], $argv[2]);
if($ret == -1)
{
	print "cann't open file ".$argv[1]." or ".$argv[2]."\n";
}

?>