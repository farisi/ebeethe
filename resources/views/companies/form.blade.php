@csrf


<div class="form-group  lable-floating {{$errors->has('company_categories') ? 'has-danger' : ''}}">
    <label>Jenis Objek Pajak *</label>
    <select name="company_categories" class="form-control" id="company_categories">
        @if(isset($company->company_category))
            <option value="{{$company->company_category->id}}" selected>{{$company->company_category->name}}</option>
        @endif
    </select>
    @if($errors->has('company_categories'))    
        <label class="error">{{$errors->first('company_categories')}}</label>
        <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>
<div class="form-group lable-floating {{$errors->has('name') ? 'has-danger' : ''}}">
    <label for="name">Nama *</label>
    <input type="text" id="name" name="name" class="form-control" value="{{@$company->name }}">
    @if($errors->has('name'))
    <label class="error">{{$errors->first('name')}}</label>
    <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>

<div class="form-group lable-floating {{$errors->has('npwp') ? 'has-danger' : ''}}">
    <label for="npwp">NPWP *</label>
    <input type="text" id="npwp" name="npwp" class="form-control" value="{{@$company->npwp }}">
    @if($errors->has('npwp'))
        <label class="error">{{$errors->first('npwp')}}</label>
        <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>

<div class="form-group label-floating ">
    <label for="address">Alamat *</label>
    <textarea id="address" class="form-control" id="address" rows="3" name="address">
        {{@$company->address}}
    </textarea>
    @if($errors->has('address'))
        <label class="error">{{$errors->first('address')}}</label>
        <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>

<div class="form-group lable-floating {{$errors->has('pic') ? 'has-danger' : ''}}">
    <label for="pic">PIC</label>
    <input type="text" id="pic" name="pic" class="form-control" value="{{@$company->pic}}">
</div>

<div class="form-group lable-floating">
    <label for="nopic">No PIC </label>
    <input type="text" id="nopic" name="nopic" class="form-control" value="{{@$company->nopic}}" >
   
</div>


<input type="submit" value="{{$btnlabel}}" class="button-error" />