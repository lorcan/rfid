#!/usr/bin/python

import commands
import re
import os
import serial
import time

def main():
	
	save = ""
	print "Starting rfid.py"

	phone = "test"
	phoneID = "04162B856E"
	wallet = "test"
	walletID = "0F02D7687E"
	keys = "test"
	keysID = "0415AF2539"
	
	while (1):
		print "start"
		lcd = serial.Serial('/dev/ttyS0', 9600, timeout=1)
		if phone != "test":
			string = "Last had phone @" + phone + "  "
			lcd.write(string)
			time.sleep(2)

		if wallet != "test":
			string = "Last had wallet @ "+ wallet
			lcd.write(string)
			time.sleep(2)

		if keys != "test":
			string = "Last had keys @ " + keys + "  " 
			lcd.write(string)
			time.sleep(2)
		lcd.write("    ReFInDer                    ")

		os.system('./rfidRead -p ttyS2 -b 2400 >> ODCout 2>&1')
	
		# open text file written by C program
		file = open("params.txt", "r")
		line = file.readline()
	
		# process the following only if tag is uncorrupted
		if len(line) == 12:
			# connect to server and insert event only if tag is new
			w = "/bin/wget \'http://192.168.1.3/insert.php?tag_id=" + line[:-2] + "&reader_id=2' > /dev/null"
			os.system(w)

			line = line.strip()				
				
			if line == "04162B856E":
				phone = time.strftime("%d-%m-%y %H:%M",time.localtime(time.time())) 	
			elif line == "0F02D7687E":
				wallet = time.strftime("%d-%m-%y %H:%M",time.localtime(time.time()))
			elif line == "0415AF2539":
				keys = time.strftime("%d-%m-%y %H:%M",time.localtime(time.time()))

			#close file
			file.close()

if __name__ == "__main__": main()