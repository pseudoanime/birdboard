@forelse($projects as $project)
    <a href="{{$project->path()}}"> {{$project->title}}</a><br>
@empty
    No projects
@endforelse
