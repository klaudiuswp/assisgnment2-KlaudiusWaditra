<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            height: 100vh;
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .jersey-10-regular {
            font-family: "Jersey 10", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .orange {
            color: orange;
        }
    </style>
</head>

<body class="bg-body-secondary">
    <nav class="navbar navbar-expand-lg bg-body fixed-top shadow">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">PRODUCT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">GALLERY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/"> MY INVENTORY</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 50px;">
        <br>
    </div>

    <?php
    //============================================================================================================

    require 'function.php';
    
    $conn = getConn();
    if (isset($_GET['error'])) {
        echo "
    <div class='container p-0'>
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Terjadi kesalahan! </strong> ".$_GET['error'].".
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
    </button>
    </div>
    </div>
    ";
    }

    $result = read_data($conn);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $nama_display = $row['nama'];
            $role_display = $row['role'];
            $availability_display = $row['availability'];
            $age_display = $row['age'];
            $lokasi_display = $row['lokasi'];
            $pengalaman_display = $row['pengalaman'];
            $email_display = $row['email'];

            echo "
            <div class='container p-0 mt-2'>
            <div class='card border-0 shadow-sm'>
            <div class='row g-0 d-flex align-items-center'>

                <div class='col-md-3 col-lg-2 text-md-center p-2'>
                    <div class='text-center'>
                        <img src='images.jpg' class='img-fluid rounded-circle' alt='Profile Image'
                            style='width:150px; height:150px;'>
                    </div>
                </div>

                <div class='col-md-3 text-center text-md-start p-2 border-end'>
                    <h5 class='mt-3'>$nama_display</h5>
                    <p class='text-muted'>$role_display</p>
                    <div class='d-flex'>
                        <a href='#' class='btn btn-primary me-2'>Kontak</a>
                        <a href='#' class='btn btn-outline-success me-2'>Resume</a>
                        <form action='db_process.php' method='post'>
                        <input type='hidden' name='id' value='$id' class='form-control' id='lokasi' placeholder='Password'>
                        <button name='perintah' type='submit' value='delete' class='btn btn-danger'>X</button>
                        </form>
                    </div>
                </div>


                <div class='col-md-4'>
                    <div class='card-body'>
                        <ul class='list-unstyled'>
                            <li class='mb-2'>
                                <strong>Availability:</strong> $availability_display
                            </li>
                            <li class='mb-2'>
                                <strong>Usia:</strong> $age_display
                            </li>
                            <li class='mb-2'>
                                <strong>Lokasi:</strong> $lokasi_display
                            </li>
                            <li class='mb-2'>
                                <strong>Pengalaman:</strong> $pengalaman_display
                            </li>
                            <li class='mb-2'>
                                <strong>Email:</strong> $email_display
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
            ";
        }
    } else {
        echo "gagal";
    }

    ?>

    <form action="db_process.php" method="post">
        <div class="container my-2 form-control p-3 border-0 shadow-sm">
            <div class="form-floating mb-3">
                <input type="text" name="nama_user" class="form-control" id="nama_user" placeholder="name@example.com">
                <label for="nama">Nama</label>
            </div>
            <div class="input-group mb-3">
                <select class="form-select" name="role" id="role">
                    <option selected disabled>Role</option>
                    <option value="Front End">Front End</option>
                    <option value="Back End">Back End</option>
                    <option value="QC / QA">QC / QA</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <select class="form-select" name="availability" id="availability">
                    <option selected disabled>Availability</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>
            <div class="form-floating">
                <input type="text" name="age" class="form-control" id="usia" placeholder="Password">
                <label for="usia">Age</label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Password">
                <label for="lokasi">Lokasi</label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" name="pengalaman" class="form-control" id="pengalaman" placeholder="Password">
                <label for="pengalaman">Years Experience</label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" name="email" class="form-control" id="email" placeholder="Password">
                <label for="email">Email</label>
            </div>
            <div class="form-floating mt-3">
                <button type="submit" id="submit" name="perintah" value="create" class="btn btn-success w-100">SUBMIT WITH SESSION</button>
            </div>
        </div>
    </form>
    <div style="margin-top: 50px;">
        <br>
    </div>
</body>


</html>