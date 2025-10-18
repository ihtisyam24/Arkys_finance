<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
//membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "finance");
if ($conn) {
}

//nambah gudang
if (isset($_POST['addnewoutlet'])) {
    $namaoutlet = $_POST['namaoutlet'];


    $addtable = mysqli_query($conn, "insert into outlet (namaoutlet) values('$namaoutlet')");
    if ($addtable) {
        header('location: gudang.php');
    } else {
        echo 'Masih Gagal';
        header('location: gudang.php');
    }
}

//nambah Laporan beban pokok
if (isset($_POST['addnewbeban'])) {
    $tanggal3 = $_POST['tanggal3'];
    $outlet3 = $_POST['outlet3'];
    $persediaanawal = $_POST['persediaanawal'];
    $belanjaproduksi = $_POST['belanjaproduksi'];
    $persediaanakhir = $_POST['persediaanakhir'];
    $persediaanakhirmurni = $_POST['persediaanakhirmurni'];
    $totalhargapokokpenjualan = $_POST['totalhargapokokpenjualan'];
    $labakotor = $_POST['labakotor'];
    $total = $_POST['total'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $totalhargapokokpenjualan = $persediaanawal + $belanjaproduksi + $persediaanakhirmurni;
    $labakotor = $total - $totalhargapokokpenjualan;


    $addtable = mysqli_query($conn, "insert into bebanpokokpenjualan (tanggal3, outlet3, persediaanawal, belanjaproduksi, persediaanakhir, persediaanakhirmurni, totalhargapokokpenjualan, labakotor, idoutlet) values('$tanggal3', '$outlet3', '$persediaanawal', '$belanjaproduksi', '$persediaanakhir', '$persediaanakhirmurni', '$totalhargapokokpenjualan', '$labakotor', $idoutlet)");
    if ($addtable) {
        header('location: bebanpokokpenjualan.php');
    } else {
        echo 'Masih Gagal';
        header('location: bebanpokokpenjualan.php');
    }
}

//nambah Biaya Operasional
if (isset($_POST['addnewbp'])) {
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $biayaoperasional = $_POST['biayaoperasional'];
    $biayasewabangunan = $_POST['biayasewabangunan'];
    $pln = $_POST['pln'];
    $pdam = $_POST['pdam'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $totalbp = $biayaoperasional + $biayasewabangunan + $pln + $pdam;

    $addtable = mysqli_query($conn, "insert into keuangan (tanggal2, outlet2, biayaoperasional, biayasewabangunan, pln, pdam, totalbp, gojek, grab, idoutlet) values('$tanggal2', '$outlet2', '$biayaoperasional', '$biayasewabangunan', '$pln', '$pdam', '$totalbp', '0', '0', $idoutlet)");
    if ($addtable) {
        header('location: pengeluaranops.php');
    } else {
        echo 'Masih Gagal';
        header('location: pengeluaranops.php');
    }
}

//update Biaya Operasional
if (isset($_POST['updatebp'])) {
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $biayaoperasional = $_POST['biayaoperasional'];
    $biayasewabangunan = $_POST['biayasewabangunan'];
    $pln = $_POST['pln'];
    $pdam = $_POST['pdam'];
    $idkeuangan = $_POST['idkeuangan'];

    $totalbp = $biayaoperasional + $biayasewabangunan + $pln + $pdam;

    $update = mysqli_query($conn, "update keuangan set tanggal2='$tanggal2', outlet2='$outlet2', biayaoperasional='$biayaoperasional', biayasewabangunan='$biayasewabangunan', pln='$pln', pdam='$pdam', totalbp='$totalbp' where idkeuangan='$idkeuangan'");
    if ($update) {
        header('location: pengeluaranops.php');
    } else {
        echo 'Gagal';
        header('location: pengeluaranops.php');
    }
}

//nambah Laporan Keuangan
if (isset($_POST['addnewkeuangan'])) {
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $shiftpagi = isset($_POST['shiftpagi']) ? $_POST['shiftpagi'] : 0;
    $shiftmalam = isset($_POST['shiftmalam']) ? $_POST['shiftmalam'] : 0;
    $debittransfer = isset($_POST['debittransfer']) ? $_POST['debittransfer'] : 0;
    $qris = isset($_POST['qris']) ? $_POST['qris'] : 0;
    $gojek = isset($_POST['gojek']) ? $_POST['gojek'] : 0;
    $grab = isset($_POST['grab']) ? $_POST['grab'] : 0;
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $total = $shiftpagi + $shiftmalam + $debittransfer + $qris + $gojek + $grab;

    $addtable = mysqli_query($conn, "insert into keuangan (tanggal2, outlet2, shiftpagi, shiftmalam, debittransfer, qris, gojek, grab, total, persediaanawal, belanjaproduksi, persediaanakhir, persediaanakhirmurni, totalhargapokokpenjualan, labakotor, biayaoperasional, biayasewabangunan, bebangaji, pln, pdam, wifi, bebanpajak, totalbp, lababersih, idoutlet) values('$tanggal2', '$outlet2', '$shiftpagi', '$shiftmalam', '$debittransfer', '$qris', '$gojek', '$grab', '$total', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', $idoutlet)");
    if ($addtable) {
        header('location: laporankeuangan.php');
    } else {
        echo 'Masih Gagal';
        header('location: laporankeuangan.php');
    }
}

//nambah barang
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $Harga = $_POST['Harga'];
    $stock = $_POST['stock'];
    $kategori = $_POST['kategori'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $addtable = mysqli_query($conn, "insert into stock (namabarang, keterangan, Harga, stock, kategori, idoutlet) values('$namabarang', '$keterangan', '$Harga', '$stock', '$kategori', $idoutlet)");
    if ($addtable) {
        header('location: stock.php');
    } else {
        echo 'Masih Gagal';
        header('location: stock.php');
    }
}

//nambah barang outlet
if (isset($_POST['addnewbarang1'])) {
    $namabarang1 = $_POST['namabarang1'];
    $keterangan1 = $_POST['keterangan1'];
    $stock1 = $_POST['stock1'];
    $kategori1 = $_POST['kategori1'];
    $Harga1 = $_POST['Harga1'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $addtable = mysqli_query($conn, "insert into stockoutlet (namabarang1, keterangan1, stock1, kategori1, Harga1, idoutlet) values('$namabarang1', '$keterangan1', '$stock1', '$kategori1', '$Harga1', $idoutlet)");
    if ($addtable) {
        header('location: stockoutlet.php');
    } else {
        echo 'Masih Gagal';
        header('location: stockoutlet.php');
    }
}

//nambah barang masuk
if (isset($_POST['addbarangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';
    // cek qty minus
    if ($qty <= 0) {
        echo "<script>alert('qty tidak valid.');document.location='/stokbarang/masuk.php'</script>";
        //header('location: masuk.php');
        return false;
    }
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;
    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty, penerima, idoutlet) values('$barangnya','$keterangan', '$qty','$penerima', $idoutlet)");
    $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    if ($addtomasuk && $updatestockmasuk) {
        header('location: masuk.php');
    } else {
        echo 'Masih Gagal';
        header('location: masuk.php');
    }
}

//nambah barang masuk1
if (isset($_POST['addbarangmasuk1'])) {
    $transaksi = $_POST['transaksi'];
    $barangnya1 = $_POST['barangnya1'];
    $keterangan1 = $_POST['keterangan1'];
    $qty1 = $_POST['qty1'];
    $outletasal = $_POST['outletasal'];
    $outlet = $_POST['outlet'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';
    // cek qty minus
    if ($qty1 <= 0) {
        echo "<script>alert('qty tidak valid.');document.location='/stokbarang/masukoutlet.php'</script>";
        //header('location: masukoutlet.php');
        return false;
    }
    $cekstocksekarang1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$barangnya1'");
    $ambildatanya1 = mysqli_fetch_array($cekstocksekarang1);
    $stocksekarang1 = $ambildatanya1['stock1'];
    $tambahkanstocksekarangdenganquantity1 = $stocksekarang1 + $qty1;
    $addtomasuk1 = mysqli_query($conn, "insert into masukoutlet (transaksi, idbarang1, keterangan1, qty1, outletasal, outlet, idoutlet) values('$transaksi', '$barangnya1','$keterangan1', '$qty1', '$outletasal', '$outlet', $idoutlet)");
    $updatestockmasuk1 = mysqli_query($conn, "update stockoutlet set stock1='$tambahkanstocksekarangdenganquantity1'where idbarang1='$barangnya1'");
    if ($addtomasuk1 && $updatestockmasuk1) {
        header('location: masukoutlet.php');
    } else {
        echo 'Masih Gagal';
        header('location: masukoutlet.php');
    }
}


//nambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';
    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatanya['stock'];
    if ($stocksekarang >= $qty) {
        //kalo cukup
        $tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;
        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, keterangan, qty, penerima, idoutlet) values('$barangnya','$keterangan', '$qty','$penerima', $idoutlet)");
        $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    } else {
        //kalau  barang cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi")
            window.location.href="keluar.php";
        </script>

        ';
    }
}

//nambah barang keluar1
if (isset($_POST['addbarangkeluar1'])) {
    $transaksi = $_POST['transaksi'];
    $barangnya1 = $_POST['barangnya1'];
    $keterangan1 = $_POST['keterangan1'];
    $qty1 = $_POST['qty1'];
    $outlet = $_POST['outlet'];
    $outlettujuan = $_POST['outlettujuan'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';
    $cekstocksekarang1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$barangnya1'");
    $ambildatanya1 = mysqli_fetch_array($cekstocksekarang1);
    $stocksekarang1 = $ambildatanya1['stock1'];
    if ($stocksekarang1 >= $qty1) {
        //kalo cukup
        $tambahkanstocksekarangdenganquantity1 = $stocksekarang1 - $qty1;
        $addtokeluar1 = mysqli_query($conn, "insert into keluaroutlet (idbarang1, transaksi, keterangan1, qty1, outlet, outlettujuan, idoutlet) values('$barangnya1', '$transaksi', '$keterangan1', '$qty1','$outlet', '$outlettujuan', $idoutlet)");
        $updatestockmasuk1 = mysqli_query($conn, "update stockoutlet set stock1='$tambahkanstocksekarangdenganquantity1'where idbarang1='$barangnya1'");
    } else {
        //kalau  barang cukup
        echo '
        <script>
            alert("Stock saat ini tidak mencukupi")
            window.location.href="keluaroutlet.php";
        </script>

        ';
    }
}

// update Laporan biaya operasional
if (isset($_POST['updatebp'])) {
    $idkeu = $_POST['idkeuangan'];
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $biayaoperasional = $_POST['biayaoperasional'];
    $biayasewabangunan = $_POST['biayasewabangunan'];
    $bebangaji = $_POST['bebangaji'];
    $pln = $_POST['pln'];
    $pdam = $_POST['pdam'];
    $wifi = $_POST['wifi'];
    $bebanpajak = $_POST['bebanpajak'];
    $totalbp = $_POST['totalbp'];

    $totalbp = $biayaoperasional + $biayasewabangunan + $bebangaji + $pln + $pdam + $wifi + $bebanpajak;

    // Update the database
    $update = mysqli_query($conn, "UPDATE keuangan SET tanggal2='$tanggal2', outlet2='$outlet2', biayaoperasional='$biayaoperasional', biayasewabangunan='$biayasewabangunan', bebangaji='$bebangaji', pln='$pln', pdam='$pdam', wifi='$wifi', bebanpajak='$bebanpajak', totalbp='$totalbp'  WHERE idkeuangan='$idkeu'");

    if ($update) {
        header('location: biayaoperasional.php');
    } else {
        echo 'Failed to update.';
        header('location: biayaoperasional.php');
    }
}


// update Laporan beban
if (isset($_POST['updatebeban'])) {
    $idkeu = $_POST['idkeuangan'];
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $persediaanawal = $_POST['persediaanawal'];
    $belanjaproduksi = $_POST['belanjaproduksi'];
    $persediaanakhir = $_POST['persediaanakhir'];
    $persediaanakhirmurni = $_POST['persediaanakhirmurni'];
    $totalhargapokokpenjualan = $_POST['totalhargapokokpenjualan'];
    $total = $_POST['total'];
    $labakotor = $_POST['labakotor'];

    $totalhargapokokpenjualan = $persediaanawal + $belanjaproduksi + $persediaanakhirmurni;
    $labakotor = $total - $totalhargapokokpenjualan;

    // Update the database
    $update = mysqli_query($conn, "UPDATE keuangan SET tanggal2='$tanggal2', outlet2='$outlet2', persediaanawal='$persediaanawal', belanjaproduksi='$belanjaproduksi', persediaanakhir='$persediaanakhir', persediaanakhirmurni='$persediaanakhirmurni', totalhargapokokpenjualan='$totalhargapokokpenjualan', total='$total', labakotor='$labakotor'  WHERE idkeuangan='$idkeu'");

    if ($update) {
        header('location: bebanpokokpenjualan.php');
    } else {
        echo 'Failed to update.';
        header('location: bebanpokokpenjualan.php');
    }
}

// update Laporan Keuangan
if (isset($_POST['updatekeuangan'])) {
    $idkeu = $_POST['idkeuangan'];
    $tanggal2 = $_POST['tanggal2'];
    $outlet2 = $_POST['outlet2'];
    $es_batu = $_POST['shiftpagi'];
    $galon = $_POST['shiftmalam'];
    $gas = $_POST['debittransfer'];
    $barang_lainya = $_POST['qris'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';

    $total = $es_batu + $galon + $gas + $barang_lainya;

    // Update the database
    $update = mysqli_query($conn, "UPDATE keuangan SET tanggal2='$tanggal2', outlet2='$outlet2', shiftpagi='$es_batu', shiftmalam='$galon', debittransfer='$gas', qris='$barang_lainya', total='$total', idoutlet='$idoutlet'  WHERE idkeuangan='$idkeu'");

    if ($update) {
        header('location: pengeluaranops.php');
    } else {
        echo 'Failed to update.';
        header('location: pengeluaranops.php');
    }
}

// update gudang
if (isset($_POST['updategudang'])) {
    $idot = $_POST['idoutlet'];
    $namaoutlet = $_POST['namaoutlet'];


    // Update the database
    $update = mysqli_query($conn, "UPDATE outlet SET namaoutlet='$namaoutlet'  WHERE idoutlet='$idot'");

    if ($update) {
        header('location: gudang.php');
    } else {
        echo 'Failed to update.';
        header('location: gudang.php');
    }
}


// update barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $stock = $_POST['stock'];

    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $Harga = $_POST['Harga'];




    // Update the database
    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', stock='$stock', kategori='$kategori', keterangan='$keterangan', Harga='$Harga'  WHERE idbarang='$idb'");

    if ($update) {
        header('location: stock.php');
    } else {
        echo 'Failed to update.';
        header('location: stock.php');
    }
}

// update barang2
if (isset($_POST['updatebarang2'])) {
    $idb1 = $_POST['idbarang1'];
    $namabarang1 = $_POST['namabarang1'];
    $stock1 = $_POST['stock1'];
    $Harga1 = $_POST['Harga1'];
    $kategori1 = $_POST['kategori1'];
    $keterangan1 = $_POST['keterangan1'];




    // Update the database
    $update = mysqli_query($conn, "UPDATE stockoutlet SET namabarang1='$namabarang1', stock1='$stock1', Harga1='$Harga1', kategori1='$kategori1', keterangan1='$keterangan1' WHERE idbarang1='$idb1'");

    if ($update) {
        header('location: stockoutlet.php');
    } else {
        echo 'Failed to update.';
        header('location: stockoutlet.php');
    }
}


// update barang3
if (isset($_POST['updatebarang3'])) {
    $idb1 = $_POST['idbarang1'];
    $namabarang1 = $_POST['namabarang1'];
    $stock1 = $_POST['stock1'];
    $stockfisik1 = $_POST['stockfisik1'];
    $kategori1 = $_POST['kategori1'];
    $keterangan1 = $_POST['keterangan1'];
    $stocksisa1 = $_POST['stocksisa1'];


    $stocksisa1 = $stockfisik1 - $stock1;


    // Update the database
    $update = mysqli_query($conn, "UPDATE stockoutlet SET namabarang1='$namabarang1', stockfisik1='$stockfisik1', stocksisa1='$stocksisa1', kategori1='$kategori1', keterangan1='$keterangan1' WHERE idbarang1='$idb1'");

    if ($update) {
        header('location: penyesuaianoutlet.php');
    } else {
        echo 'Failed to update.';
        header('location: penyesuaianoutlet.php');
    }
}

// update barang1
if (isset($_POST['updatebarang1'])) {
    $idb = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $stockfisik = $_POST['stockfisik'];
    $kategori = $_POST['kategori'];
    $keterangan = $_POST['keterangan'];
    $stocksisa = $_POST['stocksisa'];


    $stocksisa = $stockfisik - $stock;


    // Update the database
    $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', stockfisik='$stockfisik', stocksisa='$stocksisa', kategori='$kategori', keterangan='$keterangan' WHERE idbarang='$idb'");

    if ($update) {
        header('location: penyesuaian.php');
    } else {
        echo 'Failed to update.';
        header('location: penyesuaian.php');
    }
}

//hapus data gudang
if (isset($_POST['hapusgudang'])) {
    $idot = $_POST['idoutlet'];
    $hapus = mysqli_query($conn, "delete from outlet where idoutlet='$idot'");
    if ($hapus) {
        header('location: gudang.php');
    } else {
        echo 'Masih Gagal';
        header('location: gudang.php');
    }
}

//hapus data keuangan
if (isset($_POST['hapusdata'])) {
    $idkeu = $_POST['idkeuangan'];
    $hapus = mysqli_query($conn, "delete from keuangan where idkeuangan='$idkeu'");
    if ($hapus) {
        header('location: laporankeuangan.php');
    } else {
        echo 'Masih Gagal';
        header('location: laporankeuangan.php');
    }
}


//hapus data beban pokok
if (isset($_POST['hapusbeban'])) {
    $idbk = $_POST['idbebanpokok'];
    $hapus = mysqli_query($conn, "delete from bebanpokokpenjualan where idbebanpokok='$idbk'");
    if ($hapus) {
        header('location: bebanpokokpenjualan.php');
    } else {
        echo 'Masih Gagal';
        header('location: bebanpokokpenjualan.php');
    }
}

//hapus info barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idbarang'];
    $hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
    if ($hapus) {
        header('location: stock.php');
    } else {
        echo 'Masih Gagal';
        header('location: stock.php');
    }
}

//hapus info barang1
if (isset($_POST['hapusbarang1'])) {
    $idb1 = $_POST['idbarang1'];
    $hapus = mysqli_query($conn, "delete from stockoutlet where idbarang1='$idb1'");
    if ($hapus) {
        header('location: stockoutlet.php');
    } else {
        echo 'Masih Gagal';
        header('location: stockoutlet.php');
    }
}

//ubah (barang masuk) 
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];
    $qtysekarang = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    $tambahstock = $stocksekarang + ($qty - $qtysekarang);
    $nambahinstock = mysqli_query($conn, "update stock set namabarang='$namabarang', keterangan='$keterangan', stock='$tambahstock' where idbarang='$idb'");
    $updatenya = mysqli_query($conn, "update masuk set qty='$qty' where idmasuk='$idm'");
    if ($nambahinstock && $updatenya) {
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}

//ubah (barang masuk)1 
if (isset($_POST['updatebarangmasuk1'])) {
    $idb1 = $_POST['idbarang1'];
    $idm1 = $_POST['idmasuk1'];
    $namabarang1 = $_POST['namabarang1'];
    $keterangan1 = $_POST['keterangan1'];
    $qty1 = $_POST['qty1'];
    $outlet = $_POST['outlet'];
    $outlettujuan = $_POST['outlettujuan'];
    $lihatstock1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$idb1'");
    $stocknya1 = mysqli_fetch_array($lihatstock1);
    $stocksekarang1 = $stocknya1['stock1'];
    $qtysekarang1 = mysqli_query($conn, "select * from masukoutlet where idmasuk1='$idm1'");
    $qtynya1 = mysqli_fetch_array($qtysekarang1);
    $qtysekarang1 = $qtynya1['qty1'];
    $tambahstock1 = $stocksekarang1 + ($qty1 - $qtysekarang1);
    $nambahinstock1 = mysqli_query($conn, "update stockoutlet set namabarang1='$namabarang1', keterangan1='$keterangan1', stock1='$tambahstock1' where idbarang1='$idb1'");
    $updatenya1 = mysqli_query($conn, "update masukoutlet set qty1='$qty1' where idmasuk1='$idm1'");
    if ($nambahinstock1 && $updatenya1) {
        header('location:masukoutlet.php');
    } else {
        echo 'Gagal';
        header('location:masukoutlet.php');
    }
}

//hapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $qty = $_POST['qty'];
    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    $selisih = $stock - $qty;
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");
    if ($hapusdata) {
        header('location: masuk.php');
    } else {
        echo 'Masih Gagal';
        header('location: masuk.php');
    }
}

//hapus barang masuk1
if (isset($_POST['hapusbarangmasuk1'])) {
    $idb1 = $_POST['idbarang1'];
    $idm1 = $_POST['idmasuk1'];
    $qty1 = $_POST['qty1'];
    $getdatastock1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$idb1'");
    $data1 = mysqli_fetch_array($getdatastock1);
    $stock1 = $data1['stock1'];
    $selisih1 = $stock1 - $qty1;
    $hapusdata1 = mysqli_query($conn, "delete from masukoutlet where idmasuk1='$idm1'");
    if ($hapusdata1) {
        header('location: masukoutlet.php');
    } else {
        echo 'Masih Gagal';
        header('location: masukoutlet.php');
    }
}

//ubah (barang keluar) 
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];
    $qtysekarang = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    $tambahstock = $stocksekarang + ($qtysekarang - $qty);
    $nambahinstock = mysqli_query($conn, "update stock set stock='$tambahstock' where idbarang='$idb'");
    $updatenya = mysqli_query($conn, "update keluar set  keterangan='$keterangan', qty='$qty', penerima='$penerima' where idkeluar='$idk'");
    if ($nambahinstock && $updatenya) {
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
}

