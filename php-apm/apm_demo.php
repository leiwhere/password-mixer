<?php

/*
#-------------------------------------------------------------------------------------------------
# The apm_demo of the PHP binding
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

function apm_demo_register_user_test($user, $password, $ext_info)
{
	$ret = apm_register_user($user, $password, $ext_info);
	if($ret == 0)
	{
		print "apm_demo_register_user_test: regisetr user successful!\n";
	}
	
	if($ret == -1)
	{
		print "apm_demo_register_user_test: cann't open database".$g_apm_db_name."\n";
	}
	
	if($ret == -2)
	{
        	print "apm_demo_register_user_test: user or password is NULL\n";
        }
        
	if($ret == -3)
	{
		print "apm_demo_register_user_test: user [".$user."] already reigster\n";
	}
	if($ret == -4)
	{
		print "apm_demo_register_user_test: save original password error!\n";
	}
	if($ret == -5)
	{
		print "apm_demo_register_user_test: save extend information error!\n";
	}
	if($ret == -6)
	{
		print "apm_demo_register_user_test: save user information error!\n";
	}
}

function apm_demo_change_pwd_test($user, $oldpwd, $newpassword)
{
	$ret = apm_change_pwd($user, $oldpwd, $newpassword);
	if($ret == 0)
	{
		print "apm_demo_change_pwd_test: change password successful !\n";
	}
	
	if($ret == -1)
	{
		print "apm_demo_change_pwd_test: cann't open database".$g_apm_db_name."\n";
	}
	
	if($ret == -2)
	{
		print "apm_demo_change_pwd_test: user or password is NULL\n";
	}
	
	if($ret == -3)
	{
		print "apm_demo_change_pwd_test: user name doesn't exist or password is incorrect\n";
	}
	if($ret == -4)
	{
		print "apm_demo_change_pwd_test: user name is invalid\n";
	}
	if($ret == -5)
	{
		print "apm_demo_change_pwd_test: save user information error!\n";
	}
}

function apm_demo_authenticate_user_test($user, $password)
{
	$ret = apm_authenticate_user($user, $password);
	if($ret == 0)
	{
		print "apm_demo_authenticate_user_test: authenticate password successful !\n";
	}
	if($ret == -1)
	{
		print "apm_demo_authenticate_user_test: cann't open database".$g_apm_db_name."\n";
	}
	if($ret == -2)
	{
		print "apm_demo_authenticate_user_test: user or password is NULL\n";
	}
	if($ret == -3)
	{
		print "apm_demo_authenticate_user_test: user name doesn't exist\n";
	}
	if($ret == -4)
	{
		print "apm_demo_authenticate_user_test: user name is invalid\n";
	}
	if($ret == -5)
	{
		print "apm_demo_authenticate_user_test: authenticate password error!\n";
	}
}

function apm_demo_delete_user_test($user)
{
	$ret = apm_delete_user($user);
	if($ret == 0)
	{
		print "apm_demo_delete_user_test: delete user successful !\n";
	}
	if($ret == -1)
	{
		print "apm_demo_delete_user_test: cann't open database ".$g_apm_db_name."\n";
	}
	if($ret == -2)
	{
		print "apm_demo_delete_user_test: user name is NULL\n";
	}
	if($ret == -3)
	{
		print "apm_demo_delete_user_test: user name is invalid\n";
	}
}
		
# test register user
apm_demo_register_user_test("testuser", "passwordtest", "");

# test register user and alreadly register
apm_demo_register_user_test("testuser", "passwordtest", "");

# test change password
apm_demo_change_pwd_test("testuser", "passwordtest", "passwordtest1");

# test change password and password is NULL
apm_demo_change_pwd_test("testuser", "", "passwordtest1");

# test change password and user name doesn't exist
apm_demo_change_pwd_test("testuser123", "passwordtest", "passwordtest1");

# test change password and input password is invalid
apm_demo_change_pwd_test("testuser", "passwordtest", "passwordtest1");

# test authenticate user
apm_demo_authenticate_user_test("testuser", "passwordtest1");

# test authenticate user and password is NULL
apm_demo_authenticate_user_test("testuser", "");

# test authenticate user and user name doesn't exist
apm_demo_authenticate_user_test("testuser123", "passwordtest1");

# test authenticate user and password is invalid
apm_demo_authenticate_user_test("testuser", "passwordtest");

# test delete user
apm_demo_delete_user_test("testuser");

# test delete user and username is NULL
apm_demo_delete_user_test("");

   
# test delete user and username is invalid
apm_demo_delete_user_test("testuser");


?>