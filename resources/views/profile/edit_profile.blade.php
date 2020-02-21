<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 5px !important;">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {!! Form::open(['id'=>'editProfileForm','files'=>true]) !!}
            <div class="modal-body">
                <div class="alert alert-danger" style="display: none" id="editProfileValidationErrorsBox"></div>
                {!! Form::hidden('user_id',null,['id'=>'pfUserId']) !!}
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {!! Form::label('name', 'Name:') !!}<span class="required">*</span>
                        {!! Form::text('name', null, ['id'=>'pfName','class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-6 d-flex">
                        <div class="col-sm-6 pl-0">
                            {!! Form::label('photo', 'Profile:') !!}
                            <label class="edit-profile__file-upload"> Choose
                                {!! Form::file('photo',['id'=>'pfImage','class' => 'd-none']) !!}
                            </label>
                        </div>
                        <div class="col-sm-3 preview-image-video-container float-right" style="margin-top: 2px;">
                            <img id='edit_preview_photo' class="img-thumbnail" width="200px;"
                                 src="{{asset('images/user-avatar.png')}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}<span class="required">*</span>
                        {!! Form::text('email', null, ['id'=>'pfEmail','class' => 'form-control','required']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('phone', 'Phone:') !!}
                        {!! Form::text('phone', null, ['id'=>'pfPhone','class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="text-right">
                    {!! Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnPrEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) !!}
                    <button type="button" class="btn btn-light" data-dismiss="modal"
                            style="margin-left: 5px">Cancel
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
