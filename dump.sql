/*Added*/
CREATE TABLE questions (
  id SERIAL PRIMARY KEY,
  survey_id integer NOT NULL,
  name varchar(5000) NOT NULL,
  description varchar(255) DEFAULT NULL,
  with_options integer NOT NULL DEFAULT '1',
  is_calculating integer NOT NULL DEFAULT '1',
  include_no_response integer NOT NULL DEFAULT '0',
  no_response_option varchar(255) NOT NULL,
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  is_deleted integer NOT NULL
);


CREATE TABLE users (
  user_id serial PRIMARY KEY,
  role_id integer DEFAULT NULL,
  first_name varchar(64) NOT NULL,
  last_name varchar(64) NOT NULL,
  email_address varchar(128) NOT NULL,
  password varchar(128) NOT NULL,
  address varchar(255) DEFAULT NULL,
  city varchar(255) DEFAULT NULL,
  state varchar(255) DEFAULT NULL,
  zip varchar(32) DEFAULT NULL,
  country varchar(255) DEFAULT NULL,
  created date DEFAULT NULL,
  updated date DEFAULT NULL,
  confirmation_key varchar(255) DEFAULT NULL,
  is_email_confirmed integer NOT NULL DEFAULT '0',
  is_active integer NOT NULL DEFAULT '1'
);




