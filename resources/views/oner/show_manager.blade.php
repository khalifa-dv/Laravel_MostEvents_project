@extends('layouts.template')

@section('content')
<br><br><br>

<div class="container">

    <div class="row bg-light mt-5">
        <div class="col-3 px-5 pt-2">
            <img src="{{$oner->logo()}}" class="w-100">
        </div>
        <div class="col-9 pt-5 mt-5">
            <div class="float-right">
                <a href="{{route('oner.edit',$oner->id)}}" class="btn btn-light">
                    <i class="fas fa-cog mr-2"></i>edit
                </a>
            
            </div>
            <h1 class="text-muted mt-5">{{$oner->name}}</h1>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-reserve-tab" data-toggle="pill" href="#v-pills-reserve" role="tab" aria-controls="v-pills-reserve" aria-selected="false"><i class="fas fa-handshake mr-2"></i> Réservation</a>
               
              
                <a class="nav-link" id="v-pills-settings-tab" href="{{route('oner.edit',$oner->id)}}"><i class="fas fa-cog mr-2"></i> Settings</a>
            </div>
        </div>

        <div class="col-md-9">
         
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade active show" id="v-pills-reserve" role="tabpanel" aria-labelledby="v-pills-reserve-tab"> 
                     
                    @if (count($oner->booking()) >= 1)
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">fullname</th>
                            <th scope="col">date</th>
                            <th scope="col">From</th>
                            <th scope="col">to</th>
                            <th scope="col">note</th>
                            <th scope="col">action</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                          
                          @foreach($oner->booking() as $item)
                            <tr class="eventRow{{ $item->id }}">
                        
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->managerFullName()}}</td>
                            <td>{{$item->date}}</td>
                            <td>{{$item->from}}</td>
                            <td>{{$item->to}}</td>
                            <td>{{$item->note}}</td>
                            <td>                     
                         
                             <div class="btn-group">
                                             @if($item->validate == 0)
                                                        <form id="status-form-{{ $item->id }}" action="{{ route('approve-booko',$item->id) }}" style="display: none;" method="POST">
                                                            @csrf
                                                            </form>
                                                        <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('allow ?')){
                                                                event.preventDefault();
                                                                document.getElementById('status-form-{{ $item->id }}').submit();
                                                                }else {
                                                                event.preventDefault();
                                                                }"><i class="material-icons">done</i>
                                                                </button>
                                                                
                                                @endif 
                                 <form action="" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                         <button  Cevent_id="{{ $item->id }}" class="delete_btn btn-sm btn-danger">Delete</button>
                                 </form> 
                                 </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @else
                        <div class="card-body table-responsive">
                            <p class="text-center fw-bolder ">NO reservation to show  </p>
                        </div>
                    @endif
                     </div>
                     </div>
                
                
        </div>
        

    

</div>


@endsection
@section('scripts')
<script>
    $(document).on('click', '.delete_btn', function(e) {
        e.preventDefault();
        var Cevent_id = $(this).attr('Cevent_id');
        $.ajax({
            type: 'post',
            url: "{{ route('book.delete')}}",
            data: {
                '_token': "{{ csrf_token() }}",
                'id': Cevent_id
            },
            success: function(data) {
                if (data.status == true) {
                    // $('#success_msg').show();



                }
                $('.eventRow' + data.id).remove();
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success("Events Added successfully");
            },
            error: function(reject) {}
        });
    });
</script>
@stop