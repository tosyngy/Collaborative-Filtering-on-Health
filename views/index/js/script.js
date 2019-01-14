$(function(){
   $(document).on('click', '.sym-sub', function () {
        var txt=$(this).text();
           $('.openmo').trigger('click'); 
        $.post("http://localhost/CollaborativeFilteringHealthSystem/expert/index.php", {doc:txt}, function (response) {
            $('.suggest-doc .row').replaceWith("<div class='row' data-toggle='modal' data-target='#mymodal'>"+response+"</div>");
        });
    }); 
} )