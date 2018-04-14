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
  f = open(file_target,"w")
  f.write("---\nMyth:\n")
  f.close()
  
  for line in fileinput.FileInput(sys.path[0]+"/"+file_name):
    f = open(file_target,"a+")
    f.write("  "+line.strip().replace(' ', '').lower()+":\n")
    f.write("    name:         "+line.lower()+"\n")
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