//ubah (barang keluar)1
if (isset($_POST['updatebarangkeluar1'])) {
    $idb1 = $_POST['idbarang1'];
    $idk1 = $_POST['idkeluar1'];
    $namabarang1 = $_POST['namabarang1'];
    $keterangan1 = $_POST['keterangan1'];
    $qty1 = $_POST['qty1'];
    $outlet = $_POST['outlet'];
    $outlettujuan = $_POST['outlettujuan'];
    $lihatstock1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$idb1'");
    $stocknya1 = mysqli_fetch_array($lihatstock1);
    $stocksekarang1 = $stocknya1['stock1'];
    $qtysekarang1 = mysqli_query($conn, "select * from keluaroutlet where idkeluar1='$idk1'");
    $qtynya1 = mysqli_fetch_array($qtysekarang1);
    $qtysekarang1 = $qtynya1['qty1'];
    $tambahstock1 = $stocksekarang1 + ($qtysekarang1 - $qty1);
    $nambahinstock1 = mysqli_query($conn, "update stockoutlet set stock1='$tambahstock1' where idbarang1='$idb1'");
    $updatenya1 = mysqli_query($conn, "update keluaroutlet set keterangan1='$keterangan1', qty1='$qty1', outlet='$outlet', outlettujuan='$outlettujuan' where idkeluar1='$idk1'");
    if ($nambahinstock1 && $updatenya1) {
        header('location:keluaroutlet.php');
    } else {
        echo 'Gagal';
        header('location:keluaroutlet.php');
    }
}

