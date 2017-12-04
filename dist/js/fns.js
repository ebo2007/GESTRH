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

    AdminLTE.msgBox = function () {
        $.notifyDefaults({
            element: 'body',
            position: null,
            type: "info",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "bottom",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 10310,
            delay: 9000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated flipInY',
                exit: 'animated flipOutX'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button>' +
                        '<span data-notify="icon"></span> ' +
                        '<span data-notify="title">{1}</span>' +
                        '<span data-notify="message">{2}</span>' +
                        '<div class="progress" data-notify="progressbar">' +
                            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                        '</div>' +
                        '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>'
        });

    }

    AdminLTE.editDept = function () {
        $("#myModal").on("shown.bs.modal", function(e) {
            $("#dep_frm").trigger('reset');
            var link = $(e.relatedTarget);
            var data = $.parseJSON(link.attr('data-val').replace(/\'/g, '"'));
            var count = 0;
            $.each(data, function(key, value){
                $("#dep_frm [name="+key+"]").val(value);
                count++;
            });
            if(count > 1){
                $("#dep_frm select[name='parent']").removeAttr('disabled');
            }else{
                $("#dep_frm select[name='parent']").attr('disabled', 'disabled');
            }
        });

        $( "#dep_frm select[name='parent']" ).change(function() {
            $( "#dep_frm select[name='parent'] option:selected" ).each(function() {
                $( "#dep_frm input[name='parent']" ).val( $( this ).val() );
            });
        }).trigger( "change" );

        $("#dep_frm input[type='submit']").on('click', function(e){
            $.ajax( {
                url : "control/handler/departementHdl.php",
                type : "POST",
                data : $('#dep_frm').serialize(),
                success : function(data) {
                    $.AdminLTE.loadContent('view/departements.php');
                    $.notify(data);
                }
            });
        });

        $("#msgBox").on("shown.bs.modal", function(e) {
            $("#msgBox").trigger('reset');
            var elem = $(e.relatedTarget);
            var data = $.parseJSON(elem.attr('data-val').replace(/\'/g, '"'));
            $.each(data, function(key, value){
                $("#frm_delete [name="+key+"]").val(value);
            });
            $("#msgBox .modal-body h4 i").text(data['nom']);
        });

        $("#frm_delete input[type='submit']").on('click', function(e){
            $.ajax( {
                url : "control/handler/departementHdl.php",
                type : "POST",
                data : $('#frm_delete').serialize(),
                success : function(data) {
                    $.AdminLTE.loadContent('view/departements.php');
                    $.notify(data);
                }
            });
        });

    }

})(jQuery, $.AdminLTE);
