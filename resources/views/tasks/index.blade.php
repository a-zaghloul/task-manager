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
                        <input type="date" name="due_date" id="end_date" required class="form-control" value="{{ old('due_date')  }}" autocomplete="on">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-header">
            <form method="GET" action="{{ route('tasks.index') }}">
                <div class="row card-header bg-light border-0">
                    <div class="col">
                        <input type="input" name="title" placeholder="Title" id="title" class="form-control" value="{{ request('title') }}">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-primary" >Filter</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table ">
                @if (count($tasks) > 0)
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">
                            <a href="{{ route('tasks.index', array_merge(request()->all(), ['sortBy' => 'title', 'direction' => request('sortBy') == 'title' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                Title @if(request('sortBy') == 'title') {{ request('direction') == 'asc' ? '↑' : '↓' }} @endif
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('tasks.index', array_merge(request()->all(), ['sortBy' => 'due_date', 'direction' => request('sortBy') == 'due_date' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                Due Date @if(request('sortBy') == 'due_date') {{ request('direction') == 'asc' ? '↑' : '↓' }} @endif
                            </a>
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                @endif
                <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td scope="row" class="">
                            <div>
                                <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}> -->
                                    <button class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                            <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                        </svg>
                                    </button>
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
                @empty
                    <h3>No tasks</h3>
                @endforelse

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
                @if (count($completedTasks) > 0)
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Title</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Completed At</th>
                    </tr>
                </thead>
                @endif
                <tbody>
                @forelse ($completedTasks as $task)
                    <tr>
                        <td scope="row" class="">
                            <div>
                                <!-- <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </form> -->
                                <form action="/tasks/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!-- <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}> -->
                                    <button class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="">{{ $task->title }}</td>
                        <td class="">{{ $task->due_date }}</td>
                        <td class="">{{ $task->completed_at }}</td>
                    </tr>
                @empty
                    <h3>No completed tasks</h3>
                @endforelse

                </tbody>
            </table>
        </div>
        <!--div>
            $tasks->links()
        </div-->
    </div>
</div>
</x-layout>
