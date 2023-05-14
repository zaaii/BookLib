<?php
function addFavorite(id_buku, id_user) {
   $.ajax({
      url: 'addFavorite.php',
      type: 'POST',
      data: {id_buku: id_buku, id_user: id_user},
      success: function(response) {
         alert('Book added to favorites');
      },
      error: function(xhr, status, error) {
         alert(xhr.responseText);
      }
   });
}