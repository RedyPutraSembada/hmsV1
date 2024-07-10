<div style="max-height: 80%; overflow-y: auto;" class="mt-3">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach ($datas as $key => $data)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $data->name }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $data->name }}-tab-pane" type="button" role="tab" aria-controls="{{ $data->name }}-tab-pane" aria-selected="{{ $key == 0 ? true : false }}">{{ $data->name }}</button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach ($datas as $key => $data )
            <div class="tab-pane fade show {{ $key == 0 ? 'active' : '' }}" id="{{ $data->name }}-tab-pane" role="tabpanel" aria-labelledby="{{ $data->name }}-tab" tabindex="0">
                <div class="d-flex flex-wrap">
                    @foreach ($data->product as $ky => $value)
                        <div class="card image-container" style='width: 200px; height: 200px; margin: 5px; position: relative;'>
                            @if ($value->type == 'product' && $value->qty == 0)
                                <h5 class="text-center" style="margin-bottom: -30px; z-index: 3;">Habis</h5>
                            @else
                                <button type="button" onclick="Add({{ $value->id }})" style="position: absolute; top: 5px; right: 5px; border-radius: 50%; border: 0; padding: 5px 10px; background-color: rgb(249, 118, 118); color: white;"><i class="fas fa-plus"></i></button>
                            @endif
                            <img class="card-img-top" src="{{ asset('storage/' . $value->image) }}" alt=''>
                            <h6 class="text-center m-auto">{{ $value->name }}</h6>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        function Add(id) {
            $.get(`{{ url('menu/${id}') }}`);
            location.reload();
        }
    </script>
