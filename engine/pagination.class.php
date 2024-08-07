<?php

class ArrayPaginator
{
	public  $page    = 1;   /* Текущая страница */
	public  $amt     = 0;   /* Кол-во страниц */
	public  $limit   = 10;  /* Кол-во элементов на странице */
	public  $total   = 0;   /* Общее кол-во элементов */
	public  $display = '';	/* HTML-код навигации */
 
	private $url     = '';       
	private $carrier = 'page';
 
	/**
	 * Конструктор.
	 */
	public function __construct($url, $limit = 0)
	{
		$this->url = $url;		
		
		if (!empty($limit)) {
			$this->limit = $limit;
		}		
 
		$page = intval(@$_GET['page']);
		if (!empty($page)) {
			$this->page = $page;
		}
 
		$query = parse_url($this->url, PHP_URL_QUERY);
		$this->carrier = '&' . $this->carrier . '=';
		
	}
 
	/**
	 * Срез массива и формирование HTML-кода навигации в переменную display.
	 */
	public function getItems($array)
	{
		$this->total = count($array);
		$this->amt = ceil($this->total / $this->limit);	
		if ($this->page > $this->amt) {
			$this->page = $this->amt;
		}
 
		if ($this->amt > 1) {
			$adj = 2;	
			$this->display = '<nav class="pagination-row"><ul class="pagination justify-content-center">';
 
			/* Назад */
			if ($this->page == 1) {
				$this->addSpan('<i class="fa-solid fa-angle-left"></i>', 'prev disabled');
			} elseif ($this->page == 2) {
				$this->addLink('<i class="fa-solid fa-angle-left"></i>', '', 'prev');
			} else {
				$this->addLink('<i class="fa-solid fa-angle-left"></i>', $this->carrier . ($this->page - 1), 'prev');
			}
 
			if ($this->amt < 7 + ($adj * 2)) {
				for ($i = 1; $i <= $this->amt; $i++){
					$this->addLink($i, $this->carrier . $i);			
				}
			} elseif ($this->amt > 5 + ($adj * 2)) {
				$lpm = $this->amt - 1;
				if ($this->page < 4){
					for ($i = 1; $i < 5; $i++){
						$this->addLink($i, $this->carrier . $i);
					}
					$this->addSpan('...', 'separator');
					$this->addLink($this->amt, $this->carrier . $this->amt);	
				} elseif ($this->amt - 3 > $this->page && $this->page > 3) {
					$this->addLink(1);
					$this->addSpan('...', 'separator');	
					for ($i = $this->page - $adj; $i <= $this->page +2; $i++) {
						$this->addLink($i, $this->carrier . $i);
					}
					$this->addSpan('...', 'separator');
					$this->addLink($this->amt, $this->carrier . $this->amt);	
				} else {
					$this->addLink(1, '');
					$this->addSpan('...', 'separator');	
					for ($i = $this->amt - 4; $i <= $this->amt; $i++) {
						$this->addLink($i, $this->carrier . $i);
					}
				}
			}
 
			/* Далее */
			if ($this->page == $this->amt) {
				$this->addSpan('<i class="fa-solid fa-chevron-right"></i>', 'next disabled');				
			} else {			
				$this->addLink('<i class="fa-solid fa-chevron-right"></i>', $this->carrier . ($this->page + 1));
			}
 
			$this->display .= '</ul></nav>';
		}
 
		$start = ($this->page != 1) ? $this->page * $this->limit - $this->limit : 0;		
		return array_slice($array, $start, $this->limit);	
	}
 
	private function addSpan($text, $class = '')
	{
		$class = 'page-item ' . $class;
		$this->display .= '<li class="' . trim($class) . '"><span class="page-link">' . $text . '</span></li>';		
	}	
 
	private function addLink($text, $url = '', $class = '')
	{
		if ($text == 1) {
			$url = '';
		}
 
		$class = 'page-item ' . $class . ' ';
		if ($text == $this->page) {
			$class .= 'active bg-primary';
		}
		$this->display .= '<li class="' . trim($class) . '"><a class="page-link" href="' . $this->url . $url . '">' . $text . '</a></li>';
	}	
	
	/**
	 * Метод для title страниц.
	 */
	public function getTitle()
	{
		if ($this->page > 1) {
			return ' - страница ' . $this->page;
		} else {
			return '';
		}
	}
}