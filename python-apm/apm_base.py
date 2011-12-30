#!/usr/bin/python

#-------------------------------------------------------------------------------------------------
# The apm_base of the Python binding
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


import random, hashlib, M2Crypto, base64, string

apm_alpha_digits = string.ascii_letters + string.digits

def apm_gen_salt():
	salt = ""
	for x in range(1, 32):
		salt += random.choice(apm_alpha_digits)
	return salt
	
def apm_calc_sha256(user, salt, password):
	sign = user+salt+password
	myhash = hashlib.sha256(sign)
	return  myhash.hexdigest() 
	
def apm_enc_data(keyfile, data):
	try:
        	key   = M2Crypto.RSA.load_pub_key(keyfile)
        	cdata = key.public_encrypt(data, M2Crypto.RSA.pkcs1_padding)
        	return base64.encodestring(cdata)
        except:
        	return ""
        

def apm_dec_data(keyfile, data):
	try:
        	cdata = base64.decodestring(data)
        	key  = M2Crypto.RSA.load_key(keyfile)
        	ddata = key.private_decrypt(cdata, M2Crypto.RSA.pkcs1_padding)
        	return ddata
        except:
        	return ""






