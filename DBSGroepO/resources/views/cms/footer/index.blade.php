@extends('layouts.cms')

@section('content')
    <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Footer content</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-1">Adres: {{$footerdata->address}}</p> <br>
                            <p class="mb-1">Email: {{$footerdata->email}}</p> <br>
                            <p class="mb-1">Telefoonnummer: {{$footerdata->phonenumber}}</p> <br>
                            <p class="mb-1">Secretaris email: {{$footerdata->secretaryemail}}</p> <br>
                            <p class="mb-1">Kvk: {{$footerdata->kvk}}</p> <br>
                            <p class="mb-1">Facebook: {{$footerdata->facebookurl}}</p>

                            <div class="d-flex flex-row justify-content-end mt-4">
                                <a href="{{ route('footer.edit', $footerdata->id) }}" class="mr-2 btn btn-primary">Bijwerken</a>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

