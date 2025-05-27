<?php
// Request.php
class Request
{
    // Ambil data GET
    public function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    // Ambil data POST
    public function post($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    // Ambil semua input (GET + POST)
    public function all()
    {
        return array_merge($_GET, $_POST);
    }

    // Cek method request
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }
}
