<?php include('includes/header.php'); ?>
<?php session_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != "") {
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
                                if ($fetchdata > 0) {
                                    foreach ($fetchdata as $key => $row) {
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
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">Data tidak tersedia di Firebase</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php


                        // deklarasi data dalam format array 
                        // ada 4 komponen yaitu nilai matematika, pengetahuan umum, bahasa inggris dan agama
                        // data diambil dari sumber terpercaya
                        // $data = array(
                        $data_testing  =  array(1, 1,   1,    'Melon');
                        $data = array(
                            array(6, 33.1,    75,    'Melon'),
                            array(6.5,    32,    75,    'Melon'),
                            array(6,    33,    80,    'Melon'),
                            array(6.5,    26,    75,    'Melon'),
                            array(6.2,    32,    60,    'Jeruk'),
                            array(6,    35,    70,    'Jeruk'),
                            array(5.7,    32,    65,    'Jeruk'),
                            array(3.68,    29,    74,    'Nanas'),
                            array(4.11,    28,    60,    'Nanas'),
                            array(3.3,    30,    72,    'Nanas'),
                            array(6.3,    28,    60,    'Bawang Merah'),
                            array(5.6,    30,    65,    'Bawang Merah'),
                            array(6,    28,    85,    'Bawang Merah'),
                            array(7,    28,    75,    'Bawang Putih'),
                            array(6.5,    30,    75,    'Bawang Putih'),
                            array(5.5,    30,    82,    'Bawang Putih'),
                            array(7,    27,    76,    'Semangka'),
                            array(6.5,    28,    65,    'Semangka'),
                            array(6.4,    27,    70,    'Semangka'),

                        );

                        $push = array_push($data_testing, $data);
                        echo "<br><br>";
                        print_r($push);
                        // ambil data training dari database
                        // array




                        // membuat jarak euclidance memanggil methode/function euclideanDistance
                        $distances = $data;
                        array_walk($distances, 'euclideanDistance', $data);
                        /** 
                        php manual
                        bool array_walk ( array &$array , callable $funcname [, mixed $userdata = NULL ] )
                        return true or false
                        array_walk � Apply a user function to every member of an array
                         */
                        // Memanggil methode getNearsetNeighbors
                        $neighbors = getNearestNeighbors($distances, 0, 1);
                        $neighbors2 = getNearestNeighbors($distances, 0, 2);
                        $neighbors3 = getNearestNeighbors($distances, 0, 3);

                        $byValues = array_values($distances[0]);
                        // print_r($byValues[0]);

                        echo "Label: " . getLabel($data, $neighbors) . " : " . $byValues[0]; // Menampilakan Hasil ke layar
                        echo "<br><br>";
                        echo "Label: " . getLabel($data, $neighbors2) . " : " . $byValues[1];
                        echo "<br><br>";
                        echo "Label: " . getLabel($data, $neighbors3) . " : " . $byValues[2];
                        echo "<br><br>";
                        // print_r($distances[0]);
                        // echo "<br><br>";
                        // print_r(asort($distances[0]));
                        // print_r(array_values($distances[0]));



                        /**
                        
                         */
                        function euclideanDistance(&$sourceCoords, $sourceKey, $data)
                        {
                            $distances = array();
                            list($y1, $z1, $q1) = $sourceCoords;
                            foreach ($data as $destinationKey => $destinationCoords) {

                                if ($sourceKey == $destinationKey) {
                                    continue;
                                }
                                list($y2, $z2, $q2) = $destinationCoords;
                                $distances[$destinationKey] = sqrt(pow($y1 - $y2, 2) + pow($z1 - $z2, 2) + pow($q1 - $q2, 2));
                                // rumus untuk mencari jarak euclidean
                                // setiap inputan akan dihitung jaraknya dengan nilai data yang ada dan di cari jarak terpendek(yang mendekatai dengan data yang tersedia)
                                // akan dilakukan terus menerus looping sampai data statis semuanya telah di hitung jaraknya dengan inputan
                            }
                            asort($distances);
                            //asort(array,sorttype) asort fungsi untuk sorting array
                            $sourceCoords = $distances;
                            // print_r($sourceCoords);
                            // echo json_encode($sourceCoords);
                        }

                        /**
                         * Returns n-nearest neighbors
                         *
                         */
                        function getNearestNeighbors($distances, $key, $num)
                        {
                            return array_slice($distances[$key], 0, $num, true);
                            //The array_slice() function returns selected parts of an array.
                            /**
                             *Example 
                        
                             *<?php
                             *$a=array(0=>"Dog",1=>"Cat",2=>"Horse",3=>"Bird");
                             *print_r(array_slice($a,1,2));
                             *?>
                             *The output of the code above will be:
                        
                             *Array ( [0] => Cat [1] => Horse )
                             */
                        }

                        /**
                         * Gets result label from associated data
                         *
                         * @param array $data 
                         * @param array $neighbors Result from getNearestNeighbors()
                         * @return string label
                         */
                        function getLabel($data, $neighbors)
                        {
                            $results = array();
                            $neighbors = array_keys($neighbors);
                            foreach ($neighbors as $neighbor) {
                                $results[] = $data[$neighbor][3];
                            }
                            $values = array_count_values($results);
                            $values = array_flip($values);
                            //The array_flip() function returns an array with all the original keys as values, and all original values as keys.
                            /**
                             *Example
                        
                             *<?php
                             *$a=array(0=>"Dog",1=>"Cat",2=>"Horse");
                        
                             *print_r(array_flip($a));
                             *?>
                             *The output of the code above will be:
                        
                             *Array ( [Dog] => 0 [Cat] => 1 [Horse] => 2 )
                                
                             **/

                            // echo ksort($values);
                            // echo "<br>";
                            // ksort($fruits);
                            // foreach ($values as $key => $val) {
                            // 	echo "$key = $val\n";
                            // }
                            //The ksort() function sorts an array by the keys. The values keep their original keys.
                            //This function returns TRUE on success, or FALSE on failure.

                            // print_r($results);
                            // echo "<br><br>";
                            // return print_r($values);
                            // echo json_encode($values);
                            return array_pop($values);
                            //The array_pop() function deletes the last element of an array.
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>