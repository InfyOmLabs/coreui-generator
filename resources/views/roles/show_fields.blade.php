<!-- Name Field -->
<div class="form-group">
    <b> {!! Form::label('name', 'Name:') !!}</b>
    <p>{{ $roles->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    <b>{!! Form::label('description', 'Description:') !!}</b>
    <p>{{ $roles->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <b>{!! Form::label('created_at', 'Created At:') !!}</b>
    <p>{{ $roles->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    <b>{!! Form::label('updated_at', 'Updated At:') !!}</b>
    <p>{{ $roles->updated_at }}</p>
</div>

<section>
    <h3>
        Permissions:
    </h3>
</section>
<?php
$permissionList = '';
$prefix = 1;?>
<div class="row">
    @foreach ($permissions as $permissionId => $display_name)
        <div class="col-xl-4">
            <?php
            $permissionList = '';
            $permissionList .= $prefix.'. '.$display_name;
            $prefix += 1;
            echo $permissionList;
            ?>
        </div>
    @endforeach
</div>
