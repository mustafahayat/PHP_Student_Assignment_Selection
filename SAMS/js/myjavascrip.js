$(document).ready(function(){
    
    $("a.delete").click(function(){
        var result = confirm("Do You Readlly Want to Delete The Record?");
        if(!result){
            event.preventDefault();
        }
    });
 
});