$(document).ready(function() {
    
    //globals for animal selection
    let animals;
    let counter = 0;
    let cartTotal = 0;
    let selected = [];
    let species = "all";
    let sex = "all";
    
    
    //since github.pages is static, load data from local json
    $.getJSON('js/animals.json', function (json) {
        useReturnData(json);
    });
    
    //store .getJSON/ajax request to be searched below
    function useReturnData(data){
        animals = data;
        insertAnimals(sex, species);
    }
    
    //determine sex and species of radios on click
    $('input[name="species"]').on('click change', function() {
        species = this.value;
        insertAnimals(sex, species);
    });
    
    $('input[name="sex"]').on('click change', function() {
        sex = this.value;
        insertAnimals(sex, species);
    });
    
    //insert animals into 'fill' div depending on criteria
    function insertAnimals(sex, species){
        //empty the current content injected in html doc
        $(".fill").empty();
        
        //injection of animals into page
        let arrLength = animals.length;
        for (let i = 0; i < arrLength; i++)
        {
            if (species == 'all' && sex == animals[i].sex)
            {
                let animalName = "<span><b>Name: </b><a href='"+animals[i].url+"' target='_blank'>" + animals[i].name + "</a></span></br>";
                let animalSpecies ="<span><b>Species: </b>" + animals[i].species + "</span><br>";
                let animalSex = "<span><b>Sex: </b>" + animals[i].sex + "</span><br>";
                let animalSize= "<span><b>Size: </b>" + animals[i].size + "</span><br>";
                let petImage = "<img src='img/"+animals[i].img+"' height='140' width='105'><br>";
                let button = "<button id= '" +animals[i].name +"'class='btn btn-primary' value='"+animals[i].name+"'> Adopt </button>";
                
                $(".fill").append("<div class='col-sm-4 col-xs-6 animalTable'>" +petImage + animalName + animalSpecies + animalSex + animalSize + button +" </div>");
            
            }
            else if (species == animals[i].species && sex == 'all')
            {
                let animalName = "<span><b>Name: </b><a href='"+animals[i].url+"' target='_blank'>" + animals[i].name + "</a></span></br>";
                let animalSpecies ="<span><b>Species: </b>" + animals[i].species + "</span><br>";
                let animalSex = "<span><b>Sex: </b>" + animals[i].sex + "</span><br>";
                let animalSize= "<span><b>Size: </b>" + animals[i].size + "</span><br>";
                let petImage = "<img src='img/"+animals[i].img+"' height='140' width='105'><br>";
                let button = "<button id= '" +animals[i].name +"'class='btn btn-primary' value='"+animals[i].name+"'> Adopt </button>";
                
                $(".fill").append("<div class='col-sm-4 col-xs-6 animalTable'>" +petImage + animalName + animalSpecies + animalSex + animalSize + button +" </div>");
            }
            else if (species == animals[i].species && sex == animals[i].sex)
            {
                let animalName = "<span><b>Name: </b><a href='"+animals[i].url+"' target='_blank'>" + animals[i].name + "</a></span></br>";
                let animalSpecies ="<span><b>Species: </b>" + animals[i].species + "</span><br>";
                let animalSex = "<span><b>Sex: </b>" + animals[i].sex + "</span><br>";
                let animalSize= "<span><b>Size: </b>" + animals[i].size + "</span><br>";
                let petImage = "<img src='img/"+animals[i].img+"' height='140' width='105'><br>";
                let button = "<button id= '" +animals[i].name +"'class='btn btn-primary' value='"+animals[i].name+"'> Adopt </button>";
                
                $(".fill").append("<div class='col-sm-4 col-xs-6 animalTable'>" +petImage + animalName + animalSpecies + animalSex + animalSize + button +" </div>");
            }
            else if (species == 'all' && sex == 'all')
            {
                let animalName = "<span><b>Name: </b><a href='"+animals[i].url+"' target='_blank'>" + animals[i].name + "</a></span></br>";
                let animalSpecies ="<span><b>Species: </b>" + animals[i].species + "</span><br>";
                let animalSex = "<span><b>Sex: </b>" + animals[i].sex + "</span><br>";
                let animalSize= "<span><b>Size: </b>" + animals[i].size + "</span><br>";
                let petImage = "<img src='img/"+animals[i].img+"' height='140' width='105'><br>";
                let button = "<button id= '" +animals[i].name +"'class='btn btn-primary' value='"+animals[i].name+"'> Adopt </button>";
                
                $(".fill").append("<div class='col-sm-4 col-xs-6 animalTable'>" +petImage + animalName + animalSpecies + animalSex + animalSize + button +" </div>");
            }
        }
        
    }
    
    
    //function for adding animals to cart checkout
    $( ".fill" ).on( "click", "button", function() {
        
        //disable button selected
        $(this).prop("disabled",true);
        
        //add to cart total and multiply by flat fee of $50
        counter =+ counter + 1;
        cartTotal = counter * 50;
        
        //inject animal name into cart
        $(".cd-cart-items").append("<li><span class='cd-qty'>1x - </span>" + $(this).val() + "<div class='cd-price'>$50.00</div><a href='#0' class='cd-item-remove' id='"+$(this).val()+"'></a></li>");
        
        //empty and place price total into cart total
        $(".cd-cart-total").empty();
        $(".cd-cart-total").append("<p> Total <span>" + cartTotal + ".00</span></p>")
        
        selected.push($(this).val());
        
        
         //insert checkout button based on animals
        $("#checkoutLocation").empty();
        $("#checkoutLocation").append("<a href='checkout.html?"+ selected +"' class='checkout-btn'> Checkout</a>");
        //console log worked. now iterate through animals and display proper attributes in cart
        
    });
    
    //for removal of items from cart
    $(".cd-cart-items").on("click", ".cd-item-remove", function () {
        
        //re-enable button in main page content
        let animalRemove = this.id;
        $(".fill").find("#" + animalRemove).prop("disabled", false);
        
        //remove li from list of cart items and update cart count and total
        $(this).parents('li').remove();
        counter = counter - 1;
        cartTotal = counter * 50;
        
        //empty total and refresh
        $(".cd-cart-total").empty();
        $(".cd-cart-total").append("<p> Total <span>" + cartTotal + ".00</span></p>");
        
        //update the animals selected to be pushed through to next page
        let index = selected.indexOf(this.id);
        if (index > -1)
        {
            selected.splice(index,1);
            console.log(selected);
        }
        
        $("#checkoutLocation").empty();
        $("#checkoutLocation").append("<a href='checkout.html?"+ selected +"' class='checkout-btn'> Checkout</a>");
        
    });
    
    
    
});
