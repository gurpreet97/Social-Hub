-- during registration insert query for user

insert into user values (name,email,ph_no,dob,gender,password) (name,email,ph_no,dob,gender,password);

-- during registration insert query for page

insert into page values (pname,admin_name,email,ph_no,dob,gender,password) (pname,admin_name,email,ph_no,dob,gender,password);


-- during login check credentials

select password from user where email = email;

if(count==0)email is invalid
else if(count==1 && fetched_password==password)login successful

-- show names of all users

select name from user;

-- list of friends

select name from have_friend inner join user on have_friend.friend_id = user.user_id where have_friend.user_id = given_user_id

-- list of friend requests


select name from friend_request inner join user on friend_request.sent_by = user.user_id where friend_request.sent_to = given_user_id

-- show name of all pages

select pname from page;

-- show liked pages

select pname from user_like_page inner join page on user_like_page.page_id = page.page_id where user_id = given_user_id

-- page like

insert into user_like_page values (given_user_id,given_page_id)

-- page unlike

delete from user_like_page where user_id = given_user_id and page_id = given_page_id

-- user timeline

select * from user_post_creation inner join post on user_post_creation.post_id  = post.post_id where user_id = given_user_id and privacy <= given_privacy

-- page timeline

select * from page_post_creation inner join post on page_post_creation.post_id  = post.post_id where page_id = given_page_id

-- accept friend request

delete from friend_request where sent_to = given_user_id and sent_by = given_friend_id

insert into have_friend values (given_user_id,given_friend_id),(given_friend_id,given_user_id)

-- delete friend request

delete from friend_request where sent_to = given_user_id and sent_by = given_friend_id


-- unfriend 

delete from have_friend where user_id = given_user_id and friend_id = given_friend_id

delete from have_friend where user_id = given_friend_id and friend_id = given_user_id

-- send friend request

insert into friend_request values(given_user_id,given_sent_to_id)

-- user make post

insert into post values(given_post_id,given_post_text,given_post_heading,given_post_image)

insert into user_post_creation values(given_post_creation_id,given_user_id,given_post_id,current_time,given_privacy,"posted by given_user_name")

-- user share post

insert into user_post_creation values(given_post_creation_id,given_user_id,given_post_id,current_time,given_privacy,"shared from given_friend_name")


-- page post creation

insert into post values(given_post_id,given_post_text,given_post_heading,given_post_image)

insert into page_post_creation values(given_post_creation_id,given_page_id,given_post_id,current_time)


-- post story

insert into story values(given_story_id,story_text,story_heading,story_image,current_time)

insert into user_have_story values(given_user_id,given_story_id)

-- do comment

insert into comment values(given_comment_id,comment_content,given_user_id,given_creation_id)


-- like post

insert into like_post values(given_user_id,given_post_creation_id)


-- unlike post

delete from like_post where user_id = given_user_id and  creation_id = given_post_creation_id


-- delete comment

delete from comment where comment_id = given_comment_id and user_id = given_user_id

-- delete user post

delete from user_post_creation where post_creation_id = given_post_creation_id and user_id  = given_user_id

select count(*) from user_post_creation where post_id = given_post_id

if(count==0){
	delete from post where post_id = given_post_id
}


-- home

select * from user_post_creation where privacy = 'public' union select * from user_post_creation where privacy = 'friends' and name in(select friend_name from have_friend where name = $user ) union select * from user_post_creation where name  = $user;

select * from user_post_creation where privacy = 'public' or (privacy = 'friends' and name in(select friend_name from have_friend where name = $user ) ) or name  = $user order by post_creation_time desc;