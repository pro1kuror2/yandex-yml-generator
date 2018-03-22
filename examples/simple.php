<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: text/xml; charset=utf-8');
include('../ymlOffer.php');
include("../ymlDocument.php");

  //параметры: Короткое название магазина, полное наименование компании, [кодировка]
  $y 	= new ymlDocument('Магаз','ООО Шикарный магаз интернейшнл'/* , 'windows-1251'*/);


  $y ->url('http://best.seller.ru/'); 		// !!!	условно обязательный. Адрес магазина


  $y ->cms('Joomla!','3.4')					// 		CMS: название, [версия] они же 'platform' и 'version'
	 ->agency('Webdivision.ru')				//   	Агенство, отвечающее за работоспособность сайта
	 ->email('notdest@gmail.com');			//  	Контактный адрес разработчиков CMS или агентства

  $y ->currency('RUR',1)					// !!!	Минимум одна. 	Добавляем валюты, это основная, тк rate=1
	 ->currency('USD','CBRF',3)				// 		считаем по курсу ЦБ РФ, плюс 3 %
	 ->currency('EUR',70.8)					// 		дробную часть отделяем точкой

	 ->category(1,'Книги')					// !!!  должны быть.	категория, находится в корне, id - положительное целое число, больше 0
	 ->category(2,'Детективы',1)			// 		подкатегория в "книги"
	 ->category(3,'Боевики',1)
	 ->category(4,'Видео')
	 ->category(5,'Комедии',4);

  $y ->delivery(300,4,18) 					// !!! Условно обязательно. Доставка: стоимость 300р, срок 4 дня , до 18:00 срок не изменится
  	 ->delivery(500,0,15)
  	 ->delivery(0,'7-8')

  	 ->cpa();								//   	включение программы "Заказ на Маркете", можно еще передать false



//-------------- добавляем одно упрощенное описание товара -----------------------------



  	 			// name , id , price, currencyId, categoryId, [price from - "цена от ххх руб." ]
$offer = $y->simple('Наручные часы Casio A1234567B', 'id01id1111', 900, "USD",15 /* , true*/ );


	$offer 	->model('V RACER NYLON')							//		модель товара
			->vendor('Adidas')									//  	Производитель
			->vendorCode('I do not know')						//   	Код производителя для данного товара. 
			->cbid(80)											//		Размер ставки на карточке товара. 0,8 у.е.
			->bid(90)											//		Размер ставки на остальных местах размещения. 0,9 у.е.
			->fee(220)											//		Размер комиссии от цены товара. 2.2%
			->available(false)									//		под заказ 

			->url("http://magaz.ru/tovar.html")					// !!!	условно обязательный. URL страницы товара 

			->oldprice(1500)									//   	Старая цена для расчёта скидки
			->vat('VAT_10_110')									//		Ставка НДС для товара.

			->pic('http://best.seller.ru/img/device12345.jpg')	// !!!  условно обязательные. Картинки
			->pic('http://best.seller.ru/img/device124.jpg')
			->pic('http://best.seller.ru/img/devi45.jpg')

			->delivery(/* false*/ )								//		Возможно доставить. false, чтобы невозможно

			->dlvOption(300,4,18)								//		Доставка: стоимость 300р, срок 4 дня , до 18:00 срок не изменится
			->dlvOption(0,'7-8')								//		бесплатно довезем через неделю. Вообще не больше 5 опций

			->pickup()											//  	Возможен самовывоз
			->store()											//   	можно купить в розничном магазине


			->description(										//		Описание с разрешенными тегами
'<h3>Односторонний матрас средней жесткости  EVS 500</h3>
    <p>Наполнители:</p>
    <ul>
      <li>пенополиуретан</li>
      <li>латексированная кокосовая койра</li>
    </ul>'
 ,true)			
			// ->description('Просто описание')					//		или просто описание

			->sale('первым десяти покупателям скидка 15%')		//		sales_notes, минимальные суммы и партии, наличие скидок и т.д.	
			->minq(2)											//	~	только в некоторых категориях. min-quantity ,минимальный заказ 2шт.
			->stepq(2)											//	~	только в некоторых категориях. step-quantity , заказывыем по 2шт.

			->warranty()										//		manufacturer_warranty Официальная гарантия производителя.
			->origin('Демократическая Республика Конго')		//   	country_of_origin. страна производитель из списка Яндекса. Иногда желательно указывать
			->adult()											//		является товаром "для взрослых"
			->barcode(11122299)									//		штрихкод указанный производителем
			->cpa(false)										//		нельзя сделать "Заказ на Маркете"

			->param('Размер экрана','27','дюйм')				//		Параметры из поиска на маркете
			->param('Материал','алюминий')	

			->expiry('P1Y2M10DT2H30M')							//		Срок годности ISO8601, может иметь формат YYYY-MM-DDThh:mm
			->weight(15.1)										//		Вес товара в килограммах с учетом упаковки.
			->dimensions(14.0,80.2,90.0)						//		длина, ширина и высота в сантиметрах
			->downloadable()									//		товар можно скачать
			->age(5,'month')									//		возрастная категория, годы или месяцы
			//->age(16,'year')
			->group_id(111111111)								//	~	только в паре категорий. Объединяет вариации одной модели
			->rec('123123,1214,243')							//		айдишники рекомендованных товаров
;


echo $y->saveXML();


?>