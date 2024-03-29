<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Landing</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-info text-light border-bottom border-dark">
        <div class="container">
            <h2 class="navbar-brand" href="index.php">Website Gallery Foto</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0 0 24 24">
                    <path
                        d="M 3 5 A 1.0001 1.0001 0 1 0 3 7 L 21 7 A 1.0001 1.0001 0 1 0 21 5 L 3 5 z M 3 11 A 1.0001 1.0001 0 1 0 3 13 L 21 13 A 1.0001 1.0001 0 1 0 21 11 L 3 11 z M 3 17 A 1.0001 1.0001 0 1 0 3 19 L 21 19 A 1.0001 1.0001 0 1 0 21 17 L 3 17 z">
                    </path>
                </svg>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto"> </div>

                <?php
                session_start();
                if (!isset($_SESSION['userid'])) {
                    ?>
                    <ul>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                     <?= $_SESSION['namalengkap'] ?>
                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="index.php" class="btn text-light m-1">Home</a></li>
                        <li class="nav-item"><a href="album.php" class="btn text-light m-1">Album</a></li>
                        <li class="nav-item"><a href="foto.php" class="btn text-light m-1">Foto</a></li>
                        <li class="nav-item"><a href="logout.php" class="btn btn-danger m-1">Logout</a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>

    </nav>
    <div class="text-center display-4 fst-italic mb-5 mt-5">
        <?php
        // session_start();
        if (!isset($_SESSION['userid'])) {
            header("location:login.php");
        }
        ?>
        <p>Selamat Datang <b class="text-decoration-underline">
                <?= $_SESSION['namalengkap'] ?>
            </b></p>
    </div>

    <div class="table-responsive">
        <div class="container mb-1">
            <table class="table table-bordered table-striped">
                <tr class="table-primary">
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Uploader</th>
                    <th>Jumlah Like</th>
                    <th>Aksi</th>
                </tr>

                <?php
                include "koneksi.php";
                $sql = mysqli_query($conn, "select * from foto,user where foto.userid=user.userid");
                while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td>
                            <?= $data['fotoid'] ?>
                        </td>
                        <td>
                            <?= $data['judulfoto'] ?>
                        </td>
                        <td>
                            <?= $data['deskripsifoto'] ?>
                        </td>
                        <td><img src="gambar/<?= $data['lokasifile'] ?>" alt="hellow" width="150px"></td>
                        <td>
                            <?= $data['namalengkap'] ?>
                        </td>
                        <td>
                            <?php
                            $fotoid = $data['fotoid'];
                            $sql2 = mysqli_query($conn, "select * from likefoto where fotoid='$fotoid'");
                            echo mysqli_num_rows($sql2);
                            ?>
                        </td>
                        <td>
                            <div class="p-2">
                                <a href="like.php?fotoid=<?= $data['fotoid'] ?>"><i class="bi bi-heart"></i></i></a>
                                <a href="komentar.php?fotoid=<?= $data['fotoid'] ?>"><i class="bi bi-chat-dots-fill"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    <br><br><br><br><br>
    <footer class="d-flex justify-content-center border-top mt-2 bg-secondary fixed-bottom">
        <p class="pt-2 text-light">&copy; UKK RPL 2024 | Salsa Awaliyah | SMK AL-GHIFARI</p>
    </footer>

    <script src="asset/js/bootstrap.min.js"></script>
</body>

</html>