<?php
$aksi="modul/mod_profil/aksi_profil.php";
$sql=mysql_query("SELECT * FROM mod_page WHERE id_page='2'");
$s=mysql_fetch_array($sql);
   echo "<h2 class='hLine'>Edit Profil</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=profil&act=update>
          <table class='list'>";
   echo "<tr>
  <td  class='left' valign='middle'>Judul Halaman</td> 
  <td class='left'><input type=text name='judul' size=60 value='$s[judul]'> </td>
  </tr>
   <tr>
      <td width=100 class='left'>Banner</td>
      <td valign='top' class='left'> <img src='../joimg/banner/s_$s[gambar]' width='150' height='90'/></td>
              </tr>
              <tr>
                <td class='left'>Ganti Banner</td>
                <td valign='top' class='left'> <input type=file name='fupload' size=50></td>
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