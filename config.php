<?php
error_reporting(E_ALL);

$dbopts = parse_url(getenv('DATABASE_URL'));
define( "DB_DSN", 'pgsql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"] . ';port=' . $dbopts["port"] );
define( "DB_HOST", $dbopts["host"]);
define( "DB_USERNAME", $dbopts["user"] );
define( "DB_PASSWORD", $dbopts["pass"]);
