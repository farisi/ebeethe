@csrf
<div class="form-group  {{$errors->has('company_id') ? 'has-danger' : ''}}">
      <label for="companies">Objek Pajak</label>
      <select id="companies" class="form-control" name="company_id" readonly>
        @if($letter != null)
          <option value="{{$letter->company->id}}" selected>{{$letter->company->name}}</option>
        @endif
        
      </select>
</div>

<div class="form-group {{$errors->has('month') ? 'has-danger' : ''}}">
    <label for="month">Bulan *</label>
    <select id="month" class="form-control" name="month" readonly>
      <option selected disabled>Pilih bulan untuk pajak</option>
      @foreach(config('month') as $value=>$label)
       <option value="{{$value}}"  {{ isset($letter) && $letter->month == $value ? 'selected' :''}} >{{$label}}</option>
      @endforeach
    </select>
    
</div>

<div class="form-group  {{$errors->has('pokok') ? 'has-danger' : ''}}">
     <label for="pokok" class="bmd-label-floating">Pokok</label>
     <input type="text" class="form-control" id="pokok" name="pokok" value="{{$letter->pokok}}" readonly>
</div>


<div class="form-group  {{$errors->has('pinalty_persen') ? 'has-danger' : ''}}">
    <label for="pinalty_persen" class="bmd-label-floating">Denda Dalam persen</label>
    <input type="text" class="form-control" id="pinalty_persen" name="pinalty_persen" value="{{isset($letter) ? $letter->histories->max()->pinalty_persen : ''}}">
    @if($errors->has('pinalty_persen'))
      <label class="error">{{$errors->first('pinalty_persen')}}</label>
      <span class="material-icons form-control-feedback">clear</span>
    @endif
</div>

<div class="form-group  {{$errors->has('penalty') ? 'has-danger' : ''}}">
  <label for="penalty" class="bmd-label-floating">Pinalty</label>
  <input type="text" class="form-control" id="penalty" name="penalty"  value="{{isset($letter) ? $letter->histories->max()->penalty : ''}}">
  @if($errors->has('penalty'))
   <span class="material-icons form-control-feedback">clear</span>
 @endif
</div>

<div class="form-group  {{$errors->has('letter_date') ? 'has-danger' : ''}}">
  <label for="letter_date" class="bmd-label-floating">Tanggal Surat *</label>
  <input type="text" class="form-control datepicker" id="letter_date" name="letter_date" >
  @if($errors->has('letter_date'))
  <label for="periode" class="bmd-label-floating">{{$errors->first('letter_date')}}</label>
   <span class="material-icons form-control-feedback">clear</span>
 @endif
</div>


<div class="form-group  {{$errors->has('periode') ? 'has-danger' : ''}}">
    <label for="periode" class="bmd-label-floating">Periode *</label>
    <input type="text" class="form-control datepicker" id="periode" name="periode" >
    @if($errors->has('periode'))
    <label for="periode" class="bmd-label-floating">{{$errors->first('periode')}}</label>
     <span class="material-icons form-control-feedback">clear</span>
   @endif
  </div>

<div class="form-group " >
  <label for="desc" class="bmd-label-floating">Keterangan</label>
  <textarea class="form-control" id="desc" name="desc">
  </textarea>
</div>


<input type="submit" value="{{$btnlabel}}" class="button-success" />