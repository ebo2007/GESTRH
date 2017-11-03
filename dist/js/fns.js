/**
 * Created by e.bouh on 23/10/2017.
 */
(function ($, AdminLTE) {
    AdminLTE.loadContent = function (url) {
        $("div.content-wrapper").load(url);
    }

    AdminLTE.clickMenu = function () {
        $("ul.sidebar-menu").delegate("a", "click", function () {
            var id = $(this).attr('id');
            if (id) {
                $.AdminLTE.loadContent("view/" + id + ".php");
            }

        });
    }
    AdminLTE.sortBox = function () {
        $(".connectedSortable").sortable({
            placeholder: "sort-highlight",
            connectWith: ".connectedSortable",
            handle: ".box-header, .nav-tabs",
            forcePlaceholderSize: true,
            zIndex: 999999
        });
        $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
    }

})(jQuery, $.AdminLTE);
