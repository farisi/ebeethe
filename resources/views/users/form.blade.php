<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
    <label for="role_id" class="control-label">{{ 'Group' }}</label>
    <select name="role_id" id="role_id" class="select2 form-control">
        <option>Silahkan pilih role</option>
        @foreach($roles as $role)
            <option value="{{$role->id}}" {{isset($data) && $data->roles->contains($role->id) ? 'selected' : ''}}>{{$role->name}}</option>
        @endforeach
    </select>
    {!! $errors->first('role_id', '<p class="error">:message</p>') !!}
</div>


<div class="form-group form-float">
    <div class="form-line">
        <label for="email" class="control-label">{{ 'Email Pengguna' }}</label>
        <input class="form-control" name="email" type="email" id="name"
            value="{{ isset($data->email) ? $data->email : ''}}">
    </div>
    {!! $errors->first('email', '<label class="error">:message</label>') !!}
</div>

<div class="form-group form-float {{ $errors->has('name') ? 'has-error' : ''}}">
    <div class="form-line">
        <label for="nama" class="control-label">{{ 'Nama Pengguna' }}</label>
        <input class="form-control" name="name" type="text" id="name"
            value="{{ isset($data->name) ? $data->name : ''}}">
    </div>
    {!! $errors->first('name', '<label class="error">:message</label>') !!}
</div>

<div class="form-group form-float">
    <div class="form-line">
        <label for="password" class="control-label">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" autocomplete="new-password">
    </div>
    {!! $errors->first('password', '<label class="error">:message</label>') !!}
</div>

<div class="form-group form-float">
    <div class="form-line">
        <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
            autocomplete="new-password">
    </div>
    {!! $errors->first('password_confirmation', '<label class="error">:message</label>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

@push('scripts')
<script type="text/javascript">
{{--  $("#wilayah_id").change(function() {
    if ($(this).val() != 0) {
        $('#instansi_id').html('');
        $('#instansi_id').html('<option> Pilih Instansi </option>');
        $.get("{{route('users.show_instansi')}}/" + $(this).val(), function(instansi) {
            var selectList = $("#instansi_id");
            if (instansi != '') {
                for (var i = 0; i < instansi.length; i++) {
                    var option = document.createElement("option");
                    option.value = instansi[i].id;
                    option.text = instansi[i].name;
                    selectList.append(option);
                }
                var jnsdataselected = $("#wilayah_id option:selected").html();
                $("#instansi_id").selectpicker('refresh');
            } else {
                $("#instansi_id").selectpicker('refresh');
                $('#instansi_id').html('');
                $('#instansi_id').html('<option> Pilih Instansi </option>');
            }
        }, "json");
    }
});  --}}
</script>
@endpush