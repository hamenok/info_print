jQuery(document).ready(function() {
    
    var $wrapper = $('.js-tags-wrapper');
    $wrapper.on('click', '.js-tags-add', function(e) {
        e.preventDefault();
        
        // Get the data-prototype explained earlier
        var prototype = $wrapper.data('prototype');
        // get the new index
        var index = $wrapper.data('index');
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);
        // increase the index with one for the next item
        $wrapper.data('index', index + 1);
        // Display the form in the page before the "new" link
        $(this).before(newForm);
        
    });

   $('.js-tags-wrapper').on('click', function(e) {
        if (e.target.classList.contains("btn-close")){
            e.preventDefault();
            let item = e.target.parentNode;
            item.remove();
        }
    })

    $('#sendcomment').on('click', function (e) {
        e.preventDefault();
        let $form = $('form');
        let $url =  $('#sendcomment').attr( 'url' );
        
        $.ajax({
            type: "POST",
            url: $url ,
            data: $form.serialize(),
            cache: false,
            success: function (response) {
                $('.panel-body').load(window.location + ' .panel-body > *');
                $('form textarea').val('');
               
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    $('body').on('click','#heart_img', function(){
    
        $(this).animate({ width: "15px" }, 100);
        $(this).animate({ width: "20px" }, 100);

        let $url =  $('#heart_img').attr( 'url' );
        
        $.ajax({
            type: "POST",
            url: $url ,
            cache: false,
            success: function (response) {
                $('.like').load(window.location + ' .like > *');
            },
            error: function (response) {
                console.log(response);
            }
        });
    }); 

    $('body').on('click','.paginations', function(e){
       
        e.preventDefault();
        $page = $('.paginations a').attr('href'); 
        $.ajax({
            type: "POST",
            url: $page,
            cache: false,
            success: function (response) {
                $('.last_item').load($page + ' .last_item > *');
            },
            error: function (response) {
                console.log(response);
            }
        
    });
            
            
        
    
});
    
    



});
