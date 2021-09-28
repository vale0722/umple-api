CREATE VIEW followed_posts_view AS
SELECT posts.id,
       posts.content,
       posts.photo_url,
       users.id                                as user_id,
       users.name                              as user_name,
       users.email                             as user_email,
       users.photo_uri                         as user_profile,
       users.created_at                        as date,
       (SELECT count(*)
        FROM interactions
        WHERE interactions.post_id = posts.id) as likes,
       (SELECT count(*)
        FROM comments
        WHERE comments.post_id = posts.id)     as comments
FROM posts JOIN users ON posts.user_id = users.id;
