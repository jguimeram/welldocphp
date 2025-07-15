<?php
namespace app\core;

class View
{
    public function render(string $template, array $params = []): string
    {
        $path = __DIR__ . '/../views/' . $template . '.php';
        if (!file_exists($path)) {
            return '';
        }
        extract($params);
        ob_start();
        require $path;
        return ob_get_clean();
    }
}
