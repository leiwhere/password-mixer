#!/usr/bin/env ruby

#-------------------------------------------------------------------------------------------------
# The apm_migration of the Ruby binding
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

require 'apm'

def data_migration(filename, logfile)
	begin
		f      = File.open(filename, "r")
		log    = File.open(logfile, "w")
	rescue
		return -1
	end
	
	i = 1
	lines = f.readlines()
	for data in lines do
		data = data.delete("\n")
		fields = data.split("\t")

		if fields.size != 2
			log.write("Error: [line=%d] data format error\n"%(i))
			i = i+1
			next
		end
		
			
		ret = apm_register_user(fields[0], fields[1], "")
		
		if ret == -1
			log.write("Error: [line=#{i}] cann't open database " + $g_apm_db_name + " \n")
		end
		
		if ret == -2
			log.write("Error: [line=%d] user or password is NULL\n"%(i))
		end
		
		if ret == -3
			log.write("Error: [line=%d] user already reigster\n"%(i))
		end
		
		if ret == -4
			log.write("Error: [line=%d] save original password error\n"%(i))
		end
		
		if ret == 5
			log.write("Error: [line=%d] save extend information error\n"%(i))
		end
		
		if ret == 6
			log.write("Error: [line=%d] save user information error\n"%(i))
		end

		i = i+1
	end
	
	f.close()
	log.close()
	return 0
end


usage = "Usage:\n   apm_migration datafile logfile"

if ARGV.size < 2
	puts usage
	exit(0)
end

ret = data_migration(ARGV[0], ARGV[1])

if ret == -1
	puts "cann't open file " + ARGV[0] + " or " + ARGV[1]
end

