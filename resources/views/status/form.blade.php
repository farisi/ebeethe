@csrf
<div class="form-group label-floating {{$errors->has('desc') ? 'has-danger' : ''}}">
    <label for="exampleFormControlTextarea1">Keterangan *</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc" >
        {{@$status->desc}}
    </textarea>
    @if($errors->has('desc'))
    <label class="error">{{$errors->first('desc')}}</label>
    <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>


<input type="submit" value="{{$btnlabel}}" class="button-error" />