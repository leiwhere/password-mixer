<?

#-------------------------------------------------------------------------------------------------
# The apm of the PHP binding
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

include_once("./apm_config.php");
include_once("./apm_base.php");

global $g_apm_db_name;
$dbh = dba_open($g_apm_db_name, "c");

$g_frequently_used_pwd = array();

function apm_load_pwd_list($password_list_file, $flag)
{
	global $g_frequently_used_pwd;
	
	if($flag != 1)
	{
		return 0;
	}
	
	if(!file_exists($password_list_file))
	{
		return -1;
	}
	
	$fd = fopen($password_list_file, "rt");
	
	if(!$fd)
	{
		return -2;
	}
	
	while(!feof($fd))
	{
		$line = fgets($fd);
		if(!$line)
		{
			break;
		}
		$line = str_replace("\n", "", $line);
		$line = str_replace("\r", "", $line);
		array_push($g_frequently_used_pwd, $line);
	}
	fclose($fd);
	return 0;
}

global $g_apm_pwd_name;
global $g_apm_check_frequently_used_pwd;
apm_load_pwd_list($g_apm_pwd_name, $g_apm_check_frequently_used_pwd);
	
function apm_check_pwd($user, $password, $flag)
{
	global $g_frequently_used_pwd;
	if ($flag == 1)
	{
		//it's a frequently used password
		if(in_array($password,$g_frequently_used_pwd))
		{
			return -1;
		}
		
		// it's a pure digital password
		if(is_numeric($password))
		{
			return -2;
		}
		
		// passowrd contain the user
		$ret = strpos($password, $user);
		if($ret !== False && (strlen($password) - strlen($user)) < 3)
		{
			return -3;
		}		
	}
	return 0;
}

function apm_register_user($user, $password, $ext_info)
{
	global $dbh;
	global $g_apm_register_type;
	global $g_apm_check_frequently_used_pwd;

	if(!$dbh)
	{
		return -1;
	}
	
	if(strlen($user) == 0 || strlen($password) == 0)
	{
		return -2;
	}
	
	if(TRUE == dba_exists($user, $dbh))
	{
		return -3;
	}
	
	if( apm_check_pwd($user, $password, $g_apm_check_frequently_used_pwd) != 0)
	{
		return -7;
	}
	
	$salt         = apm_gen_salt();
	$pwd_hash     = apm_calc_sha256($user, $salt, $password);
	
	$pwd_enc      = "";
	$ext_info_enc = "";
	$validity     = "1";
	if ($g_apm_register_type == 1)
	{
		$pwd_enc  = apm_enc_data($g_apm_pub_key, $salt.$password);
		if(strlen($pwd_enc) == 0)
		{
			return -4;
		}
	}

	if(strlen($ext_info) > 0)
	{
		$ext_info_enc = apm_enc_data($g_apm_pub_key, $ext_info);
		if(strlen(ext_info_enc) == 0)
		{
			return -5;
		}
	}
	
	$value = $salt.','.$pwd_hash.','.$pwd_enc.','.$ext_info_enc.','.$validity;

	if(FALSE == dba_insert($user, $value, $dbh))
	{
		return -6;
	}
	return 0;
}

function apm_change_pwd($user, $oldpwd, $newpassword)
{
	global $dbh;
	global $g_apm_register_type;
	global $g_apm_pub_key;
	global $g_apm_check_frequently_used_pwd;
	
	if(!$dbh)
	{
		return -1;
	}
	if(strlen($user) == 0 || strlen($oldpwd) == 0 || strlen($newpassword) == 0)
	{
		return -2;
	}
	if(apm_authenticate_user($user, $oldpwd) != 0)
	{
		return -3;
	}
	
	if( apm_check_pwd($user, $newpassword, $g_apm_check_frequently_used_pwd) != 0)
	{
		return -7;
	}
	
	$value         = dba_fetch($user, $dbh);
	list($salt,$pwd_hash,$pwd_enc,$ext_info_enc,$validity) = split(",", $value);
	if(strcmp($validity, "0") == 0)
	{
		return -4;
	}
	if($g_apm_register_type == 1)
	{
		$pwd_enc  = apm_enc_data($g_apm_pub_key, $salt.$newpassword);
		if(strlen($pwd_enc) == 0)
		{
			return -6;
		}
	}
	
	$pwd_hash  = apm_calc_sha256($user, $salt, $newpassword);
	$value     = $salt.','.$pwd_hash.','.$pwd_enc.','.$ext_info_enc.','.$validity;
	if(FALSE == dba_replace($user , $value , $dbh))
	{
		return -5;
	}
	return 0;
}

function apm_delete_user($user)
{
	global $dbh;
	if(!$dbh)
	{
		return -1;
	}
	if(strlen($user) == 0 )
	{
		return -2;
	}
	if(FALSE == dba_delete($user, $dbh))
	{
		return -3;
	}
	return 0;
}

function apm_authenticate_user($user, $password)
{
	global $dbh;
	if(!$dbh)
	{
		return -1;
	}
	
	if(strlen($user) == 0 || strlen($password) == 0)
	{
		return -2;
	}
	
	if(FALSE == dba_exists($user, $dbh))
	{
		return -3;
	}
	
	$value         = dba_fetch($user, $dbh);
	list($salt,$pwd_hash,$pwd_enc,$ext_info_enc,$validity) = split(",", $value);
	
	if(strcmp($validity, "0") == 0)
	{
		return -4;
	}
	
	$calc_pwd_hash = apm_calc_sha256($user, $salt, $password);
	if(strcmp($pwd_hash, $calc_pwd_hash) != 0)
	{
		return -5;
	}
	
	return 0;
}

function apm_set_user_validity($user, $validity)
{
	global $dbh;
	if(!$dbh)
	{
		return -1;
	}
	
	if(FALSE == dba_exists($user, $dbh))
	{
		return -2;
	}
	
	$value         = dba_fetch($user, $dbh);
	list($salt,$pwd_hash,$pwd_enc,$ext_info_enc,$change_validity) = split(",", $value);
	$change_validity = strval($validity);
	
	$value     = $salt.','.$pwd_hash.','.$pwd_enc.','.$ext_info_enc.','.$change_validity;
	
	if(FALSE == dba_replace($user , $value , $dbh))
	{
		return -3;
	}			
	return 0;
}

?>