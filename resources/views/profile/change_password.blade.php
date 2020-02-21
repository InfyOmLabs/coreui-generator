<div id="ChangePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="border-radius: 5px !important;">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {!! Form::open(['id'=>'changePasswordForm','files'=>true]) !!}
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="alert alert-danger" style="display: none" id="editPasswordValidationErrorsBox"></div>
                {!! Form::hidden('user_id',null,['id'=>'pfUserId']) !!}
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {!! Form::label('current password', 'Current Password:') !!}<span
                                class="required confirm-pwd">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfCurrentPassword" type="password"
                                   name="password_current" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('password', 'New Password:') !!}<span class="required confirm-pwd">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewPassword" type="password"
                                   name="password" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('password_confirmation', 'Confirm Password:') !!}<span
                                class="required confirm-pwd">*</span>
                        <div class="input-group">
                            <input class="form-control input-group__addon" id="pfNewConfirmPassword" type="password"
                                   name="password_confirmation" required>
                            <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="icon-ban icons"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    {!! Form::button('Save', ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnPrPasswordEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) !!}
                    <button type="button" class="btn btn-light" data-dismiss="modal"
                            style="margin-left: 5px">Cancel
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<?php
