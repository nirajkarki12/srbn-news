<select class="form-control" id="address_line_2" name="address_line_2" @error('address_line_2') is-invalid @enderror" required autocomplete="address_line_2" autofocus>
  <option selected value="">--select--</option>
	@foreach($districts as $district)
		<option @if($oldValue == $district->name) selected @endif value="{{ $district->name }}">{{ $district->name }}</option>
	@endforeach
</select>