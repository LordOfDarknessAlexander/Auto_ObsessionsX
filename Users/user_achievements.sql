
-- Table structure for table `User achievements`
create table user_achievements(
  achievement_id int not null auto_increment, 
  user_id int not null,
  date timestamp,
  remark varchar(100),
  primary key (achievement_id)
 
);
