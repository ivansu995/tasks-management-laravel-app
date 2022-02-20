{{--@extends('master.userlayout')--}}
@extends('layouts.app')
@section('title', 'Tasks')
@section('main')
<div class="row justify-content-center">
    <div class="col-md-12">
        <a href="{{ action('App\Http\Controllers\TaskController@create') }}">Create new task</a>
        <table class="table table-hover" id="tabela">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Naslov</th>
                    <th>Opis</th>
                    <th>Prioritet</th>
                    <th>Pocetak zadatka</th>
                    <th>Kraj zadatka</th>
                    <th>Prilozi</th>
                    <th>Izvrsioci</th>
                    <th>Rukovodilac</th>
                    <th>Grupa zadatka</th>
                    <th>Zavrsen</th>
                    <th>Otkazan</th>
                    <th>Otvori zadatak</th>
                </tr>
            </thead>
            <tbody id="tabela_podaci">
                @foreach($tasks as $task)
                    <tr>
                        <td> {{ $task->id }} </td>
                        <td> <a href="{{ url('/tasks/task/'.$task->slug) }}"> {{ $task->title }} </a></td>
                        <td> {{ $task->description }} </td>
                        <td> {{ $task->priority }} </td>
                        <td> {{ date('d.m.Y.', strtotime($task->start_date)) }} </td>
                        <td> {{ date('d.m.Y.', strtotime($task->end_date)) }} </td>
                        <td> Prilog </td>
                        <td> Izvrsioci </td>
                        <td> Rukovodilac </td>
                        <td> {{ $task->taskGroup->task_group_name }} </td>
                        <td> {{ $task->finished }} </td>
                        <td> {{ $task->canceled }} </td>
                        <td>
                            <form action="{{ url('tasks/' . $task->id) }}" method="post">
                                <button type="submit">Delete</button>
                                @method('DELETE')
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </td>
                        <td>
                            <a href="{{ url('tasks/' . $task->id . '/edit') }}"
                                class="btn btn-info">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
