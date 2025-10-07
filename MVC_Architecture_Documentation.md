# MVC Architecture Documentation - Tata Usaha Surat Menyurat System

## Table of Contents
1. [System Overview](#system-overview)
2. [MVC Pattern Implementation](#mvc-pattern-implementation)
3. [Model Layer](#model-layer)
4. [View Layer](#view-layer)
5. [Controller Layer](#controller-layer)
6. [Additional Components](#additional-components)
7. [Data Flow](#data-flow)
8. [Authentication & Authorization](#authentication--authorization)
9. [File Structure](#file-structure)

---

## System Overview

The **Tata Usaha Surat Menyurat System** is a Laravel-based web application designed for managing correspondence at Telkom Schools Banjarbaru. The system follows the **Model-View-Controller (MVC)** architectural pattern, enhanced with **Livewire** components for reactive interfaces.

### Core Functionality
- **Public Correspondence Submission**: External users can submit letters/documents
- **Administrative Management**: Staff can manage, review, and process correspondence
- **Status Tracking**: Real-time status updates for submitted correspondence
- **Role-based Access**: Different access levels for admins, teachers, and public users

---

## MVC Pattern Implementation

### Laravel MVC Structure
```
app/
├── Http/Controllers/     # Controller Layer
├── Models/              # Model Layer (Data/Business Logic)
└── Livewire/           # Livewire Components (Enhanced Controllers)

resources/views/         # View Layer (Presentation)
├── public/             # Public-facing views
├── admin/              # Admin panel views
├── auth/               # Authentication views
└── livewire/           # Livewire component views

routes/
└── web.php             # Route definitions (Entry Points)
```

---

## Model Layer

The Model layer handles **data management** and **business logic**.

### Core Models

#### 1. `Pesan` Model (`app/Models/Pesan.php`)
**Purpose**: Represents correspondence/letters in the system

```php
class Pesan extends Model
{
    protected $table = 'tb_pesan';
    protected $primaryKey = 'id_pesan';
    public $timestamps = false;
    
    protected $fillable = [
        'nomor_pesan',       // Letter number
        'judul',             // Title/subject
        'kategori',          // Category (akademik, kesiswaan, etc.)
        'tipe',              // Type (masuk/keluar)
        'pengirim',          // Sender name
        'instansi',          // Sender institution
        'alamat_pengirim',   // Sender address
        'kontak_pengirim',   // Sender contact
        'perihal',           // Subject matter
        'status_pesan',      // Status (pending, diterima, etc.)
        'tanggal_kirim',     // Send date
        'id_penerima'        // Recipient ID
    ];
}
```

**Key Features**:
- Custom table name (`tb_pesan`)
- Custom primary key (`id_pesan`)
- Disabled Laravel timestamps (custom date handling)
- Status management for workflow

#### 2. `User` Model (`app/Models/User.php`)
**Purpose**: Represents system users (staff members)

```php
class User extends Authenticatable
{
    protected $table = 'tb_pengguna';
    protected $primaryKey = 'id_pengguna';
    
    protected $fillable = [
        'nama',
        'email',
        'password',
        'divisi'    // Department/division
    ];
}
```

#### 3. `Lampiran` Model (`app/Models/Lampiran.php`)
**Purpose**: Manages file attachments for correspondence

```php
class Lampiran extends Model
{
    protected $table = 'tb_lampiran';
    protected $primaryKey = 'id_lampiran';
    
    protected $fillable = [
        'id_pesan',     // Foreign key to Pesan
        'nama_file',    // Original filename
        'path_file',    // Storage path
        'ukuran_file',  // File size
        'jenis_file'    // File type/extension
    ];
}
```

### Model Relationships
```php
// Pesan Model
public function lampiran() {
    return $this->hasMany(Lampiran::class, 'id_pesan');
}

public function penerima() {
    return $this->belongsTo(User::class, 'id_penerima', 'id_pengguna');
}

// User Model  
public function pesanDiterima() {
    return $this->hasMany(Pesan::class, 'id_penerima', 'id_pengguna');
}

// Lampiran Model
public function pesan() {
    return $this->belongsTo(Pesan::class, 'id_pesan');
}
```

---

## View Layer

The View layer handles **presentation** and **user interface**.

### View Structure

#### 1. **Public Views** (`resources/views/public/`)
- **Purpose**: Public-facing interface for external users
- **Key Files**:
  - `layout.blade.php` - Public layout template
  - `pesan/create.blade.php` - Letter submission form
  - `pesan/success.blade.php` - Success confirmation page

#### 2. **Admin Views** (`resources/views/admin/`)
- **Purpose**: Administrative interface for staff
- **Key Files**:
  - `pesan/index.blade.php` - Letter management dashboard
  - `pesan/show.blade.php` - Letter detail view
  - `pesan/create.blade.php` - Internal letter creation

#### 3. **Authentication Views** (`resources/views/livewire/auth/`)
- **Purpose**: User authentication interfaces
- **Key Files**:
  - `custom-login.blade.php` - Custom login component
  - `register.blade.php` - User registration

#### 4. **Shared Components** (`resources/views/components/`)
- **Purpose**: Reusable UI components
- **Examples**: Layout templates, navigation, common forms

### Blade Templating Features Used

```blade
{{-- Template Inheritance --}}
@extends('public.layout')

{{-- Section Definition --}}
@section('content')
    <!-- Page content -->
@endsection

{{-- Component Usage --}}
<x-app-custom>
    <x-slot name="title">Dashboard</x-slot>
</x-app-custom>

{{-- Conditional Rendering --}}
@if($letters->count() > 0)
    @foreach($letters as $letter)
        <!-- Letter display -->
    @endforeach
@else
    <p>No letters found</p>
@endif

{{-- Asset Management --}}
@push('styles')
    <style>/* Custom CSS */</style>
@endpush
```

---

## Controller Layer

The Controller layer handles **request processing** and **business coordination**.

### Core Controllers

#### 1. `PublicPesanController` (`app/Http/Controllers/PublicPesanController.php`)
**Purpose**: Handles public correspondence submission

```php
class PublicPesanController extends Controller
{
    // Show submission form
    public function create() {
        $staffMembers = User::where('email', '!=', 'visitor@dummy.local')
            ->orderBy('divisi')
            ->get()
            ->groupBy('divisi');
            
        return view('public.pesan.create', compact('staffMembers'));
    }

    // Process form submission
    public function store(Request $request) {
        // Validation
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            // ... other validations
        ]);

        // Create letter record
        $pesan = Pesan::create($validated);

        // Handle file uploads
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                // Store file and create Lampiran record
            }
        }

        return redirect()->route('public.pesan.success');
    }

    // AJAX endpoint for dynamic dropdowns
    public function getStaffByDivisi($divisi) {
        $staffMembers = User::where('divisi', $divisi)
            ->orderBy('nama')
            ->get(['id_pengguna', 'nama', 'divisi']);
            
        return response()->json($staffMembers);
    }
}
```

#### 2. `AdminPesanController` (`app/Http/Controllers/AdminPesanController.php`)
**Purpose**: Administrative management of correspondence

```php
class AdminPesanController extends Controller
{
    // List all letters with filtering/search
    public function index(Request $request) {
        $query = Pesan::query();
        
        // Apply search filters
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        $letters = $query->paginate(10);
        
        return view('admin.pesan.index', compact('letters'));
    }

    // Show letter details
    public function show($id) {
        $letter = Pesan::with('lampiran', 'penerima')->findOrFail($id);
        
        if (request()->expectsJson()) {
            return response()->json($letter);
        }
        
        return view('admin.pesan.show', compact('letter'));
    }

    // Update letter status
    public function update(Request $request, $id) {
        $letter = Pesan::findOrFail($id);
        
        $validated = $request->validate([
            'status_pesan' => 'required|in:pending,diterima,dalam_proses,perlu_perbaikan,disetujui,ditolak'
        ]);
        
        $letter->update($validated);
        
        return response()->json(['success' => true]);
    }
}
```

#### 3. `WelcomeController` (`app/Http/Controllers/WelcomeController.php`)
**Purpose**: Handles homepage display

```php
class WelcomeController extends Controller
{
    public function index() {
        // Get recent letters for display
        $recentLetters = Pesan::orderBy('tanggal_kirim', 'desc')
            ->limit(5)
            ->get();
            
        return view('welcome', compact('recentLetters'));
    }
}
```

### Controller Responsibilities
1. **Request Validation**: Validate incoming data
2. **Business Logic**: Coordinate between models
3. **Data Preparation**: Prepare data for views
4. **Response Generation**: Return appropriate responses (views/JSON)
5. **Error Handling**: Handle exceptions and errors

---

## Additional Components

### 1. Livewire Components
**Purpose**: Enhanced interactivity and real-time updates

#### Custom Login Component (`resources/views/livewire/auth/custom-login.blade.php`)
```php
<?php
// Livewire component class
new #[Layout('components.layouts.auth.custom-login')] class extends Component {
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void {
        $this->validate();
        
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'Invalid credentials');
            return;
        }
        
        $this->redirect(route('dashboard'));
    }
}; ?>

{{-- Blade template --}}
<div>
    <form wire:submit.prevent="login">
        <input wire:model="email" type="email" placeholder="Email" />
        <input wire:model="password" type="password" placeholder="Password" />
        <button type="submit">Log in</button>
    </form>
</div>
```

### 2. Middleware
- **Authentication**: `auth` middleware for protected routes
- **Role-based Access**: Custom middleware for admin/teacher routes

### 3. Request Classes
- **Form Validation**: Custom request classes for complex validation

---

## Data Flow

### 1. Public Letter Submission Flow
```
1. User visits /pesan/create
2. Route → PublicPesanController@create
3. Controller fetches staff data from User model
4. Returns public.pesan.create view with data
5. User submits form
6. Route → PublicPesanController@store
7. Controller validates & saves to Pesan model
8. Handles file uploads → Lampiran model
9. Redirects to success page
```

### 2. Admin Letter Management Flow
```
1. Admin visits /admin/pesan
2. Middleware checks authentication
3. Route → AdminPesanController@index
4. Controller queries Pesan model with filters
5. Returns admin.pesan.index view
6. Admin clicks letter for details
7. AJAX request → AdminPesanController@show
8. Returns JSON response
9. JavaScript updates UI
```

### 3. Status Update Flow
```
1. Admin changes status in modal
2. JavaScript submits AJAX request
3. Route → AdminPesanController@update
4. Controller validates & updates Pesan model
5. Returns JSON success response
6. Frontend updates UI
```

---

## Authentication & Authorization

### Authentication System
- **Laravel Fortify**: Backend authentication
- **Livewire/Volt**: Frontend components
- **Custom Login**: Enhanced user experience

### User Roles & Permissions
```php
// Route grouping by role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pesan', AdminPesanController::class);
    });
    
    // Teacher routes  
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [GuruPesanController::class, 'dashboard']);
    });
});
```

### Access Control
- **Public Routes**: Letter submission, homepage
- **Authenticated Routes**: Dashboard, admin panel
- **Role-based Routes**: Admin vs Teacher access

---

## File Structure

```
tata_usaha_surat/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AdminPesanController.php
│   │       ├── PublicPesanController.php
│   │       ├── GuruPesanController.php
│   │       ├── WelcomeController.php
│   │       └── DashboardController.php
│   ├── Models/
│   │   ├── Pesan.php
│   │   ├── User.php
│   │   └── Lampiran.php
│   └── Livewire/
│       └── Actions/
│           └── Logout.php
├── resources/
│   └── views/
│       ├── public/
│       │   ├── layout.blade.php
│       │   └── pesan/
│       │       ├── create.blade.php
│       │       └── success.blade.php
│       ├── admin/
│       │   └── pesan/
│       │       ├── index.blade.php
│       │       └── show.blade.php
│       ├── livewire/
│       │   └── auth/
│       │       └── custom-login.blade.php
│       ├── welcome.blade.php
│       └── dashboard.blade.php
├── routes/
│   └── web.php
└── database/
    └── migrations/
        ├── create_pesan_table.php
        ├── create_pengguna_table.php
        └── create_lampiran_table.php
```

---

## Key Design Patterns

### 1. **Repository Pattern** (Implicit)
- Models act as repositories for data access
- Controllers coordinate between models

### 2. **Observer Pattern**
- Livewire components observe state changes
- Real-time UI updates

### 3. **Factory Pattern**
- Model factories for testing
- Eloquent model creation

### 4. **Facade Pattern**
- Laravel facades (Auth, Storage, etc.)
- Simplified interface to complex subsystems

---

## Benefits of This MVC Implementation

### 1. **Separation of Concerns**
- **Models**: Pure data and business logic
- **Views**: Pure presentation logic
- **Controllers**: Request coordination only

### 2. **Maintainability**
- Clear code organization
- Easy to locate and modify functionality
- Reusable components

### 3. **Scalability**
- Easy to add new features
- Modular architecture
- Database abstraction through Eloquent

### 4. **Testability**
- Models can be unit tested
- Controllers can be integration tested
- Views can be tested independently

### 5. **Security**
- Built-in protection (CSRF, XSS)
- Authentication middleware
- Input validation

---

## Conclusion

The Tata Usaha Surat Menyurat system effectively implements the MVC pattern using Laravel's framework capabilities. The architecture provides a robust, maintainable, and scalable solution for correspondence management while ensuring security and user experience through modern web development practices.

The combination of traditional Laravel MVC with Livewire components creates a powerful hybrid that maintains the benefits of server-side rendering while providing reactive user interfaces where needed.
