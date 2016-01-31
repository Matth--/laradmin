<div class="col-sm-12">
    @foreach(['success', 'warning', 'danger', 'info'] as $msg)
        @if(Session::has($msg))
        <div class="box box-{{$msg}} box-solid">
            <div class="box-header">
                <h3 class="box-title">
                    {{ Session::get($msg) }}
                </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
        </div>
        @endif
    @endforeach
</div>