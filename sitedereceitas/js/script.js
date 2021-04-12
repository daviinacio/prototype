var delay = 1000;

$(function(){
    $('.receita').click(function(e){
        $('.receita').css('display', 'none');
        $(e.currentTarget).addClass('selected');
        
        $('figure').animate({ width: "84%" }, delay, function(){
            $('figure').css('margin', 'auto');
        });
        
        $('form').css('display', 'block');
    });
    
    $('a').click(function(){
        $('.receita').css('display', 'block');
        $('.receita').removeClass('selected');
        
        $('figure').animate({ width: "35%" }, delay, function(){
            $('figure').css('margin', 'auto');
        });
        
        $('form').css('display', 'none');
    });
    
    $('#send').click(function(){
        
    });
});