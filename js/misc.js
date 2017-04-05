/* ������������� ������� ���� */
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
						var myPlacemark = new ymaps.Placemark(position,{hintContent: '������� ����� ��������',balloonContent: '������� ����� �������� - ������, ��. ������������, �. 10�'});
						myMap.geoObjects.add(myPlacemark);  
					}); 
			
			}

/* �������� */

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
    }
function isValidPhone(myPhone) { 
   return /^\d{11}$/.test(myPhone); 
}  

function alertObj(obj) { 
    var str = ""; 
    for(k in obj) { 
        str += k+": "+ obj[k]+"\r\n"; 
    } 
    alert(str); 
} 

/**
 * ������� ���������� ��������� ��� �������������� ����� ����� �� ��������� ����� � ������� ���������
 * param  iNumber Integer ����� �� ������ �������� ����� ������������ ���������
 * param  aEndings Array ������ ���� ��� ��������� ��� ����� (1, 4, 5),
 *         �������� ['������', '������', '�����']
 * return String
 */
function getNumEnding(iNumber, aEndings)
{
    var sEnding, i;
    iNumber = iNumber % 100;
    if (iNumber>=11 && iNumber<=19) {
        sEnding=aEndings[2];
    }
    else {
        i = iNumber % 10;
        switch (i)
        {
            case (1): sEnding = aEndings[0]; break;
            case (2):
            case (3):
            case (4): sEnding = aEndings[1]; break;
            default: sEnding = aEndings[2];
        }
    }
    return sEnding;
}