# wisp-mvc

MVC (Model-View-Controller) architecture plugin for the [Wisp](https://github.com/tlek-tech/wisp) PHP micro-framework.

Adds base `Controller`, `Model` (Active Record with query builder), and `View` (Blade-style template compiler with caching) classes, route resolution for `'Controller@action'` and `['Controller', 'action']` syntax, automatic constructor dependency injection via Wisp's container, and directory autoloading for `app/controllers/` and `app/models/`.

## Requirements

Your Wisp core must support the plugin extension points this relies on:
- Callback resolution via `$app->registerCallbackResolver()`
- Dependency injection via `$app->resolve()`
- Database query builder `\Wisp\DbBuilder` and `\Wisp\DB`
- The `plugins/` auto-loader in `public/index.php` (loads `plugins/<name>/<name>.php`)
- Write permissions for `storage/views/` (for compiled template caching)

## Install

1. Copy the `plugins/mvc/` folder from this repo into your Wisp project's `plugins/` folder:
   ```
   your-wisp-project/
   └── plugins/
       └── mvc/
           └── mvc.php
   ```
2. Create or copy the MVC directory structure into your project:
   ```
   your-wisp-project/
   ├── app/
   │   ├── controllers/
   │   ├── models/
   │   └── views/
   └── storage/
       └── views/
   ```
3. That's it — Wisp's plugin loader picks up `plugins/mvc/mvc.php` automatically on boot.

## Usage

### 1. Controllers

Controllers extend `Controller` (or `\Wisp\Controller`) and support constructor dependency injection:

```php
// app/controllers/UserController.php
class UserController extends Controller {
    public function index($req) {
        $products = Product::all();

        return $this->view('products', [
            'title' => 'Product Listing',
            'products' => $products
        ]);
    }
}
```

Helper methods available in controllers:
- `$this->view(string $name, array $data = [])`
- `$this->json(mixed $data, int $status = 200, array $headers = [])`
- `$this->text(string $text, int $status = 200, array $headers = [])`
- `$this->redirect(string $url, int $status = 302)`

### 2. Models (Active Record)

Models extend `Model` (or `\Wisp\Model`) and automatically map to snake_case plural table names (e.g. `Product` &rarr; `products`):

```php
// app/models/Product.php
class Product extends Model {
    // protected string $table = 'products';      // Optional override
    // protected string $primaryKey = 'id';       // Optional override
}

// Queries & CRUD
$products = Product::all();
$product = Product::find(1);
$active = Product::where('status', 'active')->get();

// Insert or update
$item = new Product();
$item->name = 'Wisp Framework Guide';
$item->price = 19.99;
$item->save();

// Delete
$item->delete();
```

### 3. Views (Blade-Style Templates)

Views are stored in `app/views/` using the `.view.php` extension and compiled to `storage/views/`:

```html
<!-- app/views/products.view.php -->
@extends('layouts.main')

@section('content')
    <h2>{{ $title }}</h2>

    @if(empty($products))
        <p>No products found.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - ${{ number_format($product->price, 2) }}</li>
            @endforeach
        </ul>
    @endif
@endsection
```

Supported template directives:
- Layout inheritance: `@extends('layout')`, `@section('name')` ... `@endsection`, `@yield('name')`
- Sub-views: `@include('partial')` (renders with isolated variable scope)
- Variable output: `{{ $escaped }}` and `{!! $raw !!}`
- Comments: `{{-- comment --}}`
- Conditionals: `@if(...)`, `@elseif(...)`, `@else`, `@endif`, `@unless(...)`, `@endunless`
- Loops: `@foreach(...)`, `@endforeach`, `@while(...)`, `@endwhile`

### 4. Routing

Routes can be registered using `'Controller@action'` strings or `['ControllerClass', 'action']` arrays:

```php
// String syntax
$app->get('/mvc-demo', 'UserController@index');

// Array syntax
$app->get('/mvc-demo/db', ['UserController', 'dbDemo']);
```

See `routes/mvc-demo.php` and the `app/` folder in this repo for a runnable example (copy them into your project's folders if you want the `/mvc-demo` endpoints).

## License

MIT
