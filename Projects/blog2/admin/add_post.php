<?php

session_start();

require 'connection.php';

if (!isset($_SESSION['id']))
{
    header("Location: index.php");
}

if (isset($_POST['post']))
{

    $message='';

    if (empty($_POST['title']))
    {
        $message.='Please enter a title!';
    }
    else if(empty($_POST['description']))
    {
        $message.='Please enter a description <br>';
    }
    else if (empty($_POST['content']))
    {
        $message.='Please enter content <br>';
    }
    else 
    {
            $title=$_POST['title'];
            $content=$_POST['content'];
            $postdesc=$_POST['description'];

            $sql = "INSERT INTO posts (title, cont, postdesc) VALUES (:title, :cont, :postdesc)";
            $stmt = $link->prepare($sql);

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':cont', $content);
            $stmt->bindParam(':postdesc', $postdesc);

            if ($stmt->execute() )
            {
                header("Location: postlist.php");
            }
            else 
            {
                die('failure');
            }
    }
}
    


?>

<!DOCTYPE html>
<html>
<head>
	<title>Create a Post</title>

	<meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>

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

    <?php 
        if(!empty($message))
        {
            echo "<div class='alert alert-danger'>".$message."</div>";
        }

    ?>

    <a style="margin:10px;" href='logout.php' class='btn btn-danger btn-lg pull-right'>Logout</a>

    <div class='container' id='contentMain'>

        <h1 class='mainPage'>Add a Post</h1>
    	<div class='container-fluid'>
    		<div class='col-sm-12 heading'>
                
                <form action='' method='post' enctype='mulipart/form-data'>
                    <div class='form-group'>
                        <label for='Title'>Title</label>
                        <input class='form-control' placeholder='Title' name='title' type='text' value="<?php echo ($_POST['title']);?>">
                    </div>
                    <div class='form-group'>
                        <label for='Description'>Description</label>
                        <input class='form-control' placeholder='Description' name='description' type='text' value="<?php echo ($_POST['description']); ?>">
                    </div>
                    <div class='form-group'>
                        <label for="post">Post</label>
                        <textarea class='form-control' rows='15' placeholder='Content' name='content' value="<?php echo ($_POST['content']); ?>"></textarea>
                    </div>

                    <input class='btn btn-primary btn-lg' name='post' type='submit' value='Post'>

                </form>



    		</div>
    	</div>
    </div>

</body>
</html>