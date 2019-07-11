var id = 1;

$(document).ready(function() {
    // инициализация Графического редактора
    $('#summernote_ru').summernote();
    $('#summernote_en').summernote();
    
	$('.note-style').detach();
	$('.note-para').detach();
	$('.note-table').detach();
	$('.note-insert').detach();
	$('.modal').closest('div').find(".modal-footer").detach();

    // Обработчик кнопки
    $(".btnSave").bind("click", function() {
        // 
        let word = $('#list-element'+id+'-list')[0].innerHTML;
		let ru = $('.russian').closest('div').find(".card-block").html();
		let en = $('.english').closest('div').find(".card-block").html();

        $.ajax({
            url: "./saveIntoDb.php",
            type: "POST",
            data: {
                word:word,
                ru: ru,
                en, en
            }, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){ 
                    //console.log(result);
                    $('.text-ru').val(result.record['ru']);
                    $('.text-en').val(result.record['en']);
                    alert('Изменения сохранены');
                    var markup_ru = $('.summernote_ru').summernote('code');
                    var markup_en = $('.summernote_en').summernote('code');
                    $('.summernote_ru').summernote('destroy');
                    $('.summernote_en').summernote('destroy');
                }else{
                    alert(result.message);
                }
                document.location.href = './admin.php';
				return false;
            },
            error: function(){
                alert('error!');
            }
        });
	    return false;
    });

    // Понимание на что нажимаем в listbox
    $('a[data-toggle="list"]').on('shown.bs.tab', function (e) {
        e.target
        e.relatedTarget
        // считываем строку с id
        let str = e.currentTarget.id;
        // шаблон регулярки
        let reg = new RegExp('[123456789]{1,3}', 'g');
        // получаем  по регулярке id
        id = reg.exec(str)[0];
        // id строки
        //alert(id);
        // AJAX запрос
        $.ajax({
            url: "./selectFromDb.php",
            type: "POST",
            data: {
                id:id
            }, // Передаем данные для записи
            dataType: "json",
            success: function(result) {
                if (result){ 
                    //console.log(result);
                    // rus
                    $('.russian').closest('div').find(".card-block").html(result.record['ru']);
                    // eng
                    $('.english').closest('div').find(".card-block").html(result.record['en']);

                    $('#summernote_ru').summernote({focus: true});
                    $('#summernote_en').summernote({focus: true});
                }else{
                    alert(result.message);
                }
				return false;
            },
            error: function(){
                alert('error!');
            }
        });
    });
});

