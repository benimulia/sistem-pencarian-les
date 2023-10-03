@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-4">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right mb-2">
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> {{ $message }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('users.verify') }}" method="POST" id="userForm">
        @csrf
        <!-- Form verifikasi pengguna -->
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary" onclick="verifySelectedUsers()">Verifikasi Pengguna
                        Terpilih</button>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
                <th>Verifikasi</th>
                <th>Hapus</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <span class="badge rounded-pill bg-warning">{{ $v }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    </td>
                    <td>
                        <input type="checkbox" name="users_verified[]" value="{{ $user->id }}"
                            {{ !empty($user->email_verified_at) ? 'checked' : '' }} />
                    </td>
                    <td>
                        <input type="checkbox" name="users_to_delete[]" value="{{ $user->id }}" />
                    </td>
                </tr>
            @endforeach
        </table>
    </form>

    {!! $data->render() !!}
@endsection

@section('footer-script')
    <script type="text/javascript">
        var ctext = 'Confirm you want to Delete ? \n'

        function verifySelectedUsers() {
            var checkboxes = document.getElementsByName('users_verified[]');
            var checkedCheckboxes = Array.prototype.slice.call(checkboxes).filter(function(checkbox) {
                return checkbox.checked;
            });

            if (checkedCheckboxes.length > 0 && confirm(ctext)) {
                // Submit form verifikasi pengguna
                document.getElementById('userForm').submit();
            } else {
                alert('Select at least one user to verify.');
            }
        }
    </script>
@endsection
