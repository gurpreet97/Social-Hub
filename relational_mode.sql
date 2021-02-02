create database s_media;
use s_media;



create table user(user_id int primary key auto_increment,
				   name varchar(50) unique not null,
				   email varchar(100) not null,
				   ph_no varchar(20),
				   dob date,
				   gender varchar(20),
				   dp longblob,
				   password varchar(250) not null);


create table page(page_id int primary key auto_increment,
				   pname varchar(50) unique not null,
				   admin_name varchar(50) not null,
				   email varchar(100) not null,
				   ph_no varchar(20),
				   dob date,
				   gender varchar(20),
				   dp longblob,
				   password varchar(250) not null);


create table post(post_id varchar(200)  not null primary key, 
		post_text text,
		post_heading text,
		post_image longblob);

create table story(story_id varchar(200) not null primary key, 
		story_text text,
		story_heading text,
		story_image longblob,
		start_time datetime);


create table comment(comment_id varchar(200) not null primary key, 
			comment_content text,
			name varchar(50) , 
			creation_id varchar(200),
			foreign key(name) references user(name));

create table user_post_creation(post_creation_id varchar(200) not null primary key,
						name varchar(50) not null,
						post_id varchar(200) not null,
						post_creation_time datetime,
						privacy varchar(20) not null,
						creation_type varchar(20),
						foreign key(post_id) references post(post_id),
						foreign key(name) references user(name));

create table page_post_creation(post_creation_id varchar(200) not null primary key,
						pname varchar(50) not null,
						post_id varchar(200) not null,
						post_creation_time datetime,
						foreign key(post_id) references post(post_id),
						foreign key(pname) references page(pname));







create table have_friend(name varchar(50) not null,
						 friend_name varchar(50) not null,
						 foreign key(name) references user(name),
						 foreign key(friend_name) references user(name),
						 primary key(name,friend_name));


create table friend_request(sent_by varchar(50),
						 	sent_to varchar(50),
						 	foreign key(sent_by) references user(name),
						 	foreign key(sent_to) references user(name),
						 	primary key(sent_by,sent_to));


create table user_have_story(name varchar(50) not null,
							 story_id varchar(200),
							 foreign key(name) references user(name),
						 	 foreign key(story_id) references story(story_id),
						 	 primary key(name,story_id));


create table page_have_story(pname varchar(50) not null,
							 story_id varchar(200),
							 foreign key(pname) references page(pname),
						 	 foreign key(story_id) references story(story_id),
						 	 primary key(pname,story_id));


create table like_post(name varchar(50) not null,
					   creation_id varchar(200),
					   foreign key(name) references user(name),
					   primary key(name,creation_id));


create table user_like_page(name varchar(50) not null,
						 	pname varchar(50) not null,
						    foreign key(name) references user(name),
						    foreign key(pname) references page(pname),
						    primary key(name,pname));