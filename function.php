<?php 
session_start();
$conn = mysqli_connect("localhost","root","","Booking-tempat");

if(isset($_POST['addbooking'])){
    $data = mysqli_query($conn, "select * from customer");
    $fetch_tanggal = mysqli_fetch_array($data);
    $namacustomer = $fetch_tanggal['nama'];
    $tanggalmasuk = $fetch_tanggal['tanggalmasuk'];
    $tanggal_masuk_data = mysqli_query($conn, "select DATE_FORMAT(tanggalmasuk, '%Y-%m-%d') from customer");
    $tanggal_keluar_data = mysqli_query($conn, "select DATE_FORMAT(tanggalkeluar, '%Y-%m-%d') from customer");

    $nama = $_POST['namacustomer'];
    $tanggalmasuk = $_POST['tanggalmasuk'];
    $tanggalkeluar = $_POST['tanggalkeluar'];

    // if(!$tanggal_masuk_data && !$tanggal_keluar_data && !$namacustomer){
    //     $insert = mysqli_query($conn, "insert into customer(nama,tanggalmasuk,tanggalkeluar) values('$nama','$tanggalmasuk','$tanggalkeluar')");
    // }else if($namacustomer && $tanggal_masuk_data && $tanggal_keluar_data){
        
    // }
    // $cekdata = mysqli_query($conn, "select * from customer where ((tanggalmasuk>'$tanggalmasuk' and tanggalkeluar>'$tanggalmasuk') AND (tanggalmasuk>'$tanggalkeluar' and tanggalkeluar>'$tanggalkeluar')) OR ((tanggalmasuk<'$tanggalmasuk' and tanggalkeluar<'$tanggalmasuk') AND (tanggalmasuk<'$tanggalkeluar' and tanggalkeluar<'$tanggalkeluar'))");
    //     $hitungnum = mysqli_num_rows($cekdata);
    //     if($hitungnum>0){
    //         $insertcustomer = mysqli_query($conn, "insert into customer(nama,tanggalmasuk,tanggalkeluar) values('$nama','$tanggalmasuk','$tanggalkeluar')");
    //         if($insertcustomer){
    //             header('location:index.php');
    //         }else{
    //             header('location:test.php');
    //         }
    //     }
    $cekdata = mysqli_query($conn, "SELECT * FROM customer WHERE (tanggalmasuk <= '$tanggalmasuk' AND tanggalkeluar >= '$tanggalmasuk') OR (tanggalmasuk <= '$tanggalkeluar' AND tanggalkeluar >= '$tanggalkeluar') ");
        $hitungnum = mysqli_num_rows($cekdata);
        if($hitungnum<1){
            $insertcustomer = mysqli_query($conn, "insert into customer(nama,tanggalmasuk,tanggalkeluar) values('$nama','$tanggalmasuk','$tanggalkeluar')");
            if($insertcustomer){
                header('location:index.php');
            }else{
                header('location:test.php');
            }
        }
        else{
            echo '<script>alert("Ruangan sudah terisi");window.location.href="index.php";</script>';
        }
}

if(isset($_POST['hapusdata'])){
    $idc = $_POST['idc'];
    $hapusdata = mysqli_query($conn, "delete from customer where idcustomer='$idc'");
}
?>
