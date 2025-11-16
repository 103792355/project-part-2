# Tech Job Portal - Installation Guide

## Quick Start (5 Minutes)

### Requirements
- XAMPP (includes Apache + MySQL + PHP)
- Modern web browser

### Installation Steps

1. **Install XAMPP**
   - Download from: https://www.apachefriends.org/
   - Install with default settings
   - Start Apache and MySQL from XAMPP Control Panel

2. **Deploy Project**
   ```
   Copy project folder to:
   C:\xampp\htdocs\project2\
   ```

3. **Configure Database** (Optional - Auto-configured)
   - Default settings in `settings.php` work with XAMPP
   - Database `project2_db` creates automatically

4. **Access Website**
   ```
   Open browser: http://localhost/project2/
   ```

5. **Done!**
   - Database and tables auto-create on first visit
   - Sample jobs are automatically inserted

## Default Database Settings

```php
Host:     localhost
User:     root
Password: (empty)
Database: project2_db
```

## Manual Database Setup (Optional)

If you prefer manual setup:

1. Open phpMyAdmin: `http://localhost/phpmyadmin/`
2. Create database: `project2_db`
3. Run SQL script from `database_setup.sql`

## Troubleshooting

### Error: "Cannot connect to database"
**Solution**: Check MySQL is running in XAMPP Control Panel

### Error: "Page not found" / 404
**Solution**: 
- Verify Apache is running
- Check path: `C:\xampp\htdocs\project2\`
- Try: `http://localhost/project2/index.php`

### Error: "Forbidden" / 403
**Solution**:
- Restart Apache
- Check file permissions

### Port Conflicts
If Apache won't start (port 80 busy):
- Stop IIS or Skype
- Or change Apache port in httpd.conf

## Production Deployment

For live hosting:

1. Upload files to `public_html/`
2. Create MySQL database via cPanel
3. Update `settings.php` with hosting credentials
4. Set file permissions: files 644, folders 755
5. Access your domain

## Testing Checklist

After installation:
- [ ] Home page loads
- [ ] Jobs page shows 3 sample jobs
- [ ] Application form accessible
- [ ] Database `project2_db` exists
- [ ] Tables `eoi` and `jobs` exist
- [ ] Can submit application successfully
- [ ] Manage page displays EOI list

## Support

For issues, check:
- PHP error logs: `C:\xampp\php\logs\`
- Apache error logs: `C:\xampp\apache\logs\`
- README.md for detailed documentation

---

**Installation complete! Visit: http://localhost/project2/**

