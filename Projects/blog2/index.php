<?

require 'admin/connection.php';

//for email form
if ($_POST['submit'])
    {

        if (!$_POST['name'])
        {
            $error.='<br />Please enter your name!';
        }
        if (!$_POST['email'])
        {
            $error.='<br />Please enter your email!';
        }
        if (!$_POST['comment'])
        {
            $error.='<br />Please enter your comment!';
        }

        if ($_POST['email']!="" AND !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $error.='<br /> Please enter a valid email address!';
        }

        if ($error) 
        {
            $result='<div class="alert alert-danger"><strong>There were error(s)in your form:</strong> '.$error.'</div>';
        }
        else 
        {
            $emailTo= "henry.fording@gmail.com";
            $subject= "Incoming comment from Site";
            $body="".$_POST['name']." says: ".$_POST['comment']." From: ".$_POST['email'];
            $headers = "From: ".$_POST['email'];

            if (mail($emailTo, $subject, $body, $headers))
            {
                $result='<div class="alert alert-success"><strong>Thank you!</strong></div>';
            }

            else 
            {
                $result='<div class="alert alert-danger"><strong>Sorry, there was an error sending your message. Please try again later!</div>';
            }
        }
    }

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


    <div class='container' id='contentMain'>

        <h1 class='mainPage'>Please, enjoy my chronicles</h1>

        <div class="container-fluid blogList">
            <?php 
                $records = $link->prepare("SELECT * FROM posts ORDER BY id DESC");

                $records->execute();


                if (count($records) > 0)
                {
                    while ($row = $records->fetch(PDO::FETCH_ASSOC))
                    {
                                echo '<div class="col-sm-12 blogPost">';
                                    echo '<div class="col-sm-4">';
                                        if($row['img'] == NULL)
                                        {
                                            echo '<img class="img-responsive" src="admin/img/blog.jpg">';
                                        }
                                        else
                                        {
                                            echo '<img class="img-responsive" src="'.$row['img'].'">';
                                        }
                                    echo '</div>';
                                    echo '<div class="col-sm-8">';
                                        echo '<h2><a target="_blank" href="viewpost.php?id='.$row['id'].'">'.$row['title'].'</a></h2>';
                                        echo '<p>'.$row['postdesc'].' <a target="_blank" href="viewpost.php?id='.$row['id'].' ">   --Read More...</a></p>';
                                    echo "</div>";
                                    echo "</div>";
                    }

                    echo $posts;
                }

                else {
                    echo "No results";
                }



            ?>
        </div>
    </div>
    
    <?php echo $result?>

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
                  height="300"
                  frameborder="0" style="border:0"
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDJHmEmfBwA4QgqgUPtwMSCKpWt9Lpt20Q
                    &q=Space+Needle,Seattle+WA" allowfullscreen>
                </iframe>
            </div>
    </div>
</body>
</html>