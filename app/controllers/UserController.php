<?php

class UserController extends Controller {
    private $translator;

    // Auto-wire dependencies from Wisp container
    public function __construct(TranslateService $translateService) {
        $this->translator = $translateService;
    }

    public function index($req) {
        $greeting = $this->translator->translate("Hello from UserController!");
        
        $products = [];
        try {
            // Query DB using Active Record
            $products = Product::all();
        } catch (\Exception $e) {
            // Fallback list if DB is not initialized yet
            $products = [
                new Product(['id' => 1, 'name' => 'Wisp Framework Guide', 'price' => 0.00]),
                new Product(['id' => 2, 'name' => 'MVC Plugin License', 'price' => 49.99])
            ];
        }

        return $this->view('products', [
            'title' => 'Product Listing',
            'greeting' => $greeting,
            'products' => $products
        ]);
    }

    public function dbDemo($req) {
        try {
            // Create products table dynamically if it doesn't exist for test environment
            $driver = strtolower($_ENV['DB_CONNECTION'] ?? 'mysql');
            if ($driver === 'sqlite') {
                \Wisp\DB::execute("CREATE TABLE IF NOT EXISTS products (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT, price REAL)");
            } else {
                \Wisp\DB::execute("CREATE TABLE IF NOT EXISTS products (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), price DECIMAL(10,2))");
            }

            // 1. Create & Save (Insert)
            $product = new Product();
            $product->name = 'Premium MVC Addon ' . rand(100, 999);
            $product->price = rand(10, 100) + 0.99;
            $product->save();

            // 2. Fetch all products
            $products = Product::all();

            // 3. Find one and update
            $foundProduct = Product::find($product->id);
            if ($foundProduct) {
                $foundProduct->price = $foundProduct->price + 5.00;
                $foundProduct->save();
            }

            // Refresh list
            $products = Product::all();

            return $this->json([
                'status' => 'success',
                'message' => 'Active Record CRUD executed successfully!',
                'inserted_product' => $product->toArray(),
                'updated_price_of_last' => $foundProduct ? $foundProduct->price : null,
                'total_records' => count($products),
                'products' => array_map(fn($p) => $p->toArray(), $products)
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
