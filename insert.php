<?php include('includes/header.php'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <h3>INPUT MANUAL DATA TANAMAN</h3>
            <br></br>
                <form action="code.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="ph" class="form-control" placeholder="Masukkan Data pH">
                    </div>
                    <div class="form-group">
                        <input type="text" name="suhu" class="form-control" placeholder="Masukkan Data Suhu">
                    </div>
                    <div class="form-group">
                        <input type="text" name="kelembaban" class="form-control" placeholder="Masukkan Data Kelembaban">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="input_data" class="btn btn-primary btn-block">
                            Input Data</button>
                    </div>
                    </form>
        </div>

    </div>
</div>
<?php session_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] != "")
            {
                ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['status']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                unset($_SESSION['status']);
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>