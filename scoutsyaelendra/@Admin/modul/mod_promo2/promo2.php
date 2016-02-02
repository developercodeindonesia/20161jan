<?php
$aksi="modul/mod_promo2/aksi_promo2.php";
$sql=mysql_query("SELECT * FROM mod_page WHERE id_page='15'");
$s=mysql_fetch_array($sql);
   echo "<h2 class='hLine'>Edit Promo</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=promo2&act=update>
          <table class='list'>";
   echo "<tr>
  <td  class='left' valign='middle'>Judul Halaman</td> 
  <td class='left'><input type=text name='judul' size=60 value='$s[judul]'> </td>
  </tr>
     </tr>
     </table>
    ";

  echo  "<tr>
      <td class='left' colspan=2>
      <textarea name='isi_halaman' id='jogmce' style='height:400px;'>$s[isi]</textarea>
      <input class='butt' type=submit value=Update>
            <input class='butt' type=button value=Batal onclick=self.history.back()></td></tr>
         </form>";
?>