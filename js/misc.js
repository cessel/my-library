/* Инициализация Янкдекс Карт */
ymaps.ready(init);
	var myMap, 
		myPlacemark;

		function init()
			{
				var adress = '<? echo $contacts['adress']; ?>';
	            ymaps.geocode(adress).then(function (res)
					{
						var position = res.geoObjects.get(0).geometry.getCoordinates();
    					myMap = new ymaps.Map('map',{center: position,zoom : 14 });
						var myPlacemark = new ymaps.Placemark(position,{hintContent: 'Русская Школа Искусств',balloonContent: 'Русская Школа Искусств - Москва, Ул. Ляпидевского, д. 10а'});
						myMap.geoObjects.add(myPlacemark);  
					}); 
			
			}