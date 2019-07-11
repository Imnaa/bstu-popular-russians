<?php
    error_reporting(E_ALL);
    ini_set('display_errors','Off');
	// Определяем язык -->
	$isLang = isset($_GET["lang"])? $_GET["lang"]: "ru"; //Берём значение GET-параметра, либо, если его нет, то устанавливаем русский

	if (!($isLang == "en")) {
		$isLang = "ru";
	}
	
	require "./includes/db.php";

	//Получаем все записи методом выборки SELECT, создав запрос
	$result = R::getAll( 'SELECT * FROM lang' );


	for ($i = 0; $i < count($result); ++$i) {
		if ($isLang == "ru") {
			$LANG[$result[$i]['word']] = $result[$i]['ru'];
		} else {
			$LANG[$result[$i]['word']] = $result[$i]['en'];
		}
	}

	/*
	include_once("./langs/".$isLang.".php");

	if ($isLang == "en") {
  		$LANG = $en;
 	} else {
		$LANG = $ru;
	}
	*/

	$GLOBALS['title'] = $LANG['titlePage'];
	$GLOBALS['desc'] = $LANG['descript'];
	$GLOBALS['keywords'] = $LANG['keys'];

	include("./header.php");
?>		
	<body>
		<!-- Информационная полоса -->
			<div class="alert alert-success information-line" role="alert">
				<?php echo $LANG['information-text']?>
			</div>
		<!-- Конец Информационная полоса -->

		<!-- Меню -->
			<ul class="navbar cf">
				<li>
					<a href="#" class="anime" data-target="#modalAboutSite" data-toggle="modal">
						<img src="./images/info_ico.png" width="24px" height="24px">
						<?php echo $LANG['btnAboutSite'];?>
				</a>
				</li>
				<?php 
					if ($isLang == "en") { ?>
						<li><a href="index.php?lang=ru"><img src="./images/rus_ico.png" width="26px" height="22px"> Русскоязычная версия</a></li>
					<?php } else {?>
					<li><a href="index.php?lang=en"><img src="./images/eng_ico.png" width="30px" height="30px"> English version</a></li>
				<?php } ?>
				<li><a href="#" class="anime" data-target="#modalContact" data-toggle="modal"><img src="./images/contact_ico.png" width="28px" height="28px"> <?php echo $LANG['btnContact'];?></a></li>
				<li><a href="javascript:void(0)" class="clickDemo" id="clickDemo" value="1"><img src="./images/demo_ico.png"> <?php echo $LANG['btnDemoOff'];?></a></li>
			</ul>
			<!-- Мобальное окно About -->
			<div class="modal fade bd-example-modal-lg" id="modalAboutSite" tabindex="-1" role="dialog" aria-labelledby="modalLabelAboutSite" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalLabelAboutSite"><?php echo $LANG['modalLabelAboutSite']?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">

							<blockquote class="blockquote text-right">
								<p class="mb-0 alert-info"><?php echo $LANG['modalQuoteAbout']?></p>
								<footer class="blockquote-footer"><cite title="Автор"><?php echo $LANG['modalQuoteAuthorAbout']?></cite></footer>
							</blockquote>

							<div style="text-indent: 20px">
								<?php echo $LANG['modalAboutSite']?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $LANG['close']?></button>
						</div>
					</div>
				</div>
			</div>
			<!-- Модальное окно ОБРАТНАЯ СВЯЗЬ -->
			<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-labelledby="modalLabelContact" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalLabelContact"><?php echo $LANG['modalLabelContact']?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- ТУТ ОБРАТНАЯ СВЯЗЬ -->
							<form action="mail.php" method="post">
							<fieldset>
									<div class="form-group">
									<label for="name"><?php echo $LANG['feedbackName']?></label>
									<input type="name" name="name" class="form-control" id="name" placeholder="<?php echo $LANG['feedbackHitName']?>">
									</div>
									<div class="form-group">
									<label for="email1"><?php echo $LANG['feedbackEmail']?></label>
									<input type="email" name="email" class="form-control" id="email1" placeholder="<?php echo $LANG['feedbackHitEmail']?>">
									</div>
									<div class="form-group">
									<label for="phone"><?php echo $LANG['feedbackPhone']?></label>
									<input type="phone" name="phone" class="form-control" id="phone" placeholder="<?php echo $LANG['feedbackHitPhone']?>">
									</div>
									<div class="form-group">
									<label for="message"><?php echo $LANG['feedbackMessage']?></label>
									<textarea class="form-control" name="message" rows="3"></textarea>
									</div>
									<button type="submit" class="btn btn-info col-12"><?php echo $LANG['feedbackSendMessage']?></button>
							</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		<!-- Конец Меню -->

		<!-- НАЧАЛО ФРАГМЕНТОВ -->

        <?php

            $filename = "./css/style.css";
            if ($fh = fopen($filename, "r")) {

                // Если открыт то...
                $file_content = "";
                // Читаем до конца файла
                while (!feof($fh)) {
                    // Записываем в переменную из файла
                    $file_content .= fgets($fh);
                }
                // Удаляем переносы и ненужные символы
                $file_content = nl2br($file_content);

                // Находим все классы в CSS для картинок
                $regexp = "/img-[a-z]*/uim";

                // совпадение с шаблоном
                $match = [];

                if (preg_match_all($regexp, $file_content, $match, PREG_PATTERN_ORDER)) {
                    //var_dump($match[0][0]);
                }

                fclose($fh);
            }

            $keys_all = array_keys($LANG);
            //var_dump($keys_all);

            for ($ClassIndex = 0, $ModalIndex = 24; $ClassIndex < count($match[0]) && $ModalIndex < count($keys_all); ++$ClassIndex, $ModalIndex += 2) {

                $modal = $keys_all[$ModalIndex+1];
                $modalLabel = $keys_all[$ModalIndex];
                $img_portret = $match[0][$ClassIndex];

                if ($modal != "modalMather" && $modal != "modalBoy" && $modal != "modalGrandfather") {
                    ?>

                    <a href="#" class="anime" data-target="#<?php echo $modal ?>" data-toggle="modal">
                        <div class="<?php echo $img_portret ?>"></div>
                    </a>
                    <div class="modal fade bd-example-modal-lg" id="<?php echo $modal ?>" tabindex="-1" role="dialog"
                         aria-labelledby="<?php echo $modalLabel ?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="<?php echo $modalLabel ?>"><?php echo $LANG[$modalLabel]?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <?php
                                    $Exts = array(".jpg", ".png", ".jpeg", ".gif");

                                    $pathImg = "./images/portraits/" . $img_portret;

                                    for ($i = 0; $i < count($Exts) + 1; ++$i) {
                                        $info = getimagesize($pathImg . $Exts[$i]);
                                        $extension = image_type_to_extension($info[2]);
                                        if ($extension) {
                                            // нашли расширение. Все ок. Сохраняем.
                                            $pathImg .= $Exts[$i];
                                            break;
                                        } else if ($i == count($Exts)) {
                                            // Не нашли расширение
                                            // по дефолту jpg ставим
                                            $pathImg .= $Exts[1];
                                        }
                                    }
                                    ?>

                                    <img src="<?php echo $pathImg ?>" alt=""
                                         class="modal-portraits-img">
                                    <?php echo $LANG[$modal]?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"
                                            data-dismiss="modal"><?php echo $LANG['close']?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                else {
                    ?>

                    <a href="#" class="anime" data-target="#<?php echo $modal ?>" data-toggle="modal">
                        <div class="<?php echo $img_portret ?>"></div>
                    </a>
                    <div class="modal fade" id="<?php echo $modal ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modalLabel ?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="<?php echo $modalLabel ?>"><?php echo $LANG[$modalLabel]?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo $LANG[$modal]?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $LANG['close']?></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
        ?>
		<!-- КОНЕЦ ФРАГМЕНТОВ -->

		<!-- Скрипт для анимации -->
		<script type="text/javascript">
			$(".clickDemo").click(function() {
				if (this.getAttribute("value") == "1") { // 1 - остановлено демо
					this.setAttribute("value", "2"); // 2 - запуск
					this.innerHTML="<img src=\"./images/demo_ico.png\"> <? echo $LANG['btnDemoOn']?>";
				} else { // если запущено
					this.setAttribute("value", "1"); // останавливает
					this.innerHTML="<img src=\"./images/demo_ico.png\"> <? echo $LANG['btnDemoOff']?>";
				}
				main();
			});	
			// PHP код для считывания из файла
			<?php
				error_reporting(E_ALL);
				// Открываем файл
				$fp = fopen ( './css/style.css', 'r' );
				// Открыт файл
				if ($fp) {
					// Если открыт то...
					$file_content = "";
					// Читаем до конца файла
					while  (!feof($fp)) {
						// Записываем в переменную из файла
						$file_content .= fgets($fp);
					}
					// Удаляем переносы и ненужные символы
					$file_content = nl2br($file_content);
					$getfile = str_replace(array("}", "{", "\"", "'", 
						"\n", "\r\n", "\r", "<p>", "</p>", "<h1>", "</h1>", 
						"<br>", "<br />", "<br/>"), 
						// Заменяет на
						"", 
						// Откуда заменяем
						$file_content);
					// Закрываем файл
					fclose ( $fp ); 
				} else {
					// Если не открыли файл, то просто хоть что нибудь записываем
					$getfile = "img-lomonosov";
				}
			?>
			// Записываем результат считывания из файла в переменную
			let dataCss = "<?php echo $getfile; ?>";
			// Регулярочка
			let reg = new RegExp('img-[^ ]*', 'g');
			// Массив всех лиц
			let face = [];
			let facemax = 0;
			let faceElement = "";
			while (faceElement = reg.exec(dataCss)) {
				face.splice(facemax, 0, faceElement);
				++facemax;
			}
			--facemax;
			// устанавливаем переменную которая говорит что пользователь никуда не кликал
			let testclick = 'false';
			// Рандомное лицо выбираем
			let faceid;
			// первая функция которая отвечает за подсветку лиц
			function functime1() {
				// проверяем клик ли пользователь куда либо
				if (testclick != 'true'){
					// начало цикла для подсветки всех лиц из массива
					/*let i = 0;
					while (i <= facemax) {
						// меняем атрибут лиц по очереди из массива где добавляем тег style с нужными парраметрами
						document.querySelector('.'+face[i][0]).setAttribute("style", "border: 2px solid white; border-radius: 25px; opacity: 1.0;");
						++i;
					}*/
					$('a.anime div').css({
						'border': '2px solid white',
						 'border-radius': '25px',
						 'opacity': '1.0'
						 }); // .addClass(), removeClass()
				}
			}
			// подсвечивает выбранное лицо
			function functime15(){
				faceid = Math.floor(Math.random() * facemax + 1);
				document.querySelector('.'+face[faceid][0]).setAttribute("style", "border: 6px solid purple; border-radius: 25px; opacity: 1.0;");
			}
			// функция которая отвечает за вывод окна
			function functime2 (){
				// проверяем был ли клик
				if (testclick != 'true'){
					// функция рандома
					function randomInteger(min, max) {
						let rand = min - 0.5 + Math.random() * (max - min + 1)
						rand = Math.round(rand);
						return rand;
					}
					// открываем рандомное лицо
					document.querySelector('.'+face[faceid][0]).click();
					//$('#img-Gagarin').trigger('click');
					// делаем пометку что клик был сделан не человеком
					testclick = 'false';
					// возвращаем обводку, до того пока человек сам не нажмет
					functime1();
				}
			}
			// функция, которая закрывает модальное окно
			function functime3(){
				document.elementFromPoint(0, 0).click();
			}
			// функция которая отвечает за событие клика          
			window.onload = function() {
				document.body.onclick = function(event) {
					// когда человек нажал куда либо меняем значение переменной
					testclick = 'true';
					// цикл который удаляет обводку лиц
					let i = 0;
					while (i <=  facemax) {
						document.querySelector('.'+face[i][0]).removeAttribute("style");
						++i;
					}
				}
			}
			let timer;
			// Главна функция
			// Функция для анимирования всего
			function main() {
				timer = setInterval(function() {
					let element = document.getElementById("clickDemo");
					if (element.getAttribute("value") == "2") {
						setTimeout(functime1, 1000); // ожидание на подсветку
						setTimeout(functime15,2000); // ожидание на выделение выбранного
						setTimeout(functime2, 3000); // ожидание до открытия
						setTimeout(functime3, 4000); // ожидание до закрытия
					}
					else {
						clearInterval(timer);
						return;
					}
					testclick = 'false';
				}, 5000);
			} /*

			Доделать авто-аниме

			*/
		</script>
	</body>
</html>