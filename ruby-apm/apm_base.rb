#!/usr/bin/env ruby

#-------------------------------------------------------------------------------------------------
# The apm_base of the Ruby binding
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

require 'openssl'
require 'base64'

$apm_alpha_digits = ("a".."z").to_a + ("A".."Z").to_a + ("0".."9").to_a

def apm_gen_salt()
	salt = ""
	1.upto(32) { |i| salt << $apm_alpha_digits[rand($apm_alpha_digits.size-1)]}
	return salt
end

def apm_calc_sha256(user, salt, password)
	sign = user+salt+password
	sha = OpenSSL::Digest::SHA256.hexdigest(sign)
	return sha
end

def apm_enc_data(keyfile, data)
	enc_data = ''
	begin
		fp       = File.open(keyfile, 'rb')
		pub_key  = fp.read
		rsa      = OpenSSL::PKey::RSA.new(pub_key)
		cdata    = rsa.public_encrypt(data)
		enc_data = Base64.encode64(cdata)
	rescue
		enc_data = ''
	end
	return enc_data
end

def apm_dec_data(keyfile, data)
	dec_data = ''
	begin
		fp       = File.open(keyfile, 'rb')
		priv_key = fp.read
		ddata    = Base64.decode64(data)
		rsa      = OpenSSL::PKey::RSA.new(priv_key)
		dec_data = rsa.private_decrypt(ddata)
	rescue
		dec_data = ''
	end
	return dec_data
end

