/*Added*/
CREATE TABLE survey_answers (
  id SERIAL PRIMARY KEY,
  name varchar(255) NOT NULL,
  question_id int NOT NULL,
  score int NOT NULL,
  is_deleted int NOT NULL DEFAULT '0',
  created date NOT NULL,
  modified date NOT NULL
);

CREATE TABLE survey_questions (
  id SERIAL PRIMARY KEY,
  survey_id int NOT NULL,
  question_id int NOT NULL,
  name varchar(5000) NOT NULL,
  description varchar(255) DEFAULT NULL,
  type varchar(50) DEFAULT NULL,
  with_options int NOT NULL DEFAULT '1',
  is_calculating int NOT NULL DEFAULT '1',
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  is_deleted VARCHAR(10) NOT NULL DEFAULT 'no'
);

CREATE TABLE survey_dimension (
  id SERIAL PRIMARY KEY,
  name varchar(255) NOT NULL,
  survey_id int NOT NULL,
  dimension_id int NOT NULL
);

CREATE TABLE survey_groups (
  id serial PRIMARY KEY,
  name varchar(255) NOT NULL,
  survey_id integer NOT NULL,
  group_id integer NOT NULL
);

CREATE TABLE dimension (
  id int NOT NULL,
  name varchar(255) NOT NULL,
  description text NOT NULL,
  icon varchar(255) NOT NULL,
  is_deleted int NOT NULL DEFAULT '0',
  created date NOT NULL,
  modified date NOT NULL
);

INSERT INTO dimension (id, name, description, icon, is_deleted, created, modified) VALUES
(1, 'Leadership', 'intended to measure leadership skills.', '', 0, '2018-05-22 10:16:35', '2018-05-22 04:57:33'),
(2, 'Relationship', 'intended to measure relationship with peers.', '', 0, '2018-05-22 10:16:35', '2018-05-22 04:57:33'),
(3, 'Management', 'intended to measure management skills.', '', 0, '2018-05-22 10:16:35', '2018-05-22 04:57:33'),
(4, 'Vision', '', '', 0, '2018-05-22 10:16:35', '2018-05-22 04:57:33'),
(5, 'Knowledge', 'intended to measure knowledge of the person on the given subject', '', 0, '2018-05-22 10:16:35', '2018-05-22 04:57:33');


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
  survey_group_id integer NOT NULL,
  question_id integer NOT NULL,
  question_option_id integer NOT NULL,
  question_answer varchar(5000) NOT NULL,
  question_value integer NOT NULL,
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

CREATE TABLE questions ( //standard_questions
  id SERIAL PRIMARY KEY,
  name varchar(5000) NOT NULL,
  dimension int NOT NULL,
  with_options integer NOT NULL DEFAULT '1',
  is_calculating integer NOT NULL DEFAULT '1',
  created date DEFAULT NULL,
  modified date DEFAULT NULL,
  is_deleted integer NOT NULL
);


INSERT INTO questions (id, name, with_options, is_calculating, dimension, created, modified, is_deleted) VALUES
(1, 'Works to understand their industry and contribute to its evolution through their company work.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(2, 'Communicates the school vision and strategies and helps their team to better understand how they contribute to the achievement of Company goals.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(3, 'Leaders encourage staff to constructively challenge educational practice.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(4, 'School leaders demonstrate an interest in, and an accountability for student learning outcomes.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(5, 'School leaders build relationships based on trust, collegiality and mutual respect.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(6, 'Leaders improve the school through an understanding of the schools strengths and weaknesses.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(7, 'School leaders ensure that all members of the school community are treated fairly.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(8, 'School leaders effectively implement change processes which result in improved student learning outcomes.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(9, 'Leaders ensure that all groups within the school community develop the statement of schools purpose.', 1, 1, 1, '2018-05-18', '2018-05-18', 0),
(10, 'Staff, parents and students are encouraged to take leadership roles at the school.', 1, 1, 1, '2018-05-18', '2018-05-18', 0);
(11, 'Treat the student with respect.', 1, 1, 2, '2018-05-18', '2018-05-18', 0),
(12, 'Help student and work together.', 1, 1, 2, '2018-05-18', '2018-05-18', 0),
(13, 'Models a respectful behavior.', 1, 1, 2, '2018-05-18', '2018-05-18', 0),
(14, 'Enthusiastic about teaching and communicate this to students.', 1, 1, 2, '2018-05-18', '2018-05-18', 0),
(15, 'Has an open door policy.', 1, 1, 2, '2018-05-18', '2018-05-18', 0),
(16, 'Able to teach all the subjects effectively.', 1, 1, 3, '2018-05-18', '2018-05-18', 0),
(17, 'Able to implement curriculum and performance standards.', 1, 1, 3, '2018-05-18', '2018-05-18', 0),
(18, 'Has an effective classroom management.', 1, 1, 3, '2018-05-18', '2018-05-18', 0),
(19, 'Address the academic needs of students who speak English as a second language.', 1, 1, 3, '2018-05-18', '2018-05-18', 0),
(20, 'Address the academic needs of students with different ethnic or cultural backgrounds.', 1, 1, 3, '2018-05-18', '2018-05-18', 0),
(21, 'Very committed on teaching.', 1, 1, 4, '2018-05-18', '2018-05-18', 0),
(22, 'Think about students as individuals, and not stereotype them as part of some group.', 1, 1, 4, '2018-05-18', '2018-05-18', 0),
(23, 'Communicates the schools vision and goals to the students.', 1, 1, 4, '2018-05-18', '2018-05-18', 0),
(24, 'Develops teaching techniques for students success.', 1, 1, 4, '2018-05-18', '2018-05-18', 0),
(25, 'Attend staff meetings to discuss the vision and mission of the school.', 1, 1, 4, '2018-05-18', '2018-05-18', 0)
(26, 'Attend courses/workshops to further developed teaching techniques.', 1, 1, 5, '2018-05-18', '2018-05-18', 0),
(27, 'Has a clear knowledge and understanding to the subject fields.', 1, 1, 5, '2018-05-18', '2018-05-18', 0),
(28, 'Knowledge and understanding of the instructional practices in subject fields.', 1, 1, 5, '2018-05-18', '2018-05-18', 0),
(29, 'Motive student to participate in school activities.', 1, 1, 5, '2018-05-18', '2018-05-18', 0);



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
CREATE TABLE questions_options (
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

(Status == 0) ? STOP : START;
