$(document).ready(function() {

    var userList=[];
    
    $.getJSON('js/users.json', function (json) 
    {
        useReturnData (json);
    });
    
    function useReturnData(data)
    {
        userList = data;
        console.log(userList);
    }
    
    //obtain animals' names from url and inject into checkout fields
    var location = window.location.href;
    var animalsToUse;
    animalsPassed(location);
    function animalsPassed(str) {
        var lefter = str.indexOf("?") + 1;
        var righter = str.lastIndexOf("");
        var totalURL = (str.substring(lefter, righter));
        animalsToUse = (totalURL.split(","));
    }
    console.log(animalsToUse);
    // $("form").submit(function(e){
    //   e.preventDefault(); 
    // });

    //check to see if email exists in db of previously registered users
    $("#userSubmit").on("click", function(evnt)
    {
        var inputty = $("#checkoutEmail").val();
        var userLength = userList.length;
        var counter=0;
        
        for (var i = 0; i < userLength; i++)
        {
            if (inputty == userList[i].email)
            {
                counter++;
            }
        }
        //if it exists, proceed to checkout injection -- if not send to application
        if (counter > 0)
        {
            checkoutProceed();
            //alert("It exists!");
        }
        else 
        {
            applicationAdd();
        }
        
        evnt.preventDefault();
        
});

$( "#spaceForContent" ).on( "click", "#input-button", function(evnt) {
    evnt.preventDefault();
    $("#spaceForContent").empty();
    $("#spaceForContent").append("<h2>Thank you for your order!</h2><br><br><p>A representative will call you shortly to schedule an appointment for pickup!</p>");
});
    
    //inject checkout
    function checkoutProceed () 
    {
       $("#spaceForContent").empty();
       $("#spaceForContent").append("<h1>Checkout</h1><br><br><h4>Your total is $" + animalsToUse.length * 50 + ".00</h4>")
       $("#spaceForContent").append('<form onsubmit="return notSubmit();"><div class="form-container"><div class="personal-information"><h2>Payment Information</h2></div> <input class="replacement" id="input-field" type="text" name="streetaddress" required="required" autocomplete="on" maxlength="45" placeholder="Street Address"/> <input class="replacement"id="column-left" type="text" name="city" required="required" autocomplete="on" maxlength="20" placeholder="City"/> <input class="replacement"id="column-right" type="text" name="zipcode" required="required" autocomplete="on" pattern="[0-9]*" maxlength="5" placeholder="ZIP code"/> <input class="replacement"id="input-field" type="email" name="email" required="required" autocomplete="on" maxlength="40" placeholder="Email"/><div class="card-wrapper"></div> <input class="replacement"id="column-left" type="text" name="first-name" placeholder="First Name"/> <input class="replacement"id="column-right" type="text" name="last-name" placeholder="Surname"/> <input class="replacement"id="input-field" type="text" name="number" placeholder="Card Number"/> <input class="replacement"id="column-left" type="text" name="expiry" placeholder="MM / YY"/> <input class="replacement"id="column-right" type="text" name="cvc" placeholder="CCV"/> <input class="replacement"id="input-button" type="submit" value="Submit"/></form>');
       
    }
    
    //inject application with buttons to navigate forward in tabs
    function applicationAdd()
    {
        $("#spaceForContent").empty();
        $("#spaceForContent").append("<div id='app_tabs' class='container-fluid'><h3>I'm sorry, we don't recognize that e-mail as being registered with us. Please fill out an application below to proceed to checking out</h3><br> <br><h1>Application</h1><ul class='nav nav-tabs'><li id='app_1' class='active'><a data-toggle='pill' href='#page1'>Page 1</a></li><li id='app_2'><a data-toggle='pill' href='#page2'>Page 2</a></li><li id='app_3'><a data-toggle='pill' href='#page3'>Page 3</a></li><li id='app_4'><a data-toggle='tab' href='#page4'>Page 4</a></li></ul><div class='tab-content'><div id='page1' class='tab-pane fade in active'><h2>Personal Information</h2><br><form><p>First Name: <input type='text' name='firstname' placeholder=' First Name'></p><p> Last Name: <input type='text' name='lastname' placeholder=' Last Name'></p> <br><p> Address: <input type='text' name='address' placeholder=' Address'> City: <input type='text' name='city' placeholder='City'></p><p> State: <input type='text' name='state' placeholder='State'> Zip: <input type='text' name='zip' placeholder='Zip'></p> <br><p> E-mail: <input type='text' name='email' placeholder='E-mail'></p> <br><p> Primary Phone : <input type='text' name='phone' placeholder='(xxx) xxx- xxxx'></p><p> Date of Birth : <input type='text' name='dob' placeholder='dob'></p><p> Employer: <input type='text' name='employer' placeholder='Employer'> Work Phone: <input type='text' name='wphone' placeholder='(xxx) xxx-xxxx'></p> <br> <br> <button id='pg_1'type='button' class='btn'>Save and Continue</button></form></div><div id='page2' class='tab-pane fade'><h3>References</h3><form><p>Please list 3 references names and phone numbers</p> <br><p>Reference Name: <input type='text' name='reference1' placeholder='First Reference'> Phone :<input type='text' name='ref1phone' placeholder='(xxx) xxx-xxxx'></p> <br><p>Reference Name: <input type='text' name='reference1' placeholder='First Reference'> Phone :<input type='text' name='ref1phone' placeholder='(xxx) xxx-xxxx'></p> <br><p>Reference Name: <input type='text' name='reference1' placeholder='First Reference'> Phone :<input type='text' name='ref1phone' placeholder='(xxx) xxx-xxxx'></p> <br> <br> <button id='pg_2'type='button' class='btn'>Save and Continue</button></form></div><div id='page3' class='tab-pane fade'><h3>Household Information</h3><br><form><p>Have you ever adopted from us before?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>	If yes, do you still have the pet?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>	Will this be an inside or an outside companion?</p> <input type='radio' name='yesno'value='yes'> Inside<br> <input type='radio' name='yesno'value='no'> Outside<br></form><form><p>	Do you have a fenced yard?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>	Would you attend obedience training with your new pet?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>	Which age range are you looking for?</p> <input type='radio' name='yesno'value='yes'> 0-3<br> <input type='radio' name='yesno'value='no'> 3-6<br> <input type='radio' name='yesno'value='maybe'> 6+<br></form> <br> <br> <button id='pg_3'type='button' class='btn'>Save and Continue</button></div><div id='page4' class='tab-pane fade'><h3>Declarations</h3><form><p>Have you ever given up a pet to an adoption agency?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>Have you ever been convicted of any animal cruelty related crimes?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form><form><p>Have you ever had an animal taken from you due to negligence or other reasons?</p> <input type='radio' name='yesno'value='yes'> Yes<br> <input type='radio' name='yesno'value='no'> No<br></form> <button id='sub_final' type='button' class='btn'>Submit</button></div></div>");
    }
    
    //save and continue to page 2 of app
    $("#spaceForContent").on("click", "#pg_1", function()
    {
        $("#app_2").attr("class","active");
        $("#app_1").removeAttr("class", "active");
        $("#page1").removeAttr("class", "tab-pane fade active in");
        $("#page1").attr("class", "tab-pane fade");
        $("#page2").removeAttr("class", "tab-pane fade");
        $("#page2").attr("class", "tab-pane fade active in");
    });
    
    //save and continue to page 3 of app
    $("#spaceForContent").on("click", "#pg_2", function()
    {
        $("#app_3").attr("class","active");
        $("#app_2").removeAttr("class", "active");
        $("#page2").removeAttr("class", "tab-pane fade active in");
        $("#page2").attr("class", "tab-pane fade");
        $("#page3").removeAttr("class", "tab-pane fade");
        $("#page3").attr("class", "tab-pane fade active in");
    });
    
    //save and continue to page 4 of app
    $("#spaceForContent").on("click", "#pg_3", function()
    {
        $("#app_4").attr("class","active");
        $("#app_3").removeAttr("class", "active");
        $("#page3").removeAttr("class", "tab-pane fade active in");
        $("#page3").attr("class", "tab-pane fade");
        $("#page4").removeAttr("class", "tab-pane fade");
        $("#page4").attr("class", "tab-pane fade active in");
    });
    
    //submit and inject the checkout fields
    $( "#spaceForContent" ).on( "click", "#sub_final", function()
    {
        checkoutProceed();
    });
    
});