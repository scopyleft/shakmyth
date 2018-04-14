#!/usr/bin/env python
# encoding: utf-8
"""
untitled.py

Created by PointBar on 2009-04-20.
Copyright (c) 2009 __MyCompanyName__. All rights reserved.
"""

import sys, os
import getopt
import fileinput
import unicodedata

help_message = '''
Compose fixtures with simple text
'''

class Usage(Exception):
  def __init__(self, msg):
    self.msg = msg
    
def txt_to_fixtures(file_name):
  """build fixtures"""
  file_target = sys.path[0]+"/../fixtures/"+file_name[0:file_name.index(".")]+".yml"

  # fixme: delete a file

  # sfGuardUser:
  #   slang:
  #     username:           stephane
  #     password:           xxxxxxxx
  #     is_super_admin:     true
  #     Profile:
  #       first_name:       stephane
  #       last_name:        Langlois
  
  sf_guard_user = "\nsfGuardUser:\n"
  sf_guard_group = """
sfGuardGroup:
  sgg_contributor:
    name:               contributor
    description:        Contributor group
    
sfGuardUserGroup:   
"""
  for line in fileinput.FileInput(sys.path[0]+"/"+file_name):
    
    fields = line.split(";")
    user_id = fields[0][0]+fields[1][0:5].lower()
    user_name = unicodedata.normalize("NFKD", unicode(fields[2])).encode("ascii", "ignore").strip().lower()
    password = fields[0][0:4]+fields[1][0:4]
    first_name = fields[0].lower()
    last_name = fields[1].lower()
    
    sf_guard_user += """\
  %(user_id)s:
    username:             %(user_name)s
    password:             %(password)s
    Profile:
      first_name:         %(first_name)s
      last_name:          %(last_name)s
      photo:              %(last_name)s.jpg
      biography:          |
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
""" % locals()
  
    sf_guard_group += """\
  sgg_%(user_id)s:
    sfGuardGroup:         sgg_contributor
    sfGuardUser:          %(user_id)s  
""" % locals()


  # sfGuardGroup:
  #   sgg_stephane:
  #     name:               stephane
  #     description:        Administrator group
  # 
  # sfGuardUserGroup:
  #   sgug_stephane:
  #     sfGuardGroup:       sgg_stephane
  #     sfGuardUser:        slang

  f = open(file_target,"w")  
  f.write("---\n" + sf_guard_group + sf_guard_user)  
  f.close()
    
  os.system("cat "+file_target)

def main(argv=None):
  if argv is None:
    argv = sys.argv
  try:
    try:
      opts, args = getopt.getopt(argv[1:], "hf:", ["help", "file="])
    except getopt.error, msg:
      raise Usage(msg)
  
    # option processing
    for option, value in opts:
      if option == "-v":
        verbose = True
      if option in ("-h", "--help"):
        raise Usage(help_message)
      if option in ("-f", "--file"):
        txt_to_fixtures(value)

  except Usage, err:
    print >> sys.stderr, sys.argv[0].split("/")[-1] + ": " + str(err.msg)
    print >> sys.stderr, "\t for help use --help"
    return 2

main()

