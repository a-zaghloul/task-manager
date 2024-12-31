<x-layout>
<div class="container">
    <h1>Tasks</h1>

    <div class="card m-4">

        <div class="card-header">
            <form action="/tasks" method="POST">
                @csrf
                <div class="row">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col">
                        <input type="text" name="title" placeholder="New Task" required class="form-control" value="{{ old('title') }}" autocomplete="on" autofocus>
                    </div>
                    <div class="col">
                        <input type="date" name="due_date" id="end_date" reuired class="form-control" value="{{ old('due_date')  }}" autocomplete="on">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Due Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td scope="row" class="">
                            <div>
                                <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </form>
                            </div>
                        </td>
                        <td class="">{{ $task->title }}</td>
                        <td class="">{{ $task->due_date }}</td>
                        <td class="d-flex">
                            <!-- <button form="delete-form" class="btn btn-danger ms-auto" onclick="return confirm('Are you sure you want to delete this task ({{ $task->title }})?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button> -->
                            <span class="float-end ms-auto">
                                <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task ({{ $task->title }})?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    <!-- <form method="POST" action="/tasks/{{ $task->id }}" id="delete-form" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form> -->
                @endforeach

                </tbody>
            </table>
        </div>
        <!--div>
            $tasks->links()
        </div-->
    </div>

    <div class="card m-4">

        <div class="card-header">
            <h4>Completed</h4>
        </div>

        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Completed At</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($completedTasks as $task)
                    <tr>
                        <td scope="row" class="">
                            <div>
                                <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </form>
                            </div>
                        </td>
                        <td class="">{{ $task->title }}</td>
                        <td class="">{{ $task->due_date }}</td>
                        <td class="">{{ $task->completed_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!--div>
            $tasks->links()
        </div-->
    </div>
</div>
</x-layout>
