$(document).ready(function(){
    $(".bas").click(function(){
           $( ".info-content" ).toggle( "slow" );
           $(".bas").hide();
           $(".haut").show();
    });
    $(".haut").click(function(){
           $( ".info-content" ).toggle( "slow" );
           $(".bas").show();
           $(".haut").hide();
    });
    
    $('.ville_option').hide();
    
    $('.type_ville').on('change', function() {
        
       //var type = this.value; 
       
       if(this.value == 'ville'){
            $('.ville_option').show();
       } 
       else{
           $('.ville_option').hide();
       }
});
   
});
