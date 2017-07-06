<?php

session_start();

require 'connection.php';

if (!isset($_SESSION['id']))
{
    header("Location: index.php");
}

if (($_GET['id']) == 'delete')
{
    $message= '<div class="alert alert-danger">Post successfully deleted!</div>';
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Postlist</title>

	<meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css" type="text/css">
</head>
<body>

    <div class='container-fluid contentContainer' id='topContainer'>

        <div class='col-sm-12' id='topRow'>

            <h1 class='marginTop white'>Hankthew's Blog</h1>
            <p class='lead white'>Write. Coffee. Repeat.</p>
            
        <div id='hankPic'></div>
        </div>

    </div>

    <a style="margin:10px;" href='add_post.php' class='btn btn-success btn-lg pull-left'>Add Post</a>

    <a style="margin:10px;" href='logout.php' class='btn btn-danger btn-lg pull-right'>Logout</a>


    <div class='container' id='contentMain'>

        <h1 class='mainPage'>Please, enjoy my chronicles</h1>
            <?php 

                echo $message;
                
                $records = $link->prepare("SELECT * FROM posts ORDER BY id DESC");

                $records->execute();


                if (count($records) > 0)
                {
                    while ($row = $records->fetch(PDO::FETCH_ASSOC))
                    {
                            echo '<div class="container-fluid blogList">';
                                echo '<div class="col-sm-12 blogPost">';
                                    echo '<div class="col-sm-4">';
                                        if($row['img'] == NULL)
                                        {
                                            echo '<img class="img-responsive" src="img/blog.jpg">';
                                        }
                                        else
                                        {
                                            echo '<img class="img-responsive" src="'.$row['img'].'">';
                                        }
                                    echo '</div>';
                                    echo '<div class="col-sm-8">';
                                        echo '<h2><a href="../viewpost.php?id='.$row['id'].'">'.$row['title'].'</a></h2>';
                                        echo '<p>'.$row['postdesc'].'  <a href="../viewpost.php?id='.$row['id'].'">Read More...</a></p>';
                                        echo '<span class="pull-right spanners">';
                                            echo '<a href="del_post.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                                            echo '<a href="edit_post.php?id='.$row['id'].'">Edit</a>';
                                        echo '</span>';
                                    echo "</div>";
                                echo "</div>";


                                        
                                //     echo '<h1><a href="viewpost.php?id='.$row['id'].'">'.$row['title'].'</a></h1>';
                                //     echo '<p>'.$row['desc'].'</p>';                
                                //     echo '<p><a href="viewpost.php?id='.$row['cont'].'">Read More</a></p>';                
                                // echo '</div>';
                    }

                    echo $posts;
                }

                else {
                    echo "No results";
                }



            ?>
    </div>

</body>
</html>