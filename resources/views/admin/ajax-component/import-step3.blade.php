<form method="post" id="step3_form">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                <tr>
                    @foreach($data as $key => $values)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @for($i=0; $i < count($data['current_status']); $i++ )
                    <tr>
                        @foreach($data as $key => $values)
                            <td>
                                <input type="hidden" name="{{ $key . '[]' }}" value="{{ $data[$key][$i] }}">
                                {{ $data[$key][$i] }}
                            </td>
                        @endforeach
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
        <button type="submit" id="_complete_import" class="btn btn-save mt-2 text-capitalize">Complete Import</button>
    </div>
</form>