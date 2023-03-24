<?php
require_once '../models/Post.php';

    // Start PHP session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['auth'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Posts</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Main Content-->
        <main class="mb-4 mt-5">

            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10">
                        <h2>Add Post</h2>
                        <div class="my-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">
                                            Action
                                            <!-- <a class="btn btn-primary" href="">New Post</a> -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <form method="POST" enctype="multipart/form-data">
                                            <td>
                                                <!-- <input class="form-control" name="id" type="number" placeholder="ID" /> -->
                                            </td>
                                            <td>
                                                <input class="form-control" name="title" type="text" placeholder="Title" />
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                <!-- <input class="form-control" name="content" type="text" placeholder="Content" /> -->
                                            </td>
                                            <td>
                                                <input class="form-control" name="img" type="file" placeholder="Image" />
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="submit">Add</button>
                                            </td>
                                        </form>
                                    </tr>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    

                    if (isset($_POST['title'])){


                        // $id = $_POST['id'];
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        // $imgUrl = $_POST['img'];

                        // $arr = ["id" => $id, "title" => $title, "content" => $content, "image" => $imgUrl];


                        // print_r($arr);
                        // $a = $GLOBALS['posts'];
                        

                        
                        // array_push($a, new Post((int)$id, $title, $content, $img));
                        // var_dump($a);

                        
                        $file = $_FILES['img'];
                        $fileName = $_FILES['img']['name'];
                        $fileTmpName = $_FILES['img']['tmp_name'];
                        $fileSize = $_FILES['img']['size'];
                        $fileError = $_FILES['img']['error'];
                        $fileType = $_FILES['img']['type'];
                    
                        // allowed extension
                        $fileExt = explode('.', $fileName);
                        $fileActualExt = strtolower(end($fileExt));

                        $allowed = array('jpg', 'jpeg', 'png');

                        if (in_array($fileActualExt, $allowed)){
                            if ($fileError === 0){
                                if($fileSize < 5000000) {
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    $fileDestination = '../assets/uploads/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName,
                                            $fileDestination);
                                } else {
                                    echo "Your file is too big!";
                                }
                            } else {
                                echo "There was an error uploading your file!";
                            }

                        } else {
                            echo "You cannot upload file of this type!";
                        }
                    

                        $_SESSION['posts'][] = new Post(count($_SESSION['posts']) + 1, $title, $content, $fileDestination);

                        header("Location: ./posts.php?uploadsuccess");
                        exit();
                        
                        }
                    ?>
                </div>
            </div>
        </main>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
