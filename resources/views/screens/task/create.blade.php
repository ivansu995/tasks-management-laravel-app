@extends('master.userlayout')
@section('title', 'Create new task')
@section('main')
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script>
        $(function () {
            $.ajax({
                url: "http://localhost/tasks-management-laravel/public/task-groups",
                type: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response.task_groups);
                    var data = response.task_groups;
                     $.each(data, function(key, value) {
                        console.log(value);
                        $('#grupe_zadataka').append('<option value="' + value.id +'">' + value.task_group_name + '</option>');
                    });

                },
            });
        });
    </script>
    <h4 class="podnaslov">Create new task</h4>
    <form action="{{ isset($task) ? url('tasks/' . $task->id) : action('App\Http\Controllers\TaskController@store') }}"
          method="post"
          id="prva_forma"
          enctype="multipart/form-data">

        <div class="form-group">
            <label for="title"
                   class="form-label">
                Task title
            </label>
            <input type="text"
                   name="title"
{{--                   naslov--}}
                   id="title"
                   maxlength="191"
                   placeholder="Title of the task..."
                   value="{{ isset($task) ? $task->title : null }}"
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="description"
                   class="form-label">
                Task description
            </label>
            <textarea name="description"
                      id="description"
{{--                      opis--}}
                      placeholder="Description of the task..."
                      class="form-control"
            > {{ isset($task) ? $task->description : null }} </textarea>
        </div>
        <div class="form-group">
            <label for="priority"
                   class="form-label">
                Task priority
            </label>
            <select name="priority"
                    id="priority"
{{--                    prioritet--}}
                    class="form-control">
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{$i}}">
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="start_date"
                   class="form-label">
                Start of the task
            </label>
            <input type="date"
                   name="start_date"
                   id="start_date"
                   value="{{ isset($task) ? $task->start_date : null }}"
{{--                   pocetak_zdatka--}}
                   class="form-control">
        </div>
        <div class="form-group">
            <label for="end_date"
                   class="form-label">
                End of the task
            </label>
            <input type="date"
                   name="end_date"
                   id="end_date"
                   value="{{ isset($task) ? $task->end_date : null }}"
{{--                   kraj_zadatka--}}
                   class="form-control">
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="prilog"--}}
{{--                   class="form-label">--}}
{{--                Izaberite fajlove--}}
{{--            </label>--}}
{{--            <input type="file" name="prilog[]"--}}
{{--                   id="prilog"--}}
{{--                   --}}
{{--                   placeholder="Dodaj fajl"--}}
{{--                   accept=".pdf,.png,.jpg,.jpeg,.txt,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"--}}
{{--                   multiple--}}
{{--                   class="form-control">--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="izvrsioci"--}}
{{--                   class="form-label">--}}
{{--                Izaberite izvrsioce (Ctrl za vise)--}}
{{--            </label>--}}
{{--            <select name="izvrsioci[]"--}}
{{--                    multiple--}}
{{--                    id="izvrsoci"--}}
{{--                    class="form-control">--}}
{{--                <?php foreach ($obicni_korsinici as $korisnik): ?>--}}
{{--                <option value="<?= $korisnik->id?>">--}}
{{--                    <?= $korisnik->ime_prezime?>--}}
{{--                </option>--}}
{{--                <?php endforeach ?>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="tip_korisnika"--}}
{{--                   class="form-label">--}}
{{--                Task Manager--}}
{{--            </label>--}}
{{--            <select name="tip_korisnika"--}}
{{--                    id="tip_korisnika"--}}
{{--                    class="form-control">--}}
{{--                <?php foreach ($korisnici as $korisnik): ?>--}}
{{--                <option value="<?= $korisnik->id?>">--}}
{{--                    <?= $korisnik->ime_prezime ?>--}}
{{--                </option>--}}
{{--                <?php endforeach ?>--}}
{{--            </select>--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="grupe_zadataka"
                   class="form-label">
                Izaberite grupu zadatka
            </label>
            <select name="grupe_zadataka"
                    id="grupe_zadataka"

                    class="form-control">
{{--                @foreach (task_groups as group)--}}
{{--                <option value="{{ group->id }}">--}}
{{--                    {{ group->name }}--}}
{{--                </option>--}}
{{--                @endforeach--}}
            </select>
        </div>
        <div class="form-group">
            <label for="finished"
                   class="form-label">
                Is task finished?
            </label>
            <select name="finished"
                    id="finished"
                    value="{{ isset($task) ? $task->finished : null }}"
{{--                    zavrsen--}}
                    class="form-control">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="canceled"
                   class="form-label">
                Is task canceled?
            </label>
            <select name="canceled"
                    id="canceled"
                    value="{{ isset($task) ? $task->canceled : null }}"
{{--                    otkazan--}}
                    class="form-control">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="slug"
                   class="form-label">
                Enter slug (lowercase title with dash between)
            </label>
            <input type="text"
                   name="slug"
                   id="slug"
                   value="{{ isset($task) ? $task->slug : null }}"
                   class="form-control">
        </div>
        <div class="form-group">
            <input type="submit"
                   value="Save"
                   class="btnSubmit">
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (isset($task))
            @method('PUT')
        @endif
    </form>



@endsection
