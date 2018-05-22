<?php
error_reporting(E_ALL);

$dbopts = parse_url(getenv('DATABASE_URL'));
define( "DB_DSN", 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"] );
define( "DB_HOST", $dbopts["host"]); //ec2-54-83-1-94.compute-1.amazonaws.com
define( "DB_USERNAME", $dbopts["user"] );//fccczroxijlspx
define( "DB_PASSWORD", $dbopts["pass"]);//b5d3146f1ff4b565a3c72f2ec3aa7dfade6aae3b4819d597b9e863b540e93c96
//dbname d9qqrpvoldsupj
//{ ["scheme"]=> string(8) "postgres" ["host"]=> string(38) "ec2-54-83-1-94.compute-1.amazonaws.com" ["port"]=> int(5432) ["user"]=> string(14) "fccczroxijlspx" ["pass"]=> string(64) "b5d3146f1ff4b565a3c72f2ec3aa7dfade6aae3b4819d597b9e863b540e93c96" ["path"]=> string(15) "/d9qqrpvoldsupj" }*/