<?php

class App
{
    // untuk set default controller dan route
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $param = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]); /* untuk menghilangkan dari daftar array */
        } else {
            #code...            
        }

        /* ===== CONTROLLER ===== */
        require_once '../app/controllers/' . $this->controller . '.php';

        // instansiasi controller yang baru
        $this->controller = new $this->controller; /* agar bisa memanggil method atau fungsi yang ada di controller */

        /* ===== METHOD ATAU FUNGSI ===== */
        // cek method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]); /* untuk menghilangkan dari daftar array */
            } else {
                #code...
            }
        }

        /* ===== PARAMS ===== */
        if (!empty($url)) {
            // get params
            $this->param = array_values($url);
        }

        /* ===== CALL CONTROLLER AND EXECUTE FUNGTION ===== */
        call_user_func_array([$this->controller, $this->method], $this->param);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
