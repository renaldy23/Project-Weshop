<?php
    $no=1;

    $pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

    $data_halaman = 3;
    $mulai = ($pagination-1)*$data_halaman; 
      
    $queryAdmin = mysqli_query($koneksi, "SELECT * FROM user ORDER BY nama ASC LIMIT $mulai, $data_halaman");
      
    if(mysqli_num_rows($queryAdmin) == 0)
    {
        echo "<h3>Saat ini belum ada data user yang dimasukan</h3>";
    }
    else
    {
        echo "<table class='table-list'>";
          
            echo "<tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Nama</th>
                    <th class='kiri'>Email</th>
                    <th class='kiri'>Phone</th>
                    <th class='kiri'>Level</th>
                    <th class='tengah'>Status</th>
                    <th class='tengah'h>Action</th>
                 </tr>";
  
            while($rowUser=mysqli_fetch_array($queryAdmin))
            {
                echo "<tr>
                        <td class='kolom-nomor'>$no</td>
                        <td>$rowUser[nama]</td>
                        <td>$rowUser[email]</td>
                        <td>$rowUser[phone]</td>
                        <td>$rowUser[level]</td>
                        <td class='tengah'>$rowUser[status]</td>
                        <td class='tengah'><a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=user&action=form&user_id=$rowUser[user_id]"."'>Edit</a></td>
                     </tr>";
              
                $no++;
            }
          
        //AKHIR DARI TABLE
        echo "</table>";

        $queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM user");
        $total_data = mysqli_num_rows($queryHitungKategori);
        $total_halaman = ceil($total_data/$data_halaman);


        echo "<ul class='pagination'>";
            for ($i=1; $i<=$total_halaman; $i++) { 
                if ($pagination == $i) {
                    echo "<li><a class='active' href='".BASE_URL."index.php?page=my_profile&module=user&action=list&pagination=$i'>$i</a></li>";
                }
                else{
                    echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=user&action=list&pagination=$i'>$i</a></li>";
                }
                
            }
        echo "</ul>";
    }
?>