<?

require 'admin/connection.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Hank's Blog</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="admin/css/styles.css" type="text/css">
</head>
<body>

    <div class='container-fluid contentContainer' id='topContainer'>
        <div class='col-sm-12' id='topRow'>
            <h1 class='marginTop white'>Hankthew's Blog</h1>
            <p class='lead white'>Write. Coffee. Repeat.</p>
        <div id='hankPic'></div>
        </div>
    </div>

    <div class='container'>

        <div class='col-sm-12 postContent'>

            <?php 
                $id = $_GET['id'];
                
                $records= $link->prepare("SELECT * FROM posts WHERE id = :id");
                $records->bindParam(':id', $id);

                $records->execute();


                if(count($records) > 0);
                {
                    while ($row = $records->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<div class="container" id="contentMain">';
                            echo '<div class="col-sm-12">';
                                echo '<h1>'.$row['title'].'</h2>';
                            echo '</div>';
                            echo '<div class="col-sm-8 col-sm-offset-2 viewpostContent">'.$row['cont'].'</div>';
                        echo '</div>';


                    }
                }

            ?>

        </div>

    </div>

    <div class='container-fluid col-sm-12 footer'>


            <div class='col-sm-12 col-md-6 emailForm'>
            <h3>Contact Me!</h3>

            <p class='lead'>Just email me below, and I'll get back to you as soon as I can!</p>

            <form method='post'>

                <div class='form-group'>

                    <label for='name'>Your Name:</label>
                    <input type='text' value="<?php echo $_POST['name']; ?>" name='name' class='form-control' placeholder="Your Name">

                </div>
                <div class='form-group'>

                    <label for='email'>Your Email:</label>
                    <input type='email' value="<?php echo $_POST['email']; ?>" name='email' class='form-control' placeholder="Your Email">

                </div>
                <div class='form-group'>

                    <label for='comment'>Your Comment:</label>
                    <textarea class='form-control' name='comment'><?php echo $_POST['comment']; ?></textarea>

                </div>

                <input type='submit' name='submit' class='btn btn-success btn-lg' value='Submit'>

            </form>

        </div>

            <div class='col-sm-12 col-md-6'>
                <h3>This is where I live</h3>
                <iframe 
                  width="400"
                  height="250"
                  frameborder="0" style="border:0"
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDJHmEmfBwA4QgqgUPtwMSCKpWt9Lpt20Q
                    &q=Space+Needle,Seattle+WA" allowfullscreen>
                </iframe>
            </div>
    </div>

</body>
</html>