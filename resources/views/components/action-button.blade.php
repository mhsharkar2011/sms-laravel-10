@props(['userId'])

<a class="btn btn-primary btn-sm" href="{{ route('profile.show', $userId) }}"><i class="far fa-eye"></i></a>
<a class="btn btn-info btn-sm" href="{{ route('profile.edit',$userId) }}"><i class="fas fa-pen"></i></a>
<a class="btn btn-danger btn-sm" href="{{ route('profile.destroy',$userId) }}"><i class="fas fa-user-minus"></i></a>
<a class="btn btn-warning btn-sm" href="{{ route('profile.restore',$userId) }}"><i class="fa fa-window-restore" aria-hidden="true"></i></a>