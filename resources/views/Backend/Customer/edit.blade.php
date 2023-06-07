<!-- Edit Customer -->
<div class="modal fade" id="Editcustomer{{$customer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Edit Customer </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('customers.update',$customer->id)}}" method="post" autocomplete="off" >
                    @method('POST')
                    @csrf
                    {{--Input hidden id--}}
                    <input type="hidden" name="id" value="{{$customer->id}}"/>

                    <div class="row">

                        <div class="col">
                            <label> Name </label>
                            <input type="text" name="first_name" class="form-control">
                            {{ $customer -> name }}
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Confirm</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

