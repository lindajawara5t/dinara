<!DOCTYPE html>
<html>
<head>
    <title>Smart Travel Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(to right, #00c6ff, #0072ff); min-height: 100vh; display: flex; align-items: center; }
        .card { border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card p-4 mx-auto" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h3>🌊 Karimun Planner</h3>
                <p class="text-muted">Rencanakan liburan sesuai kantong!</p>
            </div>
            
            <form action="/kalkulator/hitung" method="post">
                <div class="mb-3">
                    <label class="fw-bold">Punya Budget Berapa?</label>
                    <input type="number" name="budget" class="form-control form-control-lg" placeholder="Contoh: 1000000" required>
                </div>
                
                <div class="mb-3">
                    <label class="fw-bold">Jumlah Orang?</label>
                    <input type="number" name="orang" class="form-control" value="1" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg rounded-pill">
                    🚀 Cek Dapat Apa Aja
                </button>
            </form>
        </div>
    </div>
</body>
</html>