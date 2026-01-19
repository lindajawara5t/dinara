-- ===== TABEL BOOKING & PAYMENT =====

-- Tabel bookings untuk menyimpan order utama
CREATE TABLE IF NOT EXISTS bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_code VARCHAR(20) UNIQUE NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255),
    customer_phone VARCHAR(20),
    customer_address TEXT,
    city_origin VARCHAR(100),
    travel_date DATE,
    duration_day INT,
    num_people INT,
    num_children INT DEFAULT 0,
    
    -- Wisata
    tour_laut_selected LONGTEXT,  -- JSON array of selected tour indices
    tour_darat_selected LONGTEXT, -- JSON array of selected tour indices
    
    -- Fasilitas & Akomodasi
    hotel_selected VARCHAR(255),
    facilities_selected LONGTEXT,  -- JSON array
    guide_type VARCHAR(100),
    transport_type VARCHAR(100),
    flight_type VARCHAR(100),
    
    -- Estimasi Harga
    total_price DECIMAL(15,2) NOT NULL,
    total_net_cost DECIMAL(15,2),
    estimated_margin DECIMAL(15,2),
    
    -- Status
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    payment_status ENUM('unpaid', 'partial', 'paid') DEFAULT 'unpaid',
    notes TEXT,
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_booking_code (booking_code),
    INDEX idx_customer_email (customer_email),
    INDEX idx_status (status),
    INDEX idx_payment_status (payment_status)
);

-- Tabel booking_items untuk detail setiap paket yang dipilih
CREATE TABLE IF NOT EXISTS booking_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    item_type ENUM('tour_laut', 'tour_darat', 'hotel', 'guide', 'transport', 'facility') NOT NULL,
    item_id INT,
    item_name VARCHAR(255) NOT NULL,
    quantity INT DEFAULT 1,
    price_unit DECIMAL(15,2),
    price_total DECIMAL(15,2),
    notes TEXT,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    INDEX idx_booking_id (booking_id),
    INDEX idx_item_type (item_type)
);

-- Tabel payments untuk tracking pembayaran
CREATE TABLE IF NOT EXISTS payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    payment_code VARCHAR(20) UNIQUE NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    payment_method ENUM('transfer', 'cash', 'card', 'check') DEFAULT 'transfer',
    payment_date DATE,
    due_date DATE,
    status ENUM('pending', 'confirmed', 'failed', 'cancelled') DEFAULT 'pending',
    
    -- Bank details
    bank_name VARCHAR(100),
    bank_account VARCHAR(50),
    account_holder VARCHAR(255),
    
    -- Notes
    notes TEXT,
    evidence_url VARCHAR(500),  -- Bukti transfer
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    INDEX idx_booking_id (booking_id),
    INDEX idx_payment_code (payment_code),
    INDEX idx_status (status),
    INDEX idx_payment_date (payment_date)
);

-- Tabel financial_summary untuk dashboard keuangan
CREATE TABLE IF NOT EXISTS financial_summary (
    id INT PRIMARY KEY AUTO_INCREMENT,
    summary_date DATE UNIQUE NOT NULL,
    total_bookings INT DEFAULT 0,
    total_revenue DECIMAL(15,2) DEFAULT 0,
    total_net_cost DECIMAL(15,2) DEFAULT 0,
    total_margin DECIMAL(15,2) DEFAULT 0,
    paid_amount DECIMAL(15,2) DEFAULT 0,
    pending_amount DECIMAL(15,2) DEFAULT 0,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_date (summary_date)
);
