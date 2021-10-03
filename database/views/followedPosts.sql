CREATE VIEW followed_posts_view AS
SELECT
    posts.id,
    posts.content,
    posts.photo_url,
    users.id as user_id,
    users.name as user_name,
    users.email as user_email,
    users.photo_uri as user_profile,
    posts.created_at as date,
  (
    SELECT
      count(*)
    FROM
      interactions
    WHERE
      interactions.post_id = posts.id
  ) as likes,
  	case WHEN comments.id IS NOT NULL THEN
         (group_concat(JSON_OBJECT(
    	'text', comments.comment,
    	'user_profile', commentsUsers.photo_uri,
    	'user_name', commentsUsers.name,
    	'user_id', commentsUsers.id,
    	'date', comments.created_at
    	)))
        ELSE null
END AS comments
FROM
  posts
  LEFT  JOIN comments ON posts.id = comments.post_id
  LEFT  JOIN users as commentsUsers ON comments.user_id = commentsUsers.id
  JOIN users ON posts.user_id = users.id
GROUP BY id, content, photo_url, users.id, users.name, users.email, users.photo_uri, posts.created_at;
