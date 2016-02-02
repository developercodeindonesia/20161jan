<?php

class pagingBukuall{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=books-halaman-1><< First</a> | 
                    <a href=books-halaman-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=books-halaman-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=books-halaman-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=books-halaman-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=books-halaman-$next>Next ></a> | 
                     <a href=books-halaman-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



class pagingBest{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=best-halaman-1><< First</a> | 
                    <a href=best-halaman-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=best-halaman-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=best-halaman-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=best-halaman-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=best-halaman-$next>Next ></a> | 
                     <a href=best-halaman-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



class pagingNew{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=new-halaman-1><< First</a> | 
                    <a href=new-halaman-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=new-halaman-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=new-halaman-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=new-halaman-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=new-halaman-$next>Next ></a> | 
                     <a href=new-halaman-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



class pagingResensi{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=resensi-halaman-1><< First</a> | 
                    <a href=resensi-halaman-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=resensi-halaman-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=resensi-halaman-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=resensi-halaman-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=resensi-halaman-$next>Next ></a> | 
                     <a href=resensi-halaman-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



class pagingBlog{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=blog-halaman-1><< First</a> | 
                    <a href=blog-halaman-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=blog-halaman-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=blog-halaman-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=blog-halaman-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=blog-halaman-$next>Next ></a> | 
                     <a href=blog-halaman-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}



class pagingByKategori{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
	if(empty($_GET['halaman'])){
		$posisi=0;
		$_GET['halaman']=1;
	}
	else{
		$posisi = ($_GET['halaman']-1) * $batas;
	}
	return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=media.php?module=detailKategori&id=$_GET[id]&halaman=1><< First</a> | 
                    <a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$next>Next ></a> | 
                     <a href=media.php?module=detailKategori&id=$_GET[id]&halaman=$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}


?>