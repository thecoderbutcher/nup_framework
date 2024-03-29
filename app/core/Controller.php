<?php
    namespace app\core;
    
    class Controller{
        protected $class;

        public function __construct(){
            $aux = (explode('\\', strtolower(get_class($this))));	
            $this->class = $aux[count($aux) -1 ]; 
        }
        
        # Load model
		public function model($model, $class = ""){
			if (!strcmp($class, "")) $class = $this->class;
			require_once '../app/entities/'. $class .'/model/' . $model . '.php';
			return new $model();
		}

        # Load view
        public function view($route, $param = []){
            session_start();

            extract($param); # Destructuracion de array
            $route = str_replace('.','/',$route);

            if(self::authenticated()){ 
                $file_route = $this->class === 'main' ? APP_ROUTE . "/app/entities/$this->class/views/protected/{$route}.php" : APP_ROUTE . "/app/entities/$this->class/views/{$route}.php";
            
                if(file_exists($file_route)){
                    ob_start();
                    require_once $file_route;
                    return ob_get_clean();
                }
                else{
                    return "File $route not found";     # Page not found
                }
            }
            else{
                require_once APP_ROUTE . '/app/entities/main/views/public/components/top.php';
                require_once APP_ROUTE . '/app/entities/main/views/public/components/header.php';
                
                ($route === 'login' or $route === 'forgot_password') ? require_once APP_ROUTE . "/app/entities/main/views/public/$route.php" : require_once APP_ROUTE . '/app/entities/main/views/public/index.php'; 

                require_once APP_ROUTE . '/app/entities/main/views/public/components/bottom.php';
            } 
        }

        public static function authenticated(){
			return (isset($_SESSION['username']));
		}
    }
?>