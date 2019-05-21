<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


class TemplateContext {
    private $vars = [];
    private $encoding;

    public function __construct($encoding = 'UTF-8') {
        $this->encoding = $encoding;
    }

    public function __get($name) {
        if (!array_key_exists($name, $this->vars)) {
            throw new Exception('Missing variable: ' . $name);
        }
        return htmlspecialchars($this->vars[$name], ENT_COMPAT, $this->encoding);
    }

    public function assignVars(array $vars) { // geht nur für eindimensionale Arrays
        foreach ($vars as $name => $value) {
            $this->vars[$name] = $value;
        }
    }

    public function assignVar($name, $value) { // einzelne Array Einträge
        $this->vars[$name] = $value;
    }

    public function render($templatePath) { // puffert die Ausgabe
        if (!is_readable($templatePath)) {
            throw new Exception('Cant read template: ' . $templatePath);
        }

        $content = '';
        ob_start();

        try {
            require $templatePath;
            $content = ob_get_contents();
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage() . ' (in template ' . $templatePath . ')');
        } finally {
            ob_end_clean();
        }

        return $content;
    }
}
?>  
