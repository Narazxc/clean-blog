<?php

    // Start PHP session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['auth'])) {
        header("Location: ../index.php");
        exit();
    }

class Post {

    public function __construct(
        public int $id,
        public String $title,
        public String $content,
        public String $imageUrl
    ) {}
}

if (!isset($_SESSION['posts'])) {
    $_SESSION['posts'] = [
        new Post(1, 'Post 1', 'Content 1', 'https://fastly.picsum.photos/id/123/300/200.jpg?hmac=kXYDwT491zyy8kdoIlZfMs-IUzLA5VTv6DKX2dq5MO0'),
        new Post(2, 'Post 2', 'Content 2', 'https://fastly.picsum.photos/id/123/300/200.jpg?hmac=kXYDwT491zyy8kdoIlZfMs-IUzLA5VTv6DKX2dq5MO0'),
        new Post(3, 'Post 3', 'Content 3', 'https://fastly.picsum.photos/id/123/300/200.jpg?hmac=kXYDwT491zyy8kdoIlZfMs-IUzLA5VTv6DKX2dq5MO0')
    ];
}

?>