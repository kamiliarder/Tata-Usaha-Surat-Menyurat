# Postman Testing Setup for Tata Usaha Surat

## Environment Variables
Create environment: "Local Development"
- `base_url` = `http://127.0.0.1:8000`
- `auth_token` = (auto-filled)
- `XSRF-TOKEN` = (auto-filled)

## Request Order

### 1. Get CSRF Cookie
**Method:** GET
**URL:** `{{base_url}}/sanctum/csrf-cookie`

**Tests:**
```javascript
pm.test("CSRF cookie received", function () {
    pm.expect(pm.cookies.has('XSRF-TOKEN')).to.be.true;
    const xsrfCookie = pm.cookies.get('XSRF-TOKEN');
    pm.environment.set('XSRF-TOKEN', decodeURIComponent(xsrfCookie));
});
```

### 2. Get Auth Token
**Method:** POST
**URL:** `{{base_url}}/api/token`

**Body (JSON):**
```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

**Tests:**
```javascript
pm.test("Token received", function () {
    var jsonData = pm.response.json();
    pm.environment.set("auth_token", jsonData.token);
});
```

### 3. Submit Public Message
**Method:** POST
**URL:** `{{base_url}}/public/pesan/store`

**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (form-data):**
```
judul: Test Message
perihal: Test content
kategori: akademik
id_penerima: 1
pengirim: John Doe
instansi: Test School
kontak_pengirim: 08123456789
alamat_pengirim: 123 Test St
```

### 4. Create Message (Authenticated)
**Method:** POST
**URL:** `{{base_url}}/pesan`

**Authorization:** Bearer Token
**Token:** `{{auth_token}}`

**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (form-data):**
```
judul: Internal Message
perihal: Test
kategori: umum
id_penerima: 2
tipe: keluar
```

### 5. Update Message
**Method:** PATCH
**URL:** `{{base_url}}/pesan/1`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (JSON):**
```json
{
    "perihal": "Updated",
    "status_pesan": "selesai"
}
```

### 6. Delete Message
**Method:** DELETE
**URL:** `{{base_url}}/pesan/1`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

### 7. Reply to Message
**Method:** POST
**URL:** `{{base_url}}/pesan/1/reply`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (form-data):**
```
isi_balasan: This is a reply
```

### 8. Create User (Admin)
**Method:** POST
**URL:** `{{base_url}}/akun`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (JSON):**
```json
{
    "nama": "Test User",
    "email": "test@example.com",
    "password": "password123",
    "role": "guru",
    "nomor_telp": "08123456789",
    "nip": "987654321"
}
```

### 9. Update User
**Method:** PUT
**URL:** `{{base_url}}/akun/1`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

**Body (JSON):**
```json
{
    "nama": "Updated Name",
    "nomor_telp": "08199999999"
}
```

### 10. Delete User
**Method:** DELETE
**URL:** `{{base_url}}/akun/1`

**Authorization:** Bearer Token
**Headers:**
- `X-XSRF-TOKEN`: `{{XSRF-TOKEN}}`

## Tips
1. Always run "Get CSRF Cookie" first
2. Run "Get Auth Token" second
3. Add `X-XSRF-TOKEN` header to all web route requests
4. API routes (`/api/*`) don't need CSRF tokens
5. Use Collection Runner to run all tests in sequence
