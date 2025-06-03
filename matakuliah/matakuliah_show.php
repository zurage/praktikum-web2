<div class="card">
    <div class="card-header">
        <strong>Data Mata Kuliah</strong>
    </div>

    <div class="card-body">
        <form action="?page=matakuliah-show" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukan Kode atau Nama Mata Kuliah..." name="keyword">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="search">Cari !</button>
                </div>
            </div>
        </form>

        <a href="?page=matakuliah-add" class="btn btn-primary mb-2">Tambah Data</a>
        <a href="../matakuliah/matakuliah_print.php" target="_blank" class="btn btn-success mb-2">Cetak Data</a>

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover m-0">
                <?php
                $limit = 5;
                $page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
                $mulai = ($page > 1) ? ($page * $limit) - $limit : 0;

                $query = mysqli_query($con, "SELECT * FROM matakuliah LIMIT $mulai, $limit") or die(mysqli_error($con));
                ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $keyword = trim($_POST['keyword']);
                        if (!empty($keyword)) {
                            $query = mysqli_query($con, "SELECT * FROM matakuliah WHERE kode LIKE '%$keyword%' OR nama LIKE '%$keyword%'");
                        }
                    }

                    $no = $mulai + 1;
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['kode']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['sks']; ?></td>
                            <td><?= $data['semester']; ?></td>
                            <td>
                                <a class="btn btn-sm btn-success" href="?page=matakuliah-edit&id=<?= $data['id']; ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="../matakuliah/matakuliah_delete.php?id=<?= $data['id']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>

        <?php
        $result = mysqli_query($con, "SELECT * FROM matakuliah");
        $total_records = mysqli_num_rows($result);
        ?>

        <p>Jumlah Data : <?= $total_records; ?></p>

        <nav class="mb-5">
            <ul class="pagination justify-content-end">
                <?php
                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 1;
                $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

                if ($page == 1) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>';
                } else {
                    $link_prev = $page - 1;
                    echo '<li class="page-item"><a class="page-link" href="?page=matakuliah-show&halaman=1">First</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=matakuliah-show&halaman=' . $link_prev . '">&laquo;</a></li>';
                }

                for ($i = $start_number; $i <= $end_number; $i++) {
                    $active = ($page == $i) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=matakuliah-show&halaman=' . $i . '">' . $i . '</a></li>';
                }

                if ($page == $jumlah_page) {
                    echo '<li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>';
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    $link_next = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="?page=matakuliah-show&halaman=' . $link_next . '">&raquo;</a></li>';
                    echo '<li class="page-item"><a class="page-link" href="?page=matakuliah-show&halaman=' . $jumlah_page . '">Last</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>