//hapus keluar     
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $namabarang = $_POST['namabarang'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    $selisih = $stock - $qty;
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");
    if ($hapusdata) {
        header('location: keluar.php');
    } else {
        header('location: keluar.php');
    }
}

//hapus keluar1     
if (isset($_POST['hapusbarangkeluar1'])) {
    $idb1 = $_POST['idbarang1'];
    $idk1 = $_POST['idkeluar1'];
    $namabarang1 = $_POST['namabarang1'];
    $keterangan1 = $_POST['keterangan1'];
    $qty1 = $_POST['qty1'];
    $getdatastock1 = mysqli_query($conn, "select * from stockoutlet where idbarang1='$idb1'");
    $data1 = mysqli_fetch_array($getdatastock1);
    $stock1 = $data['stock1'];
    $selisih1 = $stock1 - $qty1;
    $hapusdata1 = mysqli_query($conn, "delete from keluaroutlet where idkeluar1='$idk1'");
    if ($hapusdata1) {
        header('location: keluaroutlet.php');
    } else {
        header('location: keluaroutlet.php');
    }
}

//nambah po
if (isset($_POST['addpo'])) {
    $idbarang = $_POST['idbarang'];
    $kode_transaksi = $_POST['kode_transaksi'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $penerima = $_POST['penerima'];
    $Supplier = $_POST['Supplier'];
    $idoutlet = isset($_SESSION['idoutlet']) && !empty($_SESSION['idoutlet']) ? $_SESSION['idoutlet'] : 'NULL';
    $addtopo = mysqli_query($conn, "insert into po (idbarang, kode_transaksi, keterangan, qty, status, penerima, Supplier, idoutlet) values('$idbarang','$kode_transaksi','$keterangan', '$qty','$status','$penerima','$Supplier', $idoutlet)");
    if ($addtopo) {
        header('location: PO.php');
    } else {
        echo 'Masih Gagal';
        header('location: PO.php');
    }
}

//tambah
if (isset($_POST['adduser'])) {
    $em = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $idoutlet = !empty($_POST['idoutlet']) ? (int)$_POST['idoutlet'] : "NULL";

    $queryinsert = mysqli_query($conn, "insert into login (email, password, level, idoutlet) values ('$em','$password','$level', $idoutlet)");
    if ($queryinsert) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//update
if (isset($_POST['updateuser'])) {
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $level = $_POST['level'];
    $idnya = $_POST['id'];

    $idoutlet = !empty($_POST['idoutlet']) ? (int)$_POST['idoutlet'] : "NULL";

    $queryupdate = mysqli_query($conn, "update login set email='$emailbaru', password='$passwordbaru', level='$level', idoutlet='$idoutlet' where iduser='$idnya'");
    if ($queryupdate) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//hapus
if (isset($_POST['hapususer'])) {
    $id = $_POST['id'];
    $querydelete = mysqli_query($conn, " delete from login where iduser='$id' ");
    if ($queryinsert) {
        //jika berhasil
        header('location: keluser.php');
    } else {
        //gagal
        header('location:keluser.php');
    }
}

//approve
if (isset($_POST['approve'])) {
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $idpo = $_POST['idpo'];
    $idb = $_POST['idbarang'];
    $checkStock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $current_stock = mysqli_fetch_array($checkStock);
    $stocksekarang = $current_stock['stock'];
    $final_stock = $stocksekarang + $qty;
    $updatepo = mysqli_query($conn, "update po set penerima='$penerima',qty='$qty',Status='$status' where idpo='$idpo'");
    if ($updatepo && $updatestockmasuk) {
        header('location: PO.php');
    } else {
        echo 'Masih Gagal';
        header('location: PO.php');
    }
}

//hapus
if (isset($_POST['hapuspo'])) {
    $idpo = $_POST['idpo'];
    $querydelete = mysqli_query($conn, " delete from po where idpo='$idpo' ");
    if ($querydelete) {
        //jika berhasil
        header('location: PO.php');
    } else {
        //gagal
        header('location: PO.php');
    }
}

// Tambahkan fungsi ini ke dalam file function.php yang sudah ada

// Fungsi untuk validasi file upload
function validateUploadedFile($file, $allowedTypes = ['xlsx', 'xls', 'csv'], $maxSize = 5242880)
{ // 5MB default
    $errors = [];

    // Cek apakah file berhasil diupload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        switch ($file['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errors[] = "File terlalu besar. Maksimal " . ($maxSize / 1024 / 1024) . "MB";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errors[] = "File tidak terupload sempurna";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errors[] = "Tidak ada file yang dipilih";
                break;
            default:
                $errors[] = "Terjadi kesalahan saat upload file";
                break;
        }
        return $errors;
    }

    // Cek ukuran file
    if ($file['size'] > $maxSize) {
        $errors[] = "File terlalu besar. Maksimal " . ($maxSize / 1024 / 1024) . "MB";
    }

    // Cek ekstensi file
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedTypes)) {
        $errors[] = "Format file tidak didukung. Gunakan: " . implode(', ', $allowedTypes);
    }

    // Cek MIME type
    $allowedMimes = [
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        'xls' => ['application/vnd.ms-excel', 'application/excel'],
        'csv' => ['text/csv', 'application/csv', 'text/plain']
    ];

    $fileMime = mime_content_type($file['tmp_name']);
    $validMime = false;

    foreach ($allowedTypes as $type) {
        if (isset($allowedMimes[$type]) && in_array($fileMime, $allowedMimes[$type])) {
            $validMime = true;
            break;
        }
    }

    if (!$validMime) {
        $errors[] = "Jenis file tidak valid";
    }

    return $errors;
}

