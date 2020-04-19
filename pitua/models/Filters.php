<?php
class Filters extends model {

	public function getFilters($filters) {
		$products = new Products();
		$brands = new Brands();

		$array = array(
			'searchTerm' => '',
			'brands' => array(),
			'slider0' => 0,
			'slider1' => 0,
			'maxslider' => 1000,
			'stars' => array(
				'0' => 0,
				'1' => 0,
				'2' => 0,
				'3' => 0,
				'4' => 0,
				'5' => 0
			),
			'sale' => 0,
			'options' => array()
		);

		if(isset($filters['searchTerm'])) {
			$array['searchTerm'] = $filters['searchTerm'];
		}

		

		// Criando filtro de Preço
		if(isset($filters['slider0'])) {
			$array['slider0'] = $filters['slider0'];
		}
		if(isset($filters['slider1'])) {
			$array['slider1'] = $filters['slider1'];
		}
		

		// Criando filtro das Estrelas
		$star_products = $products->getListOfStars($filters);
		foreach($array['stars'] as $skey => $sitem) {
			foreach($star_products as $sproduct) {
				if($sproduct['rating'] == $skey) {
					$array['stars'][$skey] = $sproduct['c'];
				}
			}

		}

		// Criando filtro das Promoções
		$array['sale'] = $products->getSaleCount($filters);

		// Criando filtro das Opções
		$array['options'] = $products->getAvailableOptions($filters);

		return $array;
	}

}