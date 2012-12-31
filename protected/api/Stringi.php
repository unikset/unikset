<?php
// ======================================
// Класс по работе со строками и массивами
// ======================================
class Stringi {
	private $alphabet = array(
		'en' => array ('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','W','X','Y','Z'),
		'ru' => array ('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я')
	);
	
	private $default_language = 'en';
	
	// Конструктор. Получает язык, обозначенный двухбуквенной кодировкой
	public function Stringi($lang) {
		$this->default_language = strtolower($lang);
	}
	
	// Функция для группировки ассоциативного массива по алфавиту.
	// Параметры: $source - массив, требующий групировки 
	//            $field - поле, по которому группировать
	public function alphaGroup($source,$field) {
		$res = array();
		foreach($this->alphabet[$this->default_language] as $letter) {
			foreach($source as $item) {
				if(isset($res[strtoupper($item[$field][0])])&&$letter==strtoupper($item[$field][0])) {
					array_push($res[$letter],$item);
				} else if(!isset($res[strtoupper($item[$field][0])])&&$letter==strtoupper($item[$field][0])) {
					$res[strtoupper($item[$field][0])] = array($letter => $item);
				}
			}
		}
		return $res;
	}
}