@extends('layout')

@section('content')

<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="uper">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  @if($employees)

    <table class="table table-bordered table-striped table-responsive">
    <thead>
        <tr>
          <td>ID</td>
          <td>Име</td>
          <td>Email</td>
          <td>Адрес</td>
          <td>Телефон</td>
          <td>Отдел</td>
          <td>Длъжност</td>
          <td>Заплата</td>
          <td colspan="2"></td>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{$employee->id}}</td>
            <td>{{$employee->name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->address}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->department}}</td>
            <td>{{$employee->position}}</td>
            <td>{{$employee->salary}} лв.</td>
            <td><a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-sm btn-primary">Редактирай</a></td>
            <td>
                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" type="submit">Изтрий</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

  {{ $employees->links() }}

  @else

  <div class="bg-light p-5 rounded mt-4">
    <p class="lead">Все още нямате служители</p>
    <a class="btn btn-lg btn-primary" href="{{ route('employees.create') }}" role="button">Добави служител »</a>
  </div>

  @endif

<div>
@endsection