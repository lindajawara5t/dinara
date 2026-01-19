# Fix VS Code Error Guide

## 🔴 Masalah: "The window is not responding"

### ✅ Solusi yang Sudah Dilakukan:

1. **✓ Hapus Global Cache**
   - `%APPDATA%\Code\User\workspaceStorage`
   - `%APPDATA%\Code\CachedExtensions`
   - `%APPDATA%\Code\logs`

2. **✓ Konfigurasi .vscode/settings.json**
   - Exclude folder besar dari watcher (node_modules, vendor, cache)
   - Optimize search & indexing
   - Disable unnecessary telemetry

3. **✓ Setup .gitignore**
   - Exclude cache, logs, vendor
   - Ignore OS files & temporary files

4. **✓ Optimized Extension List**
   - Hanya extensions yang diperlukan
   - Disable slow/heavy extensions

---

## 🚀 Langkah Perbaikan Lanjutan:

### 1. Restart VS Code dengan Clean
```bash
# Close VS Code completely
# Press: Ctrl + Shift + P
# Type: "Developer: Reload Window"
# Or: Press Ctrl + R
```

### 2. Disable Heavy Extensions
VS Code Extensions yang sering bikin lambat:
- ~~Docker~~ (jika tidak digunakan)
- ~~Remote SSH~~ (jika tidak perlu)
- ~~Peacock~~ (theme, tidak perlu)
- ~~Too many language packs~~

**Recommended Extensions:**
- **Intelephense** - PHP intellisense
- **Prettier** - Code formatter
- **GitLens** - Git integration
- **SQLTools** - Database tools
- **Thunder Client** - API testing

### 3. Increase VS Code Resource Limit
Edit: `C:\Users\YOUR_USERNAME\AppData\Roaming\Code\User\settings.json`

```json
{
  "memory.maxMemoryMB": 2048,
  "extensions.ignoreRecommendations": true
}
```

### 4. Disable Source Control Extension (jika tidak perlu)
```json
{
  "scm.autoReveal": false,
  "git.enabled": false
}
```

### 5. Clear Workspace State
```bash
# Delete workspace cache:
# %APPDATA%\Code\User\workspaceStorage\*
```

---

## 📋 Checklist Rutin Maintenance:

### Setiap Minggu:
- [ ] Restart VS Code
- [ ] Update extensions
- [ ] Clear workspace cache

### Setiap Bulan:
- [ ] Delete old logs in writable/logs/
- [ ] Clear writable/cache/
- [ ] Rebuild intellisense cache (Ctrl+Shift+P → "PHP: Clear Cache")

### Setiap Upgrade:
- [ ] Backup settings.json
- [ ] Update extensions
- [ ] Test performance

---

## 🔧 Command Palette Shortcuts:

| Command | Purpose |
|---------|---------|
| `Ctrl + Shift + P` | Command Palette |
| `Ctrl + Shift + L` | Change language mode |
| `Ctrl + K Ctrl + T` | Color theme |
| `Ctrl + Shift + X` | Extensions |
| `Ctrl + J` | Toggle terminal |
| `Ctrl + B` | Toggle sidebar |
| `Ctrl + ,` | Settings |

---

## 🆘 If Still Getting Errors:

### Nuclear Option (Last Resort):
1. **Close VS Code completely**
2. **Run:**
   ```bash
   Remove-Item -Path "$env:APPDATA\Code" -Recurse -Force
   ```
3. **Reinstall VS Code**
4. **Open project folder**
5. **Install recommended extensions only**

### Alternative: Portable VS Code
- Download portable version from official site
- Run from clean folder
- No registry pollution

---

## 📊 Monitor Performance:

**Check VS Code Performance:**
- `Ctrl + Shift + P` → "Help: Toggle Developer Tools"
- Go to "Performance" tab
- Check for slow extensions

**Monitor Resource Usage:**
- Open Task Manager
- Search for "Code.exe"
- Check Memory & CPU usage
- If > 1GB = Problem

---

## 💾 Backup Your Settings:

```bash
# Backup settings
cp $env:APPDATA\Code\User\settings.json settings.json.backup

# Backup extensions list
code --list-extensions > extensions.txt
```

**Restore later:**
```bash
# Install extensions from list
cat extensions.txt | ForEach-Object { code --install-extension $_ }
```

---

## 🎯 Preventive Measures:

1. **Use .gitignore properly** - ✓ Done
2. **Exclude large folders** - ✓ Done
3. **Limit extensions** - ✓ Done
4. **Clean cache regularly** - TODO
5. **Use latest VS Code** - Check periodically
6. **Don't open huge folders** - Keep organized
7. **Monitor extensions** - Review monthly

---

## 📞 When to Contact Support:

If errors persist after all fixes:
1. Check VS Code GitHub Issues
2. Report with logs: `Help → Report Issue`
3. Include: OS version, VS Code version, extensions list
4. Try with minimal extensions enabled

---

Last Updated: January 18, 2026
