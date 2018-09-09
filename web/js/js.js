// JavaScript Document

$(document).ready(function() {
    //Действия по умолчанию
    $(".tab_content").hide(); //скрыть весь контент
    $("ul.tabs > li:first").addClass("active").show(); //Активировать первую вкладку
    $(".tab_content:first").show(); //Показать контент первой вкладки

    //Событие по клику
    $("ul.tabs > li").click(function() {
        $("ul.tabs > li").removeClass("active"); //Удалить "active" класс
        $(this).addClass("active"); //Добавить "active" для выбранной вкладки
        $(".tab_content").hide(); //Скрыть контент вкладки
        var activeTab = $(this).find("a").attr("href"); //Найти значение атрибута, чтобы определить активный таб + контент
        $(activeTab).fadeIn(); //Исчезновение активного контента
        return false;
    });

    $(document).on('pjax:end', function () {
        var $btns = $("[data-toggle='popover-x']");
        if ($btns.length) {
            $btns.popoverButton();
        }
    });




});