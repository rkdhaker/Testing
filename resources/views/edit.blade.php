<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        <div class="modal-body p-0">
            <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                    <h4 class="font-weight-bolder text-info text-gradient">
                        {{ __('Edit  User') }}</h4>
                </div>
                <div class="card-body">
                    <form autocomplete="off" id="update_user" action="" enctype="multipart/form-data" method="post"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('POST')
                        <input type="hidden" id="edit_id" value="{{ $user->id}}">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Phone No.</label>
                            <input type="tel" name="phone" class="form-control" id="exampleInputEmail1" value="{{ $user->phone }}">
                        </div>
                        <button type="submit"  class="btn btn-primary mt-2 mb-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
