$(document).ready(function() {
    
    let trivia,
    questionNum,
    correctAnswers = 0,
    count = 1,
    randomNumber;
    
    
    //since github.pages is static, load data from local json
    $.getJSON('js/trivia.json', function (json) {
        useReturnData (json);
    });
    //store .getJSON/ajax request in letiable to be searched below
    function useReturnData(data){
        trivia = data;
        console.log(trivia);
        
        //obtain number of questions
        questionNum = trivia.length;
        //obtain random number to display random question
        randomNumber = randomRange(questionNum);
        //display random question when ?s have loaded from ajax call
        displayQuestion(trivia, randomNumber);
    }
    
    //random number function
    function randomRange(number) {
            return Math.floor(Math.random() * (number - 1));
        }

    //display question
    function displayQuestion (trivia, randomNumber) {
        $("#triviaArea").append("<div>" + trivia[randomNumber].question + "</div>");
    }
    
    //evaluate user's answer for correctness
    $(".submittal").click(function () {
        
        $(this).prop("disabled",true);
        let originalAnswer = $("#userAnswer").val();
        
        let userAnswer = originalAnswer.toLowerCase();
        //console.log(userAnswer);
        //console.log(questionNum);
        
        if (userAnswer == trivia[randomNumber].answer)
        {
            $("#feedbackArea").append("<h2>Correct!</h2>");
            correctAnswers += 1;
            console.log(correctAnswers);
            count += 1;
        }
        else 
        {
            $("#feedbackArea").append("<h3>" + trivia[randomNumber].wrongresponse + "</h3>");
            count+= 1;
        }
        
        if (count == 10) 
        {
            $(".nextOne").prop("disabled", true);
            $("#feedbackArea").empty();
            $("#tryAgain").append("<h2>You got " + correctAnswers + " out of 10 correct!</h2><br>");
            $("#tryAgain").append("<button class='tryAgain btn-primary'>Try Again?</button>");
        }
        
    });
    
    //next question
    $(".nextOne").click(function () {
            
            //enable submit button
            $(".submittal").prop("disabled", false);
            //get rid of feedback
            $("#feedbackArea").empty();
            
            //reset input area to blank
            let resetText = "";
            $("#userAnswer").val(resetText);
            
            //empty question area
            $("#triviaArea").empty();
            
            //update count
            $(".questionCount").empty();
            $(".questionCount").append("" + count + "/10");
            
            //obtain random number to display random question
            randomNumber = randomRange(questionNum);
            //display random question when ?s have loaded from ajax call
            displayQuestion(trivia, randomNumber);
            
    });
    
     $( "#tryAgain" ).on( "click", ".tryAgain", function () {
            
            correctAnswers = 0;
            count = 1;
            $(".questionCount").empty();
            $(".questionCount").append("" + count + "/10");
            
            $("#tryAgain").empty();
            $(".nextOne").prop("disabled", false);
            $(".submittal").prop("disabled", false);
            
            let resetText = "";
            $("#userAnswer").val(resetText);
            
             //empty question area
            $("#triviaArea").empty();
            
            //obtain random number to display random question
            randomNumber = randomRange(questionNum);
            //display random question when ?s have loaded from ajax call
            displayQuestion(trivia, randomNumber);
            
     });
});