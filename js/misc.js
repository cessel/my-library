/* Èíèöèàëèçàöèÿ ßíêäåêñ Êàðò */
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
						var myPlacemark = new ymaps.Placemark(position,{hintContent: 'Ðóññêàÿ Øêîëà Èñêóññòâ',balloonContent: 'Ðóññêàÿ Øêîëà Èñêóññòâ - Ìîñêâà, Óë. Ëÿïèäåâñêîãî, ä. 10à'});
						myMap.geoObjects.add(myPlacemark);  
					}); 
			
			}
function alertObj(obj) { 
    var str = ""; 
    for(k in obj) { 
        str += k+": "+ obj[k]+"\r\n"; 
    } 
    alert(str); 
} 
