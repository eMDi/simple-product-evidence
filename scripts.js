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
            var data = jQuery.parseJSON(data);
            if(data[code] == 'OK') {
              $("#submit_state").text('Produkt uspesne pridany');
              $("#input[name='product_name']").val('');
              $("#input[name='product_price']").val('');
              $("#textarea[name='product_desc']").val('');
              $("#product_list").prepend('<div class="produkt" id="produkt_'+data[inserted]+'"><span class="nazov">'+data[nazov]+'</span><span class="popis">'+data[popis]+'</span><span class="cena">'+data[cena]+'</span><span class="akcie"><a class="edit" href="#">edit</a></span></div>');
            } else {
              $("#submit_state").text('Produkt sa nepodarilo pridat'+data[text]);
            }

          });
        });

    });
