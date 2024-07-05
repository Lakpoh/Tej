<?php
/*
Plugin Name: Tej
Plugin URI: https://github.com/Lakpoh/Tej
Description: Tej est une fonction de dump pour debug et developpement en PHP
Version: 1.0
Author: Remi Twardowski
Author URI: https://remtwa.fr
*/

/*
function tej($data)
{
    static $id = 0;
    $output = '<pre id="tej-data-' . $id . '" style="display: none;">' . print_r($data, true) . '</pre>';
    $output .= '<button id="tej-toggle-' . $id . '">Afficher les données</button>';
    $output .= '<script>
        document.getElementById("tej-toggle-' . $id . '").addEventListener("click", function() {
            var data = document.getElementById("tej-data-' . $id . '");
            if (data.style.display === "none") {
                data.style.display = "block";
                this.innerHTML = "Masquer les données";
            } else {
                data.style.display = "none";
                this.innerHTML = "Afficher les données";
            }
        });
    </script>';
    $output .= '<style>
        #tej-data-' . $id . ' {
            position: fixed;
            bottom: ' . (50 + $id * 50) . 'px;
            left: 0;
            right: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            overflow: auto;
            max-height: 300px;
        }
        #tej-toggle-' . $id . ' {
            position: fixed;
            bottom: ' . (40 + $id * 50) . 'px;
            left: 0;
            margin: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
			z-index: 99999;
        }
    </style>';
    echo $output;
    $id++;
}
*/

class TejTime {
    private static $start_time;

    public static function start() {
        self::$start_time = microtime(true);
    }

    public static function stop() {
        if (isset(self::$start_time)) {
            $elapsed_time = microtime(true) - self::$start_time;
            echo 'Temps d\'exécution : ' . number_format($elapsed_time, 4) . ' secondes';
        } else {
            echo 'Timer non démarré.';
        }
		echo "<br>";
    }
}


function tej($data){

    echo '<pre style="margin: 10px ; padding: 20px ; border : solid 1px black">';
	var_dump($data);
	echo '</pre>';

}

class Tej {
	public static function dump($data, $functionName = null) {
		ob_start();
		if ($functionName) {
			$start = microtime(true);
			$result = $functionName($data);
			$time = microtime(true) - $start;
			echo "Temps: $time secondes\n";
			$reflection = new ReflectionFunction($functionName);
			echo "Déclarée dans: " . $reflection->getFileName() . " ligne " . $reflection->getStartLine() . "\n";
			var_dump($result);
		} else {
			var_dump($data);
		}
		$output = ob_get_clean();
		echo "<pre style='border:1px solid #ccc;margin:10px;padding:10px;'>" . htmlspecialchars($output) . "</pre>";
	}
 }
 
 // usage  : Tej::dump($data, 'mafonctiontest');