
<?php

/*
#-------------------------------------------------------------------------------------------------
# The apm_base of the PHP binding
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

function apm_gen_salt()
{
	$apm_alpha_digits     ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$apm_alpha_digits_len = strlen($apm_alpha_digits) -1;
	$salt = '';
	
	for($i =0; $i<32; $i++)
	{
		$salt .= $apm_alpha_digits[mt_rand(0, $apm_alpha_digits_len)];
	}
	return $salt;
}

function apm_calc_sha256($user, $salt, $password)
{
	$sign = $user.$salt.$password;
	$sha = hash('sha256', $sign);
	return $sha;
}

function apm_enc_data($keyfile, $data)
{
	$enc_data = '';
	$fp = fopen($keyfile, "rb");
	if($fp == FALSE)
	{
		return $enc_data;
	}
	
	$pub_key = fread($fp, filesize($keyfile));
	fclose($fp);
	
	$cdata = '';
	if(TRUE == openssl_public_encrypt($data, &$cdata, $pub_key))
	{
		$enc_data = base64_encode($cdata);
		if($enc_data == FALSE)
		{
			$enc_data = '';
		}
	}

	return $enc_data;
}

function apm_dec_data($keyfile, $data)
{
	$dec_data = '';
	$fp = fopen($keyfile, "rb");
	if($fp == FALSE)
	{
		return $dec_data;
	}
	
	$private_key = fread($fp, filesize($keyfile));
	fclose($fp);
	
	$ddata = base64_decode($data);
	if(FALSE == openssl_private_decrypt($ddata, &$dec_data, $private_key))
	{
		$dec_data = '';
	}

	return $dec_data;
}

?>





