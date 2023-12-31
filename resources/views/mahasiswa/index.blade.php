@extends('mahasiswa.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>
                    JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG
                </h2>
            </div>  

            {{-- Search here --}}
            <form action="{{ route('mahasiswa.search') }}" method="post">
                @csrf
                <div class="my-3">
                    <label for="search" class="form-label">Search Mahasiswa Here</label>
                    <input type="text" class="form-control" id="search" name="search">
                </div>
            </form

            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}">
                Input Mahasiswa
                </a>
            </div>
            
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>

    
@endif

<table class="table table-bordered justify-center" >
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>No_Handphone</th>
        <th>Email</th>
        <th>Tanggal Lahir</th>
        <th width="280px">Action</th>
    </tr>@foreach ($mahasiswas as $Mahasiswa)
        <tr>
            <td>{{ $Mahasiswa->Nim }}</td>
            <td>{{ $Mahasiswa->Nama }}</td>
            <td>{{ $Mahasiswa->Kelas }}</td>
            <td>{{ $Mahasiswa->Jurusan }}</td>
            <td>{{ $Mahasiswa->No_Handphone }}</td>
            <td>{{ $Mahasiswa->Email }}</td>
            <td>{{ $Mahasiswa->Tanggal_Lahir }}</td>
            <td>

                
                                <form action="{{ route('mahasiswa.destroy', $Mahasiswa->Nim) }}" method="POST">
                                    <a type="button" class="btn btn-info" href="{{ route('mahasiswa.show', $Mahasiswa->Nim) }}">Show</a>
                                    <a type="button" class="btn btn-primary" href="{{ route('mahasiswa.edit', $Mahasiswa->Nim) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
            </td>
        </tr>
    @endforeach

</table>
{{ $mahasiswas->links() }}
@endsection