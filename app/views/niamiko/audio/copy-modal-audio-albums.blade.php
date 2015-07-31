<div id="chooseAlbum" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Копировать в альбом</h4>
            </div>
            <div class="modal-body">
                {{Form::select('chooseAlbum', $audioAlbums, null)}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary" id="chooseAlbumBtn">ОК</button>
            </div>
        </div>
    </div>
</div>