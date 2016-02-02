<?php
//session_start();
 if (empty($_SESSION['namaadmin']) AND empty($_SESSION['leveladmin'])){
 echo "<script>window.alert('Untuk mengakses modul anda harus login!');window.location=('../../index.php');</script>";
}
else{
  $aksi="modul/mod_banner/aksi_banner.php";
  switch($_GET['act'])
  {
    // Tampilkan banner
    default:
      echo "<h2 class='hLine'>Edit Banner</h2> ";
      echo "<input class=butt type=button value='Tambah Banner' 
            onclick=\"window.location.href='?module=banner&act=tambahbanner';\">
            <table class='list'><thead>
            <tr>
            <td class='left'>no.</td>
			<td class='left'>thumbnail</td>
            <td class='left'>nama</td>
            <td class='left'>url</td>
            <td class='center' colspan='2'>aksi</td>
            </tr></thead><tbody>"; 
	//paging
    $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    $url = "?module=$_GET[module]&";
    $limit = 10;
    $startpoint = ($page * $limit) - $limit;     
    $table = "mod_banner";
	
      $tampil=mysql_query("SELECT * FROM mod_banner  ORDER BY id_banner ASC LIMIT {$startpoint}, {$limit}");
      $no= $startpoint+1;
      while ($r=mysql_fetch_array($tampil)){
         echo "<tr>
				<td class='left' width='25'>$no.</td>
				<td class='center' width='120'><img src='../joimg/banner/$r[gambar]' width=150' height='90' /></td>
				<td class='left'>$r[judul]</td>
				<td class='left'>$r[url]</td>
				<td width='30'>
					<a href=?module=banner&act=editbanner&id=$r[id_banner]><img src='images/add-icon.gif' title='edit' /></a> </td>
				<td width='30'>
					<a href='$aksi?module=banner&act=hapus&id=$r[id_banner]&file=$r[gambar]'><img src='images/hr.gif' title='hapus' /></a> 
				</td>
               </tr>";
        $no++;
      }
      echo "</tbody></table>";
	   echo pagination($table,$limit,$page, $url);
      break;
	  
	  // Tambah banner iklan
	  case "tambahbanner";
	  echo "<h2 class='hLine'>Tambah Banner</h2>";
	  
      echo "<form method=POST action='$aksi?module=banner&act=input' enctype='multipart/form-data'>";
      echo "<table class='list'><tbody>";
      
      echo "<tr>
              <td class='left'>Judul</td>
              <td class='left'> : <input type=text size='50' name='judul' /></td>
            </tr>
			<tr>
				<td class='left'>Url</td>
				<td class='left'> : <input type=text size='50' name='url' /><i>*Masukan link url tanpa http:// ( www.domain.com atau domain.com )</i></td>
			</tr>";
		
			
      echo "<tr>
              <td class='left'>Banner</td>
              <td class='left'> <input type=file name='fupload' size=80></td>
              </tr>
            <tr>
              <td class='left' colspan=2>
              <p><small>*Ukuran lebar banner 260 pixel. Format *.Jpeg/jpg, *.png, *.gif </small></p>
              <input class=butt type=submit name=submit value=Simpan>
              <a href=media.php?module=banner><input class=butt type=button value=Batal></a>  </td>
            </tr>";
      echo "</tbody></table></form>";
	  break;
	  
	  // detail dan edit
	  case "editbanner";
	    
		$detil=mysql_query("SELECT * FROM mod_banner WHERE id_banner='$_GET[id]'");
		$d=mysql_fetch_array($detil);
		
		echo "<h2><a title='Back to list' href='?module=$_GET[module]'>Banner </a> &raquo; $d[judul]</h2>";
        
		echo "<form method=POST enctype='multipart/form-data' action=$aksi?module=banner&act=update>
              <input type=hidden name=idbanner value='$d[id_banner]'>
              <table class='list'><tbody>
              <tr>
                <td class='left'>Judul</td>
                <td valign='top' class='left'><input type=text size='50' name='judul' value='$d[judul]'></td>
              </tr>
			  <tr>
				<td class='left'>Url</td>
				<td valign='top' class='left'><input type='text' size='50' name='url' value='$d[url]' /></td>
			  </tr>"; 
			 echo "<tr>
               <td class='left'>Banner thumb</td> 
               <td valign='top' class='left'> <img src='../joimg/banner/$d[gambar]' width='150' height='90'/></td>
              </tr>
              <tr>
                <td class='left'>Ganti Banner</td>
                <td valign='top' class='left'> <input type=file name='fupload' size=50>
              <p><small>*Ukuran lebar banner 260 pixel. Format *.Jpeg/jpg, *.png, *.gif </small></p></td>
              </tr>";
       
        echo "<tr>
                <td class='left'>
				<input class=butt type=submit value=Update>
				<a href=media.php?module=home><input class=butt type=button value=Selesai></a>
                </td>
				<td class='right'><a href=media.php?module=banner><input class=butt type=button value=Kembali></a>  
                </td>
              </tr>
              </tbody></table></form>";
		break;
	  
  }//end switch

}//end else
?>
