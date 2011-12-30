#!/usr/bin/python

#-------------------------------------------------------------------------------------------------
# The apm_config.py of the Python binding
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

# user info database path
g_apm_db_path        = "/opt/AntiyPasswordMixer/database/"
g_apm_db_name        = g_apm_db_path + "userinfo.kch"
# public key path
g_apm_pub_key_path   = "/opt/AntiyPasswordMixer/keys/"
g_apm_pub_key        = g_apm_pub_key_path + "pubkey.pem"

# if set 0 donn't save original password
# if set 1 save original password
g_apm_register_type  = 0
