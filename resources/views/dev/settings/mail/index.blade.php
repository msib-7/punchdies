
<form action="{{ route('dev.email.store') }}" method="POST">
    @csrf
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Add Email</label>
        <div class="col-sm-4">
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-info">Add</button>
        </div>
    </div>
</form>
<div class="mb-3 row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Email Registered:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($email_dev as $email)
                    <tr>
                        <td>
                            <span class="d-flex align-items-center">
                                - {{ $email->email }} <a href="" class="mx-5"><i class="ki-solid ki-trash-square text-danger fs-2x"></i></a>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>