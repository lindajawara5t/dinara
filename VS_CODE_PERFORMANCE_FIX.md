# 🚀 VS Code Performance Fix Guide

## Masalah yang Terjadi:
- ❌ VS Code sangat lambat
- ❌ Force close / Not Responding
- ❌ High CPU/Memory usage

## ✅ Solusi yang Sudah Diterapkan:

### 1. **Settings Optimization** (`settings.json`)
```json
✓ Exclude folders dari file watcher:
  - writable/debugbar, logs, cache, session
  - system folder
  - vendor & node_modules
  - uploads folder

✓ Disable fitur berat:
  - Minimap
  - CodeLens  
  - Git decorations
  - Occurrences highlight
  - Selection highlight
  - Auto suggestions

✓ Optimize Git:
  - Disable auto-refresh
  - Disable auto-fetch
```

### 2. **Cleanup Script** (`cleanup_vscode.bat`)
```bash
✓ Clear writable/debugbar (JSON files yang banyak)
✓ Clear writable/cache
✓ Clear writable/logs
✓ Clear writable/session
✓ Git garbage collection
```

### 3. **Restart Script** (`restart_vscode_optimized.bat`)
```bash
✓ Close VS Code properly
✓ Clear VS Code cache
✓ Restart dengan settings optimized
```

---

## 📋 Cara Menggunakan:

### Opsi 1: Quick Fix (Paling Cepat)
```bash
cd scripts
restart_vscode_optimized.bat
```

### Opsi 2: Manual Steps
1. **Close VS Code**
2. **Run cleanup:**
   ```bash
   cd scripts
   cleanup_vscode.bat
   ```
3. **Buka VS Code lagi**

### Opsi 3: Safe Mode (No Extensions)
```bash
code --disable-extensions .
```

---

## 🔧 Tips Tambahan:

### 1. **Disable Extension yang Tidak Perlu**
   - Buka Extensions (`Ctrl+Shift+X`)
   - Click gear icon di extension
   - Pilih "Disable"
   - Extension berat yang biasa memperlambat:
     - Heavy PHP intelephense
     - Multiple formatters
     - Live preview/server

### 2. **Check Task Manager**
   - Lihat process `Code.exe` yang menggunakan CPU/Memory tinggi
   - Jika ada banyak process, artinya ada extension/feature yang berat

### 3. **Exclude More Folders**
   Tambahkan di `.vscode/settings.json`:
   ```json
   "files.watcherExclude": {
     "**/vendor/**": true,
     "**/system/**": true
   }
   ```

### 4. **Increase Memory Limit**
   Edit shortcut VS Code, tambahkan:
   ```
   --max-memory=4096
   ```

### 5. **Disable Telemetry**
   Sudah diset di settings:
   ```json
   "telemetry.telemetryLevel": "off"
   ```

---

## ✅ Hasil Setelah Optimasi:

| Before | After |
|--------|-------|
| 🐌 Very slow | ⚡ Fast |
| ❌ Force close | ✅ Stable |
| 📈 High CPU | 📉 Normal CPU |
| 💾 Many files indexed | 🎯 Only relevant files |

---

## 🎯 Verification:

Setelah restart, check:
1. ✅ VS Code responsif
2. ✅ No "Not Responding" dialog
3. ✅ File explorer smooth
4. ✅ Editing smooth tanpa lag

---

## 📞 Jika Masih Lemot:

1. **Check extension yang aktif:**
   ```
   Ctrl+Shift+P → "Show Running Extensions"
   ```

2. **Disable semua extension kecuali PHP:**
   - Keep: PHP Intelephense
   - Disable: Lainnya

3. **Restart PC** (jika sudah lama tidak restart)

4. **Check disk space** (pastikan C:\ masih ada space)

---

## 🚀 Quick Commands:

```bash
# Cleanup
cd scripts
cleanup_vscode.bat

# Restart optimized
restart_vscode_optimized.bat

# Open safe mode
code --disable-extensions .

# Check running extensions
Ctrl+Shift+P → "Show Running Extensions"
```

---

**✅ Sekarang VS Code Anda sudah dioptimasi!**