// Fungsi untuk log aktivitas import
function logImportActivity($conn, $user_id, $action, $details, $status = 'success')
{
    $timestamp = date('Y-m-d H:i:s');
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $action = mysqli_real_escape_string($conn, $action);
    $details = mysqli_real_escape_string($conn, $details);
    $status = mysqli_real_escape_string($conn, $status);

    // Jika tabel log tidak ada, buat dulu (opsional)
    $create_log_table = "
        CREATE TABLE IF NOT EXISTS import_log (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            action VARCHAR(100),
            details TEXT,
            status ENUM('success', 'error', 'warning') DEFAULT 'success',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";

    mysqli_query($conn, $create_log_table);

    $insert_log = "INSERT INTO import_log (user_id, action, details, status) 
                   VALUES ('$user_id', '$action', '$details', '$status')";

    return mysqli_query($conn, $insert_log);
}

// Fungsi untuk mencari barang berdasarkan nama (dengan fuzzy matching)
function findItemByName($conn, $searchName)
{
    $searchName = mysqli_real_escape_string($conn, trim($searchName));

    // Cari exact match dulu
    $exact_query = mysqli_query($conn, "SELECT idbarang, namabarang FROM stock WHERE namabarang = '$searchName'");
    if (mysqli_num_rows($exact_query) > 0) {
        return mysqli_fetch_array($exact_query);
    }

    // Cari dengan LIKE jika exact match tidak ditemukan
    $like_query = mysqli_query($conn, "SELECT idbarang, namabarang FROM stock WHERE namabarang LIKE '%$searchName%' LIMIT 1");
    if (mysqli_num_rows($like_query) > 0) {
        return mysqli_fetch_array($like_query);
    }

    return false;
}

// Fungsi untuk membersihkan data input
function cleanImportData($data)
{
    if (is_array($data)) {
        return array_map('cleanImportData', $data);
    }

    // Hapus spasi berlebih, karakter tidak terlihat, dan standardisasi
    $data = trim($data);
    $data = preg_replace('/\s+/', ' ', $data); // Ganti multiple spaces dengan single space
    $data = preg_replace('/[\x00-\x1F\x7F]/', '', $data); // Hapus control characters

    return $data;
}

// Fungsi untuk generate kode transaksi import
function generateImportCode($conn, $prefix = 'IMP')
{
    $date = date('Ymd');
    $random = rand(100, 999);
    $code = $prefix . '-' . $date . $random;

    // Pastikan kode unik (jika ada tabel untuk tracking)
    $check = mysqli_query($conn, "SELECT id FROM import_log WHERE details LIKE '%$code%'");
    if (mysqli_num_rows($check) > 0) {
        return generateImportCode($conn, $prefix); // Recursive jika ada duplikat
    }

    return $code;
}

// Fungsi untuk backup data sebelum import (opsional)
function backupTableBeforeImport($conn, $tableName)
{
    $backupTableName = $tableName . '_backup_' . date('Y_m_d_H_i_s');
    $backup_query = "CREATE TABLE $backupTableName AS SELECT * FROM $tableName";

    if (mysqli_query($conn, $backup_query)) {
        return $backupTableName;
    }

    return false;
}

// Fungsi untuk rollback jika import gagal
function rollbackImport($conn, $backupTableName, $originalTableName)
{
    // Hapus tabel asli
    mysqli_query($conn, "DROP TABLE IF EXISTS $originalTableName");

    // Rename backup menjadi tabel asli
    $restore_query = "RENAME TABLE $backupTableName TO $originalTableName";

    return mysqli_query($conn, $restore_query);
}

// Fungsi untuk validasi data barang masuk
function validateBarangMasukData($data)
{
    $errors = [];

    // Validasi nama barang
    if (empty($data['namabarang'])) {
        $errors[] = "Nama barang tidak boleh kosong";
    }

    // Validasi keterangan
    if (empty($data['keterangan'])) {
        $errors[] = "Keterangan tidak boleh kosong";
    }

    // Validasi quantity
    if (empty($data['qty']) || !is_numeric($data['qty']) || $data['qty'] <= 0) {
        $errors[] = "Jumlah harus berupa angka positif";
    }

    // Validasi penerima
    if (empty($data['penerima'])) {
        $errors[] = "Penerima tidak boleh kosong";
    }

    return $errors;
}
