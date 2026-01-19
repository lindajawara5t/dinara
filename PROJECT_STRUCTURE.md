# Struktur Project Dinara

## 📂 Organisasi Folder

```
dinara/
├── 📁 app/                    # CodeIgniter Application
│   ├── Common.php
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   ├── Filters/
│   ├── Helpers/
│   ├── Language/
│   ├── Libraries/
│   ├── Models/
│   ├── ThirdParty/
│   └── Views/
│
├── 📁 public/                 # Public Assets
│   ├── index.php              # Entry point
│   ├── uploads/               # User uploads
│   └── robots.txt
│
├── 📁 system/                 # CodeIgniter Core
│   ├── BaseModel.php
│   ├── Boot.php
│   ├── bootstrap.php
│   ├── CodeIgniter.php
│   ├── Common.php
│   └── ... (framework files)
│
├── 📁 config/                 # Configuration
│   ├── .env                   # Environment variables
│   ├── .htaccess              # Apache rewrite rules
│   └── preload.php            # Preload configuration
│
├── 📁 database/               # Database Files
│   ├── add_booking_tables.sql
│   ├── add_itinerary_table.sql
│   ├── add_konsumsi_table.sql
│   ├── add_wisata_tables.sql
│   ├── create_hero_slideshow_table.sql
│   ├── database_schema.sql    # Main schema
│   ├── fix_database.sql
│   ├── insert_wisata_data.sql
│   ├── sample_slideshow_data.sql
│   └── update_hero_slideshow_table.sql
│
├── 📁 docs/                   # Documentation
│   ├── AUTO_SYNC_VISUAL_GUIDE.md
│   ├── BOOKING_DETAIL_BEFORE_AFTER.md
│   ├── BOOKING_DETAIL_ENHANCEMENT.md
│   ├── COMPLETION_REPORT.md
│   ├── DATA_FLOW_DIAGRAM.md
│   ├── DROPDOWN_LINK_FIX.md
│   ├── FIX_SLIDE_NOT_CLICKABLE.md
│   ├── HOME_VS_ESTIMASI.md
│   ├── PANDUAN_BOOKING_FINANCE.md
│   ├── PANDUAN_SLIDESHOW.md
│   ├── README.md
│   ├── SERVICE_AUTO_SYNC.md
│   ├── SLIDESHOW_FIX_DOCS.md
│   ├── SLIDESHOW_FIX_FINAL.md
│   ├── TIKET_KAPAL_PESAWAT_BUGFIX.md
│   └── TIKET_KAPAL_PESAWAT_QUICK_FIX.md
│
├── 📁 scripts/                # Utility Scripts
│   ├── change_port.bat        # Change XAMPP port
│   ├── fix_slideshow_urls.php # Fix slideshow URLs
│   ├── import_db.bat          # Import database
│   ├── import_hero_slideshow.bat
│   ├── start-server.bat       # Start development server
│   └── update_hero_slideshow.bat
│
├── 📁 uploads/                # Upload directory
├── 📁 writable/               # Writable directory (logs, cache)
├── 📁 .git/                   # Git repository
│
├── index.php                  # Root index
├── spark                      # CodeIgniter CLI
├── composer.json              # Dependencies
├── phpunit.xml.dist           # PHPUnit config
├── LICENSE
└── README.md (di docs/)
```

## 🚀 Quick Start

### Start Server
```bash
scripts/start-server.bat
```

### Import Database
```bash
scripts/import_db.bat
```

### Change XAMPP Port
```bash
scripts/change_port.bat
```

## 📊 Database Files

| File | Purpose |
|------|---------|
| `database_schema.sql` | Main database schema |
| `add_wisata_tables.sql` | Wisata (tourism) tables |
| `add_booking_tables.sql` | Booking tables |
| `add_itinerary_table.sql` | Itinerary tables |
| `add_konsumsi_table.sql` | Consumption/expense tables |
| `create_hero_slideshow_table.sql` | Hero slideshow tables |
| `insert_wisata_data.sql` | Sample wisata data |
| `sample_slideshow_data.sql` | Sample slideshow data |

## 📝 Documentation

All documentation is organized in `docs/` folder. Key documents:
- **README.md** - Main project guide
- **PANDUAN_*.md** - User guides
- **COMPLETION_REPORT.md** - Project completion report
- ***_FIX*.md** - Bug fixes and improvements

## ⚙️ Configuration

- **config/.env** - Environment variables (API keys, database, etc.)
- **config/.htaccess** - Apache URL rewriting
- **config/preload.php** - Application preload settings

## 📦 Main App Structure

- **app/Controllers/** - Request handlers
- **app/Models/** - Database models
- **app/Views/** - Template files
- **app/Helpers/** - Helper functions
- **app/Libraries/** - Custom libraries

## 🛠️ Development

- Framework: CodeIgniter 4
- Database: MySQL
- Server: Apache (XAMPP)
- Language: PHP 7.4+

---
Last Updated: January 18, 2026
