<?php
    print_r($_POST);
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;color: #0c0c0c;">
    <div class="modal-dialog">
        <div class="modal-content" style="overflow: hidden;">
            <div class="modal-header">
                <button type="button" class="close fa fa-times" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="myModalLabel">Nouveau service</h4>
            </div>
            <div class="modal-body" style="max-height: 718px; overflow-y: auto;">
                <form>
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Nom Service">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-sitemap"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Abbréviation">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>