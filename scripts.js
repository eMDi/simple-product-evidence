$(document).ready(
    function(){
        $("#add_product_show_form").click(function () {
            $("#new_product").toggle();
        });
        $( "#add_product" ).submit(function( event ) {
          event.preventDefault();
          console.log('Ideme vkladat do DB.');
          var posting = $.post( "ajax/produkt.php", $( "#add_product" ).serialize() );

          posting.done(function( data ) {
            console.log(data);
            $("#input[name='product_name']").val('');
            $("#input[name='product_price']").val('');
            $("#textarea[name='product_desc']").val('');
            $("#submit_state").text( data );
          });
        });

    });
