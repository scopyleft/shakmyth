#!/usr/bin/env python
# encoding: utf-8

import os

mysql_query = """\
      TRUNCATE TABLE profile_index;
      TRUNCATE TABLE page_index;
      TRUNCATE TABLE myth_page_index;
      TRUNCATE TABLE profile;
      TRUNCATE TABLE sf_guard_group;
      TRUNCATE TABLE sf_guard_group_permission;
      TRUNCATE TABLE sf_guard_permission;
      TRUNCATE TABLE sf_guard_remember_key;
      TRUNCATE TABLE sf_guard_user;
      TRUNCATE TABLE sf_guard_user_group;
      TRUNCATE TABLE sf_guard_user_permission;
      TRUNCATE TABLE myth_page;
      TRUNCATE TABLE page;
      TRUNCATE TABLE myth;
  """ % locals()
  
# os.system("/Applications/MAMP/Library/bin/mysql -ushakmyth -pxxxxxxxx -Dshakmyth <<MYSQL\n"+mysql_query+"\nMYSQL")
# os.system("symfony doctrine:data-load --env=dev")
# os.system('symfony doctrine:insert-sql --env="test"')
# os.system('symfony doctrine:data-load --env="test" --dir="data/test-fixtures"')

os.system('symfony doctrine:build-all-reload --env="test" --no-confirmation --dir="data/test-fixtures"')