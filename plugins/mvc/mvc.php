<?php
namespace Wisp;

// 1. Directory Autoloader for Controllers and Models
spl_autoload_register(function ($class) {
    $baseDir = (defined('APP_ROOT') ? APP_ROOT : realpath(__DIR__ . '/../../')) . '/';
    $dirs = [
        $baseDir . 'app/controllers/',
        $baseDir . 'app/models/',
        realpath(__DIR__ . '/../../') . '/app/controllers/',
        realpath(__DIR__ . '/../../') . '/app/models/',
    ];
    $dirs = array_unique($dirs);
    foreach ($dirs as $dir) {
        // Strip namespace if present
        $parts = explode('\\', $class);
        $className = end($parts);
        $file = $dir . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// 2. Base Controller Class
class Controller {
    protected function view(string $name, array $data = []): Response {
        return View::render($name, $data);
    }

    protected function json($data, int $status = 200, array $headers = []): Response {
        return Response::json($data, $status, $headers);
    }

    protected function text(string $text, int $status = 200, array $headers = []): Response {
        return Response::text($text, $status, $headers);
    }

    protected function redirect(string $url, int $status = 302): Response {
        return Response::redirect($url, $status);
    }
}

// 3. Standalone Model Query Builder (Pure Wisp\DB - Zero external dependencies)
class ModelQueryBuilder {
    protected string $table;
    protected string $modelClass;
    protected array $wheres = [];
    protected array $bindings = [];
    protected array $orders = [];
    protected ?int $limit = null;
    protected ?int $offset = null;

    public function __construct(string $table, string $modelClass = '') {
        $this->table = $table;
        $this->modelClass = $modelClass;
    }

    public function setModelClass(string $modelClass): self {
        $this->modelClass = $modelClass;
        return $this;
    }

    public function getModelClass(): string {
        return $this->modelClass;
    }

    public function where($column, $operator = null, $value = null, string $boolean = 'AND'): self {
        if (is_array($column)) {
            foreach ($column as $col => $val) {
                $this->where($col, '=', $val, $boolean);
            }
            return $this;
        }

        if ($value === null && $operator !== null) {
            $value = $operator;
            $operator = '=';
        }

        $this->wheres[] = [
            'type' => 'basic',
            'column' => $column,
            'operator' => strtoupper((string)$operator),
            'value' => $value,
            'boolean' => strtoupper($boolean),
        ];
        $this->bindings[] = $value;

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null): self {
        return $this->where($column, $operator, $value, 'OR');
    }

    public function whereIn(string $column, array $values, string $boolean = 'AND'): self {
        if (empty($values)) {
            $this->wheres[] = [
                'type' => 'raw',
                'sql' => '0 = 1',
                'boolean' => strtoupper($boolean),
            ];
            return $this;
        }

        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->wheres[] = [
            'type' => 'raw',
            'sql' => $this->quoteIdentifier($column) . " IN ($placeholders)",
            'boolean' => strtoupper($boolean),
        ];
        foreach ($values as $v) {
            $this->bindings[] = $v;
        }

        return $this;
    }

    public function whereNotIn(string $column, array $values, string $boolean = 'AND'): self {
        if (empty($values)) {
            return $this;
        }

        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        $this->wheres[] = [
            'type' => 'raw',
            'sql' => $this->quoteIdentifier($column) . " NOT IN ($placeholders)",
            'boolean' => strtoupper($boolean),
        ];
        foreach ($values as $v) {
            $this->bindings[] = $v;
        }

        return $this;
    }

    public function whereNull(string $column, string $boolean = 'AND'): self {
        $this->wheres[] = [
            'type' => 'raw',
            'sql' => $this->quoteIdentifier($column) . " IS NULL",
            'boolean' => strtoupper($boolean),
        ];
        return $this;
    }

    public function whereNotNull(string $column, string $boolean = 'AND'): self {
        $this->wheres[] = [
            'type' => 'raw',
            'sql' => $this->quoteIdentifier($column) . " IS NOT NULL",
            'boolean' => strtoupper($boolean),
        ];
        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): self {
        $dir = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';
        $this->orders[] = $this->quoteIdentifier($column) . ' ' . $dir;
        return $this;
    }

    public function latest(string $column = 'id'): self {
        return $this->orderBy($column, 'DESC');
    }

    public function oldest(string $column = 'id'): self {
        return $this->orderBy($column, 'ASC');
    }

    public function limit(int $limit): self {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self {
        $this->offset = $offset;
        return $this;
    }

    public function get(): array {
        $sql = $this->toSelectSql();
        $rows = DB::query($sql, $this->bindings);

        if (empty($this->modelClass) || !class_exists($this->modelClass)) {
            return $rows;
        }

        $results = [];
        foreach ($rows as $row) {
            $instance = new $this->modelClass();
            if (method_exists($instance, 'forceFill')) {
                $instance->forceFill($row);
            }
            $results[] = $instance;
        }
        return $results;
    }

    public function first() {
        $this->limit(1);
        $results = $this->get();
        return !empty($results) ? $results[0] : null;
    }

    public function count(): int {
        $sql = "SELECT COUNT(*) FROM " . $this->quoteIdentifier($this->table);
        $whereSql = $this->compileWheres();
        if ($whereSql !== '') {
            $sql .= ' WHERE ' . $whereSql;
        }
        $val = DB::value($sql, $this->bindings);
        return (int)$val;
    }

    public function update(array $values): int {
        if (empty($values)) {
            return 0;
        }

        $sets = [];
        $updateBindings = [];
        foreach ($values as $col => $val) {
            $sets[] = $this->quoteIdentifier($col) . " = ?";
            $updateBindings[] = $val;
        }

        $sql = "UPDATE " . $this->quoteIdentifier($this->table) . " SET " . implode(', ', $sets);
        $whereSql = $this->compileWheres();
        if ($whereSql !== '') {
            $sql .= ' WHERE ' . $whereSql;
        }

        $allBindings = array_merge($updateBindings, $this->bindings);
        return DB::execute($sql, $allBindings);
    }

    public function delete(): int {
        $sql = "DELETE FROM " . $this->quoteIdentifier($this->table);
        $whereSql = $this->compileWheres();
        if ($whereSql !== '') {
            $sql .= ' WHERE ' . $whereSql;
        }
        return DB::execute($sql, $this->bindings);
    }

    public function quoteIdentifier(string $identifier): string {
        $driver = strtolower($_ENV['DB_CONNECTION'] ?? 'mysql');
        $q = ($driver === 'mysql') ? '`' : '"';
        if (strpos($identifier, '.') !== false) {
            return implode('.', array_map(fn($part) => $q . str_replace($q, '', $part) . $q, explode('.', $identifier)));
        }
        return $q . str_replace($q, '', $identifier) . $q;
    }

    protected function compileWheres(): string {
        if (empty($this->wheres)) {
            return '';
        }

        $sql = '';
        foreach ($this->wheres as $i => $w) {
            $clause = '';
            if ($w['type'] === 'basic') {
                $clause = $this->quoteIdentifier($w['column']) . ' ' . $w['operator'] . ' ?';
            } elseif ($w['type'] === 'raw') {
                $clause = $w['sql'];
            }

            if ($i === 0) {
                $sql .= $clause;
            } else {
                $sql .= ' ' . $w['boolean'] . ' ' . $clause;
            }
        }
        return $sql;
    }

    protected function toSelectSql(): string {
        $sql = "SELECT * FROM " . $this->quoteIdentifier($this->table);
        $whereSql = $this->compileWheres();
        if ($whereSql !== '') {
            $sql .= ' WHERE ' . $whereSql;
        }
        if (!empty($this->orders)) {
            $sql .= ' ORDER BY ' . implode(', ', $this->orders);
        }
        if ($this->limit !== null) {
            $sql .= ' LIMIT ' . (int)$this->limit;
        }
        if ($this->offset !== null) {
            $sql .= ' OFFSET ' . (int)$this->offset;
        }
        return $sql;
    }
}

// 4. Base Model Class (Active Record - Pure Wisp\DB)
class Model {
    protected string $table = '';
    protected string $primaryKey = 'id';
    protected array $attributes = [];

    public function __construct(array $attributes = []) {
        $this->fill($attributes);
    }

    public function fill(array $attributes): self {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
        return $this;
    }

    public function forceFill(array $attributes): self {
        $this->attributes = $attributes;
        return $this;
    }

    public function __get($key) {
        return $this->attributes[$key] ?? null;
    }

    public function __set($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function __isset($key) {
        return isset($this->attributes[$key]);
    }

    public function getPrimaryKey(): string {
        return $this->primaryKey;
    }

    public static function getTable(): string {
        $static = new static();
        if (!empty($static->table)) {
            return $static->table;
        }
        $parts = explode('\\', static::class);
        $className = end($parts);
        $snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $className));
        $len = strlen($snake);
        if ($len > 0 && $snake[$len - 1] === 'y') {
            return substr($snake, 0, -1) . 'ies';
        }
        if ($len > 0 && $snake[$len - 1] === 's') {
            return $snake;
        }
        return $snake . 's';
    }

    public static function query(): ModelQueryBuilder {
        $table = static::getTable();
        return new ModelQueryBuilder($table, static::class);
    }

    public static function all(): array {
        return static::query()->get();
    }

    public static function where($column, $operator = null, $value = null): ModelQueryBuilder {
        return static::query()->where($column, $operator, $value);
    }

    public static function find($id): ?self {
        $static = new static();
        $primaryKey = $static->primaryKey;
        return static::query()->where($primaryKey, $id)->first();
    }

    public function save(): bool {
        $primaryKey = $this->primaryKey;
        $table = static::getTable();
        $query = static::query();

        if (isset($this->attributes[$primaryKey])) {
            $id = $this->attributes[$primaryKey];
            $data = $this->attributes;
            unset($data[$primaryKey]);
            
            if (empty($data)) {
                return true;
            }
            
            return $query->where($primaryKey, $id)->update($data) >= 0;
        } else {
            $cols = array_keys($this->attributes);
            if (empty($cols)) {
                return false;
            }
            $quotedCols = array_map([$query, 'quoteIdentifier'], $cols);
            $placeholders = array_fill(0, count($cols), '?');
            $sql = "INSERT INTO " . $query->quoteIdentifier($table) . " (" . implode(', ', $quotedCols) . ") VALUES (" . implode(', ', $placeholders) . ")";
            
            $success = DB::execute($sql, array_values($this->attributes)) > 0;
            if ($success) {
                try {
                    $newId = DB::lastInsertId();
                    if ($newId) {
                        $this->attributes[$primaryKey] = is_numeric($newId) ? (int)$newId : $newId;
                    }
                } catch (\Exception $e) {}
            }
            return $success;
        }
    }

    public function delete(): bool {
        $primaryKey = $this->primaryKey;
        if (!isset($this->attributes[$primaryKey])) {
            return false;
        }
        $id = $this->attributes[$primaryKey];
        return static::query()->where($primaryKey, $id)->delete() > 0;
    }

    public function toArray(): array {
        return $this->attributes;
    }
}

// 5. Caching Blade-Style Template Compiler & View Engine
class View {
    protected static array $sections = [];
    protected static array $sectionStack = [];
    protected static ?string $layout = null;

    public static function render(string $view, array $data = []): Response {
        $content = self::renderToString($view, $data);
        return Response::html($content);
    }

    public static function renderToString(string $view, array $data = []): string {
        // Every view (and, via get_defined_vars() on @include, every partial it pulls in)
        // gets $basePath for free, so templates can prefix internal links/assets with it
        // without every controller having to pass it explicitly. See Request's matching
        // stripping of BASE_PATH off incoming request paths.
        if (!array_key_exists('basePath', $data)) {
            $data['basePath'] = rtrim($_ENV['BASE_PATH'] ?? '', '/');
        }

        $viewPath = self::getViewPath($view);
        $compiledPath = self::getCompiledPath($view);

        if (!file_exists($viewPath)) {
            throw new \Exception("View template '$view' not found at '$viewPath'");
        }

        if (!file_exists($compiledPath) || filemtime($viewPath) > filemtime($compiledPath)) {
            self::compile($viewPath, $compiledPath);
        }

        $content = self::evaluate($compiledPath, $data);

        if (self::$layout !== null) {
            $layoutView = self::$layout;
            self::$layout = null;
            $output = self::renderToString($layoutView, array_merge($data, ['content' => $content]));
            self::$sections = [];
            return $output;
        }

        return $content;
    }

    // Isolated into its own frame so `include`'s shared scope only ever exposes the intended
    // template data — not renderToString()'s own $view/$viewPath/$compiledPath locals. A nested
    // @include compiles to a renderToString() call fed by get_defined_vars() at the call site,
    // which would otherwise leak those locals in and (via extract()) let them silently overwrite
    // the nested call's own $compiledPath, causing it to re-include the parent view forever.
    // EXTR_SKIP is a second layer of defense: it keeps extract() from overwriting $__compiledPath
    // even if a leaked key of that exact name ever does make it into $__data.
    private static function evaluate(string $__compiledPath, array $__data): string {
        extract($__data, EXTR_SKIP);
        ob_start();
        include $__compiledPath;
        return ob_get_clean();
    }

    public static function extend(string $layout) {
        self::$layout = $layout;
    }

    public static function start(string $name) {
        self::$sectionStack[] = $name;
        ob_start();
    }

    public static function stop() {
        if (empty(self::$sectionStack)) return;
        $name = array_pop(self::$sectionStack);
        self::$sections[$name] = ob_get_clean();
    }

    public static function yieldSection(string $name, string $default = ''): string {
        return self::$sections[$name] ?? $default;
    }

    protected static function getViewPath(string $view): string {
        $view = str_replace('.', '/', $view);
        $projectPath = (defined('APP_ROOT') ? APP_ROOT : realpath(__DIR__ . '/../../')) . '/app/views/' . $view . '.view.php';
        if (file_exists($projectPath)) {
            return $projectPath;
        }
        $pluginPath = realpath(__DIR__ . '/../../') . '/app/views/' . $view . '.view.php';
        if (file_exists($pluginPath)) {
            return $pluginPath;
        }
        return $projectPath;
    }

    protected static function getCompiledPath(string $view): string {
        $view = str_replace('.', '_', $view);
        $appRoot = defined('APP_ROOT') ? APP_ROOT : realpath(__DIR__ . '/../../');
        return $appRoot . '/storage/views/' . $view . '.compiled.php';
    }

    protected static function compile(string $src, string $dest) {
        $content = file_get_contents($src);

        // 1. Compile layouts & inheritance
        $content = preg_replace('/@extends\s*\(\s*\'([^\']+)\'\s*\)/', '<?php \Wisp\View::extend(\'$1\'); ?>', $content);
        $content = preg_replace('/@extends\s*\(\s*"([^"]+)"\s*\)/', '<?php \Wisp\View::extend(\'$1\'); ?>', $content);

        $content = preg_replace('/@section\s*\(\s*\'([^\']+)\'\s*\)/', '<?php \Wisp\View::start(\'$1\'); ?>', $content);
        $content = preg_replace('/@section\s*\(\s*"([^"]+)"\s*\)/', '<?php \Wisp\View::start(\'$1\'); ?>', $content);
        $content = str_replace('@endsection', '<?php \Wisp\View::stop(); ?>', $content);

        $content = preg_replace('/@yield\s*\(\s*\'([^\']+)\'\s*\)/', '<?php echo \Wisp\View::yieldSection(\'$1\'); ?>', $content);
        $content = preg_replace('/@yield\s*\(\s*"([^"]+)"\s*\)/', '<?php echo \Wisp\View::yieldSection(\'$1\'); ?>', $content);

        // Sub-views render with their own isolated variable scope (the including view's
        // currently-defined variables passed in as their $data), same as a fresh renderToString()
        // call — not a raw PHP include sharing scope directly.
        $content = preg_replace('/@include\s*\(\s*\'([^\']+)\'\s*\)/', '<?php echo \Wisp\View::renderToString(\'$1\', get_defined_vars()); ?>', $content);
        $content = preg_replace('/@include\s*\(\s*"([^"]+)"\s*\)/', '<?php echo \Wisp\View::renderToString(\'$1\', get_defined_vars()); ?>', $content);

        // 2. Compile comments
        $content = preg_replace('/\{\{--\s*(.*?)\s*--\}\}/s', '<?php /* $1 */ ?>', $content);

        // 3. Compile raw and escaped variables
        $content = preg_replace('/\{!!\s*(.*?)\s*!!\}/', '<?php echo $1; ?>', $content);
        $content = preg_replace('/\{\{\s*(.*?)\s*\}\}/', '<?php echo htmlspecialchars($1 ?? \'\', ENT_QUOTES, \'UTF-8\'); ?>', $content);

        // 4. Compile control directives with balanced parenthesis matching
        $directives = ['if', 'elseif', 'foreach', 'while', 'unless'];
        foreach ($directives as $dir) {
            $pattern = '/@' . $dir . '\s*\(/';
            while (preg_match($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
                $startOffset = $matches[0][1];
                $parenStart = $startOffset + strlen($matches[0][0]) - 1; // index of opening '('
                
                // Find matching closing parenthesis
                $depth = 1;
                $len = strlen($content);
                $parenEnd = -1;
                for ($i = $parenStart + 1; $i < $len; $i++) {
                    if ($content[$i] === '(') {
                        $depth++;
                    } elseif ($content[$i] === ')') {
                        $depth--;
                        if ($depth === 0) {
                            $parenEnd = $i;
                            break;
                        }
                    }
                }

                if ($parenEnd === -1) {
                    break; // Malformed, prevent infinite loop
                }

                // Extract condition inside parentheses
                $condition = substr($content, $parenStart + 1, $parenEnd - $parenStart - 1);
                
                $before = substr($content, 0, $startOffset);
                $after = substr($content, $parenEnd + 1);
                
                if ($dir === 'if') {
                    $replacement = '<?php if(' . $condition . '): ?>';
                } elseif ($dir === 'elseif') {
                    $replacement = '<?php elseif(' . $condition . '): ?>';
                } elseif ($dir === 'foreach') {
                    $replacement = '<?php foreach(' . $condition . '): ?>';
                } elseif ($dir === 'while') {
                    $replacement = '<?php while(' . $condition . '): ?>';
                } elseif ($dir === 'unless') {
                    $replacement = '<?php if(!(' . $condition . ')): ?>';
                }
                
                $content = $before . $replacement . $after;
            }
        }

        // 5. Compile static directives
        $content = str_replace('@else', '<?php else: ?>', $content);
        $content = str_replace('@endif', '<?php endif; ?>', $content);
        $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);
        $content = str_replace('@endwhile', '<?php endwhile; ?>', $content);
        $content = str_replace('@endunless', '<?php endif; ?>', $content);

        $dir = dirname($dest);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($dest, $content);
    }
}

// 6. Register Global Class Aliases
class_alias('Wisp\Controller', 'Controller');
class_alias('Wisp\Model', 'Model');
class_alias('Wisp\View', 'View');

// 7. Register MVC Routing Callback Resolver
global $app;
if (isset($app) && method_exists($app, 'registerCallbackResolver')) {
    $app->registerCallbackResolver(function ($callback, $appInstance) {
        if (is_string($callback) && strpos($callback, '@') !== false) {
            [$class, $method] = explode('@', $callback, 2);
            $name = lcfirst($class);
            try {
                $instance = $appInstance->resolve($name);
                if (method_exists($instance, $method)) {
                    return [$instance, $method];
                }
            } catch (\Exception $e) {
                error_log("[mvc] Failed to resolve controller '$class' for route callback '$callback': " . $e->getMessage());
            }
        }

        if (is_array($callback) && count($callback) === 2 && is_string($callback[0])) {
            [$class, $method] = $callback;
            $name = lcfirst($class);
            try {
                $instance = $appInstance->resolve($name);
                if (method_exists($instance, $method)) {
                    return [$instance, $method];
                }
            } catch (\Exception $e) {
                error_log("[mvc] Failed to resolve controller '$class': " . $e->getMessage());
            }
        }

        return null;
    });
}
