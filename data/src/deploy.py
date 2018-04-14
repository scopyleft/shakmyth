#!/usr/bin/env python
# encoding: utf-8

import os
os.chdir('/Library/WebServer/Documents/shakmyth')
os.system("/Applications/MAMP/Library/bin/mysql -ushakmyth -pxxxxxxxx -Dshakmyth <<MYSQL\n"+mysql_query+"\nMYSQL")
os.system("symfony doctrine:data-load")