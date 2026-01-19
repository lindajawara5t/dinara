# Testing & Verification Guide

## ✅ Pre-Launch Checklist

### 1. Database Setup
```bash
# Restore database from backup
scripts/import_db.bat

# Or manually run:
# mysql -u root < database/database_schema.sql
```

### 2. Verify Database Connection
```bash
# Check connection in CodeIgniter
# app/Config/Database.php
```

### 3. Configure .env
```bash
# Edit config/.env and set:
# APP_BASEURL = http://localhost:8080/dinara/
# DB_HOST = localhost
# DB_USERNAME = root
# DB_PASSWORD = (your password)
# DB_DATABASE = dinara
```

### 4. Start Development Server
```bash
scripts/start-server.bat
# Or: php spark serve
```

### 5. Access Application
```
http://localhost:8080/dinara/
```

---

## 🧪 Testing Checklist

### Frontend Tests
- [ ] Homepage loads correctly
- [ ] Navigation menu works
- [ ] Slideshow displays and auto-rotates
- [ ] Booking form renders properly
- [ ] Responsive design (mobile/tablet/desktop)

### API Tests
- [ ] GET wisata list (/api/wisata)
- [ ] POST booking (/api/booking)
- [ ] GET booking status
- [ ] Update profile endpoint
- [ ] Delete operations

### Database Tests
- [ ] Records insert correctly
- [ ] Update operations work
- [ ] Delete cascade works
- [ ] Relationships intact
- [ ] No orphaned records

### Performance Tests
- [ ] Page load time < 3 seconds
- [ ] API response time < 500ms
- [ ] Database queries optimized
- [ ] No memory leaks

---

## 🐛 Common Issues & Fixes

### Issue: 404 Not Found
**Solution:** Check routing in `app/Config/Routes.php`
```php
// Example route:
$routes->get('/wisata', 'WisataController::index');
```

### Issue: Database Connection Failed
**Solution:** Verify config in `config/.env`
```
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=dinara
```

### Issue: Port Already in Use
**Solution:** Change XAMPP port using script
```bash
scripts/change_port.bat
```

### Issue: File Upload Not Working
**Solution:** Check `uploads/` folder permissions
```bash
# Ensure writable
# Windows: Right-click → Properties → Security
```

### Issue: Slowdown/Memory Issues
**Solution:** Clear cache
```bash
# Cache files in writable/cache/
# Already cleaned on startup
```

---

## 📊 Database Verification

### Check Main Tables
```sql
-- Wisata (Tourism)
SELECT * FROM wisata LIMIT 5;

-- Bookings
SELECT * FROM bookings LIMIT 5;

-- Users/Members
SELECT * FROM users LIMIT 5;

-- Itinerary
SELECT * FROM itinerary LIMIT 5;

-- Hero Slideshow
SELECT * FROM hero_slideshow LIMIT 5;
```

### Check Relationships
```sql
-- Count bookings per wisata
SELECT wisata_id, COUNT(*) as total FROM bookings GROUP BY wisata_id;

-- Active users
SELECT COUNT(*) as total FROM users WHERE status = 'active';
```

---

## 🚀 Deployment Checklist

- [ ] All tests pass
- [ ] No errors in logs
- [ ] Database backup created
- [ ] .env configured for production
- [ ] SSL certificate installed
- [ ] Cron jobs configured (if needed)
- [ ] Email service tested
- [ ] Backups automated

---

## 📝 Logging

Logs are stored in `writable/logs/` folder:
- `log-*.log` - General application logs
- Check for errors: `ERROR:`, `Exception:`, `Fatal:`

### View Recent Errors
```bash
# On Windows:
type writable\logs\log-*.log | findstr "ERROR"

# On Linux:
grep "ERROR" writable/logs/log-*.log
```

---

Last Updated: January 18, 2026
