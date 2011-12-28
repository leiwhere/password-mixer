#!/usr/bin/python

#-------------------------------------------------------------------------------------------------
# The apm of the Python binding
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

from apm_base import *
from kyotocabinet import *
from apm_config import *

db = DB()
opendb_flag = db.open(g_apm_db_name, DB.OWRITER | DB.OCREATE)


def apm_register_user(user, password, ext_info):
	if not opendb_flag:
		return -1
		
	if user == "" or password == "":
		return -2
		
	if db.get(user):
		return -3
	
	salt         = apm_gen_salt()
	pwd_hash     = apm_calc_sha256(user, salt, password)
	
	pwd_enc      = ""
	ext_info_enc = ""
	validity     = "1"
	
	if g_apm_register_type == 1:
		pwd_enc  = apm_enc_data(g_apm_pub_key, salt+password)
		if len(pwd_enc) == 0:
			return -4

	if len(ext_info) > 0:
		ext_info_enc = apm_enc_data(g_apm_pub_key, ext_info)
		if len(ext_info_enc) == 0:
			return -5
	
	value = salt + ',' + pwd_hash + ',' + pwd_enc + ',' + ext_info_enc + ',' + validity
	
	if not db.set(user, value):
		return -6
		
	return 0

def apm_change_pwd(user, oldpwd, newpassword):
	if not opendb_flag:
		return -1
		
	if user == "" or oldpwd == "" or newpassword == "":
		return -2
		
	if apm_authenticate_user(user, oldpwd) != 0:
		return -3
		
	value         = db.get(user)
	field_list    = value.split(',')
	
	salt         = field_list[0]
	pwd_hash     = field_list[1]
	pwd_enc      = field_list[2]
	ext_info_enc = field_list[3]
	validity     = field_list[4]
	
	if validity == "0":
		return -4
		
	if g_apm_register_type == 1:
		pwd_enc  = apm_enc_data(g_apm_pub_key, salt+newpassword)
		if len(pwd_enc) == 0:
			return -6
			
	pwd_hash     = apm_calc_sha256(user, salt, newpassword)
	
	value = salt + ',' + pwd_hash + ',' + pwd_enc + ',' + ext_info_enc + ',' + validity
	if not db.set(user, value):
		return -5
		
	return 0

def apm_delete_user(user):
	if not opendb_flag:
		return -1
	if user == "":
		return -2
	if not db.remove(user):
		return -3
	return 0

def apm_authenticate_user(user, password):
	if not opendb_flag:
		return -1
		
	if user == "" or password == "":
		return -2
	
	value      = db.get(user)
	
	if not value:
		return -3
	
	field_list  = value.split(',')
	salt        = field_list[0]
	db_pwd_hash = field_list[1]
	validity    = field_list[4]
	
	if validity == "0":
		return -4
	
	calc_pwd_hash = apm_calc_sha256(user, salt, password)
	
	if db_pwd_hash != calc_pwd_hash:
		return -5
	
	return 0

def apm_set_user_validity(user, validity):
	if not opendb_flag:
		return -1
		
	value = db.get(user)
	
	if not value:
		return -2
			
	field_list  = value.split(',')
	salt            = field_list[0]
	pwd_hash        = field_list[1]
	pwd_enc         = field_list[2]
	ext_info_enc    = field_list[3]
	change_validity = field_list[4]
	change_validity = validity
	
	value = salt + ',' + pwd_hash + ',' + pwd_enc + ',' + ext_info_enc + ',' + change_validity
	if not db.set(user, value):
		return -3
			
	return 0

