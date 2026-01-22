# 🧪 TESTING SINTAS REDIRECT FLOW

## Quick Test Steps

### Step 1: Open Login Page
```
http://localhost/login
```

### Step 2: Login with Test Account
- **Email:** `employee@sintasv1.test`
- **Password:** `password`

### Step 3: Expected Flow
1. ✓ Submit login form
2. ✓ Redirect to `/sintas/welcome` (SINTAS Welcome Page)
3. ✓ See countdown timer: "3 → 2 → 1"
4. ✓ See "Mulai Eksplorasi SINTAS" button
5. **Choice A:** Wait for countdown → Auto-redirect to dashboard
6. **Choice B:** Click button → Instant redirect to dashboard

### Step 4: Expected Final Destination
For `employee@sintasv1.test` (role: employee, dept: operations):
```
http://localhost/departments/operations/dashboard
```

---

## 🔍 Debug & Troubleshooting

### Check Session Data
```
http://localhost/debug/session
```
Should show:
```json
{
  "intended_redirect": "/departments/operations/dashboard",
  "auth_user": "employee@sintasv1.test",
  "all_sessions": { ... }
}
```

### View Browser Console
1. Open Developer Tools: `F12`
2. Go to **Console** tab
3. Look for debug messages:
   ```
   ==== SINTAS Welcome Page Debug ====
   Intended Redirect (from session): /departments/operations/dashboard
   Auth User: employee@sintasv1.test
   =====================================
   ```

### Check Welcome Page Debug Info
- If `APP_DEBUG=true` in `.env`, you'll see:
  ```
  Debug Info:
  Intended Redirect: /departments/operations/dashboard
  Auth User: employee@sintasv1.test
  ```

---

## 📊 Possible Issues & Solutions

### Issue 1: Session not persisted
**Symptom:** Debug shows `intended_redirect: NOT SET`

**Solution:**
1. Check `.env` - `SESSION_DRIVER=file` or `database`
2. Check if `storage/framework/sessions/` exists
3. Run: `php artisan cache:clear`

### Issue 2: Countdown doesn't start
**Symptom:** Timer stays at 3, no countdown

**Solution:**
1. Check browser console for JavaScript errors
2. Verify `session('intended_redirect')` is rendered
3. Check if auth middleware passes

### Issue 3: Button click doesn't redirect
**Symptom:** Click button but nothing happens

**Solution:**
1. Check browser console for errors
2. Verify href attribute: `{{ session('intended_redirect') }}`
3. Try clicking with JavaScript enabled

### Issue 4: Auto-redirect not working
**Symptom:** Countdown reaches 0 but no redirect

**Solution:**
1. Check console for `Countdown complete! Redirecting to:`
2. Verify intendedRedirect has value
3. Check if target route exists: `php artisan route:list | grep operations`

---

## 🔧 Manual Testing Commands

### Test Session Storage
```bash
php artisan test:redirect-flow
```

### List Department Routes
```bash
php artisan route:list | grep departments | head -10
```

### Clear All Caches
```bash
php artisan cache:clear && php artisan view:clear && php artisan route:clear
```

### Test Database User
```bash
php artisan tinker
>>> App\Models\User::where('email', 'employee@sintasv1.test')->first()
```

---

## 📋 Expected Components

✅ **AuthenticatedSessionController**
- Calculates redirect URL based on role + department
- Stores in session as `intended_redirect`
- Redirects to `/sintas/welcome`

✅ **Welcome Page View**
- Displays countdown timer "3 → 2 → 1"
- Shows "Mulai Eksplorasi SINTAS" button
- Renders debug info if APP_DEBUG=true

✅ **JavaScript Logic**
- Starts countdown on page load
- Updates counter every 1 second
- Redirects to intendedRedirect when countdown = 0
- Allows button click to skip countdown

✅ **Routes Configuration**
- `/sintas/welcome` protected with auth middleware
- Department dashboard routes available

---

## 🎯 Success Criteria

- [x] User logs in successfully
- [x] Redirected to welcome page (not dashboard)
- [x] Countdown timer displays and counts down
- [x] Button available to click
- [x] Auto-redirect after countdown OR button click
- [x] Lands on correct dashboard for their role/department
- [x] Console logs show debug messages

---

## 📞 If Still Not Working

1. **Check caches cleared:**
   ```bash
   php artisan cache:clear && php artisan view:clear && php artisan route:clear
   ```

2. **Check .env settings:**
   ```
   APP_DEBUG=true
   SESSION_DRIVER=file
   ```

3. **Check browser cookies:**
   - F12 → Application → Cookies → Check LARAVEL_SESSION

4. **Monitor server logs:**
   ```bash
   tail -f storage/logs/laravel.log
   ```

5. **Test with different browser:**
   - Try incognito/private mode
   - Clear browser cache
   - Try different browser

---

**Created:** 2026-01-23
**Status:** Ready for Testing
