@csrf
<div class="form-group label-floating {{$errors->has('name') ? 'has-danger' : ''}}">
    <label for="name">Jenis Objek Pajak</label>
    <input name="name" class="form-control" />
    @if($errors->has('name'))
    <label class="error">{{$errors->first('name')}}</label>
    <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>


<input type="submit" value="{{$btnlabel}}" class="button-error" />