@extends('layout')

@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="card uper mb-4">
  <div class="card-header">
    Редактирай данните на: {{ $employee->name }}
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('employees.update', $employee->id ) }}" id="create-employee">

            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="name">Име:</label>
                <input type="text" class="form-control" name="name" value="{{ $employee->name }}"/>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ $employee->email }}"/>
            </div>

            <div class="form-group">
                <label for="address">Адрес:</label>
                <input type="text" class="form-control" name="address" value="{{ $employee->address }}"/>
            </div>

            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control" name="phone" value="{{ $employee->phone }}"/>
            </div>

            <div class="form-group">
                <label for="department">Отдел:</label>
                <input type="text" class="form-control" name="department" value="{{ $employee->department }}"/>
            </div>

            <div class="form-group">
                <label for="position">Длъжност:</label>
                <input type="text" class="form-control" name="position" value="{{ $employee->position }}"/>
            </div>

            <div class="form-group">
                <label for="salary">Заплата:</label>
                <input type="number" class="form-control" name="salary" value="{{ $employee->salary }}"/>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary">Редактирай</button>
            </div>

      </form>

      <script>
        $(document).ready(function () {
          $('#create-employee').validate({
              rules: {
                  name: {
                    required: true,
                    minlength:3
                  },
                  email: {
                    required: true,
                    email: true
                  },
                  address: {
                    required: true,
                    minlength: 10
                  },
                  phone: {
                    required: true,
                    digits: true,
                    minlength:10, 
                    maxlength:10
                  },
                  department: {
                    required: true
                  },
                  position: {
                    required: true
                  },
                  salary: {
                    required: true,
                    digits: true
                  }

              }
          });
      });
      </script>

  </div>
</div>
@endsection