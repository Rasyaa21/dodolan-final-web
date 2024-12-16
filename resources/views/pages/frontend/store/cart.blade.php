@extends('layouts.store')

@section('title', 'Pembayaran')

@section('content')
<section class="container">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Checkout</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">First Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="contact-info-vertical">Mobile</label>
                                        <input type="number" id="contact-info-vertical" class="form-control" name="contact" placeholder="Mobile">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="mb-1 btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="mb-1 btn btn-light-secondary me-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

