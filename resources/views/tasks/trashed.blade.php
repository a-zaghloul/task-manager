<x-layout>
<div class="container">
    <h1>Trashed Tasks</h1>

    <div class="card m-4">

        <!-- <div class="card-header">
            <h3>Trashed Tasks</h3>
        </div> -->

        <div class="card-body border border-danger">
            <table class="table table-dark table-striped table-bordered">
                @if (count($trashedTasks) > 0)
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Deleted At</th>
                    </tr>
                </thead>
                @endif
                <tbody>
                @forelse ($trashedTasks as $task)
                    <tr>
                        <td class="">{{ $task->title }}</td>
                        <td class="">{{ $task->due_date }}</td>
                        <td class="">{{ $task->deleted_at }}</td>
                    </tr>
                @empty
                    <h3>No trashed tasks</h3>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
</x-layout>
