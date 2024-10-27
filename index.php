<!DOCTYPE html>
<html>

<head>
    <title>Pemesanan Tiket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Form Pemesanan Tiket</h2>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="adultTicketCount">Jumlah Tiket Dewasa:</label><br>
                                    <input type="number" name="adultTicketCount" id="adultTicketCount" min="0" required class="form-control"><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="childTicketCount">Jumlah Tiket Anak-anak:</label><br>
                                    <input type="number" name="childTicketCount" id="childTicketCount" min="0" required class="form-control"><br>
                                </div>
                            </div>
                            <label for="dayOfWeek">Pilih Hari:</label><br>
                            <select name="dayOfWeek" id="dayOfWeek" required class="form-control">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select><br>

                            <input type="submit" value="Hitung Total Harga" class="btn btn-primary">
                        </form>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Mengambil data dari form
                            $adultTicketCount = $_POST['adultTicketCount'];
                            $childTicketCount = $_POST['childTicketCount'];
                            $dayOfWeek = $_POST['dayOfWeek'];

                            // Fungsi untuk menghitung total harga
                            function calculatePrice($adultTicketCount, $childTicketCount, $dayOfWeek)
                            {
                                // Harga tiket
                                $adultPrice = 50000;
                                $childPrice = 30000;
                                $weekendSurcharge = 10000;

                                // Menghitung total harga dasar
                                $totalPrice = ($adultPrice * $adultTicketCount) + ($childPrice * $childTicketCount);

                                // Menambahkan biaya tambahan jika hari Sabtu atau Minggu
                                if ($dayOfWeek == "Sabtu" || $dayOfWeek == "Minggu") {
                                    $totalPrice += $weekendSurcharge * ($adultTicketCount + $childTicketCount);
                                }

                                // Diskon 10% jika total harga lebih dari atau sama dengan 150 ribu
                                if ($totalPrice >= 150000) {
                                    $totalPrice *= 0.9;
                                }

                                return $totalPrice;
                            }

                            // Menghitung total harga berdasarkan input user
                            $totalPrice = calculatePrice($adultTicketCount, $childTicketCount, $dayOfWeek);

                            // Menampilkan hasil
                            echo "<div class='alert alert-success mt-4'>Total harga tiket: Rp " . number_format($totalPrice, 0, ',', '.') . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>