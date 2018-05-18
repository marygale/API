/*Added*/

CREATE TABLE standard_questions (
  id int NOT NULL,
  name text NOT NULL,
  type varchar(150) NOT NULL,
  with_options int NOT NULL DEFAULT '1',
  is_calculating int NOT NULL DEFAULT '1',
  is_deleted int NOT NULL DEFAULT '0',
  created date NOT NULL,
  modified date NOT NULL
);

CREATE TABLE standard_question_options (
  id int NOT NULL,
  name varchar(255) NOT NULL,
  question_id int NOT NULL,
  score int NOT NULL,
  is_deleted int NOT NULL DEFAULT '0',
  created date NOT NULL,
  modified date NOT NULL
);


INSERT INTO surveys (id, name, password, status, email_verification_on, user_id, open, created, modified, is_deleted) VALUES
(1, 'Feedback for Director Bonnie', 'bonnie123', 0, 1, 1, 1, '2018-05-10 20:55:45', '2018-05-10 20:55:45', 'no');
CREATE TABLE survey_results (
  id serial PRIMARY KEY,
  survey_id INTEGER references surveys(id),
  group_id integer NOT NULL,
  is_admin VARCHAR(5) NOT NULL,
  respondent varchar(255) NOT NULL,
  ipaddress varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  is_deleted VARCHAR(5) NOT NULL
);

INSERT INTO roles (role_id, name, created, updated) VALUES
(1, 'admin', '2018-05-10 16:04:01', '2018-05-10 16:04:01'),
(2, 'user', '2018-05-10 16:04:10', '2018-05-10 16:04:10'),
(3, 'subscriber', '2018-05-10 00:00:00', '2018-05-10 00:00:00');

CREATE TABLE roles (
  role_id INT NOT NULL,
  name varchar(64) NOT NULL,
  created date DEFAULT NULL,
  updated date DEFAULT NULL
);

CREATE TABLE surveys (
  id serial PRIMARY KEY,
  name varchar(255) NOT NULL,
  description VARCHAR(255),
  password varchar(255) NOT NULL,
  status INTEGER NOT NULL DEFAULT '0',
  email_verification_on integer DEFAULT '1',
  user_id integer REFERENCES users(user_id),
  open INTEGER NOT NULL DEFAULT '1',
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  is_deleted VARCHAR(10) DEFAULT 'no'
);

CREATE TABLE survey_answers (
  id serial PRIMARY KEY,
  survey_result_id integer NOT NULL,
  question_id integer NOT NULL,
  question_option_id integer NOT NULL,
  question_answer varchar(5000) NOT NULL,
  created date NOT NULL,
  modified date NOT NULL,
  is_deleted INTEGER  NOT NULL DEFAULT '0'
);

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

INSERT INTO `questions` (`id`, `survey_id`, `name`, `description`, `type`, `with_options`, `is_calculating`, `include_no_response`, `no_response_option`, `survey_theme_id`, `created`, `modified`, `is_deleted`) VALUES
(1, 88, 'Is making significant progress towards building-level school improvement.', NULL, 'likert', 1, 0, 0, '', 108, '2018-05-18', '2018-05-18', 'no'),


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
)

CREATE TABLE groups (
  id serial PRIMARY KEY,
  survey_id integer NOT NULL,
  name varchar(255) NOT NULL,
  description varchar(255) DEFAULT NULL,
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  status VARCHAR(15) NOT NULL,
  is_deleted VARCHAR(5) NOT NULL
);



/** still to add **/
CREATE TABLE `questions_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `score` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `respondent_passcodes` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `passcode` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




INSERT INTO `roles` (`role_id`, `name`, `created`, `updated`) VALUES
(1, 'admin', '2013-08-28 16:04:01', '2013-08-28 16:04:01'),
(2, 'user', '2013-08-28 16:04:10', '2013-08-28 16:04:10'),
(3, 'subscriber', '2016-06-23 00:00:00', '2016-06-23 00:00:00');




CREATE TABLE `survey_report_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `value` blob NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*postgres://fccczroxijlspx:b5d3146f1ff4b565a3c72f2ec3aa7dfade6aae3b4819d597b9e863b540e93c96@ec2-54-83-1-94.compute-1.amazonaws.com:5432/d9qqrpvoldsupj
{ ["scheme"]=> string(8) "postgres" ["host"]=> string(38) "ec2-54-83-1-94.compute-1.amazonaws.com" ["port"]=> int(5432) ["user"]=> string(14) "fccczroxijlspx" ["pass"]=> string(64) "b5d3146f1ff4b565a3c72f2ec3aa7dfade6aae3b4819d597b9e863b540e93c96" ["path"]=> string(15) "/d9qqrpvoldsupj" }*/

