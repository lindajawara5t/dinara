<!DOCTYPE html>
<html>
<head>
    <title>Dinara Travel System</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding-top: 50px; }
        .kotak-login { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 400px; }
        h1 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; color: #666; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; margin-top: 20px; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .logo { text-align: center; font-weight: bold; font-size: 24px; color: #007bff; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="kotak-login">
        <div class="logo">DINARA TRAVEL</div>
        <h1>Cek Budget Wisata</h1>
        <p style="text-align:center; font-size: 14px; color: #888;">Transparan & Jujur Apa Adanya</p>

        <form action="" method="post">
            
            <label>Rencana Tanggal Berangkat</label>
            <input type="date" name="tanggal">

            <label>Jumlah Peserta (Orang)</label>
            <input type="number" name="jumlah_orang" placeholder="Contoh: 2">

            <label>Budget Per Orang (Rupiah)</label>
            <input type="number" name="budget" placeholder="Contoh: 800000">

            <button type="button">HITUNG SEKARANG</button>

        </form>
    </div>

</body>
</html>