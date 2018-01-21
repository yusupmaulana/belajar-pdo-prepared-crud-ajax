<?php
require_once "core/init.php";
require_once "templates/header.php";
?>

    <h1>Artikel Pertama</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><br>

    <form>
      <textarea name="textarea_komentar" id="textarea_komentar" rows="8" cols="80"></textarea><br>
      <input type="submit" name="submit_komentar" id="submit_komentar" value="Submit">
    </form><br>
    <div id="komentar_wrapper">
        <?php
          $rows = tampilkan();
          // die(var_dump($rows));
          foreach($rows as $row){ ?>
            <p class="komentar_text" id="komentar_<?=$row['id_komentar']?>" data-id="<?=$row['id_komentar']?>"><?=$row['isi_komentar']?></p>
              <button type="button" class="hapus_komentar" data-id="<?=$row['id_komentar']?>">Hapus</button>
              <button type="button" class="edit_komentar" data-id="<?=$row['id_komentar']?>">Edit</button>
        <?php  } ?>
    </div>

    <script>
      $(document).ready(function(){
        $('#submit_komentar').click(function(){
          event.preventDefault();
          var text = $('#textarea_komentar').val();
          // console.log(text);
          $.ajax({
            method: "POST",
            url:    "komentar_ajax.php",
            data:   {isi_komentar: text, type:"insert"},
            success: function(data){
              // console.log(data);
              if( data == '0'){
                alert("anda harus login!");
              }else{
                $('#textarea_komentar').val("");
                $('#komentar_wrapper').prepend(data);
              }
            }
          });
        });

        $(document).on('click', '.hapus_komentar', function(){
          var id = $(this).attr('data-id');
          // console.log(id);
          $.ajax({
            method: "POST",
            url:    "komentar_ajax.php",
            data:   {id_komentar: id, type:"delete"},
            success: function(data){
              console.log(data);
              if(data == '0'){
                alert("anda harus login!");
              }else if(data == '1'){
                $("#komentar_"+id).fadeOut();
              }
            }
          });
        });

        $(document).on('click','.komentar_text', function(){
          var id = $(this).attr('data-id'); /*console.log(id);*/
          var textbox = $(document.createElement('textarea')).attr('id','textarea_'+id);
          $(this).replaceWith(textbox);
        });

        $(document).on('click','.edit_komentar', function(){
          var id = $(this).attr('data-id');
          var isi = $('#textarea_'+id).val();
          var text = $(document.createElement('p')).attr({
                      'class':'komentar_text',
                      'id':'komentar_'+id,
                      'data-id':id
          }).text(isi);
          
        
          $.ajax({
            method:  "POST",
            url:     "komentar_ajax.php",
            data:    { id_komentar: id, isi_komentar: isi, type:"update" },
            success: function(data){
              console.log(data);
              if( data == '0'){
                alert('anda harus login!');
              }else if( data == '1' ){
                $('#textarea_'+id).replaceWith(text);
              }
            }
          });
        });
      });
    </script>

<?php require_once "templates/footer.php"; ?>
