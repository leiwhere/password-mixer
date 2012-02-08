#!/bin/sh
mkdir /opt/AntiyPasswordMixer/keys
mkdir /opt/AntiyPasswordMixer/database
cp ./pwd.lst /opt/AntiyPasswordMixer/database
openssl genrsa -out /opt/AntiyPasswordMixer/keys/privkey.pem 4096
openssl rsa -in /opt/AntiyPasswordMixer/keys/privkey.pem -out /opt/AntiyPasswordMixer/keys/pubkey.pem -pubout


