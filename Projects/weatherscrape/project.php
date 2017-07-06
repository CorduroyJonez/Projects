<!doctype html>
<html>
<head>
    <title>Example Domain</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>

        html, body {
            height:100%;
            min-height:100%;
        }

        .container {
            background-image:url('img.jpg');
            width:100%;
            height:100%;
            background-size:cover;
            background-position:center;
            padding-top:115px;
            min-height:100%;
        }
    
        .center {
            text-align:center;
        }

        .white {
            color:white;
        }

        p {
            padding-top:15px;
            padding-bottom:15px;
        }

        button {
            margin-top:15px;
        }

        .alert {
            margin-top:20px;
            display:none;
            font-weight:bold;
        }


    </style>
     
</head>
<body>

    <div class='container'>

        <div class='col-md-6 col-md-offset-3 center'>
            <h1 class='center white'>Weather Predictor</h1>
            <p class='lead center white'>Enter your city below to get a forecast of the weather</p>
            <form>
                <div class='form-group'>
                    <input type='text' class='form-control' name='city' id='city' placeholder='Eg. London, Paris, San Francisco'>
                </div>
                <button id='findWeather' class='btn btn-success btn-lg'>Find My Weather</button>
            </form>

            <div id='success' class='alert alert-success'></div>
            <div id='fail' class='alert alert-danger'>Could not find weather data for that city. Please try again!</div>
            <div id='noCity' class='alert alert-danger'>Please enter a city!</div>
        </div>


    </div>

<script>

    $('#findWeather').click(function (event){

        event.preventDefault();

        $('.alert').hide();

        if ($('#city').val()!="")
        {
            //ajax call to scraper.php and obtain the $matches variable it echoes
            $.get('scraper.php?city='+$('#city').val(), function(data){


                if (data.includes("Warning")==true)
                {
                    $('#fail').fadeIn();
                }
                else 
                {
                    //put in alert div that appears below button
                    $('#success').html(data).fadeIn();
                }

            });

        }
        else {
            $('#noCity').fadeIn();
        }
    });

</script>
</body>
</html>