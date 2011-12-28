#!/usr/bin/python

#-------------------------------------------------------------------------------------------------
# The apm_migration of the Python binding
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

from apm import *
import sys

def data_migration(filename, logfile):
	try:
		f      = open(filename)
		log    = open(logfile, "w")
	except:
		return -1
	i = 1
	for data in f.readlines():
		fields = data.split('\t')
		print len(fields)
		if len(fields) != 2:
			log.write("Error: [line=%d] data format error\n"%(i))
			continue
			
		ret = apm_register_user(fields[0], fields[1], "")
		if ret == -1:
			log.write("Error: [line=%d] cann't open database %s\n"%(i, g_apm_db_name))
		if ret == -2:
			log.write("Error: [line=%d] user or password is NULL\n"%(i))
		if ret == -3:
			log.write("Error: [line=%d] user already reigster\n"%(i))
		if ret == -4:
			log.write("Error: [line=%d] save original password error\n"%(i))
		if ret == -5:
			log.write("Error: [line=%d] save extend information error\n"%(i))
		if ret == -6:
			log.write("Error: [line=%d] save user information error\n"%(i))
		i = i+1
	f.close()
	log.close()
	return 0


usage = "Usage:\n   apm_migration datafile logfile"

if len(sys.argv) < 3:
	print usage
	exit(0)


ret = data_migration(sys.argv[1], sys.argv[2])
if ret == -1:
	print "cann't open file %s or %s"%(sys.argv[1], sys.argv[2])
