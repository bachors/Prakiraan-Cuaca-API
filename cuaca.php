<?php
####### code by iBacor.com 2016 #######

// Menyembunyikan pesan error karena proses DOM yang tidak sempurna 
error_reporting(0);

function cuaca(){

	//#################################### mycurl('url', 'user agent'); ##############################################
    $html = mycurl('http://www.bmkg.go.id/BMKG_Pusat/Informasi_Cuaca/Prakiraan_Cuaca/Prakiraan_Cuaca_Indonesia.bmkg');
		
	// Initial ARRAY yang nanti akan dijadikan JSON	
	$rows = array();
	
	if($html == "offline"){
		
		// website yg di curl sedang offline
		$rows['status'] = "offline";
	}else{
		
		// website yg di curl sedang online maka lanjutkan
		$rows['status'] = "online";
	
		//####################################### START DOM ##############################################
		$dom = new DOMDocument;
		$dom->loadHTML($html);
		
		// Mengambil tgl sekarang dan besok di tag th
		foreach ($dom->getElementsByTagName('th') as $key => $value) {
			if($key == 1){
				$sekarang = explode("Ini", $value->nodeValue);
			}else if($key == 2){
				$besok = explode("Hari", $value->nodeValue);
			}
		}
		
		$i = 0;
		foreach ($dom->getElementsByTagName('tr') as $tr) {
			if($i != 0){
				
				foreach ($tr->getElementsByTagName('td') as $key => $value) {
					if($key == 0){
						
						// Nama kota
						$kota = $value->nodeValue;
						
					}else if($key == 1){
						
						// Data cuaca sekarang
						$cuaca_sekarang = explode("Suhu : ", $value->nodeValue);
						$suhu_sekarang = explode("Kelembaban : ", $cuaca_sekarang[1]);
						$suhu_sekarang_minmax = explode(" - ", $suhu_sekarang[0]);
						$kelembaban_sekarang = $suhu_sekarang[1];
						$kelembaban_sekarang_minmax = explode(" - ", $kelembaban_sekarang);
						
					}else if($key == 2){
						
						// Data cuaca besok
						$cuaca_besok = explode("Suhu : ", $value->nodeValue);
						$suhu_besok = explode("Kelembaban : ", $cuaca_besok[1]);
						$suhu_besok_minmax = explode(" - ", $suhu_besok[0]);
						$kelembaban_besok = $suhu_besok[1];
						$kelembaban_besok_minmax = explode(" - ", $kelembaban_besok);
						
					}
				}
				
				$cells = array(
							'kota' => $kota,
							/* Latitude & Longitude Finder. aktifkan function di line no 134
							'maps' => array(							
								'latitude' => latlng($kota, 'lat'),
								'longitude' => latlng($kota, 'lng')
							),
							*/
							'prakiraan' => array(
								'sekarang' => array(
									'tgl' => $sekarang[1],
									'cuaca' => $cuaca_sekarang[0],
									'suhu' => array(
										'min' => $suhu_sekarang_minmax[0],
										'max' => ''.intval($suhu_sekarang_minmax[1]).''
									),
									'kelembaban' =>  array(
										'min' => $kelembaban_sekarang_minmax[0],
										'max' => str_replace(" %", "", $kelembaban_sekarang_minmax[1])
									)
								),
								'besok' => array(
									'tgl' => $besok[1],
									'cuaca' => $cuaca_besok[0],
									'suhu' => array(
										'min' => $suhu_besok_minmax[0],
										'max' => ''.intval($suhu_besok_minmax[1]).''
									),
									'kelembaban' =>  array(
										'min' => $kelembaban_besok_minmax[0],
										'max' => str_replace(" %", "", $kelembaban_besok_minmax[1])
									)
								)
							)
						);
				$rows['data'][] = $cells;
			}
			$i++;
		}
	}
		
	return $rows;
}

function mycurl($url, $user_agent = "Googlebot/2.1 (http://www.googlebot.com/bot.html)") {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
		
	// Gagal ngecURL
    if(!$site = curl_exec($ch)){
		return 'offline';
	}
	
	// Sukses ngecURL
	else{
		return $site;
	}
	
	curl_close($ch);
}

/* Latitude & Longitude Finder
function latlng($kota, $find = "lng") {
	$geocode=file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".rawurlencode($kota)."&sensor=false");
	$output= json_decode($geocode);
	$lat = $output->results[0]->geometry->location->lat;
	$lng = $output->results[0]->geometry->location->lng;
	$data = ($find != "lng" ? $lat : $lng);
	return $data;
}
*/														
