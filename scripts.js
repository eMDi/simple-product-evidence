$(document).ready(
    function(){
        $("#add_product_show_form").click(function () {
            $("#new_product").toggle();
        });
        $( "#new_product" ).submit(function( event ) {
          event.preventDefault();

          var posting = $.post( "ajax/produkt.php", $( "#new_product" ).serialize() );

          posting.done(function( data ) {
            console.log(data);
            $("#input[name='product_name']").val('');
            $("#input[name='product_price']").val('');
            $("#textarea[name='product_desc']").val('');
            $("#submit_state").text( data );
          });
        });

    });
