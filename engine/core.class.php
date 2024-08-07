<?php

class core {
  public $db;
  private $CHARS;

  public $config;

  const SALT_LENGTH = 16;

  public function __construct() {
    include __DIR__.'/config.php';
    $this->config = $config;

    $this->CHARS = self::initCharRange();
    $this->db = new db(
      $config['db']['host'],
      $config['db']['user'],
      $config['db']['password'],
      $config['db']['name'],
    );
    $this->time = $_SERVER['REQUEST_TIME'];

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function getConfig() {
    return $this->config;
  }

  public function menu($type) {
    return $this->config[$type];
  }

  public function num_word($value, $words, $show = true) {
    $num = $value % 100;
    if ($num > 19) { 
      $num = $num % 10; 
    }
    
    $out = ($show) ?  $value . ' ' : '';
    switch ($num) {
      case 1:  $out .= $words[0]; break;
      case 2: 
      case 3: 
      case 4:  $out .= $words[1]; break;
      default: $out .= $words[2]; break;
    }
    
    return $out;
  }

  public function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    if ($strip_html) {
        $input = strip_tags($input);
    }

    if (strlen($input) <= $length) {
        return $input;
    }

    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
  }

  public function isValidPassword($password, $hash) {
    // $SHA$salt$hash, where hash := sha256(sha256(password) . salt)
    $parts = explode('$', $hash);
    return count($parts) === 4 && $parts[3] === hash('sha256', hash('sha256', $password) . $parts[2]);
  }

  public function hash($password) {
    $salt = $this->generateSalt();
    return '$SHA$' . $salt . '$' . hash('sha256', hash('sha256', $password) . $salt);
  }

  /**
    * @return string randomly generated salt
  */
  private function generateSalt() {
    $maxCharIndex = count($this->CHARS) - 1;
    $salt = '';
    for ($i = 0; $i < self::SALT_LENGTH; ++$i) {
        $salt .= $this->CHARS[mt_rand(0, $maxCharIndex)];
    }
    return $salt;
  }

  private static function initCharRange() {
    return array_merge(range('0', '9'), range('a', 'f'));
  }

  public function generateHash($length=6) {

    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';

    $code = '';

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
      $code .= $chars[mt_rand(0, $clen)];  
    }

    return $code;
  }

  public function userGet($user) {
    $query = $this->db->query("SELECT * FROM users WHERE id = '$user' OR email = '$user'");
    return ($query->numRows()) ? $query->fetchArray() : false;
  }

  public function usersGet() {
    $query = $this->db->query("SELECT * FROM users");
    return ($query->numRows()) ? $query->fetchAll() : false;
  }

  public function userCreate($first_name, $last_name, $email, $birthdate, $password) {
    $this->db->query("INSERT INTO users (first_name, last_name, email, birthdate, password) VALUES ('$first_name', '$last_name', '$email', '$birthdate','$password')");
    return $this->db->lastInsertID();
  }

  public function userUpdate($id, $first_name, $last_name, $email, $birthdate) {
    $this->db->query("UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', birthdate = '$birthdate' WHERE id = $id");
  }

  // СЕССИИ

  public function sessionCreate($id, $token, $ip) {
    $this->db->query("INSERT INTO sessions (user_id, token, time, ip) VALUES ($id, '$token', $this->time, $ip)");
  }

  public function sessionsStop($id, $token) {
    $this->db->query("UPDATE sessions SET active = 0 WHERE user_id = $id AND token != '$token'");
  }

  public function getSessions($id) {
    $query = $this->db->query("SELECT * FROM sessions WHERE user_id = $id ORDER BY active DESC, id DESC LIMIT 10");
    return ($query->numRows()) ? $query->fetchAll() : false;
  }

  public function checkAuth($token) {
    $salt = explode(':', $token)[0];
    if ($token !== $salt . ':' . md5($salt . ':' . $_SESSION['secret']))
      return false;

    $query = $this->db->query("SELECT * FROM sessions WHERE token = '$token' AND active = 1");
    return ($query->numRows()) ? $query->fetchArray() : false;
  }

  public function logout($token) {
    $this->db->query("UPDATE sessions SET active = 0 WHERE token = '$token'");
    unset($_COOKIE['token']);
    setcookie('CSRF_TOKEN', null, -1, '/');
  }


  public function actionDate($a) { // преобразовываем время в нормальный вид
    date_default_timezone_set('Europe/Moscow');
    $ndate = date('d.m.Y', $a);
    $ndate_time = date('H:i', $a);
    $ndate_exp = explode('.', $ndate);
    $nmonth = array(
      1 => 'янв',
      2 => 'фев',
      3 => 'мар',
      4 => 'апр',
      5 => 'мая',
      6 => 'июн',
      7 => 'июл',
      8 => 'авг',
      9 => 'сен',
      10 => 'окт',
      11 => 'ноя',
      12 => 'дек'
    );

    foreach ($nmonth as $key => $value) {
      if($key == intval($ndate_exp[1])) $nmonth_name = $value;
    }

    if($ndate == date('d.m.Y')) return $ndate_time;
    elseif($ndate == date('d.m.Y', strtotime('-1 day'))) return 'Вчера, '.$ndate_time;
    else return $ndate_exp[0].' '.$nmonth_name.' '.$ndate_exp[2];
  }

  public function weekday($n) {
    return ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'][$n-1];
  }

  public function translit($value) {
    $converter = array(
      'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
      'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
      'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
      'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
      'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
      'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
      'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
    );
   
    $value = mb_strtolower($value);
    $value = strtr($value, $converter);
    $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
    $value = mb_ereg_replace('[-]+', '-', $value);
    $value = trim($value, '-'); 
   
    return $value;
  }

  public function compress($source, $destination, $quality) {

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif') 
      $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png') {
      $image = imagecreatefrompng($source);
      imagepalettetotruecolor($image);
    }

    elseif ($info['mime'] == 'image/webp') {
      $image = imageCreatefromWebp($source);
      // imagepalettetotruecolor($image);
    }

    imageWebp($image, $destination, $quality);

    imagedestroy($image);
    return $destination;
  }

  public function get($table, $params = [], $order = false) {

    if (empty($params)) {

      $query = "SELECT * FROM $table";

    } else {

      $search_key = array_keys($params)[0];
      $search_value = $params[$search_key];

      $query = "SELECT * FROM $table WHERE $search_key = '$search_value'";
    }

    if ($order) {
      $query .= ' ORDER BY '.$order[0]. ' ' . $order[1];
    }

    $query = $this->db->query($query);
    return ($query->numRows()) ? $query->fetchAll() : false;

  }

  public function add($table, $params) {

    $fields = implode(',', array_keys($params));
    $values = implode(',', $params);

    $this->db->query("INSERT INTO $table ($fields) VALUES ($values)");

    return $this->db->lastInsertID();

  }

  public function update($table, $id, $params) {

    $n = count($params);
    $q = $s = '';
    for ($i = 0; $i < $n; $i = $i + 1) {
      $q .= $s.array_keys($params)[$i] . '=' . $params[array_keys($params)[$i]];
      $s = ',';
    }
    
    $this->db->query("UPDATE $table SET $q WHERE id = $id");
  }

  public function delete($table, $id) {
    $this->db->query("DELETE FROM $table WHERE id = $id");
  }

  public function cartGet($products) {
    $query = $this->db->query("SELECT * FROM products WHERE id IN ($products)");
    return ($query->numRows()) ? $query->fetchAll() : false;
  }
}