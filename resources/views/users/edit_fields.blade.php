<!-- Name Field -->
<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}<span class="required">*</span>
    {!! Form::text('name', null, ['id'=>'name', 'class' => 'form-control', 'required']) !!}
</div>
    <!-- Email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}<span class="required">*</span>
        {!! Form::email('email', null, ['id'=>'email', 'class' => 'form-control', 'required']) !!}
    </div>
</div>
<div class="row">
    <!-- Phone Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('phone', 'Phone:') !!}
        {!! Form::number('phone', null, ['id'=>'phone', 'class' => 'form-control']) !!}
    </div>
        <div class="form-group col-sm-3">
            {!! Form::label('photo', 'Profile:') !!}
            <label class="edit-profile__file-upload"> Choose
                {!! Form::file('photo',['id'=>'editUserImage','class' => 'd-none']) !!}
            </label>
            <div class="text-right" style="margin-top: -75px; margin-right: 170px;">
                <img id='edit_preview_photos' class="img-thumbnail" width="100px"
                     src="{{asset($user->image_path)}}"/>
            </div>
        </div>
    </div>
<!-- Submit Field -->
<div class="row">
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
</div>
</div>