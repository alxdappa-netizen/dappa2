<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Bilangan Prima</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .content {
            padding: 40px;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        input[type="number"], select {
            width: 100%;
            padding: 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        input[type="number"]:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .btn {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .result {
            margin-top: 30px;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .result-prima {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }
        
        .result-bukan-prima {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            color: white;
        }
        
        .result h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .result p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .info-box {
            background: #f7fafc;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .info-box h3 {
            color: #667eea;
            margin-bottom: 10px;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .feature-card h4 {
            color: #667eea;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔢 Cek Bilangan Prima</h1>
            <p>Masukkan angka untuk mengecek apakah bilangan tersebut prima atau bukan</p>
        </div>
        
        <div class="content">
            <div class="form-section">
                <form method="POST">
                    <div class="form-group">
                        <label for="angka">Masukkan Angka:</label>
                        <input type="number" id="angka" name="angka" min="1" 
                               value="<?php echo isset($_POST['angka']) ? $_POST['angka'] : ''; ?>" 
                               placeholder="Contoh: 17" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mode">Mode Pencarian:</label>
                        <select id="mode" name="mode">
                            <option value="single" <?php echo (!isset($_POST['mode']) || $_POST['mode'] == 'single') ? 'selected' : ''; ?>>
                                Cek Satu Angka
                            </option>
                            <option value="range" <?php echo (isset($_POST['mode']) && $_POST['mode'] == 'range') ? 'selected' : ''; ?>>
                                Cari Prima dalam Rentang (1 - angka)
                            </option>
                            <option value="first_n" <?php echo (isset($_POST['mode']) && $_POST['mode'] == 'first_n') ? 'selected' : ''; ?>>
                                Cari N Prima Pertama
                            </option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn">🔍 Cek Sekarang</button>
                </form>
            </div>
            
            <?php
            // Include fungsi prima
            function isPrima($angka) {
                if ($angka < 2) return false;
                if ($angka == 2 || $angka == 3) return true;
                if ($angka % 2 == 0 || $angka % 3 == 0) return false;
                
                for ($i = 5; $i * $i <= $angka; $i += 6) {
                    if ($angka % $i == 0 || $angka % ($i + 2) == 0) {
                        return false;
                    }
                }
                
                return true;
            }
            
            function cariPrimaRentang($start, $end) {
                $prima = [];
                for ($i = $start; $i <= $end; $i++) {
                    if (isPrima($i)) {
                        $prima[] = $i;
                    }
                }
                return $prima;
            }
            
            function cariNPrimaPertama($n) {
                $prima = [];
                $angka = 2;
                
                while (count($prima) < $n) {
                    if (isPrima($angka)) {
                        $prima[] = $angka;
                    }
                    $angka++;
                }
                
                return $prima;
            }
            
            // Proses form
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['angka'])) {
                $angka = (int)$_POST['angka'];
                $mode = $_POST['mode'] ?? 'single';
                
                if ($angka > 0) {
                    switch ($mode) {
                        case 'single':
                            $isPrimaResult = isPrima($angka);
                            $resultClass = $isPrimaResult ? 'result-prima' : 'result-bukan-prima';
                            $resultText = $isPrimaResult ? 'BILANGAN PRIMA' : 'BUKAN BILANGAN PRIMA';
                            $icon = $isPrimaResult ? '✅' : '❌';
                            
                            echo "<div class='result $resultClass'>";
                            echo "<h2>$icon $resultText</h2>";
                            echo "<p>Angka <strong>$angka</strong> " . 
                                 ($isPrimaResult ? "adalah bilangan prima" : "bukan bilangan prima") . "</p>";
                            echo "</div>";
                            break;
                            
                        case 'range':
                            $primaList = cariPrimaRentang(1, $angka);
                            echo "<div class='result result-prima'>";
                            echo "<h2>📋 Bilangan Prima 1 - $angka</h2>";
                            echo "<p>Ditemukan <strong>" . count($primaList) . "</strong> bilangan prima:</p>";
                            echo "<p style='margin-top: 15px; font-family: monospace; font-size: 1rem;'>" . 
                                 implode(", ", $primaList) . "</p>";
                            echo "</div>";
                            break;
                            
                        case 'first_n':
                            if ($angka <= 100) { // Batasi untuk performa
                                $primaList = cariNPrimaPertama($angka);
                                echo "<div class='result result-prima'>";
                                echo "<h2>🎯 $angka Bilangan Prima Pertama</h2>";
                                echo "<p style='margin-top: 15px; font-family: monospace; font-size: 1rem;'>" . 
                                     implode(", ", $primaList) . "</p>";
                                echo "</div>";
                            } else {
                                echo "<div class='result result-bukan-prima'>";
                                echo "<h2>⚠️ Batas Maksimal</h2>";
                                echo "<p>Untuk performa, maksimal pencarian 100 bilangan prima pertama</p>";
                                echo "</div>";
                            }
                            break;
                    }
                }
            }
            ?>
            
            <div class="info-box">
                <h3>💡 Apa itu Bilangan Prima?</h3>
                <p>Bilangan prima adalah bilangan asli yang lebih besar dari 1 dan hanya memiliki dua pembagi: 1 dan dirinya sendiri.</p>
                <p><strong>Contoh:</strong> 2, 3, 5, 7, 11, 13, 17, 19, 23, 29, ...</p>
            </div>
            
            <div class="feature-grid">
                <div class="feature-card">
                    <h4>🔍 Cek Tunggal</h4>
                    <p>Periksa apakah satu angka adalah bilangan prima</p>
                </div>
                <div class="feature-card">
                    <h4>📊 Cari Rentang</h4>
                    <p>Temukan semua bilangan prima dalam rentang tertentu</p>
                </div>
                <div class="feature-card">
                    <h4>🎯 N Prima Pertama</h4>
                    <p>Cari N bilangan prima pertama</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>