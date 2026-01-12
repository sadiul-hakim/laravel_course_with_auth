Below is a **clean, accurate Laravel 12 Request Lifecycle diagram**, followed by a **step-by-step explanation** so you really understand _where things happen_.

---

## Laravel 12 Request Lifecycle (Diagram)

```
┌──────────────────┐
│   HTTP Request   │
│ (Browser / API)  │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│ public/index.php │
│ (Entry Point)    │
└────────┬─────────┘
         │
         ▼
┌──────────────────────────┐
│ Bootstrap Application    │
│ - Load Composer autoload │
│ - Create App instance   │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ HTTP Kernel              │
│ App\Http\Kernel          │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Global Middleware Stack  │
│ (maintenance, CORS, etc) │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Route Matching           │
│ (web.php / api.php)      │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Route Middleware         │
│ (auth, throttle, etc)    │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Controller / Closure     │
│ (Dependency Injection)   │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Business Logic           │
│ Services / Models        │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Response Created         │
│ (JSON / View / Redirect) │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────────────┐
│ Terminate Middleware     │
│ (after response sent)    │
└────────┬─────────────────┘
         │
         ▼
┌──────────────────┐
│ HTTP Response    │
│ Sent to Client   │
└──────────────────┘
```

---

## Step-by-Step Explanation (Laravel way)

### 1️⃣ `public/index.php` (Single Entry Point)

```php
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
```

-   Loads Composer
-   Creates Laravel application instance
-   Nothing business-related happens here

---

### 2️⃣ HTTP Kernel (`App\Http\Kernel`)

```php
$response = $kernel->handle($request);
```

Kernel is responsible for:

-   Registering **global middleware**
-   Handling request → response

---

### 3️⃣ Global Middleware

Runs for **every request**:

Examples:

-   Maintenance mode
-   CORS
-   Trust proxies
-   Trim strings

Defined in:

```php
protected $middleware = [
    // global middleware
];
```

---

### 4️⃣ Route Resolution

Laravel matches request to route:

```php
Route::post('/pay', [PaymentController::class, 'pay']);
```

Route files:

-   `routes/web.php`
-   `routes/api.php`

---

### 5️⃣ Route Middleware

Middleware attached to route/group:

```php
Route::middleware(['auth', 'verified'])->group(...)
```

Examples:

-   Authentication
-   Authorization
-   Throttling

---

### 6️⃣ Controller Resolution (Dependency Injection)

```php
class PaymentController
{
    public function __construct(PaymentService $service)
    {
    }
}
```

Laravel:

-   Resolves controller
-   Injects dependencies via **Service Container**
-   Applies **contextual bindings**

---

### 7️⃣ Business Logic Layer

Usually:

-   Services
-   Repositories
-   Models
-   Jobs / Events

This is where **real work** happens.

---

### 8️⃣ Response Creation

Controller returns:

```php
return response()->json([...]);
```

or

```php
return view('payment.success');
```

Laravel wraps it into a `Response` object.

---

### 9️⃣ Terminate Middleware (After Response)

Runs **after response is sent**:

```php
public function terminate($request, $response)
```

Used for:

-   Logging
-   Cleanup
-   Analytics

---

### 🔁 Response sent back to client

Request lifecycle complete.

---

## Mental Model (Important)

> **Laravel is a pipeline**

-   Request goes **down**
-   Response comes **back up**
-   Middleware wraps around everything

Very similar to:

-   Java Servlet filters
-   Spring HandlerInterceptors

---
