<?php include('includes/header.php'); ?>
<?php session_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] != "")
            {
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey !</strong> <?php echo $_SESSION['status']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4>Menampilkan Data dari Firebase</h4>
                    <a href="insert.php" class="btn btn-primary float-right">Tambah Data</a>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>pH</th>
                                    <th>Suhu</th>
                                    <th>Kelembaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('includes/dbconfig.php');
                                    $ref = "datatanaman/";
                                    $fetchdata = $database->getReference($ref)->getValue();
                                    $i = 0;
                                    if($fetchdata > 0)
                                    {
                                        foreach($fetchdata as $key => $row)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['ph']; ?></td>
                                            <td><?php echo $row['suhu']; ?></td>
                                            <td><?php echo $row['kelembaban']; ?></td>
                                            <td>
                                                <a href="" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="6">Data tidak tersedia di Firebase</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>